#template("default.ttl")

#start("Initialize")
<?php
require_once("config.php");
require_once('HTML/BBCodeParser2.php');
$config = parse_ini_file('BBCodeParser2.ini', true);
$options = $config['HTML_BBCodeParser2'];
$parser = new HTML_BBCodeParser2($options);
?>
#end()

#start("Head")
<title>Index</title>
#end()

#start("Navbar")
#end()

#start("Body")
<div class="container">
    <?php
    require_once("articles.php");
    $articles = articles_load($link, 1, 0);
    if (is_array($articles) || is_object($articles)) {
        foreach ($articles as $article) {
            echo '<div class="post">';

            echo '<h3>' . $article["title"] . '</h3>';
            echo '<h5>' . $article["date"] . (($article["worktime"] > 0) ? ", Worked for " . $article["worktime"] . " hours." : "") . '</h5>';

            if (!empty($article["thumbnail"]))
                echo '<img src="' . $article["thumbnail"] . '" height="256" width="256" alt="Click to open full image."">';

            $parser->setText($article['content']);
            $parser->parse();
            $parsed = $parser->getParsed();

            echo '<p>' . nl2br($parsed) . "</p>";
            echo "<br>";

            if (!empty($article["git_commit"]))
                echo '<a href="' . $article["git_commit"] . '">Github Commit</a>';
            echo '</div>';
        }
    }
    ?>
</div>
#end()