<?php

class PropertiesModel {

    static public function getAll(){
        $properties= DB::fetch("SELECT
                                    properties.id AS id,
                                    name,
                                    type_id,
                                    type,
                                    occupancy,
                                    bedrooms,
                                    bathrooms,
                                    description,
                                    street,
                                    city,
                                    province,
                                    country,
                                    pricePerNight,
                                    wifi,
                                    kitchen,
                                    microwave,
                                    refrigerator,
                                    washer,
                                    dryer,
                                    heating,
                                    tv,
                                    parking,
                                    image_1,
                                    image_2,
                                    image_3,
                                    image_4,
                                    image_5
                                FROM
                                    properties
                                JOIN property_types ON properties.type_id = property_types.id
        ");  
        return PropertiesModel::buildObject($properties);      
    }

    static public function getAllWithFilter($location, $type_id, $checkIn, $checkOut, $numGuests){
        $numGuests = $numGuests ? $numGuests : '0';
        $con = DB::connect();
        $properties= DB::fetch("SELECT
                                    properties.id AS id,
                                    name,
                                    type_id,
                                    type,
                                    occupancy,
                                    bedrooms,
                                    bathrooms,
                                    description,
                                    street,
                                    city,
                                    province,
                                    country,
                                    pricePerNight,
                                    wifi,
                                    kitchen,
                                    microwave,
                                    refrigerator,
                                    washer,
                                    dryer,
                                    heating,
                                    tv,
                                    parking,
                                    image_1,
                                    image_2,
                                    image_3,
                                    image_4,
                                    image_5
                                FROM
                                    properties
                                JOIN property_types ON properties.type_id = property_types.id
                                WHERE 
                                    CASE
                                        WHEN '".mysqli_real_escape_string($con, $location)."' = '' THEN '".mysqli_real_escape_string($con, $location)."' ELSE city END = '".mysqli_real_escape_string($con, $location)."'
                                    AND
                                    CASE
                                        WHEN '".mysqli_real_escape_string($con, $type_id)."' = '' THEN '".mysqli_real_escape_string($con, $type_id)."' ELSE type_id END = '".mysqli_real_escape_string($con, $type_id)."'
                                    AND
                                    CASE
                                        WHEN $numGuests = '' THEN $numGuests ELSE occupancy END >= $numGuests
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

        return PropertiesModel::buildObject($properties);                         
    }

    static public function getTypes(){
        $types = DB::fetch("SELECT 
                                id AS type_id,
                                type                            
                            FROM 
                                property_types
                            ORDER BY 
                                type_id DESC
        ");
        return $types;
    }

    static public function countAll(){
        $numOfProperties= DB::fetchOne("SELECT
                                    COUNT(properties.id) AS numOfProperties
                                FROM
                                    properties
        ");
        return $numOfProperties["numOfProperties"];
    }

    static public function count($location, $type_id, $checkIn, $checkOut, $numGuests) {
        $numGuests = $numGuests ? $numGuests : '0';
        $con = DB::connect();
        $numOfProperties= DB::fetchOne("SELECT
                                    COUNT(properties.id) AS numOfProperties
                                FROM
                                    properties
                                JOIN property_types ON properties.type_id = property_types.id
                                WHERE 
                                    CASE
                                        WHEN '".mysqli_real_escape_string($con, $location)."' = '' THEN '".mysqli_real_escape_string($con, $location)."' ELSE city END = '".mysqli_real_escape_string($con, $location)."'
                                    AND
                                    CASE
                                        WHEN '".mysqli_real_escape_string($con, $type_id)."' = '' THEN '".mysqli_real_escape_string($con, $type_id)."' ELSE type_id END = '".mysqli_real_escape_string($con, $type_id)."'
                                    AND
                                    CASE
                                        WHEN $numGuests = '' THEN $numGuests ELSE occupancy END >= $numGuests
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

        return $numOfProperties["numOfProperties"]; // 結果がArray
    }

  
    static public function buildObject($properties){ // change the array into an object

        foreach ($properties as &$property) { // DO NOT FORGET "&"!! &を付けると、$usersを上書きできる。Arrayだった$usersをobjectに上書きしたいため。
            $property = new PropertyModel(
                                    $property["id"], 
                                    $property["name"],
                                    $property["type_id"],
                                    $property["type"],
                                    $property["occupancy"],
                                    $property["bedrooms"],
                                    $property["bathrooms"],
                                    $property["description"],
                                    $property["street"],
                                    $property["city"],
                                    $property["province"],
                                    $property["country"],
                                    $property["pricePerNight"],
                                    $property["wifi"],
                                    $property["kitchen"],
                                    $property["microwave"],
                                    $property["refrigerator"],
                                    $property["washer"],
                                    $property["dryer"],
                                    $property["heating"],
                                    $property["tv"],
                                    $property["parking"],
                                    $property["image_1"],
                                    $property["image_2"],
                                    $property["image_3"],
                                    $property["image_4"],
                                    $property["image_5"]
            );

        }
        return $properties;       
    }

}

?>