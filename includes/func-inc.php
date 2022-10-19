<?php


# CHECK SIGN UP INPUTS ------------------------------------------------------------

function signup_empty($name, $mail,$Username,$Password,$RePassword) {
    $input_empty = 0;
    if(empty($name) or empty($mail) or empty($Username) or empty($Password) or empty($RePassword)){
        $input_empty = True;
    }
    else {
        $input_empty = false;
    }
    return $input_empty;
}

function invalid_mail($mail){
    $invalid_mail = 0;

    if (strpos($mail, '@') !== False and strpos($mail,'.') !== false)   {
        $invalid_mail= False;
    }

    else {
        $invalid_mail= True;
    }
    return $invalid_mail; 
}


# PASSWORD MATCH -------------------------------------------------------------

function password_match($Password, $RePassword) {
    $match = 0;
    if ($Password === $RePassword){
        $match = True;
    }
    else {
        $match = false;
    }
    return $match;
}

#----USER_ALREADY_EXISTS: --------------------------------------------------------------------------



function uidExists($conn,$Username) {
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=STMTpreparedFAIL");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s", $Username);
    mysqli_stmt_execute($stmt);  # execute prepared statement with parameter

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {    # checks if there is any data in database
        return $row;

    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}


#-----CREATE_USER_ACCOUNT--------------------------------------------------------------------------------------


function createUser($conn,$name, $mail, $Username, $Password) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=STMT_createuser_FAIL");
        exit();
    }

    $hashedPwd = password_hash($Password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt,"ssss", $name, $mail, $Username, $hashedPwd);
    mysqli_stmt_execute($stmt);  # execute prepared statement with included parameters
    mysqli_stmt_close($stmt);

    $_SESSION["Username"] = $Username ;
    $_SESSION["name"] = $name;

    header("location: ../Account.php?error=NONE");
    exit();
}



#---------LOGIN ----------------------------------------------------


function Login($conn,$Username, $Password) {



    $sql = "SELECT * FROM users WHERE usersUid = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=STMT(login)preparedFAIL");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s", $Username);
    mysqli_stmt_execute($stmt);  # execute prepared statement with parameter

    $resultData = mysqli_stmt_get_result($stmt);

    if ( mysqli_num_rows($resultData) <= 0) {
       header("location: ../login.php?error=LoginDenied");
       exit();
    }

    
    $pass = mysqli_fetch_assoc($resultData);
    #$HashPwd = mysqli_fetch_assoc($resultData);
    $login = 0;
    
    #if ($Password === $pass["usersPwd"]) {                  #DOES NOT INCLUDE HASH
    if (password_verify ( $Password , $pass["usersPwd"])) {

        $_SESSION["name"] = $pass["usersName"];
        $_SESSION["Username"] = $pass ["usersUid"];
        $login = true;
        return $login;
        
    } 
    else {
        $login = false;
        return $login;
    }
    

    mysqli_stmt_close($stmt);
 
}


