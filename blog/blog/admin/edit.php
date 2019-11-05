#template("blog.ttl"):1

#start("Body")
<?php
$title = $thumbnail = $text = $worktime = $git_commit = "";
$id = -1;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    require_once("../../config.php");
    include_once("../articles.php");
    update_article($link, $_POST["id"], $_POST["title"], $_POST["thumbnail"], $_POST["text"], $_POST["git_commit"], $_POST["worktime"]);

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
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>
    </form>
</div>
#end()