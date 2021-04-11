<?php
include 'header.php';
$username ='';
$email ='';
$password ='';
$confirmPwd ='';
$fullname ='';
$id = isset($_GET['id'])?$_GET['id']:'';

$dob= '';

$usernamePattern='/^\w{4,}$/i';
$pwdPattern='/^\w{4,}$/i';
$namePattern='/^[a-z]+( [a-z]+)*$/i';
$emailPattern='/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i';

$isOk = TRUE;
$isValid = TRUE;


if($isPost) {
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['pwd'];
    $confirmPwd = $_REQUEST['confirm_pwd'];
    $fullname = $_REQUEST['fullname'];
}
if($_SESSION['isAuth']){
    $username=$_SESSION['user']['username'];
    $email=$_SESSION['user']['email'];
    $fullname = $_SESSION['user']['fullname'];
    $password = $_SESSION['user']['password'];
    $confirmPwd = $_SESSION['user']['password'];
}
?>
	<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php" method="post">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" value="<?= $username ?>" required/>
                        <?php if ($isPost && !preg_match($usernamePattern, $username)): $isValid=false; ?>
                            <span class="error">Required field.</span>
                        <?php endif ?>
					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" name="fullname" id="fullname" value="<?= $fullname ?>" required/>
                        <?php if ($isPost && !preg_match($namePattern, $fullname)): $isValid=false; ?>
                            <span class="error">Required field.</span>
                        <?php endif ?>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" value="<?= $email ?>" />
                        <?php if ($isPost && !preg_match($emailPattern, $email)): $isValid=false; ?>
                            <span class="error">Not a valid email.</span>
                        <?php endif ?>
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" value="<?=$password ?>" required/>
                        <?php if ($isPost && (!preg_match($pwdPattern, $password) || $password!=$confirmPwd)): $isValid=false; ?>
                            <span class="error">Required field.</span>
                        <?php endif ?>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" name="confirm_pwd" id="confirm_pwd" value="<?= $confirmPwd?>" required />
					</li>
                    <li>
                        <input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
                    </li>
                    <?php
                    if($isPost && $isValid) {
                        $isOk = $userRepo->addUser($id, $username, $email, $password, $fullname, $dob);
                        if ($isOk) {
                            redirect('index.php');
                        }
                    }
                    ?>
                    <?php if (!$isOk): ?>
                        <span class="error"><h1>This user exists in database!</h1></span>
                    <?php endif ?>
				</ul>
		</form>
<?php include 'footer.php';?>