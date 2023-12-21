<?php
namespace Myapp\controller;
require'../../vendor/autoload.php';
use Myapp\model\Reservation;

class ReservationController
{
    private $reservationModel;

    public function __construct($conn)
    {
        $this->reservationModel = new Reservation($conn);
    }

    public function reserveBook($description, $reservation_date, $return_date, $id_user, $id_book)
    {
        $result = $this->reservationModel->reserveBook($description, $reservation_date, $return_date, $id_user, $id_book);

        if ($result) {
            echo "Réservation effectuée avec succès.";
        } else {
            echo "Erreur lors de la réservation du livre.";
        }
    }
}

?>
