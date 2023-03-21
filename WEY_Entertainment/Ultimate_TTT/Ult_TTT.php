/* https://code.tutsplus.com/tutorials/how-to-create-a-simple-web-based-chat-application--net-5931 */
<?php

session_start();

if(isset($_GET['logout'])){    

	

	//Simple exit message

    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";

    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);

	

	session_destroy();

	header("Location: Ult_TTT.php"); //Redirect the user

}

if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}

function loginForm(){
    echo 
    '<div id="loginform">
<p>Please enter your name to continue!</p>
<form action="Ult_TTT.php" method="post">
<label for="name">Name &mdash;</label>
<input type="text" name="name" id="name" />
<input type="submit" name="enter" id="enter" value="Enter" />
</form>
</div>';
}

?>
<html lang="en">
 <head>
    <title>Ultimate Tic Tac Toe</title>
    <link rel="stylesheet" type="text/css" href="../CSS/Ult_TTT.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/chatroom.css">
    <link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/large-devices.css">
    <link rel="stylesheet" href="../CSS/style.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="Ult_TTT.js"></script>
  </head>
    <body>
    <?php
    if(!isset($_SESSION['name'])){
        loginForm();
    }
    else {
    ?>
            <div id="container">
            <div class="info">
              <h2>The Rules</h2>
              <p>Each small 3 × 3 tic-tac-toe board is referred to as a local board, and the larger 3 × 3 board is referred to as the global board.</p>
              <p>The game starts with X playing wherever they want in any of the 81 empty spots. This move "sends" their opponent to its relative location. For example, if X played in the top right square of their local board, then O needs to play next in the local board at the top right of the global board. O can then play in any one of the nine available spots in that local board, each move sending X to a different local board.</p>
              <p>If a move is played so that it is to win a local board by the rules of normal tic-tac-toe, then the entire local board is marked as a victory for the player in the global board.</p>
              <p>Once a local board is won by a player or it is filled completely, no more moves may be played in that board. If a player is sent to such a board, then that player may play in any other board.</p>
              <p>Game play ends when either a player wins the global board or there are no legal moves remaining, in which case the game is a draw.</p>
              <button class="info-close">Close</button>
            </div>
            <div id="game">
              <div class="game-overlay"></div>
              <div id="winner">
                <h1></h1>
              </div>
            </div>
            <div id="options">
              <button class="btn-info">Instructions</button>
              <button class="player1">Blue starts</button>
              <button class="player2">Red starts</button>
            </div>
          </div>
        </body>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
                <p class="logout"><a id="exit" href="../index.html">Exit Chat</a></p>
            </div>
            <div id="chatbox">
            <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $contents = file_get_contents("log.html");          
                echo $contents;
            }
            ?>
            </div>
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>
        </div>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div
                            //Auto-scroll
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }	
                        }
                    });
                }
                setInterval (loadLog, 2500);
                $("#exit").click(function () {
                    var exit = confirm("Are you sure you want to end the session?");
                    if (exit == true) {
                    window.location = "Ult_TTT.php?logout=true";
                    }
                });
            });
        </script>
    </body>
</html>

<?php

}

?>