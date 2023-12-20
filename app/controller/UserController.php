<?php
// namespace Myapp\controller;
// require'../../vendor/autoload.php';


// use Myapp\model\User;

// class UserController
// {
//     // private $user;

//     public function registre($first_name, $last_name, $email, $password, $phone)
//     {
//         $user = new User($first_name, $last_name, $email, $password, $phone);
//         if ($user->CreateUser()) 
//         {
//             $this->redirection(2);
//         }else 
//         {
//             echo "Erreur d'Ajout d'Utilisateur";
//         }
//     }

//     public function login($email, $password)
//     {
//      $user = new User('', '', $email, $password, '');

//      if ($user->getbyEmail()) 
//      {
//         $this->redirection($_SESSION['role']);
//      }else {
//         echo 'Email ou Mot de passe Incorrecte!';
//      }

//     }

//     public function redirection($role)
//     {
//         switch ($role) 
//         {
//             case '1':
//                 header('location:../../views/auth/login.php?Welcomeadmin');
//                 exit();
//             case '2':
//                 header('location:../../views/auth/login.php?Welcomeuser');
//                 exit();    
            
//             default:
//                 echo 'Role NON Reconnu'; 
//                 break;
//         }
//     }

    

// }

?>