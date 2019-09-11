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
#end()

#start("Body")
<div class="container">
    <h1>Admin Control</h1>
</div>
#end()