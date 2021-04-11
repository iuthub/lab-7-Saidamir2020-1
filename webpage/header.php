<?php
session_start();
include('connection.php');
include 'functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>My Personal Page</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<h1>My Blog</h1>
<h4>In this web site you can leave any post you want.</h4>
<hr />
<!-- Show this part if user is not signed in yet -->
<?php
if(isset($_SESSION['isAuth']) && $_SESSION['isAuth']){
    include 'logout.php';
}
else {
    include 'login.php';
}
?>

<!-- Show this part after user signed in successfully -->

