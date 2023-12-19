<?php
namespace Myapp\database;

require '../../vendor/autoload.php';

use PDO;
use Dotenv\Dotenv;
use PDOException;

class Database {

    public static function connexion() {
        $doten = Dotenv::createImmutable(__DIR__ . '/../../');
        $doten->load();

        $servername = $_ENV['DB_SERVERNAME'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_NAME'];

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo 'CONNECTED';
            
        } 
        
        
        catch (PDOException $e) {
            die('CONNEXION FAILED: ' . $e->getMessage());
        }

        
        return $conn;
    }
}

$db = new Database();
$db::connexion();
// ?>


