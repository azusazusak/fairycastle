<?php

class PagesController extends Controller {

    public function login(){
        session_start();
        session_destroy(); //Delete a session

        $this->state["browserTitle"] = "Login | Fairy Castle";
        $this->state["bodyId"] = "login";
        $this->state["bodyBackImage"] = "imgs/pexels-felix-mittermeier-2832044.jpg";

        $this->state["content"] = $this->loadView("login");
        $this->state["footer"] = $this->loadView("footer");       
        $this->state["html"] = $this->loadView("template"); 
    }

    public function register(){
        session_start();
        session_destroy(); //Delete a session

        $this->state["browserTitle"] = "Register | Fairy Castle";
        $this->state["bodyId"] = "register";
        $this->state["bodyBackImage"] = "imgs/pexels-felix-mittermeier-2832044.jpg";

        $this->state["content"] = $this->loadView("register");
        $this->state["footer"] = $this->loadView("footer");
       
        $this->state["html"] = $this->loadView("template");
    }

    // this is the default route
    public function home(){
        session_start();
        $user = UserModel::checkLoggedIn();

        if($user){
            // build the variables that will be injected into the template
            $this->state["browserTitle"] = "Fairy Castle";
            $this->state["bodyId"] = "home";
            $this->state["bodyBackImage"] = "";
            
            // build the content state for the template
            $this->state["content"] = $this->loadView("navigation");
            $this->state["poropertyTypes"] = PropertiesModel::getTypes();

            $this->state["content"] .= $this->loadView("home");
            $this->state["footer"] = $this->loadView("footer");
        
            // final template get the final html 
            $this->state["html"] = $this->loadView("template");

            // all of our actions write their html to the the html state
        } else {
            header("location: index.php?controller=pages&action=login");
        }

    }

    public function results(){
        session_start();
        $user = UserModel::checkLoggedIn();

        if($user){

            $_SESSION["location"] = $_POST["location"];
            $_SESSION["type_id"] = $_POST["type_id"];
            $_SESSION["numGuests"] = $_POST["numGuests"];
            $_SESSION["checkIn"] = $_POST["checkIn"];
            $_SESSION["checkOut"] = $_POST["checkOut"];

            $this->state["browserTitle"] = "Results | Fairy Castle";
            $this->state["bodyId"] = "results";
            $this->state["bodyBackImage"] = "";
            
            $this->state["content"] = $this->loadView("navigation");
            $this->state["stay"] = (strtotime($_POST["checkOut"]) - strtotime($_POST["checkIn"])) / 86400;
            $this->state["poropertyTypes"] = PropertiesModel::getTypes();
            $this->state["numOfProperties"] = PropertiesModel::count($_POST["location"], $_POST["type_id"], $_POST["checkIn"], $_POST["checkOut"], $_POST["numGuests"]);

            $this->state["properties"] = PropertiesModel::getAllWithFilter($_POST["location"], $_POST["type_id"], $_POST["checkIn"], $_POST["checkOut"], $_POST["numGuests"]);

            $this->state["content"] .= $this->loadView("results");
            $this->state["content"] .= $this->loadView("properties-list");

            $this->state["footer"] = $this->loadView("footer");       
            $this->state["html"] = $this->loadView("template"); 

        } else {
            header("location: index.php?controller=pages&action=login");
        }
    }

    
    public function details(){
        session_start();
        $user = UserModel::checkLoggedIn();

        if($user){

            $name = PropertyModel::getOneName($_GET["propertyId"]);
            $title = $name["name"];
            $this->state["browserTitle"] = "$title | Fairy Castle";
            $this->state["bodyId"] = "details";
            $this->state["bodyBackImage"] = "";
            
            $this->state["content"] = $this->loadView("navigation");

            $checkIn = isset($_POST["checkIn"]) ? $_POST["checkIn"] : $_SESSION["checkIn"];
            $checkOut = isset($_POST["checkOut"]) ? $_POST["checkOut"] : $_SESSION["checkOut"];

            $this->state["stay"] = (strtotime($checkOut) - strtotime($checkIn)) / 86400;
            // $this->state["stay"] = (strtotime($_SESSION["checkOut"]) - strtotime($_SESSION["checkIn"])) / 86400;
            $this->state["property"] = PropertyModel::getOneById($_GET["propertyId"]);
            $this->state["reviews"] = ReviewsModel::getAllByProperty($_GET["propertyId"]);
            $this->state["reviewSummary"] = ReviewsModel::getSummaryByProperty($_GET["propertyId"]);

            $this->state["content"] .= $this->loadView("property-details");
            $this->state["content"] .= $this->loadView("details");

            $this->state["footer"] = $this->loadView("footer");
        
            $this->state["html"] = $this->loadView("template");
        } else {
            header("location: index.php?controller=pages&action=login");
        }
    }

    public function payment(){
        session_start();
        $user = UserModel::checkLoggedIn();

        if($user){

            if($_POST["numGuests"] && $_POST["checkIn"] && $_POST["checkOut"]) {
                
                $availability = ReservationModel::checkAvailability($_POST["propertyId"], $_POST["checkIn"], $_POST["checkOut"], $_POST["numGuests"]);

                if($availability) {

                    if ((int)$availability["occupancy"] >= (int)$_POST["numGuests"]) {

                        $this->state["browserTitle"] = "Payment | Fairy Castle";
                        $this->state["bodyId"] = "payment";
                        $this->state["bodyBackImage"] = "";
                        
                        $this->state["content"] = $this->loadView("navigation");

                        $this->state["stay"] = (strtotime($_POST["checkOut"]) - strtotime($_POST["checkIn"])) / 86400;
                        $this->state["property"] = PropertyModel::getOneById($_POST["propertyId"]);
                        $this->state["loggedUser"] = UserModel::checkLoggedIn($_SESSION["userId"]);

                        $this->state["content"] .= $this->loadView("payment");

                        $this->state["footer"] = $this->loadView("footer");
                    
                        $this->state["html"] = $this->loadView("template");
                        
                    } else {
                        $_SESSION["numGuests"] = $_POST["numGuests"];
                        $_SESSION["checkIn"] = $_POST["checkIn"];
                        $_SESSION["checkOut"] = $_POST["checkOut"];
                        $_SESSION["occupancy"] = $availability["occupancy"];
                        header("location: index.php?controller=pages&action=details&propertyId=".$_POST["propertyId"]."&overCapacity#condition");
                    }
                } else {
                    $_SESSION["numGuests"] = $_POST["numGuests"];
                    $_SESSION["checkIn"] = $_POST["checkIn"];
                    $_SESSION["checkOut"] = $_POST["checkOut"];
                    header("location: index.php?controller=pages&action=details&propertyId=".$_POST["propertyId"]."&unavailable#condition");
                }
            } else {
                $_SESSION["numGuests"] = $_POST["numGuests"];
                $_SESSION["checkIn"] = $_POST["checkIn"];
                $_SESSION["checkOut"] = $_POST["checkOut"];
                header("location: index.php?controller=pages&action=details&propertyId=".$_POST["propertyId"]."&inputError#condition");
            }
        } else {
            header("location: index.php?controller=pages&action=login");
        }
    }

    public function thankyou(){
        session_start();
        $user = UserModel::checkLoggedIn();

        if($user){

            $reservation = ReservationModel::makeResavation(
                $_POST["userId"],
                $_POST["email"],
                $_POST["username"],
                $_POST["firstName"],
                $_POST["lastName"],
                $_POST["propertyId"],
                $_POST["propertyName"],
                $_POST["checkIn"],
                $_POST["checkOut"],
                $_POST["numGuests"],
                $_POST["note"],
                $_POST["pricePerNight"],
                $_POST["numOfNights"],
                $_POST["totalPrice"],
                $_POST["cardNumber"],
                $_POST["cardholderName"],
                $_POST["expirationDate"],
                $_POST["cvc"],
                $_POST["creationDate"]
            );

            if ($reservation) {
                $this->state["browserTitle"] = "Payment | Fairy Castle";
                $this->state["bodyId"] = "thankyou";
                $this->state["bodyBackImage"] = "";

                $this->state["content"] = $this->loadView("navigation");

                $this->state["content"] .= $this->loadView("thankyou");
                $this->state["footer"] = $this->loadView("footer");       

                $this->state["html"] = $this->loadView("template");

            } else {
                header("location: index.php?controller=pages&action=payment&error");
            }
        } else {
            header("location: index.php?controller=pages&action=login");
        }
    }

    public function account(){
        session_start();
        $user = UserModel::checkLoggedIn();

        if($user){
            $this->state["browserTitle"] = "Account | Fairy Castle";
            $this->state["bodyId"] = "account";
            $this->state["bodyBackImage"] = "";
            
            $this->state["content"] = $this->loadView("navigation");
            $this->state["loggedUser"] = UserModel::checkLoggedIn($_SESSION["userId"]);
            $this->state["reservations"] = ReservationsModel::getAllByUserId($_SESSION["userId"]);
            
            $this->state["content"] .= $this->loadView("account");

            $this->state["footer"] = $this->loadView("footer");
        
            $this->state["html"] = $this->loadView("template");
        } else {
            header("location: index.php?controller=pages&action=login");
        }

    }

    public function writeReview(){
        session_start();
        $user = UserModel::checkLoggedIn();

        if($user){
            $this->state["browserTitle"] = "Write a review | Fairy Castle";
            $this->state["bodyId"] = "writeReview";
            $this->state["bodyBackImage"] = "";
            
            $this->state["content"] = $this->loadView("navigation");

            $this->state["reservation"] = ReservationModel::getOneById($_GET["reservationId"]);
            
            $this->state["content"] .= $this->loadView("writeReview");

            $this->state["footer"] = $this->loadView("footer");
        
            $this->state["html"] = $this->loadView("template");
        } else {
            header("location: index.php?controller=pages&action=login");
        }

    }

    public function error(){
        $this->state["browserTitle"] = "Error | Fairy Castle";
        $this->state["bodyId"] = "errorPage";
        $this->state["bodyBackImage"] = "";
        $this->state["errorMsg"] = "Page Not Found.";

        $this->state["content"] = $this->loadView("error");
        $this->state["footer"] = $this->loadView("footer");

        $this->state["html"]= $this->loadView("template");
    }

    //https://www.geeksforgeeks.org/how-to-minify-html-code-of-php-page/
    function minifier($code) {
        $search = array(
              
            // Remove whitespaces after tags
            '/\>[^\S ]+/s',
              
            // Remove whitespaces before tags
            '/[^\S ]+\</s',
              
            // Remove multiple whitespace sequences
            '/(\s)+/s',
              
            // Removes comments
            '/<!--(.|\s)*?-->/'
        );
        $replace = array('>', '<', '\\1');
        $code = preg_replace($search, $replace, $code);
        return $code;
    }

    public function postTrip(){
        // echo $this->minifier($this->state["html"]);
        // minifyすると速くなる
        echo $this->state["html"];
    }

}

?>