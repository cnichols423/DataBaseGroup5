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
    <title>Add Coach | NFL Trade Database</title>
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

<p><h2>New Coach Entry Form:</h2></p>
<form action="addCoach.php" method=get>
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
	echo "Hello. Please enter new coach information and submit the form.";
}
else {

  // Create connection
  // Include config file
  require_once "../config.php";

  if (!empty($_GET["coachFname"]) && !empty($_GET["coachLname"]) && !empty($_GET["coachSalary"]) && !empty($_GET["seasonsCoached"]) && !empty($_GET["teamId"]))
  {
   $coachFname = $_GET["coachFname"]; //gets name from the form
   $coachLname = $_GET["coachLname"]; //gets id from the form
   $coachSalary = $_GET["coachSalary"]; //get department from the form
   $seasonsCoached = $_GET["seasonsCoached"]; //get salary from the form
   $teamId = $_GET["teamId"]; //get department from the form
   $sqlstatement = $mysqli->prepare("INSERT INTO coach(coachFname, coachLname, coachSalary, seasonsCoached, teamId) values(?, ?, ?, ?, ?)"); //prepare the statement
   $sqlstatement->bind_param("ssiii",$coachFname, $coachLname, $coachSalary, $seasonsCoached, $teamId); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query

   if($sqlstatement->error){
     echo $sqlstatement->error; //print an error if the query fails
   }else {
     echo "Coach Added.";
   }
   $sqlstatement->close();
  }
 $mysqli->close();
}
?>
</body>
</html>
