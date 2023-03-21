<!DOCTYPE html> 
<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<html> 
    <head>
        <meta charset="utf-8">
        <title>
            CS476 WEY Group project
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 580px)" href="CSS/small-devices.css" />
        <link rel="stylesheet" type="text/css" media="screen and (min-width: 581px)" href="CSS/large-devices.css" />    
        <link rel="stylesheet" type="text/css" href="CSS/mystyle.css" />

    </head>

    <body>
        <header>
            <h1>
                <img style="width:1400PX;height:250px;" src="file/page2.jpg" alt="first page" /><br/>Welcome to the WEY Game entertainment platform!
            </h1>
        </header>
        <hr/>
        <nav>
            <ul>
              <li><a href="self-intro.html" class="niceButton">About US</a></li>
              <li><a href="signup.html" class="niceButton">sign-up page</a></li>
              <?php if (isset($user)): ?>
                <li><a href="manage-friend.php" class="niceButton">Manage your Friend</a></li>
             <?php endif; ?>
              <li><a href="gamelist.html" class="niceButton">Find Games</a></li>
              <?php if (isset($user)): ?>
                <li>Hello <?= htmlspecialchars($user["name"]) ?>
                <a href="logout.php">Log out</a></li>
              <?php else: ?>
                <li><a href="login.html">Log in</a> or <a href="signup.html">sign up</a></li>
              <?php endif; ?>
            </ul>
        </nav>
        <hr/>
        <section id="greetings">
            <div>Hello, This is WEY Game entertainment platform! Welcome! <br/>Nice to meet you here!:)</div>
        </section>

        <section id="self-intro">
            <h4 style="text-align: center;"> NEWS!!</h4>
            <article>
                <p>
                    New evidence supports community rumors that Counter-Strike 2 is possibly being developed, thanks to one player's deep investigation.
                </p>

                <p>Sony Complains To Regulators Over Starfield And Elder Scrolls Xbox Exclusivity</p>


            </article>
            <h5 style="text-align: center;"> Latest OFF!!!</h5>
            <article>
                <p>
                    GAME XXXX is having a big price cut, this unprecedented price cut, 50% OFF!! We can provide you with a better game experience!
                     This time is also in order to feedback the support of old players has been, put yourself into the world of the game fly!
                </p>
            </article>
        </section>

        <aside id="gamelist">
            <h3>
                The following is the Game List:
            </h3>
            <article style="color:green;">
                <ul>
                    <li>Games recommended by the platform:</li>
                </ul>
                <ol>
                    <li>GAME A---------game information</li>
                    <li>GAME B---------game information</li>
                    <li>GAME C---------game information</li>
                </ol>
            </article>
            <p><br/></p>
            <article style="color:red;">
                <ul>
                    <li>The highest rated game:</li>
                </ul>
                <ol>
                    <li>GAME A---------game information</li>
                    <li>GAME B---------game information</li>
                    <li>GAME C---------game information</li>
                </ol>
            </article>
        </aside>

        <section1 id="link"> 
            <div style="text-align: center;">
                <h3>
                    An introduction to our team:
                </h3>
                <article style="color:green;">
                    <p>
                        Our platform is dedicated to providing the best possible service to users and game developers, 
                        providing a platform for users to play and communicate, which makes it easier to interact with people in games.
                    </p>
                    <p>
                        If you have any questions about our platform, you can enter the feedback submission interface through the following buttons.
                        We look forward to your feedback, which will give us a better user experience!
                    </p>
                    <div><a href="signup.html" class="niceButton">feedback page</a></div>
                </article>
            </div>
        </section>

        <footer>&#169;2023/03/15 CS476. YZF357 All rights reserved.</footer>
        <p><a href="http://validator.w3.org/">Validate HTML5</a></p>
        <p><a href="http://jigsaw.w3.org/css-validator/">Validate CSS</a></p>
    </body>
    
</html>