<?php

namespace Myapp\model;
require '../../vendor/autoload.php';

use Myapp\database\Database;
use PDO;
use PDOException;

class Reservation
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = Database::connexion();
    }

    public function reserveBook($description, $reservation_date, $return_date, $id_user, $id_book)
    {
        try {
            $query = "INSERT INTO Reservation (description, reservation_date, return_date, id_user, id_book)
                      VALUES (:description, :reservation_date, :return_date, :id_user, :id_book)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':reservation_date', $reservation_date);
            $stmt->bindParam(':return_date', $return_date);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':id_book', $id_book);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur de réservation : " . $e->getMessage();
            return false;
        }
    }
}
?>
