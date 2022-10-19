<?php

session_start();

echo "<h1> signup-inc </h1>";
echo "<br><br><p> well this is embarrassing...you were not supposed to see this.   </p>";

// ta del je optional - onemogoč dostop do signup-inc.php če to vpiše v iskalnik - dostop le prek signup button
if (isset($_POST["signup"])) {

    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $RePassword = $_POST["RePassword"];

    require_once 'dbh.inc.php';
    require_once 'func-inc.php';
    

    
    if (signup_empty($name, $mail,$Username,$Password,$RePassword)=== True) {
        header("location: ../signup.php?error=inputEmpty");
        exit();
    }

    if (invalid_mail($mail)=== true){
        header("location: ../signup.php?error=invalid_mail");
        exit();
    }


    if (password_match($Password, $RePassword) !== true) {
        header("location: ../signup.php?error=password_doesnt_match");
        exit();   
    }

    if( uidExists($conn,$Username) !== false) {
        header("location: ../signup.php?error=Username_Already_Exists");
        exit();
    }


    createUser($conn, $name, $mail, $Username, $Password);
    
}
else {
    header("location: ../index.php");
    exit();
}


