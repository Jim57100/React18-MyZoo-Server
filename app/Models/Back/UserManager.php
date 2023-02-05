<?php
namespace App\Models\Back;
use PDO;
use App\Models\DBConnect\DBConnect;

class UserManager extends DBConnect {

    //Find user by email or username
    public function findUserByEmailOrUsername($email, $username){
        $req = 'SELECT * FROM users WHERE usersUid = :username OR usersEmail = :email';
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);

        //Check row
        if($stmt->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    //Register User
    public function register($data)
    {
        $req = 'INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, role) 
        VALUES (:name, :email, :Uid, :password, :role)';
        $stmt = $this->getDB()->prepare($req);
        //Bind values
        $stmt->bindValue(':name', $data['usersName'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['usersEmail'], PDO::PARAM_STR);
        $stmt->bindValue(':Uid', $data['usersUid'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $data['usersPwd'], PDO::PARAM_STR);
        $stmt->bindValue(':role', 'user', PDO::PARAM_STR);

        //Execute
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Login user
    public function login($nameOrEmail, $password)
    {
        $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail);
        // echo '<pre>';
        // print_r($row[0]->usersPwd);
        // echo '</pre>';
        // die;

        if($row == false) return false;

        $hashedPassword = $row[0]->usersPwd;
        // echo strlen($hashedPassword); die;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }
    
    //Reset Password
    public function resetPassword($newPwdHash, $tokenEmail)
    {
        $req = 'UPDATE users SET usersPwd=:pwd WHERE usersEmail=:email';
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(':pwd', $newPwdHash, PDO::PARAM_STR);
        $stmt->bindValue(':email', $tokenEmail, PDO::PARAM_STR);

        //Execute
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}