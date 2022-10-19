
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">

    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
</head>


<body class="lib">


<?php

require_once 'dbh.inc.php';

if (isset($_POST["button"])) {
    $search = $_POST["search"];
}
else {
    echo 'isset($_POST["button"] didnt work :(';
}


    $sql = "SELECT * FROM books WHERE UPPER(Avtor) = UPPER(?) OR UPPER(Naslov) = UPPER(?) OR UPPER(ISBN) = UPPER(?) OR UPPER(Zalozba) = UPPER(?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=STMT_SearchBook_FAIL");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ssss", $search, $search, $search, $search);
    mysqli_stmt_execute($stmt);  # execute prepared statement with parameter

    $resultData = mysqli_stmt_get_result($stmt);

    
    
    #if ($result = !mysqli_fetch_assoc( $resultData) == 0 ){
    if ($rowcount = !mysqli_num_rows($resultData) <= 0) {

        #echo '<form action="lib-borrow.inc.php" method="POST">';
        
        
        echo '<table class= "search-table" id="search-table"> <br>';
        echo "<tr> <br>";
        echo "<th> Naslov </th>";
        echo "<th> Avtor </th>";
        echo "<th> Založba  </th>";
        echo "<th> ISBN </th>";
        echo "<th> Lastnik  </th>";
        echo "<th> BookId  </th>";
        echo "<th>  </th>";
        echo "</tr>";

        



        while ($row = mysqli_fetch_assoc($resultData)){
            echo "<tr>";
                echo "<td name= Naslov>".$row['Naslov']."</td>";
                echo "<td>".$row['Avtor']."</td>";
                echo "<td>".$row['Zalozba']."</td>";
                echo "<td>".$row['ISBN']."</td>";
                echo "<td>".$row['Lastnik']."</td>";
                echo "<td>".$row['BookId']."</td>";
                echo '<td> <button type="button" id="btn"> BORROW  </button> </td>';
            echo "</tr>";

            
            
        }

         

        echo "</table>";
        
        echo '<br>';
        #echo ' </form>';

        echo '<button class="back-btn"> <a href="../library.php"> Back </a> </button>';
    }

    else {
        echo '<div class="search_empty"';
        echo "<p>sorry we didnt find any books with your input.</p>";
        echo ' <a href="../library.php" class="back-btn"> Back </a>';
        echo '</div>';
    }


    mysqli_stmt_close($stmt);
?>


    <script>
        $('#search-table').on('click','#btn',function(){
            var currow = $(this).closest('tr');
            var col1 =  currow.find('td:eq(0)').text();
            var col2 =  currow.find('td:eq(1)').text();
            var col3 =  currow.find('td:eq(2)').text();
            var col4 =  currow.find('td:eq(3)').text();
            var col5 =  currow.find('td:eq(4)').text();
            var col6 =  currow.find('td:eq(5)').text();
            var result = col1 +'\n'+ col2 +'\n'+ col3 +'\n'+ col4 +'\n' + col5 +'\n'; 
            //alert(result);
            document.location.href= '../TESTING.php?col4='+ col6;
        })

    </script>
        
    
        
        

        <!-- IT WORKSSSSSSS  -->

        <!-- <script>
            $('#search-table').on('click','#btn',function() {
                alert ('hello there!');
            })
        
        </script> -->




    
</body>
</html>












