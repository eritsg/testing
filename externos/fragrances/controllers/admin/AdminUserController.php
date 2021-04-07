<?php


class AdminUserController{

    private $user;
    // private $adG;

    public function __construct()
    {
        $this->user = new AdminUserModel();
    }

    public function listUsers(){
        AuthController::isLogged();
        if(isset($_GET['id']) && isset($_GET['status']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $status = $_GET['status'];
            $user = new Users();
            if($status==1){
                $status = 0;
            }else{
                $status = 1;
            }
            $user->setId($id);
            $user->setStatus($status);

            $this->user->updateStatus($user);
        }
        $allUsers = $this->user->getUsers();
        require_once('./views/admin/users/AdminUsersItems.php');

    }

    public function login(){
        AuthController::isLogged();
        if(isset($_POST['submitted'])){
            if(strlen($_POST['pass']) >= 4 && !empty($_POST['loginEmail'])){
                $loginEmail = trim(htmlentities(addslashes($_POST['loginEmail'])));
                $pass = md5(trim(htmlentities(addslashes($_POST['pass']))));
                $data_u = $this->user->signIn($loginEmail, $pass);
            if(!empty($data_u)){
                   session_start();
                   $_SESSION['Auth'] = $data_u;
                   header('location:index.php?action=list_products');
                }else{
                    $error = "Votre login/email ou/et mot de passe ne correspondent pas";
                }
            }else{
                $error = "Entrée les données valides";
            }
        }
        
        require_once('./views/admin/users/login.php');
    }

    public function SignUp(){
        AuthController::isLogged();
        if(isset($_POST['submitted'])){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && strlen($_POST['password']) >= 4){
                $login = trim(htmlentities(addslashes($_POST['login'])));
                $name = trim(htmlentities(addslashes($_POST['name'])));
                $email = trim(htmlentities(addslashes($_POST['email'])));
                $password = md5(trim(htmlentities(addslashes($_POST['password']))));
                
                $newUser = new Users();
                $newUser->setLogin($login);
                $newUser->setName($name);
                $newUser->setEmail($email);
                $newUser->setPassword($password);
                $newUser->setStatus(1);

                $ok = $this->user->register($newUser);
                if($ok){
                    header('location:index.php?action=list_users');
                }
            }
        }
        // $allGrades = $this->adG->getGrades();
        require_once('./views/admin/users/register.php');
    }

    public function editUser(){
        AuthController::isLogged();
        if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
            $id = $_GET['id'];
            $editUser = new Users();
            $editUser->setId($id);
            $userEdition = $this->user->userFinder($editUser);

            if(isset($_POST['submitted'])){
                $id = trim(htmlentities(addslashes($_POST['id'])));
                $login = trim(htmlentities(addslashes($_POST['login'])));
                $name = trim(htmlentities(addslashes($_POST['name'])));
                $email = trim(htmlentities(addslashes($_POST['email'])));
                $password = md5(trim(htmlentities(addslashes($_POST['password']))));
                $status = trim(htmlentities(addslashes($_POST['status'])));
                
                $userEdition->setId($id);
                $userEdition->setLogin($login);
                $userEdition->setName($name);
                $userEdition->setEmail($email);
                $userEdition->setPassword($password);
                $userEdition->setStatus($status);
                
               $ok = $this->user->updateUser($userEdition);
               if($ok > 0){
                   header('location:index.php?action=list_users');
                }
            }
            require_once('./views/admin/users/editUser.php');
        }
    }
}