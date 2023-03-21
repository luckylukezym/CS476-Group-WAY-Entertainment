<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["name"])) {
        die("Name is required");
    }

    if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        die("Valid email is required");
    }

    if (strlen($_POST["password"]) < 8) {
        die("Password must be at least 8 characters");
    }

    if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
        die("Password must contain at least one letter");
    }

    if ( ! preg_match("/[0-9]/", $_POST["password"])) {
        die("Password must contain at least one number");
    }

    if ($_POST["password"] !== $_POST["cfpassword"]) {
        die("Passwords must match");
    }

    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

   $host = "sql9.freesqldatabase.com";
    $dbname = "sql9607367";
    $username = "sql9607367";
    $password = "mQQXyFvQAn";

    $mysqli = new mysqli(hostname: $host,
                         username: $username,
                         password: $password,
                         database: $dbname);

    if ($mysqli->connect_errno) {
        die("Connection error: " . $mysqli->connect_error);
    }

    $sql = "INSERT INTO user (name, email, password_hash)
            VALUES (?, ?, ?)";
            
    $stmt = $mysqli->stmt_init();

    if ( ! $stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("sss",
                    $_POST["name"],
                    $_POST["email"],
                    $password_hash);

    if ($stmt->execute()) {

        header("Location: login.html");
        exit;
        
    } else {
        
        if ($mysqli->errno === 1062) {
            die("email already taken");
        } else {
            die($mysqli->error . " " . $mysqli->errno);
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
    <head>
        <title>
            SignUpPage
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 580px)" href="CSS/small-devices.css" />
        <link rel="stylesheet" type="text/css" media="screen and (min-width: 581px)" href="CSS/large-devices.css" />    
        <link rel="stylesheet" type="text/css" href="CSS/mystyle.css" />
        <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
        
    </head>

    <body>
        <header>
            <h1>
                <img style="width:1400PX;height:250px;" src="file/page2.jpg" alt="first page" /><br/>Sign Up Page
            </h1>
        </header>
        <hr/>
        <nav>
            <ul>
              <li><a href="self-intro.html" class="niceButton">About US</a></li>
              <li><a href="index.php" class="niceButton">Back to index</a></li>
              <li><a href="signup.html" class="niceButton">sign-up page</a></li>
              <li><a href="login.html" class="niceButton">re-login page</a></li>
              <li><a href="manage-friend.php" class="niceButton">Manage your Friend</a></li>
              <li><a href="gamelist.html" class="niceButton">Find Games</a></li>
            </ul>
        </nav>
        <hr/>

        <div style="text-align:center;">
            <h3>
                Sign Up here
            </h3>
            <form method="post">
                <p>User Name:&emsp;&emsp;&emsp;<input type="text" id="name" name="name"/><br/><br/>
                Email:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<input type="text" id="email" name="email"/><br/><br/>
                Password:&emsp;&emsp;&emsp;&emsp;&nbsp;<input type="password" id="password" name="password"/><br/><br/>
                Confirm Password:<input type="password" id="cfpassword" name="cfpassword"/><br/><br/><br/>
                <button>SignUP</button></p>
            </form>
        </div>
        <p><a href="index.php" class="niceButton">Back to my home page</a>></p>
    </body>
</html>
