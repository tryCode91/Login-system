<?php
include 'dbh.class.php';
class Users extends Dbh
{
    //***************************------------VALIDATION----------------********************************\\
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function checkEmptyInput($name, $email, $pwd, $pwdRetype, $uuid)
    {
        if (empty($name) || empty($email) || empty($pwd) || empty($pwdRetype) || empty($uuid)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateName($name)
    {
        if (!preg_match("/^[a-zA-Z-']*$/", $name)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function validatePassword($pwd)
    {
        if (!ctype_alnum($pwd)) {
            return true;
        } else {
            return false;
        }
    }

    public function validatePasswordMatch($pwd, $pwdRetype)
    {
        if ($pwd !== $pwdRetype) {
            //true means there was an error
            return true;
        } else {
            return false;
        }
    }

    //*****************************------------DATABASE----------------*******************************\\

    // ****************---SIGNUP---**************************\\
    //function to check for already existing usernames
    public function checkUserExist($uuid)
    {
        $sql = "SELECT * FROM userInfo WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$uuid]);

        $dbUser = $stmt->fetchAll();
        foreach ($dbUser as $user) {
            if ($user["username"] === $uuid) {
                //there is a problem, the user exist
                return true;
            } else {
                return false;
            }
        }
    }

    //insert user into database
    public function insertUser($name, $email, $username, $password)
    {
        $pwdHash = password_hash($password, PASSWORD_DEFAULT);
        $uid = uniqid("User_");
        $sql = "insert into userInfo(name, email, username, password, uuid) values(?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $email, $username, $pwdHash, $uid]);
    }

    //fetch users from database 
    public function fetchUsers()
    {
        $sql = "SELECT * FROM userInfo";
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            if (!empty($row)) {
                echo $row['name'] . " " . $row['username'] . " " . $row['email'];
            }
        }
    }

    // ********************-------LOGIN----------*********************\\

    public function checkCredentials($uuid, $pwd)
    {
        $sql = "SELECT * FROM userInfo where username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$uuid]);
        while ($row = $stmt->fetch()) {
            //username exist in database === good
            if ($row["username"] === $uuid) {
                //check the password matches with the one in the database
                if (!password_verify($pwd, $row["password"])) {
                    echo "password is incorrect!";
                    return true;
                } else {
                    echo "password is correct!";
                    return false;
                }
            }
        }
    }

    public function setSessionUid($uuid)
    {
        session_start();
        $_SESSION["uuid"] = $uuid;
    }
}
