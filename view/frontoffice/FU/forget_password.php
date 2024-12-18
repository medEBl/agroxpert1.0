<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="font.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
        /* General styling for the body and page */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fc;
    margin: 0;
    padding: 0;
}

/* Header Styling */
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

/* Oval Button Styling */
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

/* Main Section Styling */
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

/* Input Field Styling */
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

/* Button Styling */
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

/* Error Message Styling */
.error {
    color: red;
    font-size: 0.9em;
    margin-top: 5px;
}

.rl {
    margin-top: 15px;
}

.rl p {
    font-size: 14px;
    color: #555;
}

.rl a {
    color: #ffb600;
    text-decoration: none;
}

.rl a:hover {
    text-decoration: underline;
}

/* Footer Styling */
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

/* Responsive Design */
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

    .footer-socials .social-icon {
        font-size: 20px;
    }
}

    </style>
</head>
<body>
    
    <main>
        <div class="login">
            <form method="POST" action="sendpassword_reset.php" onsubmit="return validateForgotPassword()">
                <h1>Forgot Password</h1>
                <p>Please enter your registered email address to reset your password.</p>
                <div class="input">
                    <input type="text" placeholder="E-mail" name="email" id="forgot-email">
                    <i class='bx bxs-envelope'></i>
                </div>
                <div id="forgot-email-error" class="error"></div>
                <br>
                <button type="submit" name="reset_request_submit" class="btn">Reset Password</button>
                <div class="rl">
                    <p>Remembered your password? <a href="../Log_in/user.php">Log In</a></p>
                </div>
            </form>
        </div>
    </main>

    

    

    <script>
        // Validate form before submission
        function validateForgotPassword() {
            const email = document.getElementById('forgot-email').value.trim();
            let valid = true;

            // Clear previous error messages
            document.getElementById('forgot-email-error').innerText = "";

            // Validate email
            if (!email) {
                document.getElementById('forgot-email-error').innerText = "E-mail is required.";
                valid = false;
            }

            return valid;
        }

        
    </script>
</body>
</html>
