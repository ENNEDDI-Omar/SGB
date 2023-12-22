<?php

namespace Myapp\model;

require '../../vendor/autoload.php';

use Myapp\database\Database;
use PDO;
use PDOException;

class Reservation
{
    private $id;
    private $description;
    private $reservation_date;
    private $return_date;
    private $is_returned;
    private $id_user;
    private $id_book;
    private $conn;

    public function __construct($id, $description, $reservation_date, $return_date, $is_returned, $id_user, $id_book)
    {
        $this->conn = Database::connexion();
        $this->setDescription($description);
        $this->setReservationDate($reservation_date);
        $this->setReturnDate($return_date);
        $this->setIsReturned($is_returned);
        $this->setIdUser($id_user);
        $this->setIdBook($id_book);
    }


    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getReservationDate()
    {
        return $this->reservation_date;
    }

    public function getReturnDate()
    {
        return $this->return_date;
    }

    public function getIsReturned()
    {
        return $this->is_returned;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getIdBook()
    {
        return $this->id_book;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setReservationDate($reservation_date)
    {
        $this->reservation_date = $reservation_date;
    }

    public function setReturnDate($return_date)
    {
        $this->return_date = $return_date;
    }

    public function setIsReturned($is_returned)
    {
        $this->is_returned = $is_returned;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function setIdBook($id_book)
    {
        $this->id_book = $id_book;
    }

    // Méthode pour ajouter une réservation /////
    public function addReservation($description, $reservation_date, $return_date, $id_user, $id_book)
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
            echo "Erreur d'ajout de réservation : " . $e->getMessage();
            return false;
        }
    }



    public function showReservation()
    {
        try {
            $query = "SELECT R.*, U.first_name, U.last_name, U.email, B.title
                      FROM User AS U
                      INNER JOIN Reservation AS R ON R.id_user = U.id
                      INNER JOIN Book AS B ON R.id_book = B.id";

            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des réservations : " . $e->getMessage();
            return false;
        }
    }
}
