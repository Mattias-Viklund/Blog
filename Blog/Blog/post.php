#template("blog2.ttl")

#start("Initialize")
<?php
require_once "../session.php";
require_once("articles.php");

if (!is_admin()) {
    echo "Only admins can post breh.";
    exit(420);
}

$title = $thumbnail = $category = $text = $worktime = $git_commit = "";

function generate_category($link)
{
    $hasCategory = !empty($_POST['category'])  || !empty($_POST['customCategory']);
    if ($hasCategory) {
        if (!empty($_POST['category'])) {
            return $_POST['category'];
        }

        if (!empty($_POST['customCategory'])) {
            $wat = new_category($link, $_POST['customCategory']);
            echo $wat;
            return $wat;
        }
    } else {
        return 0;
        echo "Select a Category fam.";
        die();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"]) || empty($_POST["text"])) {
        echo "Needs a title and some content.";
        exit(420);
    } else {
        $title = $_POST["title"];
        $thumbnail = (!empty($_POST["thumbnail"]) ? $_POST["thumbnail"] : "");
        $category = generate_category($link);
        $text = $_POST["text"];
        $worktime = (!empty($_POST["worktime"]) ? $_POST["worktime"] : 0);
        $git_commit = (!empty($_POST["git_commit"]) ? $_POST["git_commit"] : "");
    }

    $sql = "INSERT INTO `posts` (title, thumbnail, category, content, worktime, git_commit) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param($stmt, "ssssss", $param_title, $param_thumbnail, $param_category, $param_text, $param_worktime, $param_git_commit);

        $param_title = $title;
        $param_thumbnail = $thumbnail;
        $param_category = $category;
        $param_text = $text;
        $param_worktime = $worktime;
        $param_git_commit = $git_commit;

        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
        } else {
            echo "Something went wrong. Please try again later. insert into";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
#end()


#start("Navbar")
#end()

#start("Body")
#end()

#start("Sidebar")
<h3>Create a New Post</h3>
<p>
    Make sure it's descriptive,
    and all that jazz.
</p>
#end()

#start("Head")
<title>Welcome</title>
#end()

#start("Main")
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <p>Create new Post.</p>
    <div>
        <label>Title</label><br />
        <input type="text" name="title" class="form-group" id="half" value="<?php echo $title; ?>">
    </div>
    <div>
        <label>Thumbnail URL</label><br />
        <input type="text" name="thumbnail" class="form-group" id="half" value="<?php echo $thumbnail; ?>">
    </div>
    <div>
        <label>Category</label>
        <select name="category">
            <option value="">Custom Category</option>
            <?php
            $categories = get_categories($link);
            if (is_array($categories) || is_object($categories)) {
                foreach ($categories as $cat) {
                    echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
                }
            }
            ?>
        </select>
        <label>OR</label>
        <input type="text" name="customCategory" class="form-group" id="half" value="" />

    </div>
    <div>
        <label>Text</label><br />
        <textarea name="text" rows="28" cols="100" class="form-group" id="half" value="<?php echo $text; ?>"></textarea>
    </div>
    <div>
        <label>Work Time</label><br />
        <input type="number" name="worktime" min="0" max="12" style="color:#000; width:25%;" class="form-group" value="<?php echo $worktime; ?>">
    </div>
    <div>
        <label>Github Commit Link</label><br />
        <input type="text" name="git_commit" class="form-group" id="half" value="<?php echo $git_commit; ?>">
    </div>
    <div class="form-group">
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </div>
</form>
#end()