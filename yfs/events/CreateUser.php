
<?php
// Start the session
session_start();

 $_SESSION["UserID"] = "";
$_SESSION["LoginName"] = "";
?>

<html>
<head><title>Create User</title></head>
<body>
<a href="HomePage.php">Home</a> <br />

<?php

$name = $password = $email = $errors ="";
$len = strlen(null);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $userpassword = $_POST["userpassword"];
    
    $len = strlen( $name );
    if($len == 0 )
    {
        $errors = "User name is missing";
    }
    $len = strlen( $email );
    if($len == 0 )
    {
        $errors = $errors . "<br />User email is missing";
    }
    $len = strlen( $userpassword );
    if($len == 0 )
    {
        $errors = $errors . "<br />User password is missing";
    }

    $len = strlen( $errors );
    if($len == 0 ){

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

        $sql = "INSERT INTO Users (username, email, userpassword,  registered)
        VALUES ('$name', '$email', '$userpassword',  0)";

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header("Location: ListEvents.php");
            die();
        } else {
            $errors = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}


?>

 <h2 style="color:#FF0000"> <?php echo $errors ?> </h2>
<form action="CreateUser.php" method="post">
User Name  : <input type="text" name="name" value="<?php echo $name ?>"  ><br />
User Email : <input type="text" name="email" value="<?php echo $email ?>" ><br />
Password : <input type="password" name="userpassword" value="<?php echo $userpassword ?>" ><br />
<input value="Create User"  type="submit">
</form>

</body>
</html>