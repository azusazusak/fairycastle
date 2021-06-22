<?php

class UsersModel {

    static public function getAll(){

        $users= DB::fetch("SELECT
                                *
                            FROM
                                users"
        ); // get multi-dimensional array

        return UsersModel::buildObject($users);                         
    }
   
    static public function buildObject($users){ // change the array into an object

        foreach ($users as &$user) { // DO NOT FORGET "&"!! &を付けると、$usersを上書きできる。Arrayだった$usersをobjectに上書きしたいため。
            $user = new UserModel($user["id"], 
                                    $user["email"],
                                    $user["username"],
                                    $user["firstName"], 
                                    $user["lastName"], 
                                    $user["password"]
            );
        // newすると、UserModelの__constructが実行される。パラメータを渡したい場合はコンストラクターが必要
        }
        return $users;       
    }

}

?>