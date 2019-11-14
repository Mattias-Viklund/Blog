#template("blog1.ttl"):2

#start("Initialize")
#end()

#start("Head")
<title>Edit</title>
#end()

#start("Navbar")
#end()

#start("Body")
#end()

#start("Sidebar")
<h3 class="m-shade">Edit Post</h3>
<p>Edit the post, make it meaningful.</p>
#end()

#start("Main")
<?php
$title = $thumbnail = $category = $text = $worktime = $git_commit = "";
$id = -1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../../config.php");
    include_once("../articles.php");

    update_article($link, $_POST["id"], $_POST["title"], $_POST["thumbnail"], $_POST["category"], $_POST["text"], $_POST["git_commit"], $_POST['updateTime'], $_POST["worktime"]);
}

if (isset($_GET["id"])) {
    require_once("../../config.php");
    include_once("../articles.php");

    $id = $_GET["id"];
    $articles = get_article($link, $_GET["id"]);
    if (is_array($articles) || is_object($articles)) {
        foreach ($articles as $article) {
            $title = $article["title"];
            $thumbnail = $article["thumbnail"];
            $category = $article["category"];
            $text = $article["content"];
            $worktime = $article["worktime"];
            $git_commit = $article["git_commit"];
        }
    }
} else {
    header("location: ../index.php");
}
?>

<div class="container">
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <p>Create new Post.</p>
        <div>
            <label>ID:</label>
            <input type="number" name="id" value="<?= $_GET["id"] ?>" readonly />
        </div>
        <div>
            <label>Title</label><br />
            <input type="text" name="title" class="form-group" id="half" value="<?= $title; ?>">
        </div>
        <div>
            <label>Thumbnail URL</label><br />
            <input type="text" name="thumbnail" class="form-group" id="half" value="<?= $thumbnail; ?>">
        </div>
        <div>
            <label>Category</label>
            <select name="category" id="selcat">
                <option value="">Custom Category</option>
                <?php
                $categories = get_categories($link);
                $out = "";
                if (is_array($categories) || is_object($categories)) {
                    foreach ($categories as $cat) {
                        if ($cat['id'] == $category) {
                            $out = "<script>$('#selcat').val('" . $cat['id'] . "')</script>";
                        }
                        echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
                    }
                }
                ?>
            </select>
            <?php echo $out; ?>
            <label>OR</label>
            <input type="text" name="customCategory" class="form-group" id="half" value="" />

        </div>
        <div>
            <label>Text</label><br />
            <textarea name="text" rows="28" cols="100" class="form-group" id="half"><?= $text; ?></textarea>
        </div>
        <div>
            <label>Work Time</label><br />
            <input type="number" name="worktime" min="0" max="12" style="color:#000; width:25%;" class="form-group" value="<?= $worktime; ?>">
        </div>
        <div>
            <label>Github Commit Link</label><br />
            <input type="text" name="git_commit" class="form-group" id="half" value="<?= $git_commit; ?>">
        </div>
        <div class="form-group">
            <label>Update Timestamp?</label>
            <input type="checkbox" name="updateTime"><br>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>
    </form>
</div>
#end()