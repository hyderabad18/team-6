<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ysf";
$date_checkin;
$date_checkout;
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO event (Event_ID, Evnt_Name, Event_desc, Type, Vol_count, Benefit, Loc_Name, Loc_Lat, Loc_Long, Start_Date, End_date)
VALUES ('1', 'Evnt_Name', 'Event_desc', 'Type', '1', '1', 'Loc_Name', 'Loc_Lat', 'Loc_Long', '12:12:12', '12:12:12')";

} 
?>