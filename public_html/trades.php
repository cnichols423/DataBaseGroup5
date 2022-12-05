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
    <title>Recent Trades | NFL Trades Database</title>
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

<p><h2>Recent NFL Trades:</h2></p>

<?php // this line starts PHP Code

   // Include config file
   require_once "../config.php";

   $sql = "SELECT tradeId, playerId, receiverTeamId, senderTeamId, tradeTimestamp FROM trades ORDER BY tradeTimestamp DESC";
   $result = $mysqli->query($sql);

   if ($result->num_rows > 0) {
     	// Setup the table and headers
	echo "<Center><table><tr><th>Trade ID</th><th>Player</th><th>Sending Team</th><th>Receiving Team</th><th>Timestamp</th></tr>";
	// output data of each row into a table row

	 while($row = $result->fetch_assoc()) {
		 $sql = "SELECT playerFname, playerLname FROM player WHERE playerId = ".$row["playerId"];
                 $resultPlayer = $mysqli->query($sql);
                 $rowPlayer = $resultPlayer->fetch_assoc();

		 $sql = "SELECT teamLocation, teamName FROM team WHERE teamId = ".$row["senderTeamId"];
                 $resultSend = $mysqli->query($sql);
                 $rowSend = $resultSend->fetch_assoc();

		 $sql = "SELECT teamLocation, teamName FROM team WHERE teamId = ".$row["receiverTeamId"];
                 $resultReceive = $mysqli->query($sql);
                 $rowReceive = $resultReceive->fetch_assoc();

		 echo "<tr><td>".$row["tradeId"]."</td><td>".$rowPlayer["playerFname"]." ".$rowPlayer["playerLname"].
                   "</td><td>".$rowSend["teamLocation"]." ".$rowSend["teamName"]. "</td><td>".
                   $rowReceive["teamLocation"]." ".$rowReceive["teamName"].
                   "</td><td>".$row["tradeTimestamp"]."</td></tr>";
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
