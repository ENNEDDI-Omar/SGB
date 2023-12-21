<?php
namespace Myapp\controller;
require'../../vendor/autoload.php';
use Myapp\model\User;
use Myapp\model\Book;

class BooksController 
{
    public function showBooks()
    {
        $books = new Book(null, null, null, null, null, null, null, null);
        $row = $books->getAllBooks();
        if ($row) 
        {
            header('location:../../../views/admin');
          return $row;  
        }else 
        {
            echo "Erreur d'Affichage des Livres";
        }
        
    }

    public function addBooks($cover, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies)
    {
        $books = new Book($cover, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies);
         
        if ($books->addBook($cover, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies)) 
        {
           header('location:../../../views/admin');
        }else 
        {
          echo"Erreur d'Insertion des Livres";
        }
    }

    public function deleteBooks($id)
    {   
        
        $books = new Book(null, null, null, null, null, null, null, null);
        $result = $books->deleteBook($id);

        if ($result) {
            echo 'Livre Supprimé avec Succè';
            header('location:../../../views/admin');
        }else {
            echo 'Erreur de Suppression!';
        }

    }

    public function updateBooks($id, $cover, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies)
    {
        $books = new Book($cover, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies);
        $result = $books->updateBook($id, $cover, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies);

         if ($result) {
            echo "Livre mis à jour avec succés!";
            header('location:../../../../views/admin');
         }else {
            echo "Erreur lors de la mis à jour du Livre!!!";
         }
    }

}

if (isset($_POST['addBook'])) 
{
  
    $titel = $_POST['Titel'];
    $author = $_POST['Author'];
    $genre = $_POST['Genre'];
    $description = $_POST['Description'];
    $publication_year = $_POST['Publication'];
    $total_copies = $_POST['Total'];
    $available_copies = $_POST['Available'];

    $folder ='../../public/images/';
    $image = $folder . $_FILES['Cover']['name'];

    if (move_uploaded_file($_FILES['Cover']['tmp_name'], $image)) 
    {
        $books = new BooksController();
        $result = $books->addBooks($image, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies);
    }


}

if (isset($_GET['id'])) 
{
$id=$_GET['id'];

  $books = new BooksController();
  $books->deleteBooks($id);
}

if (isset($_POST['upBook'])) 
{
    $id = $_GET['id'];

    $titel = $_POST['Titel'];
    $cover=$_POST['Cover'];
    $author = $_POST['Author'];
    $genre = $_POST['Genre'];
    $description = $_POST['Description'];
    $publication_year = $_POST['Publication'];
    $total_copies = $_POST['Total'];
    $available_copies = $_POST['Available'];

    $books = new BooksController();
    $books->updateBooks($id, $cover, $titel, $author, $genre, $description, $publication_year, $total_copies, $available_copies);
}






?>