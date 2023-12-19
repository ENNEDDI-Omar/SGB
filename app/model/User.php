<?php
namespace Myapp\model;
use Myapp\database\Database;

use mysqli;
use mysqli_stmt;
use PDOException;
use PDO;

require'../../vendor/autoload.php';


class User{

    private $full_name;
    private $last_name;
    private $email;
    private $password;
    private $phone;
    private $conn;

  public function __construct($full_name, $last_name, $email, $password, $phone)
  {
    $this->conn = Database::connexion();
    $this->setFullName($full_name);
    $this->setLastName($last_name);
    $this->setEmail($email);
    $this->setPassword($password);
    $this->setPhone($phone);
  } 
  public function CreateUser()
  {

    $full_name = $this->getFullName();
    $last_name = $this->getLastName();
    $email = $this->getEmail();
    $password = $this->getPassword();
    $phone = $this->getPhone();

    $FullNameErreur = $this->validateFullName($full_name);
    $EmailErreur = $this->validateEmail($email);
    $passwErreur = $this->validatePassw($password);


    if (!empty($FullNameErreur) || !empty($EmailErreur) || !empty($passwErreur)) 
    {
        echo"Erreur de Validation : $FullNameErreur $EmailErreur $passwErreur";
        return false;
    }

        $hash_passw = password_hash($this->password, PASSWORD_DEFAULT);

    try{
        $requete =  "INSERT INTO 'user' ('fullname', 'last_name', 'email', 'password', 'phone')
        VALUES(:full_name, :last_name, :email, :password, :phone)";
           $stmt = $this->conn->prepare($requete);
           $stmt->bindParam(':full_name', $full_name);
           $stmt->bindParam(':last_name', $last_name);
           $stmt->bindParam(':email', $email);
           $stmt->bindParam(':password', $hash_passw);
           $stmt->bindParam(':phone', $phone);

        $result = $stmt->execute();

      if ($result) 
        {
            $lastId = $this->conn->lastInsertId();
            $requeteU_R = "INSERT INTO 'user_role'('id_user', 'id_role')
                            VALUES(':userId', '2')";
            $stmtU_R = $this->conn->prepare($requeteU_R);
            $stmtU_R->bindparam(':userId', $lastId);
            $resultU_R = $stmtU_R->execute();

            if ($resultU_R) {
                return true;
            }else {
                echo "Erreur d'Insertion du Role";
            }
          return false;
        }else {
          echo "Erreur d'Insertion d'User";
        }

        }catch(PDOException $e){
        echo "Erreur:" . $e->getMessage();
        return false;
        }  
        return false;
    }

  public function validateFullName($full_name)
  {
    return empty($full_name) ? 'Nom Complet est requis' : '';
  }

  private function validateEmail($email)
  {
    return empty($email) ? 'Adresse E-mail est requise' : '';
  }

  private function validatePassw($password)
  {
    return empty($password) ? 'Mot de Passe est Obligatoire' : '';
  }

  public function getAllUsers()
  {
    $requete = "SELECT U.*, R.name FROM user AS U
                INNER JOIN user_role AS UR ON U.id = UR.id_user
                INNER JOIN role AS R ON UR.id_role = R.id";
    $stmt = $this->conn->query($requete);
    
    if (!$stmt) 
    {
        echo "Erreur de Requete SQL: " . $this->conn->errorInfo()[2];
        return false;
    }else 
    {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }

  public function getbyEmail()
  {
    $email = $this->getEmail();
    $password = $this->password;
    $passwErreur = $this->validatePassw($password);

    if (!empty($passwErreur)) 
    {
        echo "Erreur de Validation: $passwErreur";
        return false;
    }

    $requete ="SELECT U.*, UR.id_role, R.name FROM user AS U 
                INNER JOIN user_role AS UR ON U.id = UR.id_user 
                INNER JOIN role AS R ON UR.id_role = R.id
                WHERE email = :email";

        $stmt = $this->conn->prepare($requete);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
    if (!$stmt) 
    {
        echo "Erreur de récupération d'utilisateur: " . $this->conn->errorInfo()[2];
        return false;
    }

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) 
    {
        echo "Utilisateur Inexistant";
        return false;
    }

    if (password_verify($password, $row['password'])) 
    {
        $_SESSION['role'] = $row['id_role'];
        return true;
    }else {
        echo "Mot de Passe Incorrecte";
        return false;
    }
  }
  ////Accesseurs full-name.///////////////////
    public function getFullName()
    {
        return $this->full_name;
    }
    public function setFullName($full_name)
    {
        $this->full_name=$full_name;
    } 

  ////Accesseurs last-name///////////////////
    public function getLastName()
    {
       return $this->last_name;
    }
    public function setLastName($last_name)
    {
        $this->last_name=$last_name;
    }

    ////Accesseurs email///////////////////
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
      $this->email=$email;
    }

   ////Accesseurs password///////////////////
   public function getPassword()
   {
    return $this->password;
   }
   public function setPassword($password)
   {
     $this->password=$password;
   }

    ////Accesseurs phone///////////////////
   public function getPhone()
   {
    return $this->phone;
   }
   public function setPhone($phone)
   {
    $this->phone=$phone;
   }




}

?>