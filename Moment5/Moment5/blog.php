<?php require_once "includes/config.php";?>
<?php include("includes/head.php"); ?>
    <?php include("includes/header.php"); ?>   
            <?php include("includes/navigering.php"); ?>
                <h2>Alla inlägg!</h2>                    
                <div class="line"></div>
                <?php 
                    $pages = new Posts();
                    $postID = $pages->getPosts();

                    foreach($postID as $item) {
                    ?>
                    
                    <h3><a href="pages.php?id=<?= $item['id'];?>"><?= $item['title']; ?> </a></h3>
                    <?= $item['postdate']; ?> - <?= $item['username']; ?>
                    <?= $item['content']; ?> 
                    <?php
                    }

                ?>
                <script>
    
    if(localStorage.getItem('dark')) {
         body.classList.add('dark');
    }
</script>
            <?php include("includes/footer.php"); ?>
