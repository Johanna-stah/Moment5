<?php
spl_autoload_register(function ($class_name){
    include 'classes/' . $class_name . '.class.php';
});

$DBHOST = "db-host";  //your hostname
$DBUSER = "user";       //your username
$DBPASS = "password";           //your password
$DBNAME = "db-name";   //your database name

//Create Connection
$conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
