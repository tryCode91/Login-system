<?php
include "./includes/autoloader.inc.php";
//script to validate signup input and insert data into database
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $UserData = new Users();

    $name = $UserData->test_input($_POST["name"]);
    $email = $UserData->test_input($_POST["email"]);
    $uuid = $UserData->test_input($_POST["uuid"]);
    $pwdRetype = $UserData->test_input($_POST["pwdRetype"]);
    $pwd = $UserData->test_input($_POST["pwd"]);


    $valInput = $UserData->checkEmptyInput($name, $email, $uuid, $pwd, $pwdRetype);
    if ($valInput !== false) {
        header("Location: signup_form.php?error=checkinputfields");
        exit();
    }

    echo $valName = $UserData->validateName($name);
    if ($valName !== false) {
        header("Location: signup_form.php?error=nameerror");
        exit();
    }

    $valUuid = $UserData->validateName($uuid);
    if ($valUuid !== false) {
        header("Location: signup_form?error=usernameerror");
        exit();
    }

    $valEmail = $UserData->validateEmail($email);
    if ($valEmail !== false) {
        header("Location: signup_form.php?error=emailnotvalid");
        exit();
    }


    $valPwd = $UserData->validatePassword($pwd);
    if ($valPwd !== false) {
        header("Location: signup_form.php?error=invalidpwd");
        exit();
    }


    $valMatch = $UserData->validatePasswordMatch($pwd, $pwdRetype);
    if ($valMatch !== false) {
        header("Location: signup_form.php?error=passwordnotmatch");
        exit();
    }

    $checkUser = $UserData->checkUserExist($uuid);
    print_r($checkUser);
    if ($checkUser === true) {
        header("Location: signup_form.php?error=userExist");
        exit();
    }
    //if validation successfully completed
    $insertuser = $UserData->insertUser($name, $email, $uuid, $pwd);
    header("Location: signup_form.php?success=usercreated");
}
