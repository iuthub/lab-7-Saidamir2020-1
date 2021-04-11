<?php

$isFailed = false;

$username = isset($_COOKIE['username'])?$_COOKIE['username']:"";
$pwd = isset($_COOKIE['pwd'])?$_COOKIE['pwd']:'';

if($isPost){

    $username = $_REQUEST['username'];
    $pwd = $_REQUEST['pwd'];
    $remember = isset($_REQUEST['remember']);

    if($remember){
            setcookie('username',$username, time()+3600);
            setcookie('pwd',$pwd, time()+3600);
    }
    else {
        setcookie('username',$username, time() - 1);
        setcookie('pwd',$pwd, time() - 1);
    }
    if($userRepo->checkUser($username,$pwd)){
        $_SESSION['user'] = $userRepo->getUser($username);
        $_SESSION['isAuth'] = true;
        redirect('index.php');
    }
    else {
        $isFailed = true;
    }

}
?>

<div class="twocols">
    <form action="index.php" method="post" class="twocols_col">
        <ul class="form">
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?= $username ?>" />
            </li>
            <li>
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd" value="<?= $pwd ?>"/>
            </li>
            <?php if ($isFailed): ?>
                <span class="error">Incorrect login or password.</span>
            <?php endif ?>
            <li>
                <label for="remember">Remember Me</label>
                <input type="checkbox" name="remember" id="remember" checked />
            </li>
            <li>
                <form id="loginForm" action="index.php?action=login" method="post">
                    <input type="submit" value="Login" /> &nbsp;
                </form>
            </li>
            <li>
                Not registered? <a href="register.php">Register</a>
            </li>
        </ul>
    </form>
    <div class="twocols_col">
        <h2>About Us</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur libero nostrum consequatur dolor. Nesciunt eos dolorem enim accusantium libero impedit ipsa perspiciatis vel dolore reiciendis ratione quam, non sequi sit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nobis vero ullam quae. Repellendus dolores quis tenetur enim distinctio, optio vero, cupiditate commodi eligendi similique laboriosam maxime corporis quasi labore!</p>
    </div>
</div>
