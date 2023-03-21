<?php

session_start();
if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM friend
            WHERE user_1 = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
}
?>
<!DOCTYPE html> 
<html> 
    <head>
        <meta charset="utf-8">
        <title>
           Manage Friend Page
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 580px)" href="CSS/small-devices.css" />
        <link rel="stylesheet" type="text/css" media="screen and (min-width: 581px)" href="CSS/large-devices.css" />    
        <link rel="stylesheet" type="text/css" href="CSS/mystyle.css" />

    </head>

    <body>
        <header>
            <h1>
                <img style="width:1400PX;height:250px;" src="file/page2.jpg" alt="first page" /><br/> Manage Your Friend
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


        <div>
            <table>
                <tr class="evenRow">
                    <th>Name</th>
                    <th>Friend E-mail</th>
                    <th>Talk with your Friend</th>
                </tr>
                
                <?php
                    while ($row = $result->fetch_assoc()) {
                        // Get friend information from user_2 table
                        $friendId = $row["user_2"];
                        $friendSql = "SELECT * FROM user WHERE id = '$friendId'";
                        $friendResult = $mysqli->query($friendSql);
                        $friendRow = $friendResult->fetch_assoc();
                        
                        // Display friend information in table row
                        echo '<tr>';
                        echo '<td>' . $friendRow['name'] . '</td>';
                        echo '<td>' . $friendRow['email'] . '</td>';
                        echo '<td><a href="chatroom.html">Chat room</a></td>';
                        echo '</tr>';
                    }
                ?>
            </table>
        </div>

        <div style="text-align:center;">
            <p>
                <a href="addfriend.php" class="niceButton">Go to Add New Friend</a>>
                &emsp;&emsp;&emsp;&emsp;
                <a href="index.php" class="niceButton">Back to my Home page</a>>
            </p>
        </div>

        <footer>&#169;2023/03/15 CS476. YZF357 All rights reserved.</footer>
        <p><a href="http://validator.w3.org/">Validate HTML5</a></p>
        <p><a href="http://jigsaw.w3.org/css-validator/">Validate CSS</a></p>
    </body>
    
</html>
