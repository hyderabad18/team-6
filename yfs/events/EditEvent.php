 <?php
// Start the session
session_start(); 

$userid = $_SESSION["UserID"]; 
$LoginName = $_SESSION["LoginName"];

$len = strlen($userid ); 
if ($len == 0) {
    header("Location: UserLogin.php"); 
    die(); 
}

if ($userid != 1) {
    $_SESSION["UserID"] = ""; 
    header("Location: UserLogin.php"); 
    die(); 
}
?>

<html> 
<head>
    <title> Edit Event </title >
</head>
<body>  
<h2>Logged in as <?php echo $LoginName ?></h2>
<a href="UserLogin.php">Login</a> <br />
<a href="HomePage.php">Home</a><br />  
<a href="ReviewEvents.php">Events</a><br />

<?php

$querystringvals = array(); 
parse_str($_SERVER['QUERY_STRING'], $querystringvals); 
$eventid = $querystringvals["eventid"]; 


$len = strlen($eventid); 
if ($len == 0) {
    echo "Cannot edit to this event as event id is missing"; 
    die(); 
}

$name = $venue = $eventdate = $capacity = $errors = ""; 
$len = strlen(null); 

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"]; 
    $venue = $_POST["venue"]; 
    $eventdate = $_POST["eventdate"]; 
    $capacity = $_POST["capacity"]; 

    $len = strlen($name); 
    if ($len == 0) {
        $errors = "Event name is missing"; 
    }
    $len = strlen($venue); 
    if ($len == 0) {
        $errors = $errors . "<br />Event venue is missing"; 
    }
    $len = strlen($eventdate); 
    if ($len == 0) {
        $errors = $errors . "<br />Event date is missing"; 
    }
    $len = strlen($capacity); 
    if ($len == 0) {
        $errors = $errors . "<br />Event capacity is missing"; 
    }

    $len = strlen($errors); 
    if ($len == 0) {
        $sql = "UPDATE Events SET eventname ='" . $name . "', venue='" . $venue . "', eventdate='" . $eventdate . "', capacity=" . $capacity ." WHERE id =" .$eventid; 
        if ($conn->query($sql) === TRUE) {
            $conn->close(); 
            header("Location: ReviewEvents.php"); 
            die(); 
        }else {
            $errors = "Error: " . $sql . "<br>" . $conn->error; 
        }

        $conn->close(); 
    }
}
else 
{
    # GET
    $sql = "SELECT * FROM Events where id=" . $eventid; 
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row["eventname"]; 
            $venue = $row["venue"]; 
            $eventdate = $row["eventdate"]; 
            $capacity = $row["capacity"]; 
        }
        $conn->close(); 
    }
    else {
        $conn->close(); 
        $errors = "Event not found"; 
        echo "<h2 style=\"color:#FF0000\">" . $errors . "</h2>"; 
        die(); 
    }
}
?>

<h2 style="color:#FF0000">  <?php echo $errors?>  </h2 >  

<?php $url = "EditEvent.php?eventid=".$eventid ?>
<form action="<?php echo $url ?>" method="post"> 
Event Name: <input type="text" name="name" value="<?php echo $name ?>" ><br /> 
Event Venue: <input type="text" name="venue" value="<?php echo $venue ?>" ><br /> 
Event Date: <input type="date" name="eventdate" value="<?php echo $eventdate ?>" ><br /> 
Event capacity: <input type="number" name="capacity" value="<?php echo $capacity ?>" ><br />  
<input value="Save Event" type="submit" >  
</form >  
</body >  
</html >