<?php
include 'header.php';
if(!$_SESSION['isAuth']) redirect('index.php');

$id = isset($_GET['id'])?$_GET['id']:'';
$title = "";
$body = "";
$publishDate =  date("Y/m/d");

if($id) {
    $row=$postRepo->getPost($id);
    $title = $row['title'];
    $body = $row['body'];
}


$titlePattern = "/^.+$/i";
$bodyPattern = "/^.+$/i";

$isValid = TRUE;

if($isPost) {
    $title = $_REQUEST['title'];
    $body = $_REQUEST['body'];
}
?>
<h2>New Post</h2>
    <table>
        <tr>
            <td>Title</td>
            <td>
                <input type="text" style="width:400px;" name="title" form="postForm" value="<?= $title ?>"/>
                <?php if ($isPost && !preg_match($titlePattern, $title)): $isValid=false; ?>
                    <span class="error">Required field.</span>
                <?php endif ?>

            </td>
        </tr>
        <tr>
            <td>Body</td>
            <td>
                <textarea name='body' form='postForm' style="width:400px;" rows="10" cols="50"><?= $body ?></textarea>
            </td>
        </tr>

    </table>
<?php
if($isPost && $isValid) {
    if ($id) {
        $postRepo->updatePost($id, $title, $body);
    } else {
        $postRepo->addPost($title,$body,$_SESSION['user']['id']);
    }
    redirect('index.php');
}
?>
    </div>
    <div class="article-footer">
        <div class="article-meta">

        </div>
        <div class="article-actions">
            <form id="postForm" action="newPost.php?id=<?= $id ?>" method="post">
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>


<?php
include 'footer.php';
?>