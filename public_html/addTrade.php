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
    <title>Add Trade | NFL Trade Database</title>
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

<p><h2>New Trade Entry Form:</h2></p>
<form action="addTrade.php" method=get>
	<p>Enter Trade Sender Team Id: <input type=text size=5 name="senderTeamId">
        <p>Enter Trade Receiver Team Id: <input type=text size=5 name="receiverTeamId">
        <p>Enter Trade Player Id: <input type=text size=5 name="playerId">
	<p> <input type=submit value="submit">
                <input type="hidden" name="form_submitted" value="1" >
</form>

<?php //starting php code again!
if (!isset($_GET["form_submitted"]))
{
	echo "Hello. Please enter new trade information and submit the form.";
}
else {

  // Create connection
  // Include config file
  require_once "../config.php";

  if (!empty($_GET["senderTeamId"]) && !empty($_GET["receiverTeamId"]) && !empty($_GET["playerId"]))
  {
   $senderTeamId = $_GET["senderTeamId"]; //gets name from the form
   $receiverTeamId = $_GET["receiverTeamId"]; //gets id from the form
   $playerId = $_GET["playerId"]; //get department from the form
   $sqlstatement = $mysqli->prepare("INSERT INTO trades(senderTeamId, receiverTeamId, playerId) values(?, ?, ?)"); //prepare the statement
   $sqlstatement->bind_param("iii",$senderTeamId, $receiverTeamId, $playerId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   $sqlstatement = $mysqli->prepare("UPDATE player SET teamId=? WHERE playerId=?"); //prepare the statement
   $sqlstatement->bind_param("ii",$receiverTeamId, $playerId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query


   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }else {
     echo "Trade Added.";
   }
   $sqlstatement->close();
  }
 $mysqli->close();
}
?>
</body>
</html>
