<?php

class UserModel {

    public $id;
    public $email;
    public $username;
    public $firstName;
    public $lastName;
    public $password;

    public function __construct($id=0, $email=0, $username=0, $firstName=0, $lastName=0, $password=0) {
        // new UserModelをされると、UserModelの__constructが実行される。パラメータを渡したい場合はコンストラクターが必要
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
    }

    static public function getOne($id){

        $con = DB::connect();
        $user = DB::fetchOne("SELECT * FROM users WHERE id = '".mysqli_real_escape_string($con, $id)."'");

        $user = new UserModel(
                        $user["id"], 
                        $user["email"], 
                        $user["username"],
                        $user["firstName"], 
                        $user["lastName"], 
                        $user["password"] 
        );

        return $user; // これだと結果がArrayになるので↑でObject化している。
    }

    static public function register($email, $username, $firstName, $lastName, $encPass) {

        $con = DB::connect();
        $user = DB::fetchOne("INSERT INTO users (
                                            email, 
                                            username,
                                            firstName,
                                            lastName,
                                            password
                            ) 
                            VALUES (
                                '".mysqli_real_escape_string($con, $email)."',
                                '".mysqli_real_escape_string($con, $username)."',
                                '".mysqli_real_escape_string($con, $firstName)."',
                                '".mysqli_real_escape_string($con, $lastName)."',
                                '".$encPass."'
                            )
        ");
    }

    static public function login($username, $password) { 
        
        $con = DB::connect();
        $user = DB::fetchOne("SELECT * FROM users 
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
        $check = DB::fetchOne("SELECT * FROM users WHERE $dbField='".mysqli_real_escape_string($con, $value)."'");
        if($check) {
            return $check;
        } else {
            return null;
        }
    }

    static public function checkLoggedIn() {
        $user = DB::fetchOne("SELECT * FROM users WHERE id='".$_SESSION["userId"]."'");

        if($user) {
            return $user;
        } else {
            return null;
        }
    }    

    static public function getUsernameById($id) {
        $con = DB::connect();
        $username = DB::fetchOne("SELECT username 
                                FROM users 
                                WHERE id='".mysqli_real_escape_string($con, $id)."'
        ");

        if($username) {
            return $username;
        } else {
            return null;
        }
    }  

}

?>