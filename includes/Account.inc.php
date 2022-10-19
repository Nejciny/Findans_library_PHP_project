<?php

session_start();

echo "<h1> signup-inc </h1>";
echo "<br><br><p> well this is embarrassing...you were not supposed to see this... 
        Please be so kind and show yourself out, thank you!   </p>";



if (isset($_POST["lend"])) {

    if(isset($_SESSION["Username"])){
        $Naslov = $_POST["naslov"];
        $Avtor = $_POST["avtor"];
        $Zalozba = $_POST["zalozba"];
        $ISBN = $_POST["ISBN"];

        require_once 'dbh.inc.php';

        $result = 0;

        $uporabnik = $_SESSION["Username"];

        function lend_book($conn, $Naslov, $Avtor, $Zalozba, $ISBN, $uporabnik) {

            $query = 'SELECT * FROM users WHERE usersUid = ? ;';
            $stmt2 = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt2, $query)){
                header("location: ../index.php?error=STMT_Lend_Book_USER_FAIL");
                exit();
            }

            mysqli_stmt_bind_param($stmt2,"s", $uporabnik);
            mysqli_stmt_execute($stmt2);

            $data = mysqli_stmt_get_result($stmt2);

            $result = mysqli_fetch_assoc($data);

            $Lastnik = $result["usersId"];

            mysqli_stmt_close($stmt2);

            

            $sql = 'INSERT INTO books (Naslov, Avtor, Zalozba, ISBN, Lastnik)  VALUES (?, ?, ?, ?, ?);';
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../index.php?error=STMT_Lend_Book_FAIL");
                exit();
            }

            mysqli_stmt_bind_param($stmt,"sssss", $Naslov, $Avtor, $Zalozba, $ISBN, $Lastnik);
            mysqli_stmt_execute($stmt);  # execute prepared statement with included parameters
            mysqli_stmt_close($stmt);
        
        }
        
    }
    else {
        header("location: ../Account.php?error=NoLogin");
    }

}

lend_book($conn, $Naslov, $Avtor, $Zalozba, $ISBN, $uporabnik);



header("location: ../Account.php?error=LendSuccessful");