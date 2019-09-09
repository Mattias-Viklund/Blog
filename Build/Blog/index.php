<?php
// Initialize the session
session_start();
?>
<?php
require_once("config.php");
require_once('HTML/BBCodeParser2.php');
$config = parse_ini_file('BBCodeParser2.ini', true);
$options = $config['HTML_BBCodeParser2'];
$parser = new HTML_BBCodeParser2($options);
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
<title>Index</title>
</head>
<body>
<div id="navbar">
<a href="index.php">Home</a>
<a href="index.php">Blog</a>
<a href="account.php">Account</a>
<a href="logout.php" style="float: right;">Sign Out</a>
<a href="admin.php" style="float: right;">Admin</a>
<title>Index</title>
</div>
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
</body>
</html>
