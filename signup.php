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
            <div >
                <h2>Sign up</h2>
            </div>
                
            <div >
                <form class="form-signup" action="includes/signup-inc.php" method="post">
                    Name: <input class="Name" type="text" name="name" placeholder="name"> <br>
                    Email: <input class="Email" type="text" name="mail" placeholder="mail"> <br>
                    Username: <input class="Username" type="text" name="Username" placeholder="Username"> <br>
                    Password: <input class="Password" type="password" name="Password" placeholder="Password"> <br>
                    Repeat Password: <input class="RePassword" type="password" name="RePassword" placeholder=" RePassword"> <br> 
                    <br>
                    <button class="signup-btn" type="submit" name="signup"> Sign up</button>


                    <?php
                        if (!isset($_GET['error'])) {
                            exit();
                        }
                        else {
                            $error = $_GET['error'];

                            if ($error == "inputEmpty"){
                                echo '<p class= "p-signup"> Tsk Tsk. You have not filled all the necessary boxes! <br>
                                Shall i go and fetch you a pair of spectacles to help you with this difficult task? </p> ';
                                exit();
                            }

                            elseif($error== 'invalid_mail') {
                                echo '<p class= "p-signup"> Hmm... what kind of gibberish  email is this...im sorry this will not do as it does not fit with the
                                 protocol of this land. <br> HINT (a . and a @ are quite important) !  </p> ';
                                exit();
                            }

                            elseif($error== 'password_doesnt_match') {
                                echo '<p class= "p-signup"> The passwords you have entered are not the same! Do you perhaps
                                possess a brain of a pesky fly? Please try again and focus this time. A lost password can cause you 
                                quite a headache in the future. </p> ';
                                exit();
                            }

                            elseif($error== 'Username_Already_Exists') {
                                echo '<p class= "p-signup"> Hmm...It seems that this username is already taken. Perhaps you should take a moment
                                and come up with something a bit more creative and original...perhaps something like CopyCat? . </p> ';
                                exit();
                            }
                            
                        }
                    ?>
                
                </form>
            
            </div>
            
    </section>
    

</body>









</html>



