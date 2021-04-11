<?php
include "header.php";
?>
<?php
if($_SESSION['isAuth']){
?>
<div class="onecol">

    <?php if(isset($_SESSION['isAuth'])){

        foreach ($postRepo->getPosts() as $post):?>
            <div class="card">
                <h2>TITLE: <?= $post['title'] ?></h2>
                <h5>Author: <?php  $name = $userRepo->getFullname($post['userId']);
                                    foreach ($name as $item): ?>
                                    <?= $item['fullname']?>
                                    <?php endforeach; ?>
                </h5>
                <p><?= $post['body']?></p>
            </div>
        <?php endforeach;} ?>
</div>
<?php
}
?>

<?php
include "footer.php";
?>

