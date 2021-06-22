<?php

class DB {

    static public function connect() {
        $configArray = parse_ini_file("../../fairycastledb.ini"); //returns array of configuration
        $host = $configArray['host'];
        $username = $configArray['username'];
        $password = $configArray['password'];
        $database = $configArray['database'];
        return mysqli_connect($host, $username, $password, $database);
    }

    static public function fetch($sql) {
        // access to the instance
        $oDB = new DB();

        $results = mysqli_query($oDB->connect(), $sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($results)){
            $data[] = $row;
        }

        return $data;
    }

    static public function fetchOne($sql) {
        // access to the instance
        $oDB = new DB();

        $results = mysqli_query($oDB->connect(), $sql);
        return mysqli_fetch_assoc($results);
    } 

    static public function doQuery($sql) {
        // access to the instance
        $oDB = new DB();

        $results = mysqli_query($oDB->connect(), $sql);
        return $results;
    }     
    
}


?>