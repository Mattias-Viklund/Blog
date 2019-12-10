#template("blog.ttl")

#start("Initialize")
<?php
require_once "session.php";

?>
#end()

#start("Head")
<title>Account</title>
#end()

#start("Navbar")
#end()

#start("Body")
#end()

#start("Sidebar")
<h3 class="m-shade">Account Settings</h3>
<hr>

<p>You thinking about changing settings?<br>Here's the place to do it.</p>
<?php
if ($is_admin)
    echo '<a href="/blog/post.php">' . 'New Post' . '</a><br>';
?>
<a href="logout.php">Sign out</a>
#end()

#start("Main")
<p>Account Type</p>
<?= '<h3 class="m-shade">' . (($is_admin) ? 'GLORIOUS ADMIN' : 'PESEANT') . '</h3>'; ?>

#end()