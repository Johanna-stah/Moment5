<?php include ("includes/config.php");
session_start();
$user = new User($conn);
if (!$user->isLoggedIn()) 
{
    $user->redirect('login.php');
}
if(isset($_GET['id'])) {
    $id = ($_GET['id']);
} else {
    header("location: admin.php");
}

?>
<?php include("includes/head.php"); ?>
    <?php include("includes/header.php"); ?>
        <?php include("includes/navigering.php"); ?>
            <?php       

            $posts = new Posts();
            $details = $posts->getPosts();


                // Ändra post
                if(isset($_POST['title'])){
                    $title = $_POST['title'] ;
                    $content = $_POST['content'];
                            
                    if($posts->updatePosts($id, $title, $content)){
                        echo "<p>Post uppdaterad!</p>";
                        } else {
                            echo "<p>Fel vid lagring!</p>";
                        }
                    }   
            ?>      
            <h3>Ändra blogginlägg</h3>
            <br>
            <form method="post" action="edit.php?id=<?= $id ?>"> 
                <div>
                    <label for="title">Titel:</label><br>
                    <input type="text" name="title" id="title" value="<?= $details['title'] ??""; ?>"> 
                </div>
                <div>
                    <label for="content">Innehåll:</label> <br>
                    <textarea name="content" id="content" cols="30" rows="10" required><?= $details['content'] ??""; ?></textarea>
                    <script>
                        CKEDITOR.replace( 'content' );
                    </script>
                </div>
                <br>
                <div>
                    <input type="submit" value="Updatera post" class="btn" >
                </div>
            </form>
            <p>
                <a href="logout.php?logout" class="btn">Logga ut</a>
            </p>

            <?php include("includes/footer.php"); ?>
