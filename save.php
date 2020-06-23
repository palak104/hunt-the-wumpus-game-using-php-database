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
    // connection to database
    try {
        $dbh = new PDO(
            "mysql:hot=https://csunix.mohawkcollege.ca/phpmyadmin/;dbname=000787449",
        "000787449",
        "19960601"    
        );
        
    } catch (Exception $e) {
        die("ERROR: Couldn't connect. {$e->getMessage()}");
    }

   // get email id
    $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
    
  // check whether email is not empty
    if ($email !== NULL ){
        // check wether user already register
        $command = "SELECT emailadd FROM players where emailadd = ?";
        $stmt = $dbh->prepare($command);
        $param = [$email];
        $succes = $stmt->execute($param);
        if ($row = $stmt->fetch()){
            echo"You are already register so please log in or try another user name";
        }
   
        else{
            // if not registered then insert new data into table
            $command = "INSERT into players (emailadd) VALUES (?)";
            $stmt = $dbh->prepare($command);
            $param = [$email];
            $succes = $stmt->execute($param);
            if($succes){
               // echo "data inserted";
            }
            else{
               // echo"no";
            }
            
          // update win value
            $command = "UPDATE players SET win = win+1 where emailadd = ?";
            $stmt = $dbh->prepare($command);
            $param = [$email];
            $success = $stmt->execute($param);
            if($success){
                //echo"update";
            
        }
            
        }

    }
    else{
        echo"Please insert proper email-address";
    }

   echo " Thank you";
   

?>
<br>
<form action="index.php">
    <input type="submit" value ="Play again?"> 
</form>

</body>
</html>