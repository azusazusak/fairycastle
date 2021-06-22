<?php

class ReviewModel {

    public $reviewId;
    public $reservationId;
    public $rating;
    public $comment;
    public $date;
    public $userId;
    public $username;
    public $propertyId;

    public function __construct($reviewId=0, $reservationId=0, $rating=0, $comment=0, $date=0, $userId=0, $username=0, $propertyId=0) {
        // パラメータがなくても機能するようにするため、=0でdefault値を指定している
        $this->reviewId = $reviewId;
        $this->reservationId = $reservationId;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->date = $date;
        $this->userId = $userId;
        $this->username = $username;
        $this->propertyId = $propertyId;
    }

    static public function getOneByReservation($id){

        $con = DB::connect();
        $review = DB::fetchOne("SELECT
                                    reviews.id AS reviewId,
                                    reservation_id AS reservationId,
                                    rating,
                                    comment,
                                    date,
                                    reservations.user_id AS userId,
                                    users.username AS username,
                                    reservations.property_id AS propertyId
                                FROM
                                    reviews
                                JOIN reservations ON reviews.reservation_id = reservations.id
                                JOIN users ON reservations.user_id = users.id 
                                WHERE reservations.id = '".mysqli_real_escape_string($con, $id)."'
        ");

        $review = new ReviewModel(
                        $review["reviewId"], 
                        $review["reservationId"], 
                        $review["rating"], 
                        $review["comment"], 
                        $review["date"], 
                        $review["userId"],
                        $review["username"], 
                        $review["propertyId"]
        ); 
        return $review; 
    }

    static public function register($reservation_id, $rating, $comment, $date) {

        $con = DB::connect();
        $review = DB::fetchOne("INSERT INTO reviews (
                                            reservation_id, 
                                            rating,
                                            comment,
                                            date
                            ) 
                            VALUES (
                                '".mysqli_real_escape_string($con, $reservation_id)."',
                                '".mysqli_real_escape_string($con, $rating)."',
                                '".mysqli_real_escape_string($con, $comment)."',
                                '".mysqli_real_escape_string($con, $date)."'
                            )
        ");
    }

}

?>