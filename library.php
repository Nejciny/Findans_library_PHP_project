<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>THE_Path_Of_Findan</title>
        <link rel="stylesheet" href="style.css">
    </head>

   
<body>
    
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
                    <li><a href=".php">LOGOUT</a></li>
                </ul>
            </li>
            
            <li><a href="library.php">LIBRARY</a></li>
            <li><a href="index.php">HOME</a></li>
            
        </ul>
    </nav>

</div>

</header>

<section class="img-library text-center">
        

    <h1> Library</h1>
    <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum, nisi?</p>


    <div class="lib-search">
        <form action="includes/lib.inc.php" method="POST">
            <input type="text" name="search" placeholder="naslov/avtor/zalozba/ISBN">
            <br>
            <button class="search_btn" type="submit" name="button"> Search </button>
        </form>

        <?php
            if (!isset($_GET['error'])) {
                exit();
            }
            else {
                $error = $_GET['error'];

                if ($error == "NotLoggedIn"){
                echo '<p> Tsk Tsk that will not do. You must first login before i can let you borrow books from our library ! 
                  <br> <br> </p> ';
                exit();
                }   
            }
            ?>
    </div>

    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, quos?</p>



    
    
</section> 
    
</body>

</html>