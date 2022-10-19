<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE_Path_Of_Findan: Account</title>
    <link rel="stylesheet" href="account.css">
</head>

<header>

    <div class="glava">

        <h1>Path of Findan</h1>


        <nav>
            <ul>
                <li><a href="Account.php">ACCOUNT</a>
                    <ul>
                        <li><a href="Account.php">Account</a>
                        <li><a href="login.php">LOGIN</a></li>
                        <li><a href="signup.php">SIGNUP</a></li>
                        <li><a href="logout.php">LOGOUT</a></li>
                    </ul>
                </li>
                
                <li><a href="library.php">LIBRARY</a></li>
                <li><a href="index.php">HOME</a></li>
                
            </ul>
        </nav>

    </div>

</header>



<body >

<section >

    <h1> Your Account</h1> <br> <br>

    <?php
        if(isset($_SESSION["Username"])){
            echo '<p class="login-check"> you are logged in! </p>';
            echo '<br>';
            }
        else{
            echo '<p class="login-check"> you are not logged in!</p>';
            echo '<br>';
        }
    
    if(isset($_SESSION["name"])) {
        echo '<p>Welcome back '.$_SESSION["name"].'! </p>';
    }
    else{
        echo '<div class= "welcome">';
        echo '<p class= Account_NoLogin> Hello Stranger! <br>
              Its been a while hasnt it? Actually its been so long that i dont quite remember who the bloody hell you are! <br>
              Would you be so kind and refresh my memory by login into you account? Otherwise if you are new here and i have mixed you up
              with somebody else you must first create your account and then come and visit me again. Until then Mr. Stranger i wish you a good day! </p>';
        
        echo '<a href="login.php">LOGIN</a> OR ';
        echo '<a href="signup.php">SIGNUP</a>';
        echo '</div>';
    }   
    ?>
</section>

    <div class="Lend-Book">

        <h2> Lend your book </h2>

        <form action="includes/Account.inc.php" method="POST">
                <input type="text" name="naslov" placeholder="Title">
                <br>
                <input type="text" name="avtor" placeholder="Author">
                <br>
                <input type="text" name="zalozba" placeholder="Publishing house">
                <br>
                <input type="text" name="ISBN" placeholder="ISBN">
                <br>
                <button type="submit" name="lend"> OK </button>
        </form>
  
    </div>

    <div class="my-books">

        <h2> LENDED BOOKS </h2>
        <?php
        require_once 'includes/dbh.inc.php';

        if(isset($_SESSION["Username"])){
            $sql = 'SELECT * FROM users WHERE usersUid = ? ;';
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../index.php?error=STMT_LendedBooks_FAIL");
                exit();
            }
            mysqli_stmt_bind_param($stmt,"s",$_SESSION['Username']);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt); 
            $row = mysqli_fetch_assoc($resultData);
            
            $userID = $row['usersId'];

            $sql2 = 'SELECT * FROM books WHERE Lastnik = ? ;';
            $stmt2 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt2, $sql2)){
                header("location: ../index.php?error=STMT_LendedBooks_FAIL");
                exit();
            }
            mysqli_stmt_bind_param($stmt2,"s", $userID);
            mysqli_stmt_execute($stmt2);

            $resultData2 = mysqli_stmt_get_result($stmt2); 

            if ($rowcount2 = !mysqli_num_rows($resultData2) <= 0) {

                echo '<table class= "l-books" > <br>';
                echo "<tr> <br>";
                echo "<th> BookID </th>";
                echo "<th> Naslov </th>";
                echo "<th> Avtor </th>";
                echo "<th> Založba  </th>";
                echo "<th> ISBN </th>";
                echo "<th> Lastnik  </th>";
                echo "<th>  </th>";
                echo "</tr>";

                while ($row2 = mysqli_fetch_assoc($resultData2)){
                    echo "<tr>";
                    echo "<td>".$row2['BookId']."</td>";
                    echo "<td>".$row2['Naslov']."</td>";
                    echo "<td>".$row2['Avtor']."</td>";
                    echo "<td>".$row2['Zalozba']."</td>";
                    echo "<td>".$row2['ISBN']."</td>";
                    echo "<td>".$row2['Lastnik']."</td>";
                    echo "</tr>";
                   
                }

                echo "</table>";
                echo '<br>';
            }
            else{
                echo 'you have no lended books!';
            }
        }
        else{
            #echo '<p> session not set! </p>';
        }
        ?>
    
    </div>
    
    <div class= "borrowed-books">
    
        <h2> BORROWED BOOKS </h2>

        <?php
            if(isset($_SESSION["Username"])){
                $sql3 = 'SELECT * FROM izposoje,books,users WHERE izposoje.UsersId = ? AND izposoje.BookId = books.BookId AND izposoje.UsersId = users.UsersId;';
                $stmt3 = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt3, $sql3)){
                    header("location: ../index.php?error=STMT_BorrowedBooks_FAIL");
                    exit();
                }
                mysqli_stmt_bind_param($stmt3,"s",$row['usersId']);
                mysqli_stmt_execute($stmt3);
    
                $resultData3 = mysqli_stmt_get_result($stmt3); 
                

                if ($rowcount3 = !mysqli_num_rows($resultData3) <= 0) {

                    echo '<table > <br>';
                    echo "<tr> <br>";
                    echo "<th> BookId </th>";
                    echo "<th> Naslov </th>";
                    echo "<th> Avtor </th>";
                    echo "<th> Zalozba </th>";
                    echo "<th> ISBN </th>";
                    echo "<th> Lastnik_ID </th>";
                    echo "<th>  </th>";
                    echo "</tr>";
                    
                    while ($row3 = mysqli_fetch_assoc($resultData3)){
                        echo "<tr>";
                        echo "<td>".$row3['BookId']."</td>";
                        echo "<td>".$row3['Naslov']."</td>";
                        echo "<td>".$row3['Avtor']."</td>";
                        echo "<td>".$row3['Zalozba']."</td>";
                        echo "<td>".$row3['ISBN']."</td>";
                        echo "<td>".$row3['Lastnik']."</td>";

                        echo "</tr>";
                       
                    }
    
                    echo "</table>";
                    echo '<br>';
                }
                else {
                    echo 'you have no borrowed books at the moment. ';
                }
            }
            else{
               # echo '<p>SESSION NOT SET</p>';
            }    
        ?>

    </div>

    
</body>
</html>