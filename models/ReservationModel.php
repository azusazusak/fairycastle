<?php

class ReservationModel {

    public $id;
    public $user_id;
    public $email;
    public $username;
    public $firstName;
    public $lastName;
    public $property_id;
    public $propertyName;
    public $checkIn;
    public $checkOut;
    public $numGuests;
    public $note;
    public $pricePerNight;
    public $numOfNights;
    public $totalPrice;
    public $cardNumber;
    public $cardholderName;
    public $expirationDate;
    public $cvc;
    public $creationDate;
    public $status_id;

    public function __construct($id=0,
                                $user_id=0,
                                $email=0,
                                $username=0,
                                $firstName=0,
                                $lastName=0,
                                $property_id=0,
                                $propertyName=0,
                                $checkIn=0,
                                $checkOut=0,
                                $numGuests=0,
                                $note=0,
                                $pricePerNight=0,
                                $numOfNights=0,
                                $totalPrice=0,
                                $cardNumber=0,
                                $cardholderName=0,
                                $expirationDate=0,
                                $cvc=0,
                                $creationDate=0,
                                $status_id=0        
        ) {
            $this->id = $id;
            $this->user_id = $user_id;
            $this->email = $email;
            $this->username = $username;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->property_id = $property_id;
            $this->propertyName = $propertyName;
            $this->checkIn = $checkIn;
            $this->checkOut = $checkOut;
            $this->numGuests = $numGuests;
            $this->note = $note;
            $this->pricePerNight = $pricePerNight;
            $this->numOfNights = $numOfNights;
            $this->totalPrice = $totalPrice;
            $this->cardNumber = $cardNumber;
            $this->cardholderName = $cardholderName;
            $this->expirationDate = $expirationDate;
            $this->cvc = $cvc;
            $this->creationDate = $creationDate;
            $this->status_id = $status_id;
    }
    
    static public function getOneById($id){
        $con = DB::connect();
        $reservation = DB::fetchOne("SELECT
                                        id,
                                        user_id,
                                        email,
                                        username,
                                        firstName,
                                        lastName,
                                        property_id,
                                        propertyName,
                                        checkIn,
                                        checkOut,
                                        numGuests,
                                        note,
                                        pricePerNight,
                                        numOfNights,
                                        totalPrice,
                                        cardNumber,
                                        cardholderName,
                                        expirationDate,
                                        cvc,
                                        creationDate,
                                        status_id
                                    FROM
                                        reservations
                                    WHERE
                                        id = '".mysqli_real_escape_string($con, $id)."'
        ");

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

        return $reservation;
    }

    static public function checkAvailability($propertyId, $checkIn, $checkOut, $numGuests) {
        
        $con = DB::connect();
        $availability = DB::fetchOne("SELECT
                                        occupancy
                                    FROM
                                        properties
                                    WHERE
                                        properties.id = '".mysqli_real_escape_string($con, $propertyId)."'
                                    AND NOT EXISTS 
                                    (
                                    SELECT *
                                    FROM reservations
                                    WHERE property_id = properties.id
                                        AND (
                                            checkIn BETWEEN '".mysqli_real_escape_string($con, $checkIn)."' AND '".mysqli_real_escape_string($con, $checkOut)."'
                                            OR
                                            checkOut BETWEEN '".mysqli_real_escape_string($con, $checkIn)."' AND '".mysqli_real_escape_string($con, $checkOut)."'
                                            OR
                                            '".mysqli_real_escape_string($con, $checkIn)."' BETWEEN checkIn AND checkOut
                                            OR
                                            '".mysqli_real_escape_string($con, $checkOut)."' BETWEEN checkIn AND checkOut
                                            )
                                    )
        ");

        return $availability;
    }

    static public function makeResavation($userId, $email, $username, $firstName, $lastName, $propertyId, $propertyName, $checkIn, $checkOut, $numGuests, $note, $pricePerNight, $numOfNights, $totalPrice, $cardNumber, $cardholderName, $expirationDate, $cvc, $creationDate) {
        $con = DB::connect();
        $reservation = DB::doQuery("INSERT INTO reservations (
                                        user_id,
                                        email,
                                        username,
                                        firstName,
                                        lastName,
                                        property_id,
                                        propertyName,
                                        checkIn,
                                        checkOut,
                                        numGuests,
                                        note,
                                        pricePerNight,
                                        numOfNights,
                                        totalPrice,
                                        cardNumber,
                                        cardholderName,
                                        expirationDate,
                                        cvc,
                                        creationDate,
                                        status_id
                                    )
                                    VALUES (
                                        '".mysqli_real_escape_string($con, $userId)."',
                                        '".mysqli_real_escape_string($con, $email)."',
                                        '".mysqli_real_escape_string($con, $username)."',
                                        '".mysqli_real_escape_string($con, $firstName)."',
                                        '".mysqli_real_escape_string($con, $lastName)."',
                                        '".mysqli_real_escape_string($con, $propertyId)."',
                                        '".mysqli_real_escape_string($con, $propertyName)."',
                                        '".mysqli_real_escape_string($con, $checkIn)."',
                                        '".mysqli_real_escape_string($con, $checkOut)."',
                                        '".mysqli_real_escape_string($con, $numGuests)."',
                                        '".mysqli_real_escape_string($con, $note)."',
                                        '".mysqli_real_escape_string($con, $pricePerNight)."',
                                        '".mysqli_real_escape_string($con, $numOfNights)."',
                                        '".mysqli_real_escape_string($con, $totalPrice)."',
                                        '".mysqli_real_escape_string($con, $cardNumber)."',
                                        '".mysqli_real_escape_string($con, $cardholderName)."',
                                        '".mysqli_real_escape_string($con, $expirationDate)."',
                                        '".mysqli_real_escape_string($con, $cvc)."',
                                        '".mysqli_real_escape_string($con, $creationDate)."',
                                        1
                                    )
        ");

        if($reservation) {
            return $reservation;
        } else {
            return null;
        }
         
    }

    static public function approve($id){
        $con = DB::connect();
        $approval = DB::doQuery("UPDATE
                                        reservations
                                    SET
                                        status_id = 2

                                    WHERE
                                        id = '".mysqli_real_escape_string($con, $id)."'
        ");

        if($approval) {
            return $approval;
        } else {
            return null;
        }
    }

}

?>