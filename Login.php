<?php
    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $uuid = $_POST["uuid"];
        $pwd = $_POST["pwd"];
        $userLogin = new Users();

        //a function returns true if the username exists in databse and corresponding password is correct
        //double check using hashfunction to check the password hash 

        //cases
        // ******************************
        // username does not exist in database// "there is no user named xyz" 
        // password does not match to the given username // wrong password, try again(reset link??????)

        $userExist = $userLogin->checkCredentials($uuid,$pwd);
        if($userExist !== false){
            header("Location: Index.php?error=usernotexist");
            exit();
        }
        //set session variable for user
        $userLogin->setSessionUid($uuid);
        //redirect user to the home page.
        header("Location: Home.php?user=".$uuid);
        exit();
    }
