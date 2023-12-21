<?php

namespace Myapp\model;

require '../../vendor/autoload.php';

use Myapp\database\Database;
use PDO;
use PDOException;

class Book
{
    private $cover;
    private $titel;
    private $author;
    private $genre;
    private $description;
    private $publication_year;
    private $total_copies;
    private $available_copies;
    private $conn;

    public function __construct($cover, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies)
    {
        $this->conn = Database::connexion();
        $this->cover = $cover;
        $this->titel = $titel;
        $this->author = $author;
        $this->genre = $genre;
        $this->description = $description;
        $this->publication_year = $publication_year;
        $this->total_copies = $total_copies;
        $this->available_copies = $available_copies;
    }

    public function getAllBooks()
    {
        $requete = "SELECT * FROM book";
        $stmt = $this->conn->prepare($requete);

        if (!$stmt) 
        {
            echo "Erreur de Requete: " . $this->conn->errorInfo()[2];
            return false;
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function addBook($cover, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies)
    {
        try 
        { 
            $requete = "INSERT INTO `book` ('cover', 'titel', 'author', 'genre', 'description', 'publication_year', 'total_copies', 'available_copies')
                         VALUES(:cover, :titel, :author, :genre, :description, :publication_year, :total_copies, :available_copies)";
                $stmt =$this->conn->prepare($requete);
                $stmt->bindParam(':cover', $cover);
                $stmt->bindParam(':titel', $titel);
                $stmt->bindParam(':author', $author);
                $stmt->bindParam(':genre', $genre);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':publication_year', $publication_year);
                $stmt->bindParam(':total_copies', $total_copies);
                $stmt->bindParam(':available_copies', $available_copies);
              return $stmt->execute();
        } catch (PDOException $e) 
        {
            echo "Erreur: " . $e->getMessage();
            return false;
        }
    }

    public function deleteBook($id)
    {
        try 
        {
            $requete ="DELETE FROM `book`WHERE `id` = :id";
            $stmt=$this->conn->prepare($requete);
            $stmt->bindParam(':id', $id);
        } catch (PDOException $e) 
        {
            echo "Erreur de Suppression de Livres: " . $e->getMessage();
            return false;
        }
    }

    public function updateBook($id, $cover, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies)
    {
        try 
        {
            $requete ="UPDATE `book`
                       SET `cover`=:cover, `titel`=:titel, `author`=:author, `genre`=:genre, `description`=:descritpion, `publication_year`=:publication_year, `total_copies`=:total_copies WHERE `id`=:id";

            $stmt =$this->conn->prepare($requete);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':cover', $cover);
            $stmt->bindParam(':titel', $titel);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':publication_year', $publication_year);
            $stmt->bindParam(':total_copies', $total_copies);
            $stmt->bindParam(':available_copies', $available_copies);
             return $stmt->execute();
        } catch (PDOException $e) 
        {
            echo "Erreur: " . $e->getMessage();
            return false;
        }
    }

    
}
