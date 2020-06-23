<!DOCTYPE html>
<!--  
I palak depani ,student no - 000787449 , cerify that all code submitted is my own work;
that i have not copied from any other source .
I also certify that i have not allowed my work to be copied by other.

Purpose of this assignment is to display game " hunt the wumpus" and take user data .
-->
<html>

<head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/wumpus.css">
</head>

<body>


<?php 

try {
    $dbh = new PDO(
        "mysql:hot=https://csunix.mohawkcollege.ca/phpmyadmin/;dbname=000787449",
        "000787449",
        "19960601"   
    );
    
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}

$rowNo = $_GET['row'];
$colNo = $_GET['col'];
//echo" row no is: $rowNo col num is : $colNo<br> "; 

    // this will display whether user won or not with picture
    $command = "SELECT row, col FROM wumpus where row=? AND col =? ";
    $stmt = $dbh->prepare($command);
   // echo"$command";
    $param = [$rowNo,$colNo];
    $success = $stmt->execute($param);
    if ($row =$stmt->fetch()){
          echo"<br>you found wumpus";
          echo"<br>At row num:  $row[row] and col num: $row[col]";
          echo "<img src = win.png  >";
          ?>
          <form action="save.php" method="POST">
          <input type="checkbox" id="win" name="win" value="1" checked> Win <br>
          Please enter your email address.<br>
          Email :<br>
          <input type="email" id="email" name="email">
          <input type="submit">
    <?php     
    }
    else{
        echo"<br>you didn't found wumpus";
        echo"<br>At row num:  $rowNo and col num: $colNo";
        echo "<img src = lost.png  >";
        ?>
        <form action="save.php" method="POST">
          <input type="checkbox" id="lost" name="lost" value="lost" checked> Lost <br>
          Please enter your email address.<br>
          Email :<br>
          <input type="email" id="email" name="email">
          <input type="submit">
          <?php
    }
    
?>

</form>
</body>
</html>