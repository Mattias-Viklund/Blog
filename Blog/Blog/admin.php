#template("default.ttl")

#start("Initialize")
<?php
require_once "session.php";

if (!is_admin()) {
    header("location: Pages/notadmin.html");
}
?>
#end()

#start("Head")
<title>Admin Page</title>
#end()

#start("Navbar")
<a href="post.php">New Post</a>
#end()

#start("Body")
<div class="container">
    <h5>Welcome <?php echo $_SESSION["username"] ?>.</h5>

</div>
#end()

#start("Body")
<div class="container">
    <h5>Welcome <?php echo $_SESSION["username"] ?>.</h5>

</div>
#end()