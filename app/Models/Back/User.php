<?php
namespace App\Models\Back;
use PDO;
use App\Models\DBConnect\DBConnect;

class User extends DBConnect
{

    //Find user by email or username
    public function findUserByEmailOrUsername($email, $username){
        $req = ('SELECT * FROM users WHERE usersUid = :username OR usersEmail = :email');
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        //Check row
        if($stmt->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    //Register User
    public function register($data){
        $req = ('INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) 
        VALUES (:name, :email, :Uid, :password)');
        $stmt = $this->getDB()->prepare($req);
        //Bind values
        $stmt->bindValue(':name', $data['usersName'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['usersEmail'], PDO::PARAM_STR);
        $stmt->bindValue(':Uid', $data['usersUid'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $data['usersPwd'], PDO::PARAM_STR);

        //Execute
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Login user
    public function login($nameOrEmail, $password){
        $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail);

        if($row == false) return false;

        $hashedPassword = $row->usersPwd;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }

    //Reset Password
    public function resetPassword($newPwdHash, $tokenEmail){
        $req = ('UPDATE users SET usersPwd=:pwd WHERE usersEmail=:email');
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