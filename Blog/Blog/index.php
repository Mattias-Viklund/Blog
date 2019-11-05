#template("blog.ttl")

#start("Initialize")
<?php
require_once("../config.php");
require_once('HTML/BBCodeParser2.php');
$config = parse_ini_file('BBCodeParser2.ini', true);
$options = $config['HTML_BBCodeParser2'];
$parser = new HTML_BBCodeParser2($options);

?>
#end()

#start("Head")
<title>Smack that</title>
#end()

#start("Body")
<div class="container">
    <?php
    require_once("articles.php");
    $articles = articles_load($link);
    if (is_array($articles) || is_object($articles)) {
        foreach ($articles as $article) {
            echo '<div class="post">';

            echo '<h3>' . $article["title"] . '</h3>';
            echo '<h5>' . $article["date"] . (($article["worktime"] > 0) ? ", Worked for " . $article["worktime"] . " hours." : "") . '</h5>';

            if (!empty($article["thumbnail"]))
                echo '<img src="' . $article["thumbnail"] . '" width="256" alt="Click to open full image."">';

            $parser->setText($article['content']);
            $parser->parse();
            $parsed = $parser->getParsed();

            echo '<p>' . nl2br($parsed) . '</p>';
            echo '<br>';

            if (!empty($article["git_commit"])) {
                echo '<a href="' . $article["git_commit"] . '">Github Commit</a>';
                echo '<br>';
            }

            echo '<a href="comment.php?id=' . $article["id"] . '">Comment</a>';

            if ($is_admin) {
                echo '<br>';
                echo '<div class="admin_tools">';
                echo '<b>Admin Tools</b>';
                echo '<a href="admin/edit.php?id=' . $article["id"] . '">Edit</a>';
                echo '<a href="admin/delete.php?id=' . $article["id"] . '">Remove</a>';
                echo '</div>';
            }
            echo '</div>';
            echo '<hr>';
        }
    }
    ?>
</div>
#end()