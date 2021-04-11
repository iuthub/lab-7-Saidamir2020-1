<?php
include 'header.php';

$username ='';
$email ='';
$password ='';
$confirmPwd ='';
$fullname ='';
$id = $user['id'];
$dob ='';

$username1 = '';
$fullname1 = '';
$email1 = '';
$password1 = '';
$confirm_pwd1 ='';

if($isPost && $_SESSION['isAuth']){
    $user = $_SESSION['user'];
    $username1 = $_REQUEST['username1'];
    $fullname1 = $_REQUEST['fullname1'];
    $email1 = $_REQUEST['email1'];
    $password1 = $_REQUEST['pwd1'];
    $confirm_pwd1 = $_REQUEST['confirm_pwd1'];

}

?>
<h2>User Details Form</h2>
<h4>Please, fill below fields correctly</h4>
<form action="editUser.php" method="post">
    <ul class="form">
        <li>
            <label for="username">Username</label>
            <input type="text" name="username1" id="username1" value="<?= $user['username'] ?>" required/>
        </li>
        <li>
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname1" id="fullname1" value="<?= $user['fullname'] ?>" required/>
        </li>
        <li>
            <label for="email">Email</label>
            <input type="email" name="email1" id="email1" value="<?= $user['email'] ?>" />
        </li>
        <li>
            <label for="pwd">Password</label>
            <input type="password" name="pwd1" id="pwd1" value="<?= $user['password'] ?>" required/>
        </li>
        <li>
            <label for="confirm_pwd">Confirm Password</label>
            <input type="password" name="confirm_pwd1" id="confirm_pwd1" value="<?=  $user['password'] ?>" required />
        </li>
        <?php
        if($isPost){
            $userRepo->updateUser($username1,$email1,$password1,$fullname1,$confirm_pwd1,$id);
            $_SESSION['isAuth']=FALSE;
            redirect('index.php');
        }
        ?>
        <li>
            <input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
        </li>
</form>



<?php include 'footer.php';?>
