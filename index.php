<?php
include("libs/DB.php");
include("models/UsersModel.php");
include("models/UserModel.php");
include("models/PropertiesModel.php");
include("models/PropertyModel.php");
include("models/ReviewsModel.php");
include("models/ReviewModel.php");
include("models/ReservationModel.php");
include("models/ReservationsModel.php");
include("models/FileModel.php");
include("models/admin/AdminuserModel.php");
include("controllers/Controller.php");

$controller = (isset($_GET["controller"])) ? $_GET["controller"] : "pages";
$action =  (isset($_GET["action"])) ? $_GET["action"] : "login";

if($controller)
{
    $controllerName = ucfirst($controller)."Controller"; // The ucfirst() function converts the first character of a string to uppercase.
    $controllerFile = "controllers/".$controllerName.".php"; 

    if(file_exists($controllerFile)) // The file_exists() function checks whether a file or directory exists.
    {
        include($controllerFile);
    } else {
        echo "the controller you asked for is invalid: $controllerFile";
    }
}

// creates an instance of our controller
$oController = new $controllerName(); // dynamic/variable constructor 

if(method_exists($oController, $action)){ // method_exists($object, $method_name ); It checks if the class method exists in the given object.
    $oController->$action(); // dynamic method call

    if(method_exists($oController, "postTrip"))
    {
        // if there was a postTrip, run it
        $oController->postTrip();
    } else {
        // otherwise, just show whats in the state html
        echo $oController->state["html"];
    }
} else {
    $oController->error(); // the method did not exist
    echo $oController->state["html"];
}


?>