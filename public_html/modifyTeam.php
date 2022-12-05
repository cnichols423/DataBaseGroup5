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
    <title>Modify Team | NFL Trade Database</title>
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

<p><h2>Team Modification Form:</h2></p>
<form action="modifyTeam.php" method=get>
        <p>Enter Team Id: <input type=text size=20 name="teamId">
	<p>Enter Team Location: <input type=text size=20 name="teamLocation">
	<p>Enter Team Name: <input type=text size=20 name="teamName">
        <p>Enter Team Division Name: <input type=text size=15 name="divisionName">
	<p> <input type=submit value="submit">
                <input type="hidden" name="form_submitted" value="1" >
</form>

<?php //starting php code again!
if (!isset($_GET["form_submitted"]))
{
	echo "Hello. Please enter team id, values to modify, and submit the form.";
}
else {

  // Create connection
  // Include config file
  require_once "../config.php";

  if (!empty($_GET["teamId"]) && !empty($_GET["teamLocation"]))
  {
   $teamId = $_GET["teamId"]; //gets id from the form
   $teamLocation = $_GET["teamLocation"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE team SET teamLocation=? WHERE teamId=?"); //prepare the statement
   $sqlstatement->bind_param("si",$teamLocation, $teamId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["teamId"]) && !empty($_GET["teamName"]))
  {
   $teamId = $_GET["teamId"]; //gets id from the form
   $teamName = $_GET["teamName"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE team SET teamName=? WHERE teamId=?"); //prepare the statement
   $sqlstatement->bind_param("si",$teamName, $teamId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["teamId"]) && !empty($_GET["divisionName"]))
  {
   $teamId = $_GET["teamId"]; //gets id from the form
   $divisionName = $_GET["divisionName"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE team SET divisionName=? WHERE teamId=?"); //prepare the statement
   $sqlstatement->bind_param("si",$divisionName, $teamId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }
  echo "Team Modified.";

 $mysqli->close();
}
?>
</body>
</html>
