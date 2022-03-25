<?php include_once("includes/config.php");?>
<?php

if(isset($_GET['username'])) {
    $username = ($_GET['username']);
} else {
    header("location: startpage.php");
}

$usernamePosts = new Posts();
$item = $usernamePosts->getPostsByUsername($username);

?>

<?php include("includes/head.php"); ?>
    <?php include("includes/header.php"); ?>
        <?php include("includes/navigering.php"); ?>
 
            <h2>Användarens inlägg</h2>

            <?php
            foreach($item as $post){
            ?>
            
            <h3><?= $post['title']; ?></h3>
            <?= $post['postdate']; ?> - <?= $post['username']; ?>
            <?= $post['content']; ?>

            <?php
            }
            ?>

            <?php include("includes/footer.php"); ?>
