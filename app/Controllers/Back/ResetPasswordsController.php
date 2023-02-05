<?php
namespace App\Controllers\Back;
use App\Models\Back\UserManager;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\Back\ResetPasswordManager;


require_once './app/helpers/session_helper.php';

//Require PHP Mailer
require_once './app/PHPMailer/src/PHPMailer.php';
require_once './app/PHPMailer/src/Exception.php';
require_once './app/PHPMailer/src/SMTP.php';

class ResetPasswordsController {
    private $resetModel;
    private $userModel;
    private $mail;
    
    public function __construct(){
        $this->resetModel = new ResetPasswordManager;
        $this->userModel = new UserManager;
        //Setup PHPMailer
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.mailtrap.io';
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 2525;
        $this->mail->Username = '3552d65bee6f20';
        $this->mail->Password = '9d0ced55afb500';
    }

    public function sendEmail()
    {
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $usersEmail = trim($_POST['usersEmail']);

        if(empty($usersEmail)){
            flash("reset", "Please input email");
            redirect("../common/reset");
        }

        if(!filter_var($usersEmail, FILTER_VALIDATE_EMAIL)){
            flash("reset", "Invalid email");
            redirect("../common/reset");
        }
        //Will be used to query the user from the database
        $selector = bin2hex(random_bytes(8));
        //Will be used for confirmation once the database entry has been matched
        $token = random_bytes(32);
        //URL will vary depending on where the website is being hosted from
        $url = 'http://localhost/udemy/projets/serveurFSmyZoo/back/common/new?selector='.$selector.'&validator='.bin2hex($token);
        //Expiration date will last for half an hour
        $expires = date("U") + 1800;
        if(!$this->resetModel->deleteEmail($usersEmail)){
            die("There was an error");
        }
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        if(!$this->resetModel->insertToken($usersEmail, $selector, $hashedToken, $expires)){
            die("There was an error");
        }
        //Can Send Email Now
        $subject = "Reset your password";
        $message = "<p>We recieved a password reset request.</p>";
        $message .= "<p>Here is your password reset link: </p>";
        $message .= "<a href='".$url."'>".$url."</a>";

        $this->mail->setFrom('contact@myzoo.com');
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->addAddress($usersEmail);

        $this->mail->send();

        flash("reset", "Check your email", 'alert alert-success');
        redirect("../common/reset");
    }

    public function resetPassword()
    {
        //Sanitize POST data
        $selector = htmlspecialchars($_POST['selector']);
        $validator = htmlspecialchars($_POST['validator']);
        $pwd = htmlspecialchars($_POST['pwd']);
        $pwdRepeat = htmlspecialchars($_POST['pwd-repeat']);

        $data = [
            'selector' => trim($selector),
            'validator' => trim($validator),
            'pwd' => trim($pwd),
            'pwd-repeat' => trim($pwdRepeat)
        ];
    
        $url = '../common/new?selector='.$data['selector'].'&validator='.$data['validator'];

        if(empty($_POST['pwd'] || $_POST['pwd-repeat'])){
            flash("newReset", "Please fill out all fields");
            redirect($url);
        }else if($data['pwd'] != $data['pwd-repeat']){
            flash("newReset", "Passwords do not match");
            redirect($url);
        }else if(strlen($data['pwd']) < 6){
            flash("newReset", "Invalid password");
            redirect($url);
        }

        $currentDate = date("U");
        if(!$row = $this->resetModel->resetPassword($data['selector'], $currentDate)){
            flash("newReset", "Sorry. The link is no longer valid");
            redirect($url);
        }

        $tokenBin = hex2bin($data['validator']);
        $tokenCheck = password_verify($tokenBin, $row->pwdResetToken);
        if(!$tokenCheck){
            flash("newReset", "You need to re-Submit your reset request");
            redirect($url);
        }

        $tokenEmail = $row->pwdResetEmail;
        if(!$this->userModel->findUserByEmailOrUsername($tokenEmail, $tokenEmail)){
            flash("newReset", "There was an error");
            redirect($url);
        }

        $newPwdHash = password_hash($data['pwd'], PASSWORD_DEFAULT);
        if(!$this->userModel->resetPassword($newPwdHash, $tokenEmail)){
            flash("newReset", "There was an error");
            redirect($url);
        }

        if(!$this->resetModel->deleteEmail($tokenEmail)){
            flash("newReset", "There was an error");
            redirect($url);
        }

        flash("newReset", "Password Updated, please log-in", 'alert alert-success');
        redirect($url);
    }
}

$init = new ResetPasswordsController;

//Ensure that user is sending a post request
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['type']){
        case 'send':
            $init->sendEmail();
            break;
        case 'reset':
            $init->resetPassword();
            break;
        default:
        header("location: ../common/reset");
    }
}else{
    header("location: ../common/login");
}