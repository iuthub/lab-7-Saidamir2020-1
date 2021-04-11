<?php

class UsersRepo {
    private $db;

    private $getUserStmt;
    private $addUserStmt;
    private $updateUserStmt;
    private $getFullname;

    public function __construct($db) {
        $this->db = $db;
        $this->getUserStmt = $db->prepare('SELECT * FROM users WHERE username=?');
        $this->addUserStmt = $db->prepare('INSERT INTO users(id,username, email, password, fullname,dob) VALUES(?,?,?,?,?,?)');
        $this->updateUserStmt=$db->prepare('UPDATE users SET username=?,email=?,password=?,fullname=?,dob=? WHERE id=?');
        $this->getFullname=$db->prepare("   SELECT u.fullname
                                            FROM users u
                                            JOIN posts p ON u.id=p.userId
                                            WHERE userId=? limit 1");
    }
    public function getFullname($id){
            $this->getFullname->execute(array($id));
            $fullname=$this->getFullname->fetchAll();
            return $fullname;
    }

    public function getUser($username) {
        $this->getUserStmt->execute(array($username));
        if($this->getUserStmt->rowCount()>0) {
            return $this->getUserStmt->fetch();
        }
        return NULL;
    }

    public function checkUser($username, $pwd) {
        $user=$this->getUser($username);
        return $user && $user['password']==$pwd;
    }
    public function updateUser($username,$email,$password,$fullname,$dob,$id) {
            $this->updateUserStmt->execute(array($username,$email,$password,$fullname,$dob,$id));
            return true;
    }

    public function addUser($id,$username, $email, $pwd, $name,$dob) {
        if (!$this->getUser($username)) {
            $this->addUserStmt->execute(array(
                $id,
                $username,
                $email,
                $pwd,
                $name,
                $dob
            ));
            return true;
        }
        return false;
    }
}


?>