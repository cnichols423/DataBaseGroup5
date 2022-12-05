<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the NFL Trade Database.</h1>
    <p><nav class="nav justify-content-center">
    <a href="welcome.php" class="nav-item nav-link active">Home</a>
    <a href="trades.php" class="nav-item nav-link">Recent Trades</a>
    <a href="player.php" class="nav-item nav-link">Players</a>
    <a href="playerSearch.php" class="nav-item nav-link">Search Players</a>
    <a href="coach.php" class="nav-item nav-link">Coaches</a>
    <a href="team.php" class="nav-item nav-link">Teams</a>
    <a href="manageData.php" class="nav-item nav-link" tabindex="-1">Manage Data</a>
</nav>
