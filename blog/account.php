#template("blog1.ttl")

#start("Initialize")
<?php

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
<p>You thinking about changing settings?<br>Here's the place to do it.</p>
#end()

#start("Main")
<p>Account Type</p>
<?= '<h3 class="m-shade">' . (($is_admin) ? 'GLORIOUS ADMIN' : 'PESEANT') . '</h3>'; ?>
#end()