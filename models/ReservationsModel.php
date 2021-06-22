<?php

class ReservationsModel {

    static public function getAll(){
        $con = DB::connect();
        $reservations= DB::fetch("SELECT * 
                                    FROM reservations
                                    ORDER BY id DESC
        ");     

        return ReservationsModel::buildObject($reservations);                         
    }

    static public function getAllByUserId($id){
        $con = DB::connect();
        $reservations= DB::fetch("SELECT * 
                                    FROM reservations
                                    WHERE user_id = '".mysqli_real_escape_string($con, $id)."'
                                    ORDER BY checkIn DESC
        ");     

        return ReservationsModel::buildObject($reservations);                         
    }

    static public function getAllWithFilter($id, $email){
        $con = DB::connect();
        $reservations= DB::fetch("SELECT * 
                                    FROM reservations
                                    WHERE 
                                        CASE WHEN '".mysqli_real_escape_string($con, $id)."' = '' THEN '".mysqli_real_escape_string($con, $id)."' ELSE id END = '".mysqli_real_escape_string($con, $id)."'
                                        AND
                                        CASE WHEN '".mysqli_real_escape_string($con, $email)."' = '' THEN '".mysqli_real_escape_string($con, $email)."' ELSE email END = '".mysqli_real_escape_string($con, $email)."'
                                    ORDER BY id DESC
        ");

        return ReservationsModel::buildObject($reservations);                         
    }
  
    static public function buildObject($reservations){ // change the array into an object

        foreach ($reservations as &$reservation) { // DO NOT FORGET "&"!! &を付けると、$usersを上書きできる。Arrayだった$usersをobjectに上書きしたいため。
            $reservation = new ReservationModel(
                                    $reservation["id"], 
                                    $reservation["user_id"],
                                    $reservation["email"],
                                    $reservation["username"],
                                    $reservation["firstName"],
                                    $reservation["lastName"],
                                    $reservation["property_id"],
                                    $reservation["propertyName"],
                                    $reservation["checkIn"],
                                    $reservation["checkOut"],
                                    $reservation["numGuests"],
                                    $reservation["note"],
                                    $reservation["pricePerNight"],
                                    $reservation["numOfNights"],
                                    $reservation["totalPrice"],
                                    $reservation["cardNumber"],
                                    $reservation["cardholderName"],
                                    $reservation["expirationDate"],
                                    $reservation["cvc"],
                                    $reservation["creationDate"],
                                    $reservation["status_id"]
            );

        }
        return $reservations;       
    }

}

?>