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
    <title>Add Player | NFL Trade Database</title>
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

<p><h2>New Player Entry Form:</h2></p>
<form action="addPlayer.php" method=get>
	<p>Enter Player First Name: <input type=text size=20 name="playerFname">
	<p>Enter Player Last Name: <input type=text size=20 name="playerLname">
        <p>Enter Player Salary: <input type=text size=15 name="playerSalary">
        <p>Enter Player Seasons Played: <input type=text size=5 name="seasonsPlayed">
        <p>Enter Player Jersey Number: <input type=text size=5 name="playerNumber">
        <p>Enter Player Position: <input type=text size=15 name="playerPosition">
        <p>Enter Player Team Id: <input type=text size=5 name="teamId">
	<p> <input type=submit value="submit">
                <input type="hidden" name="form_submitted" value="1" >
</form>

<?php //starting php code again!
if (!isset($_GET["form_submitted"]))
{
	echo "Hello. Please enter new player information and submit the form.";
}
else {

  // Create connection
  // Include config file
  require_once "../config.php";

  if (!empty($_GET["playerFname"]) && !empty($_GET["playerLname"]) && !empty($_GET["playerSalary"]) && !empty($_GET["seasonsPlayed"]) && !empty($_GET["playerNumber"]) && !empty($_GET["playerPosition"]) && !empty($_GET["teamId"]))
  {
   $playerFname = $_GET["playerFname"]; //gets name from the form
   $playerLname = $_GET["playerLname"]; //gets id from the form
   $playerSalary = $_GET["playerSalary"]; //get department from the form
   $seasonsPlayed = $_GET["seasonsPlayed"]; //get salary from the form
   $playerNumber = $_GET["playerNumber"]; //gets name from the form
   $playerPosition = $_GET["playerPosition"]; //gets id from the form
   $teamId = $_GET["teamId"]; //get department from the form
   $sqlstatement = $mysqli->prepare("INSERT INTO player(playerFname, playerLname, playerSalary, seasonsPlayed, playerNumber, playerPosition, teamId) values(?, ?, ?, ?, ?, ?, ?)"); //prepare the statement
   $sqlstatement->bind_param("ssiiisi",$playerFname, $playerLname, $playerSalary, $seasonsPlayed, $playerNumber, $playerPosition, $teamId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }else {
     echo "Player Added.";
   }
   $sqlstatement->close();
  }
 $mysqli->close();
}
?>
</body>
</html>
