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
    header("Location: ReviewEvents.php");
    die();
}



?>
<html>
<head><title>List Events</title></head>
<body>
<h2>Logged in as <?php echo $LoginName ?></h2>
<a href="UserLogin.php">Login</a> <br />
<a href="HomePage.php">Home</a> <br />

<?php




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

$sql = "SELECT * FROM Events WHERE Events.id NOT IN (SELECT eventid FROM EventUser WHERE userid = " .$userid ." )" ;
$result = $conn->query($sql);

echo "<h2>Current Events</h2>";
echo "<table border=1><tr><th>Event ID</th><th>Event Name</th><th>Venue</th><th>Date</th><th>Capacity</th><th>Registered</th></tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td><a href=EventRegister.php?eventid=".$row["id"] .">Register</a></td><td>" . $row["eventname"]. "</td><td>" . $row["venue"]. "</td><td>" . $row["eventdate"]. "</td><td>" . $row["capacity"]. "</td><td>" . $row["registered"]. "</td></tr>";
    }
} 
echo "</table>";

$sql = "SELECT * FROM Events WHERE Events.id IN (SELECT eventid FROM EventUser WHERE userid = " .$userid ." )" ;
$result = $conn->query($sql);

echo "<h2>Registered Events</h2>";
echo "<table border=1><tr><th>Event ID</th><th>Event Name</th><th>Venue</th><th>Date</th><th>Capacity</th><th>Registered</th></tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td><a href=EventUnregister.php?eventid=".$row["id"] .">Unregister</a></td><td>" . $row["eventname"]. "</td><td>" . $row["venue"]. "</td><td>" . $row["eventdate"]. "</td><td>" . $row["capacity"]. "</td><td>" . $row["registered"]. "</td></tr>";
    }
}
echo "</table>";

$conn->close();
?>

</body>
</html>