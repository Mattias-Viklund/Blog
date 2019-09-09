<?php
// Initialize the session
session_start();
?>
<?php
require_once "session.php";
if (!is_admin()) {
header("location: Pages/notadmin.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="blog.css">
<title>Admin Page</title>
</head>
<body>
<div id="navbar">
<a href="index.php">Home</a>
<a href="index.php">Blog</a>
<a href="account.php">Account</a>
<a href="logout.php" style="float: right;">Sign Out</a>
<a href="admin.php" style="float: right;">Admin</a>
<a href="post.php">New Post</a>
</div>
<div class="container">
<h5>Welcome <?php echo $_SESSION["username"] ?>.</h5>
</div>
</body>
</html>
