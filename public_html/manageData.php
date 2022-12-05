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
    <title>Manage Data | NFL Trade Database</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<?php
    require_once "navbar.php";
?>
    <br>
    <h2>Add Data:</h2>
    <p>
        <a href="addTrade.php" class="nav-item nav-link">Add Trades</a>
        <a href="addPlayer.php" class="nav-item nav-link">Add Players</a>
        <a href="addCoach.php" class="nav-item nav-link">Add Coaches</a>
    </p>

    <br>
    <h2>Remove Data:</h2>
    <p>
        <a href="removeTrade.php" class="nav-item nav-link">Remove Trades</a>
        <a href="removePlayer.php" class="nav-item nav-link">Remove Players</a>
        <a href="removeCoach.php" class="nav-item nav-link">Remove Coaches</a>
    </p>

    <br>
    <h2>Modify Data:</h2>
    <p>
        <a href="modifyPlayer.php" class="nav-item nav-link">Modify Players</a>
        <a href="modifyCoach.php" class="nav-item nav-link">Modify Coaches</a>
        <a href="modifyTeam.php" class="nav-item nav-link">Modify Teams</a>
    </p>

</body>
</html>
