<?php 
session_start();
include_once("includes/config.php");
$user = new User($conn);

if (!$user->isLoggedIn()) 
{
    $user->redirect('login.php');
}
    $posts = new Posts();
    // Delete posts
    if(isset($_GET['delete_id'])){
        $delete_id = intval($_GET['delete_id']);
                            
        if($posts->deletePosts($delete_id)) {
            $message = "<p class='bold'>Post raderad!</p>";
        } else { 
            $message = "<div class='bold'>Fel vid radering!</div>";
        }
    }
    // Add post
    if(isset($_POST['title'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $username = $_POST['username'];

        if($posts->addPosts($title, $content, $username)) {
            $message = "<div class='bold'>Post skapad!</div>";
        } else {
            $message = "<div class='error'>Fel vid skapande av post!</div>";
        }
    }  
?>
<?php include("includes/head.php"); ?>
    <?php include("includes/header.php"); ?>
        <?php include("includes/navigering.php"); ?>
                <h2>Hej, <b><?php echo $_SESSION['userName']; ?></b>. Välkommen till din sida.</h2>
                <a href="logout.php?logout" class="btn">Logga ut</a>
                <h3>Skapa ett inlägg!</h3>
                  <br>
                  <?php if(isset($message)) { echo $message;} ?>

                  <form method="post" action="admin.php">
                      <div>
                          <label for="title">Titel:</label><br>
                          <input type="text" name="title" id="title" required>
                      </div>
                      <div>
                          <label for="content">Innehåll:</label> <br>
                          <textarea name="content" id="content" cols="30" rows="10" required></textarea>
                        <script>
                            CKEDITOR.replace( 'content' );
                        </script>
                      </div>
                      <div>
                          <label for="username">Användare:</label> <br>
                          <input type="text" name="username" id="username" value="<?php echo $_SESSION['userName']; ?>" readonly> 
                      </div>
                      <br>
                      <input type="submit" value="Skapa post" class="btn">
                  </form>
                  <br>
                  <div class="line"></div>
                  <?php 
                      $post_list = $posts->getPosts();

                      foreach($post_list as $c) {
                          echo "<h2>" . $c['title'] . "</h2>"
                          . "<p>" . $c['content'] 
                          . "<a href='admin.php?delete_id=". $c['id'] . "'>Radera</a>"
                          . " - <a href='edit.php?id=" . $c['id'] . "'>Uppdatera</a>";
                      }  
                  ?>

            <?php include("includes/footer.php"); ?>