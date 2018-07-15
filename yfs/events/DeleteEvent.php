
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
<head><title>Delete Event</title></head>
<body>
<h2>Logged in as <?php echo $LoginName ?></h2>
<a href="UserLogin.php">Login</a> <br />
<a href="HomePage.php">Home</a> <br />
<a href="ReviewEvents.php">Events</a><br />
<a href="ReviewUsers.php">Users</a><br />

<?php

$querystringvals = array();
parse_str($_SERVER['QUERY_STRING'], $querystringvals);
$eventid = $querystringvals["eventid"];


  $len = strlen( $eventid );
  if($len == 0 )
  {
    echo "Cannot delete this event as event id is missing";
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
    die("Connection failed: " .$conn->connect_error); 
}

$sql = "SELECT * FROM Events where id=" . $eventid; 
$result = $conn->query($sql); 

if ($result->num_rows > 0) {
        
    $sql = "DELETE FROM Events where id=" .$eventid ;
    if( $conn->query($sql) == TRUE )
    {
        $sql = "UPDATE Users SET registered = registered - 1 WHERE id IN (SELECT userid FROM EventUser WHERE eventid = " .$userid .")";
        if ($conn->query($sql) == TRUE) 
        {
            $sql = "DELETE FROM EventUser where eventid=" .$eventid ;
            if( $conn->query($sql) == TRUE )
            {
                $errors = "Event Deleted !!!";
            }
            else
            {
                $errors = "Event got deleted but failed to delete subtables (EventUser)";
            }
        }
        else
        {
            $errors = "Event got deleted but failed to reduce event count";
        }  
    }
    else
    {
        $errors = "Failed to delete event";
    } 
}
else
    {
        $errors = "Event not found";
    } 
?>

<h2 style="color:#FF0000"> <?php echo $errors ?> </h2>

</body>
</html>