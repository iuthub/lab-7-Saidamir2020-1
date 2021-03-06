<?php
class PostsRepo {
    private $db;

    private $getPostsStmt;
    private $getPostStmt;
    private $addPostStmt;
    private $updatePostStmt;
    private $deletePostStmt;

    public function __construct($db) {
        $this->db = $db;
        $this->getPostsStmt = $db->prepare('SELECT * FROM posts');
        $this->getPostStmt = $db->prepare('SELECT * FROM posts WHERE id=?');
        $this->addPostStmt = $db->prepare('INSERT INTO posts(title, body, userId) VALUES(?,?,?)');
        $this->updatePostStmt = $db->prepare('UPDATE posts SET title=?, body=? WHERE id=?');
        $this->deletePostStmt = $db->prepare('DELETE FROM posts WHERE id=?');
    }

    public function getPosts() {
        $this->getPostsStmt->execute();
        return $this->getPostsStmt->fetchAll();
    }

    public function getPost($userId) {
        $this->getPostStmt->execute(array($userId));
        return $this->getPostStmt->fetch();
    }

    public function addPost($title, $body,$userId) {
        $this->addPostStmt->execute(array($title, $body,$userId));
    }

    public function updatePost($id, $title, $body) {
        $this->updatePostStmt->execute(array($title, $body, $id));
    }

    public function deletePost($id) {
        $this->deletePostStmt->execute(array($id));
    }
}

?>