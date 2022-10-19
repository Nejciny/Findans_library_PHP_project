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
        <link rel="stylesheet" href="login.css">
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
                            <li><a href="logout.php">LOGOUT</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="library.php">LIBRARY</a></li>
                    <li><a href="index.php">HOME</a></li>
                    
                </ul>
            </nav>
        
        </div>
    
    </header>

        <section class="img-library text-center">
            
            <div class="login" >

                <h2> LOGIN</h2>


                <form  action="includes/login.inc.php" method="post">
                   
                     <input class="Username" type="text" name="Username" placeholder="Username"> <br>
                     <input class="Password" type="password" name="Password" placeholder="Password"> <br>
            
                    <br>
                    <button type="submit" name="submit"> Sign in</button>

                    <?php
                        if (!isset($_GET['error'])) {
                            exit();
                        }
                        else {
                            $error = $_GET['error'];

                            if ($error == "LoginDenied"){
                                echo '<p> Unfortunately i do not remember anyone with such a name and Password ! <br>
                                Would you like to try again? <br> <br> </p> ';
                                exit();
                            }
                            
                        }
                    ?>
                
                </form>
            
            </div>

        </section>
        
    </body>


</html>
