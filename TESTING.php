



<!-- <form action="" method= "">
    <button id="btn"> Submit </button>
    <br>
</form> -->


<?php

    session_start();

    if (!isset($_SESSION['Username'])){
        header('location: library.php?error=NotLoggedIn');
        exit();
    }

    $bookID = $_GET['col4'];
    echo $bookID;
    echo '<br>';



    require_once 'includes/dbh.inc.php';

    $query = 'SELECT * FROM izposoje WHERE BookId = ?;';
    $stmt4 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt4, $query)){
            header("location: ../index.php?error=STMT_SearchBook_FAIL");
            exit();
        }

        mysqli_stmt_bind_param($stmt4,"s", $bookID);
        mysqli_stmt_execute($stmt4);  # execute prepared statement with parameter
    
        $result = mysqli_stmt_get_result($stmt4);

        $rowcount = mysqli_num_rows($result);
        echo 'Rowcount is: '.$rowcount;
        echo '<br>';
        
    if ($rowcount > 0 ){
        header("location: library.php?Book_Already_RESERVED");
        exit();

    }

    else{
        $sql = 'SELECT * FROM users WHERE usersUid = ? ;';
        $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../index.php?error=STMT_SearchBook_FAIL");
                exit();
            }

            mysqli_stmt_bind_param($stmt,"s", $_SESSION['Username']);
            mysqli_stmt_execute($stmt);  # execute prepared statement with parameter
        
            $resultData = mysqli_stmt_get_result($stmt);   
            
            $row = mysqli_fetch_assoc($resultData);

            $Izposojevalec = $row['usersId'] ;
            #mysqli_stmt_close($stmt);

            $sql2 = 'SELECT * FROM books WHERE BookId = ? ;';
            $stmt2 = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt2, $sql2)){
                    header("location: ../index.php?error=STMT_SearchBook_FAIL");
                    exit();
                }

                mysqli_stmt_bind_param($stmt2,"s", $bookID);
                mysqli_stmt_execute($stmt2);  # execute prepared statement with parameter

                $resultdata2 = mysqli_stmt_get_result($stmt2);

                $row2 = mysqli_fetch_assoc($resultdata2);

                #BookID = BookId  si dubu že na začetku strani
                $Naslov = $row2['Naslov'];
                $Avtor = $row2['Avtor'];
                $Zalozba = $row2['Zalozba'];
                $ISBN = $row2['ISBN'];
                $Lastnik = $row2['Lastnik'];

                #$Izposojevalec
                # MOGOČE DODAŠ ŠE DATUM REZERVACIJE

            echo $Izposojevalec;
            echo '<br>';

            echo $Naslov;
            echo '<br>';
            echo $Avtor;
            echo '<br>';
            echo $Zalozba;
            echo '<br>';
            echo $ISBN ;
            echo '<br>';
            echo $Lastnik ;
            echo '<br>';
            
        $sql3 = 'INSERT INTO izposoje (BookId,UsersId) VALUES ( ?, ?);';
        $stmt3 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt3, $sql3)){
                header("location: ../index.php?error=STMT_SearchBook_FAIL");
                exit();
            }

            mysqli_stmt_bind_param($stmt3,"ss", $bookID, $Izposojevalec);
            mysqli_stmt_execute($stmt3);  # execute prepared statement with paramete
    }
?>

<script>
alert ('Knjiga uspešno rezervirana !');
</script>

<?php
    header("location: Account.php?error=NONE_Book_Reserved!");
    exit();
?>