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
    <title>Search Players | NFL Trade Database</title>
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

<p><h2>Search Players:</h2></p>
<form action="playerSearch.php" method=get>
        <p>Enter player first name: <input type=text size=20 name="playerFname">
        <p>Enter player last name: <input type=text size=20 name="playerLname">
        <p>Enter player id: <input type=text size=5 name="playerId">
        <p> <input type=submit value="submit">
                <input type="hidden" name="form_submitted" value="1" >
</form>

<?php // this line starts PHP Code

 if (!isset($_GET["form_submitted"])) {
   echo "Hello. Please enter a player's name or id and submit the form.";
 }
 else {

  // Include config file
  require_once "../config.php";

  if (!empty($_GET["playerFname"]))
  {
    $playerFname = $_GET["playerFname"]; //gets name from the form
    $sqlstatement = $mysqli->prepare("SELECT playerId, playerFname, playerLname, playerSalary, seasonsPlayed, ".
      "playerNumber, playerPosition, teamId FROM player WHERE playerFname=?"); //prepare the statement
    $sqlstatement->bind_param("s",$playerFname); //insert the String variable into the ? in the above statement
    $sqlstatement->execute(); //execute the query
    $searchResult = $sqlstatement->get_result(); //return the results
    $sqlstatement->close();
  }
  elseif (!empty($_GET["playerLname"]))
  {
    $playerLname = $_GET["playerLname"]; //gets name from the form
    $sqlstatement = $mysqli->prepare("SELECT playerId, playerFname, playerLname, playerSalary, seasonsPlayed, ".
      "playerNumber, playerPosition, teamId FROM player WHERE playerLname=?"); //prepare the statement
    $sqlstatement->bind_param("s",$playerLname); //insert the String variable into the ? in the above statement
    $sqlstatement->execute(); //execute the query
    $searchResult = $sqlstatement->get_result(); //return the results
    $sqlstatement->close();
  }
  elseif (!empty($_GET["playerId"]))
  {
    $playerId = $_GET["playerId"]; //gets name from the form
    $sqlstatement = $mysqli->prepare("SELECT playerId, playerFname, playerLname, playerSalary, seasonsPlayed, ".
      "playerNumber, playerPosition, teamId FROM player WHERE playerId=?"); //prepare the statement
    $sqlstatement->bind_param("i",$playerId); //insert the String variable into the ? in the above statement
    $sqlstatement->execute(); //execute the query
    $searchResult = $sqlstatement->get_result(); //return the results
    $sqlstatement->close();
  }
  if ($searchResult->num_rows > 0) {
        // Setup the table and headers
        echo "<Center><table><tr><th>ID</th><th>Name</th><th>Salary</th><th>Seasons</th><th>Number".
          "</th><th>Position</th><th>Team</th></tr>";
        // output data of each row into a table row
        while($row = $searchResult->fetch_assoc()) {
                 $sql = "SELECT teamLocation, teamName FROM team WHERE teamId = ".$row["teamId"];
                 $result2 = $mysqli->query($sql);
                 $row2 = $result2->fetch_assoc();

                 echo "<tr><td>".$row["playerId"]."</td><td>".$row["playerFname"]." ".$row["playerLname"]."</td><td>".
                   $row["playerSalary"]."</td><td>".$row["seasonsPlayed"]."</td><td>".$row["playerNumber"].
                   "</td><td>".$row["playerPosition"]."</td><td>".$row2["teamLocation"]." ".
                   $row2["teamName"]."</td></tr>";
        }

        echo "</table> </center>"; // close the table
        echo "There are ". $searchResult->num_rows . " results.";
        // Don't render the table if no results found
  } else {
      echo "no results found. 0 results";
  }
  $mysqli->close();
}
?>
</body>
</html>
