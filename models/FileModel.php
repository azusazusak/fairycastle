<?php

class FileModel {

    static public function upload($fieldName, $file, $destPath="assets/"){

        $arrAllowableExtentions = ["jpg", "png", "gif", "jpeg"];

        $fileName = $file["name"];
        $pathParts = pathinfo($fileName); //pathinfo — Returns information about a file path
        $extension = strtolower($pathParts["extension"]); //strtolower — Make a string lowercase
        $randomString = FileModel::generateRandomString();
        $fileNewName = $fieldName."_".$randomString.".".$extension; //build the full file name with the extension

        if (in_array($extension, $arrAllowableExtentions)) { 
            //in_array — Checks if a value exists in an array            
            move_uploaded_file($file["tmp_name"], $destPath.$fileNewName);
            return $fileNewName;

        } else {
            // echo "Upload error. Extention not OK: ".$pathParts["extension"];
            return false;
        }

    }

    static private function generateRandomString($length = 10) {
        //Generate a random string of characters A-z 0-9
        // https://stackoverflow.com/questions/4356289/php-random-string-generator

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}


?>