

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

if( $userid == 1)
{
   echo "Cannot register to this event as you are admin";
    die();
}
?>

<html>
<head><title>Register Event</title></head>
<body>
<h2>Logged in as <?php echo $LoginName ?></h2>
<a href="UserLogin.php">Login</a> <br />
<a href="HomePage.php">Home</a> <br />
<a href="ReviewEvents.php">Events</a><br />
<?php

$querystringvals = array();
parse_str($_SERVER['QUERY_STRING'], $querystringvals);
$eventid = $querystringvals["eventid"];


  $len = strlen( $eventid );
  if($len == 0 )
  {
    echo "Cannot register to this event as event id is missing";
    die();
  }
  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM Events WHERE id = " .$eventid;
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Cannot register to this event as event id is invalid";
    die();
}

$sql = "SELECT * FROM EventUser WHERE eventid =" .$eventid ." and userid =" .$userid;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Cannot register to this event as you already registered to it";
    die();
}

$sql = "INSERT INTO EventUser (eventid, userid) VALUES (" .$eventid .","  .$userid .")";


if ($conn->query($sql) == FALSE) {
    die( "Error: " . $sql . "<br>" . $conn->error);
}


$sql = "UPDATE Events SET registered = registered + 1 WHERE id = " .$eventid;

if ($conn->query($sql) == FALSE) {
    die( "Error: " . $sql . "<br>" . $conn->error);
}

$sql = "UPDATE Users SET registered = registered + 1 WHERE id = " .$userid;

if ($conn->query($sql) == FALSE) {
    die( "Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();

echo "Successfully registered!!!";

?>


</body>
</html>