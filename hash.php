<?php
    $pass;
    $repass;
    //remains same all through the code
    $salt='ujj';
    //rediect
    if(isset($_POST['cancel'])){
        header("Location: index.html");
        return;
    }
    $failure = false;
    $success = false;

    //if nothing is written, this code is skipped
    if(isset($_POST['pass']) && isset($_POST['repass'])){
        if(strlen($_POST['pass']) < 1 || strlen($_POST['repass']) < 1){
            $failure = "Please enter the password.";
        }
        else{
            $success = true;
            $pass = $_POST['pass'];
            $repass = $_POST['repass'];
            if($pass == $repass){ 
                $password = md5($pass.$salt);
                $file = fopen("pass.txt", "r");
                $check = fgets($file);
                fclose($file);
                if($check == $password){
                    $failure = "Password is same as the previous one.";
                }
                else{
                    $file = fopen("pass.txt", "w");
                    fwrite($file, $password);
                    $success = "Password set";
                }
            }
            else{
                $failure="Passwords do not match.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css"/>
    <title>Set Password</title>
</head>
<body>
    <header>
        <nav>
            <a href="./index.html">Index</a>
            <a href="./game.php">Game
                <ul>
                    <li>Drop Down Nav Bar</li>
                    <li>Second Element</li>
                </ul>
            </a>
            <a href="./login.php">Login</a>
            <a href="./hash.php" class="active">Set Password</a>
            <a href="./aboutme.html">About Me</a>
        </nav>
    </header>
    <main>
        <h1>Please enter a password.</h1>
        <form method="POST">
            <input type="password" id="pass" name="pass" placeholder="Please enter the password: "/>
            <br>
            <input type="password" id="pass" name="repass" placeholder="Please enter the password again: "/>
            <br>
            <input type="submit" name="cancel" value="Cancel" class="button"/>&nbsp
            <input type="submit" value="Set Password" class="button"/>
            <?php
                if($failure !== false){
                    echo('<p class="alert">'.htmlentities($failure)."</p>");
                }
                elseif($success !== false){
                    echo('<p class="alert">'.htmlentities($success)." <a href=./login.php>Login.</a></p>");
                    return;
                }
            ?>
        </form>
    </main>
    <footer>
        <p>Courtesy: Ujjwal Verma, Bidoliboi!</p>   
    </footer>
</body>
</html>