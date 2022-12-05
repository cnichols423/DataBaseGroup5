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
    <title>Coaches | NFL Trade Database</title>
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

<p><h2>List of NFL Coaches:</h2></p>

<?php // this line starts PHP Code

   // Include config file
   require_once "../config.php";

   $sql = "SELECT coachId, coachFname, coachLname, coachSalary, seasonsCoached, teamId FROM coach";
   $result = $mysqli->query($sql);

   if ($result->num_rows > 0) {
     	// Setup the table and headers
	echo "<Center><table><tr><th>ID</th><th>Name</th><th>Salary</th><th>Seasons</th><th>Team</th></tr>";
	// output data of each row into a table row

	 while($row = $result->fetch_assoc()) {
		 $sql = "SELECT teamLocation, teamName FROM team WHERE teamId = ".$row["teamId"];
		 $result2 = $mysqli->query($sql);
		 $row2 = $result2->fetch_assoc();
		 echo "<tr><td>".$row["coachId"]."</td><td>".$row["coachFname"]." ".$row["coachLname"].
                   "</td><td>".$row["coachSalary"]."</td><td>".$row["seasonsCoached"]."</td><td>".
                   $row2["teamLocation"]." ".$row2["teamName"]."</td></tr>";
	 }

	echo "</table></center>"; // close the table
	echo "There are ". $result->num_rows . " results.";
	// Don't render the table if no results found
   	} else {
               echo "0 results";
               }
     $mysqli->close();

?>
</body>
</html>
