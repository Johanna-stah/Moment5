<?php include_once("includes/config.php");?>
<?php
if(isset($_GET['id'])) {
    $id = ($_GET['id']);
} else {
    header("location: startpage.php");
}
$posts = new Posts();
$post = $posts->getPostsID($id);
?>

<?php include("includes/head.php"); ?>
    <?php include("includes/header.php"); ?>
        <?php include("includes/navigering.php"); ?>

                <h3><?= $post['title']; ?></h3>
                <?= $post['postdate']; ?> - <?= $post['username']; ?>
                <?= $post['content']; ?>

            <?php include("includes/footer.php"); ?>
