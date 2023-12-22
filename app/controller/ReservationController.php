<?php
namespace Myapp\controller;
require'../../vendor/autoload.php';
use Myapp\model\Reservation;
use Myapp\model\Book;

class ReservationController
{

    public function reserveBookList($id, $description, $reservation_date, $return_date,$is_returned, $id_user, $id_book)
    {
        $reservation = new Reservation($id, $description, $reservation_date, $return_date, $is_returned, $id_user, $id_book);
        $reservation->addReservation($description, $reservation_date, $return_date, $id_user, $id_book);
        if ($reservation) {
            echo "Réservation effectuée avec succès.";
            header('location:../../../../views/admin/dash.php');
        }else 
        {
            echo "Erreur lors de la réservation du livre.";
        }    
    } 
    
    public function showReservedList()
    {
        $reserv = new Reservation('','','','','','','');
        $reserv->showReservation();
        return $reserv;
    }
}

?>
