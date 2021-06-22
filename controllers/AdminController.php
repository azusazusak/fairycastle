<?php

class AdminController extends Controller {

    public function login(){
        session_start();
        session_destroy(); //Delete a session

        $this->state["browserTitle"] = "Login | Admin";
        $this->state["bodyId"] = "loginAdmin";
        $this->state["bodyBackImage"] = "";

        $this->state["content"] = $this->loadView("admin/login");
        $this->state["footer"] = $this->loadView("footer");       
        $this->state["html"] = $this->loadView("template"); 
    }

    public function register(){
        session_start();
        session_destroy(); //Delete a session

        $this->state["browserTitle"] = "Register | Admin";
        $this->state["bodyId"] = "registerAdmin";
        $this->state["bodyBackImage"] = "";

        $this->state["content"] = $this->loadView("admin/register");
        $this->state["footer"] = $this->loadView("footer");
       
        $this->state["html"] = $this->loadView("template");
    }

    public function dashboard(){
        session_start();
        $user = AdminuserModel::checkAdminLoggedIn();

        if($user){
            $id = isset($_POST["orderId"]) ? $_POST["orderId"] : '';
            $email = isset($_POST["email"]) ? $_POST["email"] : '';

            $this->state["browserTitle"] = "Dashboard | Admin";
            $this->state["bodyId"] = "dashboard";
            $this->state["bodyBackImage"] = "";
            
            $this->state["content"] = $this->loadView("admin/navigation");

            $this->state["reservations"] = ReservationsModel::getAllWithFilter($id, $email);

            $this->state["content"] .= $this->loadView("admin/dashboard");
            $this->state["footer"] = $this->loadView("footer");
        
            $this->state["html"] = $this->loadView("template");
            
        } else {
            header("location: index.php?controller=admin&action=login");
        }

    }

    public function properties(){
        session_start();
        $user = AdminuserModel::checkAdminLoggedIn();

        if($user){
            $this->state["browserTitle"] = "Properties | Admin";
            $this->state["bodyId"] = "properties";
            $this->state["bodyBackImage"] = "";

            $this->state["content"] = $this->loadView("admin/navigation");

            $this->state["stay"] = 0;
            $this->state["numOfProperties"] = PropertiesModel::countAll();
            $this->state["properties"] = PropertiesModel::getAll(); 
            $this->state["content"] .= $this->loadView("admin/properties");
            $this->state["content"] .= $this->loadView("properties-list");

            $this->state["footer"] = $this->loadView("footer");
        
            $this->state["html"] = $this->loadView("template");
        } else {
            header("location: index.php?controller=admin&action=login");
        }
    }

    public function details(){
        session_start();
        $user = AdminuserModel::checkAdminLoggedIn();

        if($user){
            $this->state["browserTitle"] = "Property Details | Admin";
            $this->state["bodyId"] = "detailsAdmin";
            $this->state["bodyBackImage"] = "";

            $this->state["content"] = $this->loadView("admin/navigation");

            $this->state["property"] = PropertyModel::getOneById($_GET["propertyId"]);
            $this->state["reviews"] = ReviewsModel::getAllByProperty($_GET["propertyId"]);
            $this->state["reviewSummary"] = ReviewsModel::getSummaryByProperty($_GET["propertyId"]);
            $this->state["content"] .= $this->loadView("property-details");
            $this->state["content"] .= $this->loadView("admin/details");

            $this->state["footer"] = $this->loadView("footer");
        
            $this->state["html"] = $this->loadView("template");
        } else {
            header("location: index.php?controller=admin&action=login");
        }
    }

    public function addProperty(){
        session_start();
        $user = AdminuserModel::checkAdminLoggedIn();

        if($user){
            $this->state["browserTitle"] = "Add Property | Admin";
            $this->state["bodyId"] = "addProperty";
            $this->state["bodyBackImage"] = "";

            $this->state["content"] = $this->loadView("admin/navigation");
            $this->state["poropertyTypes"] = PropertiesModel::getTypes();
            $this->state["content"] .= $this->loadView("admin/addProperty");

            $this->state["footer"] = $this->loadView("footer");
        
            $this->state["html"] = $this->loadView("template");

        } else {
            header("location: index.php?controller=admin&action=login");
        }
    }

    public function propertyTypes(){
        session_start();
        $user = AdminuserModel::checkAdminLoggedIn();

        if($user){
            $this->state["browserTitle"] = "Property Types | Admin";
            $this->state["bodyId"] = "propertyTypes";
            $this->state["bodyBackImage"] = "";

            $this->state["content"] = $this->loadView("admin/navigation");
            $this->state["poropertyTypes"] = PropertiesModel::getTypes();
            $this->state["content"] .= $this->loadView("admin/propertyTypes");

            $this->state["footer"] = $this->loadView("footer");
        
            $this->state["html"] = $this->loadView("template");

        } else {
            header("location: index.php?controller=admin&action=login");
        }
    }

    public function addType(){
        session_start();
        $user = AdminuserModel::checkAdminLoggedIn();

        if($user){
            $this->state["browserTitle"] = "Add Type | Admin";
            $this->state["bodyId"] = "addType";
            $this->state["bodyBackImage"] = "";

            $this->state["content"] = $this->loadView("admin/navigation");

            $this->state["content"] .= $this->loadView("admin/addType");

            $this->state["footer"] = $this->loadView("footer");
        
            $this->state["html"] = $this->loadView("template");

        } else {
            header("location: index.php?controller=admin&action=login");
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