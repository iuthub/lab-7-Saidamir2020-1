<?php
$user = $_SESSION['user'];
if($isPost && $action == 'logout'){
    $_SESSION['isAuth']=FALSE;
    redirect('index.php');
}

if($isPost && $action == 'newPost'){
    $_SESSION['isAuth']=TRUE;
    redirect('newPost.php');
}
if($isPost && $action == 'MyProfile'){
    $_SESSION['isAuth']=TRUE;
    redirect('editUser.php');
}
?>
<?php
if($_SESSION['isAuth']){
?>
<li>
    <h2>Welcome <?= $user['fullname'] ?></h2>
</li>

<div class="onecol">
    <div class="logout_panel">
        <form action="editUser.php?action=MyProfile" method="post">
            <input type="submit" value="My Profile">
        </form>
        <form action="index.php?action=logout" method="post">
            <input type="submit" value="Logout">
        </form>
        <form action="newPost.php?action=newPost" method="post">
            <input type="submit" value="New Post">
        </form>
    </div>
</div>

<?php
} ?>

