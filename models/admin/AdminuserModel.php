<?php

class AdminuserModel {

    public $id;
    public $email;
    public $username;
    public $password;

    public function __construct($id=0, $email=0, $username=0, $password=0) {

        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    static public function getOne($id){

        $con = DB::connect();
        $user = DB::fetchOne("SELECT * FROM admin_users WHERE id = '".mysqli_real_escape_string($con, $id)."'");

        $user = new AdminuserModel(
                        $user["id"], 
                        $user["email"], 
                        $user["username"],
                        $user["password"] 
        );

        return $user; // これだと結果がArrayになるので↑でObject化している。
    }

    static public function register($email, $username, $encPass) {

        $con = DB::connect();
        $user = DB::fetchOne("INSERT INTO admin_users (
                                            email, 
                                            username,
                                            password
                            ) 
                            VALUES (
                                '".mysqli_real_escape_string($con, $email)."',
                                '".mysqli_real_escape_string($con, $username)."',
                                '".$encPass."'
                            )
        ");
    }

    static public function login($username, $password) { 
        
        $con = DB::connect();
        $user = DB::fetchOne("SELECT * FROM admin_users 
                                WHERE username='".mysqli_real_escape_string($con, $username)."'"
        );

        if($user){
            $encPass = $user["password"];
            $providedPass = $password;
            if(password_verify($providedPass, $encPass)) {
                $_SESSION["userId"] = $user["id"];
                // echo "success";
            } else {
                // echo "error: password error";
            }
        } else {
            // echo "error: username not found";
        }
    }

    static public function checkExists($dbField, $value) {

        $con = DB::connect();
        $check = DB::fetchOne("SELECT * FROM admin_users WHERE $dbField='".mysqli_real_escape_string($con, $value)."'");
        if($check) {
            return $check;
        } else {
            return null;
        }
    }

    static public function checkAdminLoggedIn() {
        $user = DB::fetchOne("SELECT * FROM admin_users WHERE id='".$_SESSION["userId"]."'");

        if($user) {
            return $user;
        } else {
            return null;
        }
    }    

    // static public function getUsernameById($id) {
    //     $con = DB::connect();
    //     $username = DB::fetchOne("SELECT username 
    //                             FROM admin_users 
    //                             WHERE id='".mysqli_real_escape_string($con, $id)."'
    //     ");

    //     if($username) {
    //         return $username;
    //     } else {
    //         return null;
    //     }
    // }  

}

?>