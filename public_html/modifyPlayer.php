<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Player | NFL Trade Database</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
		table, th, td { border: 1px solid black; }
    </style>
</head>
<body>

<?php
    require_once "navbar.php";
?>

<p><h2>Player Modification Form:</h2></p>
<form action="modifyPlayer.php" method=get>
        <p>Enter Player Id: <input type=text size=5 name="playerId">
	<p>Enter Player First Name: <input type=text size=20 name="playerFname">
	<p>Enter Player Last Name: <input type=text size=20 name="playerLname">
        <p>Enter Player Salary: <input type=text size=15 name="playerSalary">
        <p>Enter Player Seasons Coached: <input type=text size=5 name="seasonsPlayed">
        <p>Enter Player Jersey Number: <input type=text size=5 name="playerNumber">
        <p>Enter Player Position: <input type=text size=5 name="playerPosition">
        <p>Enter Player Team Id: <input type=text size=5 name="teamId">
	<p> <input type=submit value="submit">
                <input type="hidden" name="form_submitted" value="1" >
</form>

<?php //starting php code again!
if (!isset($_GET["form_submitted"]))
{
	echo "Hello. Please enter player id, values to modify, and submit the form.";
}
else {

  // Create connection
  // Include config file
  require_once "../config.php";

  if (!empty($_GET["playerId"]) && !empty($_GET["playerFname"]))
  {
   $playerId = $_GET["playerId"]; //gets id from the form
   $playerFname = $_GET["playerFname"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE player SET playerFname=? WHERE playerId=?"); //prepare the statement
   $sqlstatement->bind_param("si",$playerFname, $playerId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["playerId"]) && !empty($_GET["playerLname"]))
  {
   $playerId = $_GET["playerId"]; //gets id from the form
   $playerLname = $_GET["playerLname"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE player SET playerLname=? WHERE playerId=?"); //prepare the statement
   $sqlstatement->bind_param("si",$playerLname, $playerId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["playerId"]) && !empty($_GET["playerSalary"]))
  {
   $playerId = $_GET["playerId"]; //gets id from the form
   $playerSalary = $_GET["playerSalary"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE player SET playerSalary=? WHERE playerId=?"); //prepare the statement
   $sqlstatement->bind_param("ii",$playerSalary, $playerId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["playerId"]) && !empty($_GET["seasonsPlayed"]))
  {
   $playerId = $_GET["playerId"]; //gets id from the form
   $seasonsPlayed = $_GET["seasonsPlayed"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE player SET seasonsPlayed=? WHERE playerId=?"); //prepare the statement
   $sqlstatement->bind_param("ii",$seasonsPlayed, $playerId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["playerId"]) && !empty($_GET["playerNumber"]))
  {
   $playerId = $_GET["playerId"]; //gets id from the form
   $playerNumber = $_GET["playerNumber"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE player SET playerNumber=? WHERE playerId=?"); //prepare the statement
   $sqlstatement->bind_param("ii",$playerNumber, $playerId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["playerId"]) && !empty($_GET["playerPosition"]))
  {
   $playerId = $_GET["playerId"]; //gets id from the form
   $playerPosition = $_GET["playerPosition"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE player SET playerPosition=? WHERE playerId=?"); //prepare the statement
   $sqlstatement->bind_param("si",$playerPosition, $playerId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["playerId"]) && !empty($_GET["teamId"]))
  {
   $playerId = $_GET["playerId"]; //gets id from the form
   $teamId = $_GET["teamId"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE player SET teamId=? WHERE playerId=?"); //prepare the statement
   $sqlstatement->bind_param("ii",$teamId, $playerId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }
  echo "Player Modified";

 $mysqli->close();
}
?>
</body>
</html>
