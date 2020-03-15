#template("blog.ttl"):2

#start("Initialize")

<?php
require_once("../config.php");

$maxNameLength = 20;

// define variables and set to empty values
$myname = $othername = "";
$myNameErr = $otherNameErr = "";

$added = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myname = strtolower(test_input($_POST["myname"]));
    $othername = test_input($_POST["othername"]);

    if (empty($_POST["myname"])) {
        $myNameErr = "Your username is required";
    } else if (strlen($maxNameLength) > $maxNameLength) {
        $otherNameErr = "Your username cannot be longer than 20.";
    }

    if (empty($_POST["othername"])) {
        $otherNameErr = "Recipient username required";
    } else if (strlen($maxNameLength) > $maxNameLength) {
        $otherNameErr = "Recipient username cannot be longer than 20.";
    }

    if (!empty($myNameErr) && !empty($otherNameErr))
        return;

    $sql = "INSERT INTO `freekills` (myname, othername) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param($stmt, "ss", $param_myname, $param_othername);

        $param_myname = $myname;
        $param_othername = $othername;

        if (mysqli_stmt_execute($stmt)) {
            $added = true;
        } else {
            echo "Something went wrong. Please try again later. insert into";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
#end()

#start("Head")
<title>Tarkov Kill Pass</title>
#end()

#start("Navbar")
#end()

#start("Body")
#end()

#start("Sidebar")
<h3 class="m-shade">Kill Pass</h3>
<p>Create a new Free-Kill pass.
    Really useful when you pissed off a close friend.
    <br>
    <br>
    <br>
    <br>
    Damn I spent too much time on this.
</p>
#end()

#start("Main")
<p>Create new Free-Kill pass.</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <?php echo "<p>" . $myNameErr . "</p>"; ?>
    Your Username: <input type="text" name="myname" value=<?php echo $myname; ?>><br>
    <?php echo "<p>" . $otherNameErr . "</p>"; ?>
    Recipient Username: <input id="othername" type="text" name="othername"><br>
    <input type="submit" value="Submit">
</form>

<script>
    document.getElementById("othername").focus();
</script>

<?php
if ($added) {
    echo '<h4>Successfully added Free-Kill pass.</h4>';
}
?>
#end()