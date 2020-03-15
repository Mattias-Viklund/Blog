#template("blog.ttl"):2

#start("Initialize")

<?php
require_once("../config.php");

$maxNameLength = 20;

// define variables and set to empty values
$myname = $othername = "";
$myNameErr = $otherNameErr = "";

$canRun = false;

$deleteId = -1;
$canDelete = false;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $deleteId = $_GET["id"];
        $canDelete = true;
    }

    if (isset($_GET["username"]))
    {
        $myname = $_GET["username"];
        $canRun = true;

    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myname = test_input($_POST["myname"]);

    if (empty($_POST["myname"])) {
        $myNameErr = "Your username is required";
    } else if (strlen($maxNameLength) > $maxNameLength) {
        $otherNameErr = "Your username cannot be longer than 20.";
    }

    if (!empty($myNameErr))
        return;

    $canRun = true;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function get_freekills($link, $name)
{
    $sql = "SELECT * FROM `freekills` WHERE `myname`=?";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $param_myname);
        $param_myname = strtolower($name);

        if (mysqli_stmt_execute($stmt)) {
            $results = mysqli_stmt_get_result($stmt);
            return $results;
        } else {
            echo "Something went wrong. Please try again later. insert into";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

function get_freekill($link, $id)
{
    $sql = "SELECT othername FROM `freekills` WHERE `id`=" . $id;
    $stmt = mysqli_query($link, $sql);

    if ($stmt) {
        return mysqli_fetch_assoc($stmt);
    }
}

function detele_pass($link, $deleteId)
{
    $sql = "DELETE FROM `freekills` WHERE `id`=?";
    $stmt = mysqli_prepare($link, $sql);

    $line = get_freekill($link, $deleteId);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $param_id);
        $param_id = $deleteId;

        if (mysqli_stmt_execute($stmt)) {
            echo "<div>";
            echo "<h4>Sucessfully deleted Free-Kill pass for " . $line["othername"] . "</h4>";
            echo "</div>";
        } else {
            echo "Something went wrong. Please try again later. insert into";
        }
        mysqli_stmt_close($stmt);
    }
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
<h3 class="m-shade"> Get Free-Kill passes.</h3>
<p>View the Free-Kill passes you have created.
Or delete them as necessary.</p>
#end()

#start("Main")
<p>Get your Free-Kill passes.</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <?php echo "<p>" . $myNameErr . "</p>"; ?>
    Your Username: <input type="text" name="myname" value=<?php echo $myname; ?>><br>
    <input type="submit" value="Submit">
</form>

<?php
if ($canDelete) {
    detele_pass($link, $deleteId);
}

if ($canRun) {
    $results = get_freekills($link, $myname);
    if (is_array($results) || is_object($results)) {
        $resultCount = 0;
        foreach ($results as $res) {
            echo "<div class='freekillpass'>";
            echo "<p>Free-Kill pass for " . $res["othername"] . "<a href='getfreekills.php?id=" . $res["id"] . "&username=".$res["myname"]."'> Redeem Pass</a></p>";
            echo "</div>";
            $resultCount++;
        }

        if ($resultCount == 0)
        {
            echo '<h4>No Free-Kill passes found for your username.</h4>';
            return;
        }
    } else {
        echo '<h4>No Free-Kill passes found for your username.</h4>';
        return;
    }
}
?>
#end()