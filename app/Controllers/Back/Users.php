<?php
namespace App\Controllers\Back;
use App\Models\Back\UserManager;

require_once './app/helpers/session_helper.php';

class Users {

    private $userModel;
    
    public function __construct(){
        $this->userModel = new UserManager;
    }

    public function register(){
        //Process form
        
        //Sanitize POST data
        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $usersName = htmlspecialchars($_POST['usersName']);
        $usersEmail = htmlspecialchars($_POST['usersEmail']);
        $usersUid = htmlspecialchars($_POST['usersUid']);
        $usersPwd = htmlspecialchars($_POST['usersPwd']);
        $pwdRepeat = htmlspecialchars($_POST['pwdRepeat']);

        //Init data
        $data = [
            'usersName' => trim($usersName),
            'usersEmail' => trim($usersEmail),
            'usersUid' => trim($usersUid),
            'usersPwd' => trim($usersPwd),
            'pwdRepeat' => trim($pwdRepeat)
        ];

        //Validate inputs
        if(empty($data['usersName']) || empty($data['usersEmail']) || empty($data['usersUid']) || 
        empty($data['usersPwd']) || empty($data['pwdRepeat'])){
            flash("register", "Please fill out all inputs");
            redirect("../user/signup");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['usersUid'])){
            flash("register", "Invalid username");
            redirect("../user/signup");
        }

        if(!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)){
            flash("register", "Invalid email");
            redirect("../user/signup");
        }

        if(strlen($data['usersPwd']) < 6){
            flash("register", "Invalid password");
            redirect("../user/signup");
        } else if($data['usersPwd'] !== $data['pwdRepeat']){
            flash("register", "Passwords don't match");
            redirect("../user/signup");
        }

        //User with the same email or password already exists
        if($this->userModel->findUserByEmailOrUsername($data['usersEmail'], $data['usersName'])){
            flash("register", "Username or email already taken");
            redirect("./signup");
        }

        //Passed all validation checks.
        //Now going to hash password
        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);
   
        //Register User
        if($this->userModel->register($data)){
            redirect("../common/login");
        }else{
            die("Something went wrong");
        }
    }

    public function login()
    {
        //Sanitize POST data
        $nameOrEmail = htmlspecialchars($_POST['name/email']);
        $usersPwd = htmlspecialchars($_POST['usersPwd']);

        //Init data
        $data=[
            'name/email' => trim($nameOrEmail),
            'usersPwd' => trim($usersPwd)
        ];
     
        if(empty($data['name/email']) || empty($data['usersPwd'])){
            flash("login", "Please fill out all inputs");
            header("location: ./login");
            exit();
        }

        //Check for user/email
        if($this->userModel->findUserByEmailOrUsername($data['name/email'], $data['name/email'])){
            //User Found
            $loggedInUser = $this->userModel->login($data['name/email'], $data['usersPwd']);
            if($loggedInUser){
                //Create session
                $this->createUserSession($loggedInUser);
            }else{
                flash("login", "Password Incorrect");
                redirect("../common/login");
            }
        }else{
            flash("login", "No user found");
            redirect("../common/login");
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['usersId'] = $user[0]->usersId;
        $_SESSION['usersName'] = $user[0]->usersName;
        $_SESSION['usersEmail'] = $user[0]->usersEmail;
        // echo('ok'); die;
        redirect("../admin/home");
    }

    public function logout()
    {
        unset($_SESSION['usersId']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersEmail']);
        session_destroy();
        redirect("./login");
    }
}

$init = new Users;

//Ensure that user is sending a post request
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    switch($_POST['type']){
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
        default:
        redirect("./login"); //?????
    }
    
}else{
    $url= $_SERVER['REQUEST_URI'];  
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);

    switch($params){
        case 'logout':
            $init->logout();
            break;
        default:
        redirect("./login");
    }
}

