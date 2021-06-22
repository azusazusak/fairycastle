<?php

class ReviewsModel {

    static public function getAllByUser($id){

        $con = DB::connect();
        $reviews= DB::fetch("SELECT
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
                            WHERE user_id = '".mysqli_real_escape_string($con, $id)."'                            
        "); 

        return ReviewsModel::buildObject($reviews);                         
    }

    static public function getAllByProperty($id){

        $con = DB::connect();
        $reviews= DB::fetch("SELECT
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
                            WHERE property_id = '".mysqli_real_escape_string($con, $id)."'
                            ORDER BY date DESC
        "); 

        return ReviewsModel::buildObject($reviews);                         
    }


    static public function getSummaryByProperty($id) {

        $con = DB::connect();
        $reviewSummary= DB::fetchOne("SELECT
                                        ROUND(AVG(rating), 2) AS aveRating,
                                        COUNT(rating) AS numOfReviews,
                                        reservations.property_id AS propertyId
                                    FROM
                                        reviews
                                    JOIN reservations ON reviews.reservation_id = reservations.id
                                    WHERE
                                        property_id = '".mysqli_real_escape_string($con, $id)."'
        ");

        return $reviewSummary; // Array
    }

   
    static public function buildObject($reviews){

        foreach ($reviews as &$review) { // DO NOT FORGET "&"!!
            $review = new ReviewModel($review["reviewId"], 
                                    $review["reservationId"], 
                                    $review["rating"], 
                                    $review["comment"], 
                                    $review["date"], 
                                    $review["userId"], 
                                    $review["username"],
                                    $review["propertyId"]
            );
        }
        return $reviews;       
    }

}

?>