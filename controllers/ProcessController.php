<?php

class ProcessController extends Controller {

    public function processRegister(){

        $email = $_POST["email"];
        $username = $_POST["username"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $password = $_POST["password"];
        $encPass = password_hash($password, PASSWORD_DEFAULT);

        $checkEmail = UserModel::checkExists("email", $email);
        $checkUsername = UserModel::checkExists("username", $username);

        if($checkEmail || $checkUsername) {
            header("location: index.php?controller=pages&action=register&exists");
        } else {
            UserModel::register($email, $username, $firstName, $lastName, $encPass);
            header("location: index.php?controller=pages&action=login&registerSuccess");
        }
    }
    
    public function processLogin(){
        session_start();
        $username = $_POST["username"];
        $password = $_POST["password"];
        UserModel::login($username, $password);

        if($_SESSION["userId"]) {
            header("location: index.php?controller=pages&action=home");
        } else {
            header("location: index.php?controller=pages&action=login&loginError");
            // $this->login();            
        }
    }

    public function processLogout(){
        session_start();
        session_destroy(); //Delete a session
        header("location: index.php?controller=pages&action=login"); 
    }

    public function processWriteReview(){
        session_start();
        $user = UserModel::checkLoggedIn();

        if($user){
            $reservation_id = $_POST["reservationId"];
            $rating = $_POST["rating"];
            $comment = $_POST["comment"];
            $date = $_POST["date"];

            ReviewModel::register($reservation_id, $rating, $comment, $date);
            header("location: index.php?controller=pages&action=account");

        } else {
            header("location: index.php?controller=pages&action=login");
        }
    }

    public function processAdminRegister(){

        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $encPass = password_hash($password, PASSWORD_DEFAULT);

        $checkEmail = AdminuserModel::checkExists("email", $email);
        $checkUsername = AdminuserModel::checkExists("username", $username);

        if($checkEmail || $checkUsername) {
            header("location: index.php?controller=admin&action=register&exists");
        } else {
            AdminuserModel::register($email, $username, $encPass);
            header("location: index.php?controller=admin&action=login&registerSuccess");
        }
    }

    public function processAdminLogin(){
        session_start();
        $username = $_POST["username"];
        $password = $_POST["password"];
        AdminuserModel::login($username, $password);

        if($_SESSION["userId"]) {
            header("location: index.php?controller=admin&action=dashboard");
        } else {
            header("location: index.php?controller=admin&action=login&loginError");
            // $this->login();            
        }
    }

    public function processApproval(){
        session_start();
        $user = AdminuserModel::checkAdminLoggedIn();

        if($user){
            $approval = ReservationModel::approve($_GET["reservationId"]);

            if($approval) {
                header("location: index.php?controller=admin&action=dashboard");
            } else {
                header("location: index.php?controller=admin&action=dashboard&error");
            }
        } else {
            header("location: index.php?controller=admin&action=login");
        }
    }

    public function processAddProperty(){
        session_start();
        $user = AdminuserModel::checkAdminLoggedIn();

        if($user){
            $files = $_FILES;

            foreach ($files as $fieldName => $file) {
                if($file["name"]){
                    $fileNewName = FileModel::upload($fieldName, $file, $destPath="assets/");
                    
                    if (preg_match('/image_1/', '/'.$fileNewName.'/')) {
                        $image_1 = $fileNewName;
                    } elseif (preg_match('/image_2/', '/'.$fileNewName.'/')) {
                        $image_2 = $fileNewName;
                    } elseif (preg_match('/image_3/', '/'.$fileNewName.'/')) {
                        $image_3 = $fileNewName;
                    } elseif (preg_match('/image_4/', '/'.$fileNewName.'/')) {
                        $image_4 = $fileNewName;
                    } elseif (preg_match('/image_5/', '/'.$fileNewName.'/')) {
                        $image_5 = $fileNewName;
                    } elseif ($fileNewName == false) {
                        header("location: index.php?controller=admin&action=addProperty&formatError#formatError");
                    }
                }
            }

            $image_1 = isset($image_1) ? $image_1 : "";
            $image_2 = isset($image_2) ? $image_2 : "";
            $image_3 = isset($image_3) ? $image_3 : "";
            $image_4 = isset($image_4) ? $image_4 : "";
            $image_5 = isset($image_5) ? $image_5 : "";

            $property = PropertyModel::addProperty($_POST["name"],
                                                    $_POST["type_id"],
                                                    $_POST["occupancy"],
                                                    $_POST["bedrooms"],
                                                    $_POST["bathrooms"],
                                                    $_POST["description"],
                                                    $_POST["street"],
                                                    $_POST["city"],
                                                    $_POST["province"],
                                                    $_POST["country"],
                                                    $_POST["pricePerNight"],
                                                    $_POST["wifi"],
                                                    $_POST["kitchen"],
                                                    $_POST["microwave"],
                                                    $_POST["refrigerator"],
                                                    $_POST["washer"],
                                                    $_POST["dryer"],
                                                    $_POST["heating"],
                                                    $_POST["tv"],
                                                    $_POST["parking"],
                                                    $image_1,
                                                    $image_2,
                                                    $image_3,
                                                    $image_4,
                                                    $image_5
            );

            if($property) {
                header("location: index.php?controller=admin&action=properties");
            } else {
                header("location: index.php?controller=admin&action=addProperty&error");          
            }

        } else {
            header("location: index.php?controller=admin&action=login");
        }
    }

    public function processAddType(){
        session_start();
        $user = AdminuserModel::checkAdminLoggedIn();

        if($user){

            $type = PropertyModel::addType($_POST["type"]);
            if($type) {
                header("location: index.php?controller=admin&action=propertyTypes");
            } else {
                header("location: index.php?controller=admin&action=propertyTypes&error");
            }            

        } else {
            header("location: index.php?controller=admin&action=login");
        }
    }

    public function processAdminLogout(){
        session_start();
        session_destroy(); //Delete a session
        header("location: index.php?controller=admin&action=login"); 
    }

    public function error() {         
        header("location: index.php?controller=pages&action=error");
    }

}

?>