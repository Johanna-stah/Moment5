<?php require_once "includes/config.php";?>
<?php include("includes/head.php"); ?>
    <?php include("includes/header.php"); ?>
        <?php include("includes/navigering.php"); ?>    
                    <h2>Startsida</h2>
                    <?php 
                        $usernamepages = new Posts();
                        $usernameposts = $usernamepages->getUsername();
                        foreach($usernameposts as $user){
                    ?>
                        <a href="usernamePage.php?username=<?= $user['username'];?>" class="btn"><?= $user['username']; ?> </a>
                    <?php
                        }     
                    ?> 
                    <button class="btn"><a role="button" class="white-text" onclick="darkmode()">Dark mode</a></button>
                    <div class="line"></div>

                    <?php 
                    $pages = new Posts();
                    $startPagePosts = $pages->getLimitedPosts();
                    foreach($startPagePosts as $item) {
                    ?>
                        <h3><a href="pages.php?id=<?= $item['id'];?>"><?= $item['title']; ?> </a></h3>
                        <p><?= $item['postdate']; ?> - <?= $item['username']; ?></p> 
                        <p><?= $item['content']; ?>
                        <?php
                    }
                    ?>
            <?php include("includes/footer.php"); ?>
