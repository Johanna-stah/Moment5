<?php 
include_once("includes/config.php");
session_start();

$user = new User($conn);

//if already logged in, redirect to admin page
if ($user->isLoggedIn()) 
{
    $user->redirect('admin.php');
}
//When login button pressed, login
if (isset($_POST['login'])) 
{
    $uname = $_POST['user'];
    $pass = $_POST['password'];
    $login = $user->loginUser($uname, $pass);
    
    if ($login === true)
    {
        $user->redirect('admin.php');
    } 
    else 
    {
        echo $login;
    }
}
?>
<?php include("includes/head.php"); ?>
    <?php include("includes/header.php"); ?>
        <?php include("includes/navigering.php"); ?>
                <h2>Logga in här</h2>
                <p>Fyll i dina uppgifter för att logga in tack!</p>

                <form method="post" action="login.php" name="loginform">

                <label><b>E-mail eller användarnamn:</b></label> <br>
                <input type="text" name="user" required /><br>

                <label><b>Lösenord:</b></label><br>
                <input type="password" name="password" auto_complete="off" required /><br>
                <br>
                <input type="submit" name="login" value="Logga in" class="btn" />

                </form>
                <br>
                <a href="register.php" class="btn">Registrera dig</a>
            <?php include("includes/footer.php"); ?>
