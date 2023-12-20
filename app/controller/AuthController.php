<?php
namespace Myapp\controller; 
require'../../vendor/autoload.php';
use Myapp\model\User;


session_start();


class AuthController
{
    // private $user;

    public function registre($first_name, $last_name, $email, $password, $phone)
    {
        $user = new User($first_name, $last_name, $email, $password, $phone);
        if ($user->CreateUser()) 
        {
            $this->redirection(2);
        }else 
        {
            echo "Erreur d'Ajout d'Utilisateur";
        }
    }

    public function login($email, $password)
    {
     $user = new User('', '', $email, $password, '');

     if ($user->getbyEmail()) 
     {
        $this->redirection($_SESSION['role']);
     }else {
        echo 'Email ou Mot de passe Incorrecte!';
     }

    }

    public function redirection($role)
    {
        switch ($role) 
        {
            case '1':
                header('location:../../views/auth/login.php?Welcomeadmin');
                exit();
            case '2':
                header('location:../../views/auth/login.php?user');
                exit();    
            
            default:
                echo 'Role NON Reconnu'; 
                break;
        }
    }

}


   if (isset($_POST['submit-up'])) 
   {

   $firstname = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $passw = $_POST['password'];
    $phone = $_POST['phone'];

    $userController = new AuthController();
   $userController->registre($firstname, $last_name, $email, $passw, $phone);
   }


   if (isset($_POST['submit-in'])) 
   {
    $email=$_POST['email'];
    $passw=$_POST['password'];

    $userController = new AuthController();
    $userController->login($email, $passw);

   }
?>