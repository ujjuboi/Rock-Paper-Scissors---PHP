<?php
if (isset($_POST['cancel'])) {
    $file = fopen("pass.txt", "r");
    $check = fgets($file);
    $password = substr($check, 0, strpos($check, " "));
    fclose($file);
    $file = fopen("pass.txt", "w");
    fwrite($file, $password);
    fclose($file);
    header("Location: index.html");
    return;
}

$user = isset($_POST['uvalue']) ? $_POST['uvalue'] + 0 : -1;

$computer = rand(0, 2);

$names = array("Rock", "Paper", "Scissors");
function check($computer, $user)
{
    if ($user === -1) return ("Please choose one option.");
    if ($user === $computer) return ("It's a tie!");
    if ($user === 0 && $computer === 1) return ("Computer Wins!");
    if ($user === 1 && $computer === 2) return ("Computer Wins!");
    if ($user === 2 && $computer === 0) return ("Computer Wins!");

    return ("You Win! Computer sucks...");
}
if ($user == -1) {
    $result = false;
} else {
    $result = check($computer, $user);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/game.css" />
    <title>Rock Paper Scissors</title>
</head>

<body>
    <header>
        <nav>
            <a href="index.html">Index</a>
            <a href="./game.php" class="active">Game
                <ul>
                    <li>Drop Down Nav Bar</li>
                    <li>Second Element</li>
                </ul>
            </a>
            <a href="./login.php">Login</a>
            <a href="./hash.php">Set Password</a>
            <a href="./aboutme.html">About Me</a>
        </nav>
    </header>
    <main>
        <?php
        if (!isset($_GET['username']) || strlen($_GET['username']) < 1) {
            $file = fopen("pass.txt", "r");
            $check = fgets($file);
            $verify = strstr($check, "verified");
            fclose($file);
            if ($verify === "verified") {
                $name = substr($check, strpos($check, " "), strlen($check) - 40);
                echo ($name);
                header("Location: game.php?username=" . urlencode($name));
                return;
            } else {
                die('<p class="alert">Please LogIn first.</p>');
            }
        } else {
            $file = fopen("pass.txt", "r");
            $check = fgets($file);
            $verify = strstr($check, "verified");
            fclose($file);
            if ($verify === "verified") {
                echo ("<h1>Welcome " . htmlentities($_GET['username']) . " to Rock Paper Scissors</h1>");
            } else {
                die('<p class="alert">Please LogIn first.</p>');
            }
        }
        ?>
        <form method="POST" id="usergame">
            <p class="message">Choose your Move</p>
            <label>
                <input type="radio" name="uvalue" value="0" />
                <img src="./images/icons8-hand-rock-100.png" />
            </label>
            <label>
                <input type="radio" name="uvalue" value="1" />
                <img src="./images/icons8-hand-100.png" />
            </label>
            <label>
                <input type="radio" name="uvalue" value="2" />
                <img src="./images/icons8-hand-scissors-100.png" />
            </label>
            <input type="submit" name="cancel" value="LogOut" class="button" />&nbsp
            <input type="submit" value="Play!" class="button" /><br>
        </form>
        <?php
        if ($result !== false) {
            echo ('<p class = "message">Your Play = ' . htmlentities($names[$user]) . ' ; Computer Play = ' . htmlentities($names[$computer]) . '</p>');
            echo ('<p class = "message">' . htmlentities($result) . '</p>');
        }
        ?>
    </main>
    <footer>
        <p>Courtesy: Ujjwal Verma.</p>
    </footer>
</body>

</html>