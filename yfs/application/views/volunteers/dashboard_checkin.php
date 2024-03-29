<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: "Lato", sans-serif;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display:flex;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 10;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="http://localhost/team-6/yfs/volunteer/">Home</a>
  <a href="http://localhost/team-6/yfs/volunteer/updateprofile">Update Preference</a>
  <a href="http://localhost/team-6/yfs/volunteer/checkins">CheckIn</a>
  
</div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function registered(k)
{
    document.location.href="http://localhost/team-6/yfs/volunteer/update_check/"+k;
}
</script>
     
	 
<div class="container">
  <h2>Check In</h2>          
  <table class="table">
    <thead>
      <tr>
        <th>Name of Event</th>
        <th>Location</th>
      </tr>
    </thead>
    <tbody>
    <tr>
    <?php foreach($eve as $m):?>
    <tr><td> <?php echo $m['event_name']; ?></td>
    <td> <?php echo $m['loc_name']; ?></td>
    <td><button id="<?php echo $m['event_id'];?>" onclick="registered(this.id)" class="btn btn-primary pull-center" >CheckIn</button>
    </td>
    </tr>
    <?php endforeach; ?>
      
    </tbody>
  </table>
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>


</body>
</html> 
