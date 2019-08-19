<?php
ini_set('display_errors', 1);

class User_Controller extends Controller
{
    public static function create_user()
    {
        // check the token integrity
        if (!hash_equals($_SESSION['key'], $_POST['token'])) {
            echo '{"status":"0","message":"Invalid token"}';
            exit;
        }
        // check if passwords matches
        if ($_POST['txtPassword'] != $_POST['txtConfirmPassword']) {
            echo '{"status":"0","message":"Passwords don\'t match"}';
            exit;
        }

        // check length of password
        if(strlen($_POST['txtPassword']) < 8 ){
            echo '{"status":"0","message":"Password should be at least 8 characters"}';
            exit;
        }

        // check length of username
        if (strlen($_POST['txtUsername']) < 4 || strlen($_POST['txtUsername']) > 20) {
            echo '{"status":"0","message":"Username should be between 6 and 20 character"}';
            exit;
        }


        //Preventing the user to create admin or moderator 
        if ($_POST['txtUsername'] === 'admin' ||
            $_POST['txtUsername'] === 'moderator' ||
            strpos($_POST['txtUsername'], 'admin') !== false ||
            strpos($_POST['txtUsername'], 'moderator') !== false) {
            echo '{"status":"0","message":"Reserved username"}';
            exit;
        }
        // check if it valid email
        if (!filter_var($_POST['txtEmail'], FILTER_VALIDATE_EMAIL)) {
            echo '{"status":"0","message":"Enter valid email"}';
            exit;
        }
        // check if the fields are empty
        if (empty($_POST['txtUsername']) ||
            empty($_POST['txtEmail']) ||
            empty($_POST['txtPassword']) ||
            empty($_POST['txtConfirmPassword'])) {
            echo '{"status":"0","message":"Please fill all the fields"}';
            exit;
        }

        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $_POST['txtPassword']);
        $lowercase = preg_match('@[a-z]@', $_POST['txtPassword']);
        $number = preg_match('@[0-9]@', $_POST['txtPassword']);
        $specialChars = preg_match('@[^\w]@', $_POST['txtPassword']);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['txtPassword']) < 8) {
            echo '{"status":"0","message":"The password is too weak"}';
            die();
        }

        //hash the password
        $user_password = password_hash($_POST['txtPassword'], PASSWORD_BCRYPT);
        // trim variables
        $username = $_POST['txtUsername'];
        $email = trim($_POST['txtEmail']);

        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $user_class = new Users;
        $returnedID = $user_class->sign_up_user($username, $user_password, $email, $token);
        // mailer::sent_mail($_POST['txtEmail'], $token , $returnedID , $username);

    }

    public static function login_user()
    {

        if (!hash_equals($_SESSION['key'], $_POST['token'])) {
            echo '{"status":"0","message":"Invalid token"}';
            exit;
        }

        //checking length
        if (strlen($_POST['txtPassword']) < 8) {
            echo '{"status":"0","message":"Wrong username or password"}';
            exit;
        }
        // check length of user name
        if (strlen($_POST['txtUsername']) < 4 || strlen($_POST['txtUsername']) > 20) {
            echo '{"status":"0","message":"Wrong username or password"}';
            exit;
        }
        // trim variables
        $username = $_POST['txtUsername'];
        $user_model = new Users;


        $selected_user = $user_model->select_username($username);

        //we are checking if the size of the array is zero or and doesn't match the user is not verifed 
        if (sizeof($selected_user) === 0 || $selected_user[0]['username'] != $username) {
            echo '{"status":"0","message":"Wrong username or password"}';
            exit;
        }

        $verified_user = $user_model->select_username_and_password($username);
        if (!password_verify($_POST['txtPassword'], $verified_user[0]['password_hashed'])) {
            echo '{"status":"0","message":"Wrong user name or password"}';
            exit;
        }

        $_SESSION['User'] = $verified_user[0];
        echo '{"status":"1","message":"User logged in"}';
        // print_r($_SESSION['User']);
    }

    public static function verify_user()
    {
        require_once("./includes/views/verify_user.php");
        $token = $_GET['token'];
        $used_Id = $_GET['id'];
        $user_model = new Users;
        $user_model->activate_user($token, $used_Id);

    }

    public static function logout()
    {
        session_start();
        session_destroy();
        header('Location: index.php');

    }
}