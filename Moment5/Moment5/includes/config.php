<?php
spl_autoload_register(function ($class_name){
    include 'classes/' . $class_name . '.class.php';
});

$DBHOST = "mysql25.unoeuro.com";  //your hostname
$DBUSER = "johannastahlgren_se";       //your username
$DBPASS = "Hbg3xnmD6h2t";           //your password
$DBNAME = "johannastahlgren_se_db_userdb";   //your database name

//Create Connection
$conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>