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
    <title>Modify Coach | NFL Trade Database</title>
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

<p><h2>Coach Modification Form:</h2></p>
<form action="modifyCoach.php" method=get>
        <p>Enter Coach Id: <input type=text size=20 name="coachId">
	<p>Enter Coach First Name: <input type=text size=20 name="coachFname">
	<p>Enter Coach Last Name: <input type=text size=20 name="coachLname">
        <p>Enter Coach Salary: <input type=text size=15 name="coachSalary">
        <p>Enter Coach Seasons Coached: <input type=text size=5 name="seasonsCoached">
        <p>Enter Coach Team Id: <input type=text size=5 name="teamId">
	<p> <input type=submit value="submit">
                <input type="hidden" name="form_submitted" value="1" >
</form>

<?php //starting php code again!
if (!isset($_GET["form_submitted"]))
{
	echo "Hello. Please enter coach id, values to modify, and submit the form.";
}
else {

  // Create connection
  // Include config file
  require_once "../config.php";

  if (!empty($_GET["coachId"]) && !empty($_GET["coachFname"]))
  {
   $coachId = $_GET["coachId"]; //gets id from the form
   $coachFname = $_GET["coachFname"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE coach SET coachFname=? WHERE coachId=?"); //prepare the statement
   $sqlstatement->bind_param("si",$coachFname, $coachId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["coachId"]) && !empty($_GET["coachLname"]))
  {
   $coachId = $_GET["coachId"]; //gets id from the form
   $coachLname = $_GET["coachLname"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE coach SET coachLname=? WHERE coachId=?"); //prepare the statement
   $sqlstatement->bind_param("si",$coachLname, $coachId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["coachId"]) && !empty($_GET["coachSalary"]))
  {
   $coachId = $_GET["coachId"]; //gets id from the form
   $coachSalary = $_GET["coachSalary"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE coach SET coachSalary=? WHERE coachId=?"); //prepare the statement
   $sqlstatement->bind_param("ii",$coachSalary, $coachId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["coachId"]) && !empty($_GET["seasonsCoached"]))
  {
   $coachId = $_GET["coachId"]; //gets id from the form
   $seasonsCoached = $_GET["seasonsCoached"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE coach SET seasonsCoached=? WHERE coachId=?"); //prepare the statement
   $sqlstatement->bind_param("ii",$seasonsCoached, $coachId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }

  if (!empty($_GET["coachId"]) && !empty($_GET["teamId"]))
  {
   $coachId = $_GET["coachId"]; //gets id from the form
   $teamId = $_GET["teamId"]; //gets name from the form
   $sqlstatement = $mysqli->prepare("UPDATE coach SET teamId=? WHERE coachId=?"); //prepare the statement
   $sqlstatement->bind_param("ii",$teamId, $coachId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }
   $sqlstatement->close();
  }
  echo "Coach Modified.";

 $mysqli->close();
}
?>
</body>
</html>
