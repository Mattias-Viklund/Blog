#template("blog.ttl"):1

#start("Initialize")
<?php
$resultsperpage = 5;
$page = 0;
$category = -1;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}

require_once("../config.php");
require_once('HTML/BBCodeParser2.php');
$config = parse_ini_file('BBCodeParser2.ini', true);
$options = $config['HTML_BBCodeParser2'];
$parser = new HTML_BBCodeParser2($options);

require_once("articles.php");

?>
#end()

#start("Head")
<title>Exedump Blog</title>
#end()

#start("Navbar")
#end()

#start("Body")
#end()

#start("Sidebar")
<h3 class="m-shade">Categories</h3>
<hr>
<ul>
    <?php
    $categories = get_categories($link);
    if (is_array($categories) || is_object($categories)) {
        foreach ($categories as $cat) {
            echo '<li><a href="' . $_SERVER['PHP_SELF'] . '?category=' . $cat['id'] . '">' . $cat['name'] . '</a></li>';
        }
    }
    ?>

</ul>
#end()

#start("Main")
<h3 class="m-shade">Recent Posts</h3>
<hr>
<div class="post">
    <?php
    $articleCount = get_total_articles($link, $category)[0];
    $articles = articles_load($link, $resultsperpage, $resultsperpage * $page, $category);
    if (is_array($articles) || is_object($articles)) {
        if ($articleCount == 0) {
            echo '<h4>No posts found.</h4>';
            return;
        }
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
<div>
    <div class="links nopad">
        <?php
        $pages = ceil($articleCount / $resultsperpage);

        for ($i = 0; $i < $pages; $i++) {
            if ($category == -1)
                echo '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '">' . $i . '</a>';
            else
                echo '<a href="' . $_SERVER['PHP_SELF'] . '?category=' . $category . '&page=' . $i . '">' . $i . '</a>';
        }
        ?>
    </div>
    <div class="links nopad">
        <a href="https://github.com/mattias-viklund">Github</a>
        <a href="https://github.com/mattias_viklund">Twitter</a>
        <a href="https://steamcommunity.com/id/zeseductivebanana">Steam</a>
    </div>
</div>
#end()