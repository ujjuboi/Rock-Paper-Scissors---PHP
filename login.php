
<?php
    //remember to use isset and not !isset
    $failure = false;
    
    if(isset($_POST['cancel'])){
        header("Location: index.html");
        return;
    }

    if(isset($_POST['username']) && isset($_POST['pass'])){
        if(strlen($_POST['username']) < 1 || strlen($_POST['pass']) <1 ){
            $failure = "Username and Password are required.";
        }
        else{
            $name = $_POST['username'];
            $salt = 'ujj';
            $password = md5($_POST['pass'].$salt);
            $file = fopen("pass.txt", "r");
            $check = fgets($file);
            fclose($file);
            $ver = 'verified';
            if($check == $password){
                $file = fopen("pass.txt", "a");
                fwrite($file, " ".$name.$ver);
                fclose($file);
                header("Location: game.php?username=".urlencode($name));
                return;
            }
            elseif($ver === strstr($check, $ver)){
                $failure = "Already Loged In";
            }
            else{
                $failure = "Username or Password is incorrect";
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
    <title>Login</title>
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
            <a href="./login.php" class="active">Login</a>
            <a href="./hash.php">Set Password</a>
            <a href="./aboutme.html">About Me</a>
        </nav>
    </header>
    <main>
        <h1> Please LogIn to Play.</h1>
        <form method="POST">
            <input type="text" name="username"id="name" placeholder="Please enter your name: "/>
            <br>
            <input type="password" name="pass" id="pass" placeholder="Please enter the password: "/>
            <br>
            <input type="submit" name=cancel class="button" value="Cancel"/>&nbsp
            <input type="submit"  class="button" value="Log In"/>
            <?php
                if($failure !== false){
                    echo('<p class=alert>'.htmlentities($failure)."</p>");
                }
            ?>
        </form>
    </main>
    <footer>
        <p>Courtesy: Ujjwal Verma, Bidoliboi!</p>   
    </footer>
</body>
</html>