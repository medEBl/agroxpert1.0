<?php
class config
{
    private static $pdo = null;

    public static function getConnexion()
    {
        // Vérifier si la connexion PDO existe déjà
        if (!isset(self::$pdo)) {
            // Paramètres de connexion à la base de données
            $servername = "localhost";   // Hôte, par défaut 'localhost' pour XAMPP
            $username = "root";          // Nom d'utilisateur par défaut sur XAMPP
            $password = "";              // Mot de passe vide par défaut sur XAMPP
            $dbname = "agroxpert_db";  // Nom de votre base de données (à modifier si nécessaire)

            try {
                // Créer la connexion PDO à la base de données
                self::$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                // Définir les attributs pour gérer les erreurs et le mode de récupération
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // Gestion des erreurs
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  // Mode de récupération : tableau associatif
            } catch (Exception $e) {
                // Si une erreur de connexion se produit, l'afficher
                die('Erreur: ' . $e->getMessage());
            }
        }

        // Retourner l'instance de connexion PDO
        return self::$pdo;
    }
}

// Appel de la méthode pour tester la connexion
config::getConnexion();
?>
