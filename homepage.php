<?php
$browser=$_SERVER['HTTP_USER_AGENT'];
if(!strstr($browser,'Chrom')){ echo'<br><p style="color:red;text-indent:4cm;">[This website is best viewed in Chrome/Chromium (Chromium recommended).]</p>'; }

echo '<!DOCTYPE html>
<html>
<head>
<title>TheCodegolfSite</title>
<style>

/***TEXTBOX STYLES***/ 
 .textbox { 
    background: #F3FFE7 ; 
    border: 1px solid #DDD; 
    border-radius: 5px; 
    box-shadow: 0 0 1px #000 inset; 
    color: #000; 
    outline: none; 
    height:20px; 
    width: 175px; 
   } 

/***FIRST STYLE THE BUTTON***/
input.button{
cursor:pointer; /*forces the cursor to change to a hand when the button is hovered*/
padding:0.8px 15px; /*add some padding to the inside of the button*/
background:#35b128; /*the colour of the button*/
border:1px solid #33842a; /*required or the default border for the browser will appear*/
/*give the button curved corners, alter the size as required*/
-moz-border-radius: 3.5;
-webkit-border-radius: 3.5px;
border-radius: 3.5px;
/*give the button a drop shadow*/
-webkit-box-shadow: 0 0 4px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 4px rgba(0,0,0, .75);
box-shadow: 0 0 4px rgba(0,0,0, .75);
}
/***NOW STYLE THE BUTTONS HOVER AND FOCUS STATES***/
input.button:hover, input.button:focus{
background-color :#399630; /*make the background a little darker*/
/*reduce the drop shadow size to give a pushed button effect*/
-webkit-box-shadow: 0 0 1px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 1px rgba(0,0,0, .75);
box-shadow: 0 0 1px rgba(0,0,0, .75);
}

a{ text-decoration:none;color:green; }
a:hover{ color:brown;text-decoration:underline; }
h1,h2,h3,h4,h5,h6{margin-left:2cm;font-family:Courier New;}
p,tr,td{font-family:Courier New;margin-left:2cm;margin-right:5cm;}
#compilers{ text-indent:100px; }
html { background-image:url("back1.jpg");background-attachment:fixed; }
body { border-radius: 25px;margin-left:1.5cm;margin-right:1.5cm; background-image: url("background1.jpg"); }
</style>
</head>

<body><br>

<h1 style=" margin:0px;text-indent:8cm;color:green;">Welcome to TheCodegolfSite!</h1>
<p style="text-indent:4.3cm;">The only programming site dedicated to programming in <i style="color:red;"><big>golf codes</big></i>.</p>
<table style="margin:10px;">
<tr><td id="left-body" style="text-indent:0px;">';
session_start();

if(!isset($_SESSION['username'])){
echo '<form method="POST" action="problems.php">
Username: <input class="textbox" type=text name="uname"><br>
Password: <input class="textbox" type=password name="pwd" placeholder=" *******"><br>
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name="loginbutton" value="Login"><br><br>
</form>
<form method="POST" action="register.php">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit value="Register">
</form>
<br><br><a href="problems.php">Problems</a><br>
<a href="ranks.php">Ranks</a><br>
<a href="users.php">Users</a><br>
<a href="about.php">About</a><br><br><br>
<form method="POST" action="profile.php">
Find:<input class="textbox" type=text method=post name="username" placeholder=" username">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=searchbutton value="Search">
</form></td>
<td id="right-body">
<u><h3 style="color:brown;">What is Codegolfing?</h3></u>
<p>It is a relatively modern programming paradigm where programmers try to write the shortest code in terms of number of characters used. Writing really short codes may require a different type of skillset as unlike other languages it may not demand algorithmic knowledge as much as a nice familiarization with the syntax and the compiler behavior.<br></p>
<p>Codegolf resembles the popular sport Golf in that the aim of the game is to make the hole in minimum possible tries.To know more about this awesome programming practice check out its wikipedia page- <b><a style="color:DarkSlateBlue;" href="http://en.wikipedia.org/wiki/Code_golf" target=_blank>Code golf</a>.</b></p>
<u><h3 style="color:brown;">What this website is capable of?</h3></u>
<p>The site basically hosts codegolf problems which its registered users solve by submitting their codes to the server.The solutions are judged right or wrong and can show one or many messages upon occurance of either event.A rank-list is maintained- language wise and overall- to show the progress made by users.<p></td></tr><hr>
<tr><td>
</td><td>';
}
else{
require('logout_button.html');
echo '<br><a href="problems.php">Problems</a><br>
<a href="ranks.php">Ranks</a><br>
<a href="users.php">Users</a><br>
<a href="about.php">About</a><br><br>
User:<a href="profile.php" target="_blank">'.$_SESSION['username'].'</a><br>
<form method="POST" action="profile.php">
Find:<input class="textbox" type=text method=post name="username" placeholder=" username">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=searchbutton value="Search">
</form></td>
<td id="right-body">
<u><h3 style="color:brown;">What is Codegolfing?</h3></u>
<p>It is a relatively modern programming paradigm where programmers try to write the shortest code in terms of number of characters used.Writing really short codes may require a different type of skillset as unlike others it may not demand algorithmic knowledge as much as a nice familiarization with the syntax and the compiler behavior.<br></p><p>Codegolf resembles the popular sport Golf in that the aim of the game is to make the hole in minimum possible tries.To know more about this awesome programming practice check out its wikipedia page- <b><a style="color:DarkSlateBlue;" href="http://en.wikipedia.org/wiki/Code_golf" target=_blank>Code golf</a>.</b></p>
</td></tr><hr>
<tr><td></td><td>
<u><h3 style="color:brown;">What this website is capable of?</h3></u>
<p>The site basically hosts codegolf problems which its registered users solve by submitting their codes to the server.The solutions are judged right or wrong and can show one or many messages upon occurance of either event.A rank-list is maintained- language wise and overall- to show the progress made by users.<p>';
}
?>

<u><h3 style="color:brown;">Languages and compilers</h3></u>
<p>The following is a list of compilers used on the server for given languages.</p>
<table id="compilers" border="1"  style="border-collapse:collapse;padding:25px;width:55%;margin:0px 0px 0px 110px;">
<tr><th style="text-indent:0px;">Language</th><th style="text-indent:0px;">Compiler</th><tr>
<tr><td>C</td><td>gcc 4.8.2</td></tr>
<tr><td>C++</td><td>g++ 4.8.2</td></tr>
<tr><td>Python</td><td>Python 2.7.6</td></tr>
<tr><td>AWK</td><td>GNU Awk 4.0.1</td></tr>
</table>
</td>
</table>

<br><br><hr><br><br><br>
</body>
</html>
