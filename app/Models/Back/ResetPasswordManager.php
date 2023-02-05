<?php
namespace App\Models\Back;
use PDO;
use App\Models\DBConnect\DBConnect;


class ResetPasswordManager extends DBConnect {
 
    public function __construct()
    {
    }

    public function deleteEmail($email){
        $req = 'DELETE FROM pwdreset WHERE pwdResetEmail=:email';
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(':email',$email, PDO::PARAM_STR);
        //Execute
        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }

    public function insertToken($email, $selector, $hashedToken, $expires){
        $req='INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, 
        pwdResetExpires) VALUES (:email, :selector, :token, :expires)';
        $stmt = $this->getDB()->prepare($req);
         $stmt->bindValue(':email', $email, PDO::PARAM_STR);
         $stmt->bindValue(':selector', $selector, PDO::PARAM_STR);
         $stmt->bindValue(':token', $hashedToken, PDO::PARAM_STR);
         $stmt->bindValue(':expires', $expires, PDO::PARAM_STR);
        //Execute
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function resetPassword($selector, $currentDate){
        $req = 'SELECT * FROM pwdreset WHERE  pwdResetSelector=:selector AND pwdResetExpires >= :currentDate';
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(':selector',$selector, PDO::PARAM_STR);
        $stmt->bindValue(':currentDate',$currentDate, PDO::PARAM_STR);
        //Execute
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        //Check row
        if($stmt->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }
}