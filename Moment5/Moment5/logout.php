<?php
include_once("includes/config.php");
session_start();

$user = new User($conn);

//Logout out user and redirect to login page
if (isset($_GET['logout']))
{
    $user->logout();
    $user->redirect('login.php');
} 
//If user is still logged in, will redirect to login.php which will redirect to admin.php
else
{
    $user->redirect('admin.php');
}

?>