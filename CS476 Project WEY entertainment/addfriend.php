<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT id FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user1 = $result->fetch_assoc();
    
    if($_POST["email"] != ""){
        $sql3 = "SELECT id FROM user
        WHERE email = '{$_POST["email"]}'";
        $result2 = $mysqli->query($sql3);
        $user2 = $result2->fetch_assoc();
    }
    elseif($_POST["name"] != ""){
        $sql3 = "SELECT id FROM user
        WHERE name = '{$_POST["name"]}'";
        $result2 = $mysqli->query($sql3);
        $user2 = $result2->fetch_assoc();
    }
    else{
        
        header("Location: addfriend.php");
        
        exit;
    }

    $sql2 = "INSERT INTO friend (user_1, user_2)
        VALUES (?, ?)";
    
    $stmt = $mysqli->stmt_init();

    if ( ! $stmt->prepare($sql2)) {
        die("SQL error: " . $mysqli->error);
    }
    

    $stmt->bind_param("ss",
                    $user1["id"],
                    $user2["id"]);

    if ($stmt->execute()) {
        header("Location: manage-friend.php");
        exit;
        }
    else {
            die("Player does not exist.");
            }

}



?>
<!DOCTYPE html> 
<html> 
    <head>
        <meta charset="utf-8">
        <title>
           Find Friend Page
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 580px)" href="CSS/small-devices.css" />
        <link rel="stylesheet" type="text/css" media="screen and (min-width: 581px)" href="CSS/large-devices.css" />    
        <link rel="stylesheet" type="text/css" href="CSS/mystyle.css" />

    </head>

    <body>
        <header>
            <h1>
                <img style="width:1400PX;height:250px;" src="file/page2.jpg" alt="first page" /><br/> Find Friend Page
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

        <section1 id="self-intro">
            <h4 style="text-align: center;"> This is our team!</h4>
            <article>
                <p>
                    We can find our friends here. You can search by user email or by user name.
                </p>
            </article>
        </section1>

        <div style="text-align:center;">
            <h3>
               Find your friend here
            </h3>
            <form method="post">
                <p>Enter Email:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<input type="text" name="email"/><br/><br/>
                Enter User Name:&emsp;&emsp;&emsp;<input type="text" name="name"/><br/><br/>
                <
                <input type="submit" value="Add"/></p>
            </form>
        </div>

        <div style="text-align:center;">
            <p>
                <a href="manage-friend.php" class="niceButton">Back to Manage my Friend</a>>
                &emsp;&emsp;&emsp;&emsp;
                <a href="index.php" class="niceButton">Back to my Home page</a>>
            </p>
        </div>

        <footer>&#169;2023/03/15 CS476. YZF357 All rights reserved.</footer>
        <p><a href="http://validator.w3.org/">Validate HTML5</a></p>
        <p><a href="http://jigsaw.w3.org/css-validator/">Validate CSS</a></p>
    </body>
    
</html>