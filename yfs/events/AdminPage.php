
<?php
// Start the session
session_start();

$userid = $_SESSION["UserID"];
$LoginName = $_SESSION["LoginName"];

$len = strlen( $userid );
if($len == 0 )
{
    header("Location: UserLogin.php");
    die();
}

if( $userid != 1)
{
    $_SESSION["UserID"] = "";
    header("Location: UserLogin.php");
    die();
}
?>


<html>
<head><title>Admin Page</title></head>
<body>

<h2>Logged in as <?php echo $LoginName ?></h2>
<a href="UserLogin.php">Login</a> <br />
<a href="HomePage.php">Home</a> <br />
<a href="CreateEvent.php">Create Event</a> <br />
<a href="ReviewEvents.php">Review Event</a><br />
<a href="ReviewUsers.php">Review Users</a><br />

</body>
</html>