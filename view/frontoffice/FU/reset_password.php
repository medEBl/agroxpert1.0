<?php
session_start();
require_once('C:/xampp/htdocs/ProjetWeb3/controller/userc.php');

// Check if verification code exists in session
if (!isset($_SESSION['reset_code']) || !isset($_SESSION['reset_email'])) {
    header("Location: ../Home/index.php");
    exit();
}

// Handle form submission
if (isset($_POST['reset_password_submit'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    
    // Validate passwords match
    if ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match";
    } else {
        try {
            // Create instance of UserController
            $userController = new Userc();
            
            // Call updatePassword method
            $result = $userController->updatePassword($_SESSION['reset_email'], $newPassword);
            
            if ($result['success']) {
                // Clear session variables
                unset($_SESSION['reset_code']);
                unset($_SESSION['reset_email']);
                
                // Redirect to login with success message
                header("Location: index.php?reset=success");
                exit();
            } else {
                $error = $result['message'];
            }
        } catch (Exception $e) {
            // Log the error for debugging
            error_log("Password reset error: " . $e->getMessage());
            $error = "An error occurred while resetting password. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <header>
        <div class="agoxpert">
            <h1>AGROXPERT</h1>
        </div>
           
               
    </header>

    <main>
        <div class="login">
            <form action="reset_password.php" method="POST" onsubmit="return validateResetPassword()">
                <h1>Reset Password</h1>
                <p>Please enter your new password.</p>
                <div class="input">
                    <input type="password" placeholder="New Password" name="new_password" id="new-password">
                    <i class='bx bx-lock-alt'></i>
                </div>
                <div id="new-password-error" class="error"></div>
                
                <div class="input">
                    <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm-password">
                    <i class='bx bx-lock-alt'></i>
                </div>
                <div id="confirm-password-error" class="error"></div>
                
                <?php if (isset($error)) { ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php } ?>
                <br>
                <button type="submit" name="reset_password_submit" class="btn">Reset Password</button>
            </form>
        </div>
    </main>

   

    <script>
        function validateResetPassword() {
            const newPassword = document.getElementById('new-password').value.trim();
            const confirmPassword = document.getElementById('confirm-password').value.trim();
            let valid = true;

            // Clear previous error messages
            document.getElementById('new-password-error').innerText = "";
            document.getElementById('confirm-password-error').innerText = "";

            // Validate new password
            if (!newPassword) {
                document.getElementById('new-password-error').innerText = "New password is required.";
                valid = false;
            } else if (newPassword.length < 8) {
                document.getElementById('new-password-error').innerText = "Password must be at least 8 characters long.";
                valid = false;
            }

            // Validate confirm password
            if (!confirmPassword) {
                document.getElementById('confirm-password-error').innerText = "Please confirm your password.";
                valid = false;
            } else if (newPassword !== confirmPassword) {
                document.getElementById('confirm-password-error').innerText = "Passwords do not match.";
                valid = false;
            }

            return valid;
        }
    </script>
</body>
</html>
