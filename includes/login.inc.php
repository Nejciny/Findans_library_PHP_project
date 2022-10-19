<?php

session_start();

if (isset($_POST["submit"])) {
    

    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    require_once 'dbh.inc.php';
    require_once 'func-inc.php';

    if(Login($conn, $Username, $Password) === True) {

        header("location: ../Account.php?error=NONE_YOU_ARE_LOGGED_IN!");
        exit();
    }
    else{
        header("location: ../login.php?error=LoginDenied");
        exit();
    }

    

    
}

else {
    echo "button no work :( . ";
}