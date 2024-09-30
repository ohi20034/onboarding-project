<?php
session_start(); // Start the session
require_once '../../../models/user_model.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: /onboarding-project/pages/login/login.php");
    exit();
}

$userModel = new UserModel();
$userEmail = $_SESSION['user_email'];

try {
    $user = $userModel->getUserByEmail($userEmail);
} catch (Exception $e) {
    $_SESSION['error'] = 'Could not fetch user data: ' . $e->getMessage();
    header('Location: ../error.php');
    exit();
}

function escape($string) {
    return isset($string) ? htmlspecialchars($string, ENT_QUOTES, 'UTF-8') : 'N/A';
}

$firstName = escape($user['first_name'] ?? null);
$lastName = escape($user['last_name'] ?? null);
$email = escape($user['email'] ?? null);
$gender = $user['gender'] ?? 'N/A';
$streetAddress = escape($user['street_address'] ?? null);
$city = escape($user['city'] ?? null);
$state = escape($user['state'] ?? null);
$country = escape($user['country'] ?? null);
$zipCode = escape($user['zip_code'] ?? null);
$telephone = escape($user['telephone'] ?? null);


if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: /onboarding-project/pages/login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style_user_profile.css"> <!-- Include your CSS file -->
    <title>User Profile</title>
</head>
<body>
<?php include 'C:\xampp\htdocs\onboarding-project\header.php'; ?>
    <hr>
    <main>
        <section id="user-profile">
            <h1>User Profile</h1>
            <div class="profile-data">
                <p><strong>First Name:</strong> <?php echo $firstName; ?></p>
                <p><strong>Last Name:</strong> <?php echo $lastName; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                <p><strong>Street Address:</strong> <?php echo $streetAddress; ?></p>
                <p><strong>City:</strong> <?php echo $city; ?></p>
                <p><strong>State/Province:</strong> <?php echo $state; ?></p>
                <p><strong>Country:</strong> <?php echo $country; ?></p>
                <p><strong>Zip Code:</strong> <?php echo $zipCode; ?></p>
                <p><strong>Telephone Number:</strong> <?php echo $telephone; ?></p>
            </div>
            <a href="/onboarding-project/index.php" class="back-button">Back to Home</a>
            <form method="post" style="display: inline;">
                <button type="submit" name="logout" class="logout-button">Log Out</button>
            </form>
        </section>
    </main>
    <script src="./script_account.js"></script>
</body>
</html>
