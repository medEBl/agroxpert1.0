<?php
session_start();

// Check if verification code exists in session
if (!isset($_SESSION['reset_code']) || !isset($_SESSION['reset_email'])) {
    header("Location: ../Home/index.php");
    exit();
}

// Handle form submission
if (isset($_POST['verify_code_submit'])) {
    $submittedCode = $_POST['verification_code'];
    
    // Verify the submitted code matches the stored code
    if ($submittedCode == $_SESSION['reset_code']) {
        // Code is correct, redirect to reset password page
        header("Location: reset_password.php");
        exit();
    } else {
        $error = "Invalid verification code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Reset Code</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="font.css">
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
    <header >
        <div class="AgroXpert">
            <h1>AgroXpert</h1>
        </div>
        
    </header>

    <main>
        <div class="login">
            <form action="verify_reset_code.php" method="POST" onsubmit="return validateVerificationCode()">
                <h1>Verify Reset Code</h1>
                <p>Please enter the verification code sent to your email.</p>
                <div class="input">
                    <input type="text" placeholder="Verification Code" name="verification_code" id="verification-code">
                    <i class='bx bx-lock-alt'></i>
                </div>
                <?php if (isset($error)) { ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php } ?>
                <div id="verification-code-error" class="error"></div>
                <br>
                <button type="submit" name="verify_code_submit" class="btn">Verify Code</button>
            </form>
        </div>
    </main>

   
    <script>
        function validateVerificationCode() {
            const code = document.getElementById('verification-code').value.trim();
            let valid = true;

            document.getElementById('verification-code-error').innerText = "";

            if (!code) {
                document.getElementById('verification-code-error').innerText = "Verification code is required.";
                valid = false;
            }

            return valid;
        }
    </script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #6E332C;
            padding: 20px;
        }

        .ohara h1 {
            color: #fff;
            text-align: center;
            margin: 0;
        }

        .navigation {
            text-align: center;
            margin-top: 20px;
        }

        .navigation a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s;
        }

        .navigation a:hover {
            color: #ffb600;
        }

        .oval-button {
            background-color: #d25049;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .oval-button:hover {
            background-color: #ff9c00;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .login {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .login p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }

        .input {
            position: relative;
            margin-bottom: 20px;
        }

        .input input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: border 0.3s;
        }

        .input input:focus {
            border-color: #ffb600;
        }

        .input i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #777;
        }

        .btn {
            background-color: #d25049;
            color: #fff;
            border: none;
            padding: 12px 20px;
            width: 100%;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #ff9c00;
        }

        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .footer-links a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
        }

        .footer-links a:hover {
            color: #ffb600;
        }

        .footer-socials .social-icon {
            color: #fff;
            font-size: 24px;
            margin: 0 10px;
        }

        .footer-socials .social-icon:hover {
            color: #ffb600;
        }

        @media screen and (max-width: 768px) {
            .navigation a {
                margin: 0 10px;
                font-size: 14px;
            }

            .login {
                padding: 20px;
                width: 90%;
            }

            .footer-links a {
                font-size: 14px;
            }
        }
    </style>
</body>
</html>
