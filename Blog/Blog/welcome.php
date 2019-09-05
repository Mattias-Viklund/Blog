<?php
// Initialize the session
session_start();
require_once "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="blog.css">
</head>

<body>
    <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>

    <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
</body>

</html>