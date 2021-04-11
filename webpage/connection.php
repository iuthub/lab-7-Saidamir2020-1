<?php
include "users.php";
include 'posts.php';
$db =new PDO('mysql:host=localhost; dbname=blog','said','yXb84YNN6gc446n5');

$userRepo = new UsersRepo($db);
$postRepo = new PostsRepo($db);
?>