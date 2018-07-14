<h2>Click</h2>
<form action="" method="POST">
    <button name="checkin"  class="click">Check in</button>
	<button name="checkout"  class="click">Check out</button>
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$date_checkin;
$date_checkout;
$conn = new mysqli($servername, $username, $password, $dbname);
date_default_timezone_set ("Asia/Calcutta");
if(isset($_POST['checkin']))
{
    $date_checkin = date("H:i:s",time());
	echo "$date_checkin";
	

if(isset($_POST['checkout']))
{
    $date_checkout = date("H:i:s",time());
	mysqli_query($con,"INSERT INTO time (checkin, checkout)
VALUES ('$date_checkin', '$date_checkout')");
 
}
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

} 
?>