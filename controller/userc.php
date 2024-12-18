<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/modelUser.php';

class userc
{
    public function updatePassword($email, $newPassword) 
    {
        try {
            $db = config::getConnexion();
            
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            // Prepare SQL query to update password
            $sql = "UPDATE user SET password = :password WHERE email = :email";
            $stmt = $db->prepare($sql);
            
            // Bind parameters
            $stmt->bindValue(':password', $hashedPassword);
            $stmt->bindValue(':email', $email);
            
            // Execute the query
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Password updated successfully'];
            } else {
                return ['success' => false, 'message' => 'Failed to update password'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }
    // Fetch all users from the database
    public function listUser($search = '', $filters = [])
    {
        $sql = "SELECT * FROM user WHERE 1=1";
        $db = config::getConnexion();

        // Add conditions for search and filters
        if (!empty($search)) {
            $sql .= " AND (name LIKE :search OR email LIKE :search)";
        }
        if (!empty($filters['typeUser'])) {
            $sql .= " AND typeUser = :typeUser";
        }
        if (!empty($filters['registration_date'])) {
            $sql .= " AND DATE(registration_date) = :registration_date";
        }

        try {
            $stmt = $db->prepare($sql);

            // Bind search parameter if present
            if (!empty($search)) {
                $stmt->bindValue(':search', '%' . $search . '%');
            }

            // Bind role filter if present
            if (!empty($filters['typeUser'])) {
                $stmt->bindValue(':typeUser', $filters['typeUser']);
            }

            // Bind registration date filter if present
            if (!empty($filters['registration_date'])) {
                $stmt->bindValue(':registration_date', $filters['registration_date']);
            }

            $stmt->execute();
            return $stmt->fetchAll(); // Fetch all matching users
        } catch (Exception $e) {
            die('Error fetching users: ' . $e->getMessage());
        }
    }


    // Delete a user by ID
    public function deleteUser($id)
    {
        $sql = "DELETE FROM user WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Fetch a single user by ID
    public function getUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

    // Update user data by ID
    public function updateUser($name, $email, $password, $adresse, $typeUser, $id)
    {
        // Si le mot de passe est vide, on ne le met pas à jour
        if (empty($password)) {
            $sql = "UPDATE user SET name = :name, email = :email, adresse = :adresse, typeUser = :typeUser WHERE id = :id";
        } else {
            $sql = "UPDATE user SET name = :name, email = :email, password = :password, adresse = :adresse, typeUser = :typeUser WHERE id = :id";
        }
    
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            if (!empty($password)) {
                $stmt->bindValue(':password', $password, PDO::PARAM_STR); // Hachage du mot de passe
            }
            $stmt->bindValue(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindValue(':typeUser', $typeUser, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

    public function getUsers()
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();  // Connexion à la base de données
        try {
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retourne tous les utilisateurs sous forme de tableau
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    // Ajouter cette méthode à la classe userc
public function getUserByEmail($email)
{
    $sql = "SELECT * FROM user WHERE email = :email";
    $db = config::getConnexion(); // Connexion à la base de données
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne l'utilisateur si trouvé
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
// Method to handle user login
public function loginUser($email, $password)
{
    $sql = "SELECT * FROM user WHERE email = :email";
    $db = config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Check if the role is "Acheteur"
            if ($user['typeUser'] !== 'Acheteur') {
                return ['success' => false, 'message' => 'Access denied: You are not allowed to log in.'];
            }

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Successful login
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['login'] = true;

                return ['success' => true];
            } else {
                // Incorrect password
                return ['success' => false, 'message' => 'Invalid password.'];
            }
        } else {
            // User not found
            return ['success' => false, 'message' => 'User not found.'];
        }
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
    }
}

// Method to handle user registration (signup)
public function createUser($username, $email, $password, $typeUser, $adresse)
{
    if (empty($username) || empty($email) || empty($password) || empty($typeUser) || empty($adresse)) {
        return ['success' => false, 'message' => 'All fields are required.'];
    }

    try {
        $db = config::getConnexion();

        // Check if email already exists
        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Email is already taken
            return ['success' => false, 'message' => 'Invalid email: This email is already in use.'];
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert a new user
        $query = "INSERT INTO user (name, email, password, typeUser, adresse) VALUES (:name, :email, :password, :typeUser, :adresse)";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':name', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':typeUser', $typeUser);
        $stmt->bindParam(':adresse', $adresse);

        // Execute the query
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'User registered successfully!'];
        } else {
            return ['success' => false, 'message' => 'Error: Could not register user.'];
        }

    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
    }
}




   
}



?>
