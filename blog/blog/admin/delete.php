#template("blog.ttl"):2

#start("Initialize")
#end()

#start("Head")
<title>Delete Post</title>
#end()

#start("Navbar")
#end()

#start("Body")
#end()

#start("Sidebar")
<h3 class="m-shade">Delete</h3>
<p>Delete posts.</p>
#end()

#start("Main")
<?php
if (!$is_admin)
{
    echo "<p>You're not an admin. Go away, shoo.</p>";
    die();

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"])) {
        require_once("../../config.php");
        require_once("../articles.php");

        delete_article($link, $_POST["id"]);

    } else {
        header("location: ../index.php");
    }
} else {
    if (isset($_GET["id"])) {
        echo '<script>';
        echo 'function goToRoot(){ ';
        $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        echo 'window.location.href="' . $root . '"; ';
        echo '}</script>';
    } else {
        header("location: ../index.php");
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <label>Are you sure you want to delete this file?</label>
    <br>
    <label>ID:</label>
    <input type="number" name="id" value="<?= $_GET["id"] ?>" readonly />
    <br>
    <input type="submit" value="Yes" style="display: inline;" />
</form>
<button onclick="goToRoot()">NO</button>
#end()