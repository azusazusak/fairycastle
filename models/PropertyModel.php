<?php

class PropertyModel {

    public $id;
    public $name;
    public $type_id;
    public $type;
    public $occupancy;
    public $bedrooms;
    public $bathrooms;
    public $description;
    public $street;
    public $city;
    public $province;
    public $country;
    public $pricePerNight;
    public $wifi;
    public $kitchen;
    public $microwave;
    public $refrigerator;
    public $washer;
    public $dryer;
    public $heating;
    public $tv;
    public $parking;
    public $image_1;
    public $image_2;
    public $image_3;
    public $image_4;
    public $image_5;
    
    public function __construct($id=0,
                                $name=0,
                                $type_id=0,
                                $type=0,
                                $occupancy=0,
                                $bedrooms=0,
                                $bathrooms=0,
                                $description=0,
                                $street=0,
                                $city=0,
                                $province=0,
                                $country=0,
                                $pricePerNight=0,
                                $wifi=0,
                                $kitchen=0,
                                $microwave=0,
                                $refrigerator=0,
                                $washer=0,
                                $dryer=0,
                                $heating=0,
                                $tv=0,
                                $parking=0,
                                $image_1=0,
                                $image_2=0,
                                $image_3=0,
                                $image_4=0,
                                $image_5=0
        
        ) {
            $this->id = $id;
            $this->name = $name;
            $this->type_id = $type_id;
            $this->type = $type;
            $this->occupancy = $occupancy;
            $this->bedrooms = $bedrooms;
            $this->bathrooms = $bathrooms;
            $this->description = $description;
            $this->street = $street;
            $this->city = $city;
            $this->province = $province;
            $this->country = $country;
            $this->pricePerNight = $pricePerNight;
            $this->wifi = $wifi;
            $this->kitchen = $kitchen;
            $this->microwave = $microwave;
            $this->refrigerator = $refrigerator;
            $this->washer = $washer;
            $this->dryer = $dryer;
            $this->heating = $heating;
            $this->tv = $tv;
            $this->parking = $parking;
            $this->image_1 = $image_1;
            $this->image_2 = $image_2;
            $this->image_3 = $image_3;
            $this->image_4 = $image_4;
            $this->image_5 = $image_5;
    }

    static public function getOneById($id){

        $con = DB::connect();
        $property = DB::fetchOne("SELECT
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
                                    FROM properties 
                                    INNER JOIN property_types ON properties.type_id = property_types.id
                                    WHERE properties.id = '".mysqli_real_escape_string($con, $id)."'
        ");

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

        return $property; 
    }

    static public function addProperty($name,
                                        $type_id,
                                        $occupancy,
                                        $bedrooms,
                                        $bathrooms,
                                        $description,
                                        $street,
                                        $city,
                                        $province,
                                        $country,
                                        $pricePerNight,
                                        $wifi,
                                        $kitchen,
                                        $microwave,
                                        $refrigerator,
                                        $washer,
                                        $dryer,
                                        $heating,
                                        $tv,
                                        $parking,
                                        $image_1,
                                        $image_2,
                                        $image_3,
                                        $image_4,
                                        $image_5){

        $con = DB::connect();
        $property = DB::doQuery("INSERT INTO properties(
                                                name,
                                                type_id,
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
                                    )
                                    VALUES (
                                        '".mysqli_real_escape_string($con, $name)."',
                                        '".mysqli_real_escape_string($con, $type_id)."',
                                        '".mysqli_real_escape_string($con, $occupancy)."',
                                        '".mysqli_real_escape_string($con, $bedrooms)."',
                                        '".mysqli_real_escape_string($con, $bathrooms)."',
                                        '".mysqli_real_escape_string($con, $description)."',
                                        '".mysqli_real_escape_string($con, $street)."',
                                        '".mysqli_real_escape_string($con, $city)."',
                                        '".mysqli_real_escape_string($con, $province)."',
                                        '".mysqli_real_escape_string($con, $country)."',
                                        '".mysqli_real_escape_string($con, $pricePerNight)."',
                                        '".mysqli_real_escape_string($con, $wifi)."',
                                        '".mysqli_real_escape_string($con, $kitchen)."',
                                        '".mysqli_real_escape_string($con, $microwave)."',
                                        '".mysqli_real_escape_string($con, $refrigerator)."',
                                        '".mysqli_real_escape_string($con, $washer)."',
                                        '".mysqli_real_escape_string($con, $dryer)."',
                                        '".mysqli_real_escape_string($con, $heating)."',
                                        '".mysqli_real_escape_string($con, $tv)."',
                                        '".mysqli_real_escape_string($con, $parking)."',
                                        '".mysqli_real_escape_string($con, $image_1)."',
                                        '".mysqli_real_escape_string($con, $image_2)."',
                                        '".mysqli_real_escape_string($con, $image_3)."',
                                        '".mysqli_real_escape_string($con, $image_4)."',
                                        '".mysqli_real_escape_string($con, $image_5)."'
                                    )

        ");

        if($property) {
            return $property;
        } else {
            return null;
        }

    }

    static public function addType($type){

        $con = DB::connect();
        $type = DB::doQuery("INSERT INTO property_types (type) 
                                VALUES ('".mysqli_real_escape_string($con, $type)."')
        ");

        if($type) {
            return $type;
        } else {
            return null;
        }

    }

    static public function getOneImage($id){
        $con = DB::connect();
        $image_1 = DB::fetchOne("SELECT image_1
                                    FROM properties
                                    WHERE id = '".mysqli_real_escape_string($con, $id)."'
        ");

        if($image_1) {
            return $image_1;
        } else {
            return null;
        }
    }

    static public function getOneName($id){
        $con = DB::connect();
        $name = DB::fetchOne("SELECT name
                                    FROM properties
                                    WHERE id = '".mysqli_real_escape_string($con, $id)."'
        ");

        if($name) {
            return $name;
        } else {
            return null;
        }
    }


}

?>