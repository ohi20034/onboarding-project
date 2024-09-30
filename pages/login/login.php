<?php
session_start();
require_once '../../models/user_model.php';
$message = "";


if (isset($_SESSION['login']) && $_SESSION['login'] == "success") {
    header("Location: ../../index.php");
    exit();
}
if (isset($_SESSION['error_message'])) {
    $message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Clear the message after displaying it
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel = new UserModel();

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $loginResult = $userModel->loginUser($email, $password);

    if ($loginResult == 1) {
        $_SESSION['login']="success";
        $_SESSION['user_email'] = $email;
        header("Location: ../../index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Invalid email or password."; 
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page to prevent form resubmission
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style_login.css">
    <title>Login Page</title>
</head>
<body>
    
    <main>
        <section id="login">
            <div class="login-title">
                <div class="login-account-title">
                    <h1>Welcome to MyShop! Please login.</h1>
                </div>
                <div class="registration-title">
                    <span>
                        New member?
                        <a href="/onboarding-project/pages/accounts/account.php">Register</a>
                        here.
                    </span>
                </div>
            </div>

        
            <?php if (!empty($message)): ?>
                <div class="error-message">
                    <p><?php echo htmlspecialchars($message); ?></p>
                </div>
            <?php endif; ?>

            <form id="loginForm" class="login_form_container" method="POST">
                <div class="email">
                    <input type="email" id="email" name="email" required placeholder="Email">
                </div>
                <div class="password">
                    <input type="password" id="password" name="password" required placeholder="Password">
                </div>
                <div class="forgot-password">
                    <a href="forgot.html">Forgot Password</a>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
        </section>
    </main>
</body>
</html>
