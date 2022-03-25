<?php

session_start();
include_once("includes/config.php");

$user = new User($conn);
$validate = new Validate($conn);

//If user is already logged in, redirect to home page
if ($user->isLoggedIn()) 
{
    $user->redirect('home.php');
}

$errors = array();

//When register button is pressed, register
if (isset($_POST['register'])) 
{
    $fullname =$_POST['fullname'];
    $uname = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass2 = $_POST['passwordrepeat'];
    
    //Validate user input
    if ($validate->fullnameValidate($fullname) != null) 
    {
        $errors[] = $validate->fullnameValidate($fullname);
    }
    if ($validate->usernameValidate($uname) != null) 
    {
        $errors[] = $validate->usernameValidate($uname);
    }
    if ($validate->emailValidate($email) != null) 
    {
        $errors[] = $validate->emailValidate($email);
    }
    if ($validate->passwordValidate($pass, $pass2) != null) 
    {
        $errors[] = $validate->passwordValidate($pass, $pass2);
    }
    
    //If no validation errors register input, else display errors
    if (empty($errors)) 
    {
        if($user->registerUser($fullname, $uname, $email, $pass) === true) 
        {
            $user->redirect('register.php?joined');
        }
        else 
        {
            echo 'Error vid registering. Prova igen.';
        }
    }
    else
    {
        foreach ($errors as $error) 
        {
            printf ($error . "<br/>");
        }
    }   
}

?>
<?php include("includes/head.php"); ?>
    <?php include("includes/header.php"); ?>
        <?php include("includes/navigering.php"); ?>
                  <h2>Skapa konto</h2>
                  <p>Fyll i formuläret för att skapa en inloggning.</p>
                  <?php if (isset($_GET['joined'])) { ?>
                  <p>Lyckad registrering. Du kan nu <a href="login.php">logga in</a>.</p>
                  <?php }else { ?>
                  <form method="post" action="register.php" name="registerform">
                  
                  <label><b>Fullständigt namn:</b></label><br>
                  <input type="name" name="fullname" required /> <br>

                  <label><b>Användarnamn:</b></label><br>
                  <input type="text" name="username" required /> <br>

                  <label><b>E-mail</b></label><br>
                  <input type="email" name="email" required /> <br>

                  <label><b>Lösenord</b></label><br>
                  <input type="password" name="password" auto_complete="off" required /><br>

                  <label><b>Upprepa lösenord:</b></label><br>
                  <input type="password" name="passwordrepeat" auto_complete="off" required /><br>
                  <br>
                  <input type="submit" name="register" value="Register" class="btn"/>

                  </form>
                  <?php } ?> 
          <?php include("includes/footer.php"); ?>
