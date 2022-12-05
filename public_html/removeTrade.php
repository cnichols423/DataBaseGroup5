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
    <title>Remove Trade | NFL Trade Database</title>
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

<p><h2>Trade Removal Form:</h2></p>
<form action="removeTrade.php" method=get>
	<p>Enter Trade Id: <input type=text size=5 name="tradeId">
	<p> <input type=submit value="submit">
                <input type="hidden" name="form_submitted" value="1" >
</form>

<?php //starting php code again!
if (!isset($_GET["form_submitted"]))
{
	echo "Hello. Please enter trade id and submit the form.";
}
else {

  // Create connection
  // Include config file
  require_once "../config.php";

  if (!empty($_GET["tradeId"]))
  {
   $tradeId = $_GET["tradeId"]; //gets name from the form

   $sqlstatement = $mysqli->prepare("Select senderTeamId, playerId FROM trades WHERE tradeId=?"); //prepare the statement
   $sqlstatement->bind_param("i",$tradeId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query
   $result = $sqlstatement->get_result();
   $row = $result->fetch_assoc();

   $sqlstatement = $mysqli->prepare("UPDATE player SET teamId=".$row["senderTeamId"]." WHERE playerId=".$row["playerId"]); //prepare the statement
   $sqlstatement->execute(); //execute the query

   $sqlstatement = $mysqli->prepare("DELETE FROM trades WHERE tradeId=?"); //prepare the statement
   $sqlstatement->bind_param("i",$tradeId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }else {
     echo "Trade Removed.";
   }
   $sqlstatement->close();
  }
 $mysqli->close();
}
?>
</body>
</html>
