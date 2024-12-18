

<?php
require_once('C:/xampp/htdocs/ProjetWeb3/controller/userc.php');

require_once 'C:/xampp/htdocs/ProjetWeb3/vendor/autoload.php';
require_once 'C:/xampp/htdocs/ProjetWeb3/controller/userc.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



if (isset($_POST["reset_request_submit"])) {
    // Generate random verification code
    $verificationCode = rand(100000, 999999);

    // Get email from POST
    $userEmail = $_POST['email'];

    // Validate email
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }
    

    
    
    
    

    
    // Your code here
    

    $mail = new PHPMailer(true);

    try {
        // Debugging
        $mail->SMTPDebug = 2;

        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.mailersend.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'MS_GvyFJG@trial-pq3enl6o210l2vwr.mlsender.net';
        $mail->Password = 'KdVgV1tyjN45UMKd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('MS_GvyFJG@trial-pq3enl6o210l2vwr.mlsender.net', 'AgroXpert');
        $mail->addAddress($userEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Verification Code';
        $mail->Body = "Your verification code is: <b>$verificationCode</b>";

        $mail->send();

        // Store verification code in session
        session_start();
        $_SESSION['reset_code'] = $verificationCode;
        $_SESSION['reset_email'] = $userEmail;

        header("Location: verify_reset_code.php");
        exit();

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header("Location: ../Home/index.php");
    exit();
}
?>
