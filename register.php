<html>
<head>
<title>Register</title>
<style>
/***DROPDOWN STYLING***/
select {
    padding:3px;
    margin: 0;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    background: #f8f8f8;
    color:#888;
    border:none;
    outline:none;
    display: inline-block;
    -webkit-appearance:none;
    -moz-appearance:none;
    appearance:none;
    cursor:pointer;
}

/* Targetting Webkit browsers only. FF will show the dropdown arrow with so much padding. */
@media screen and (-webkit-min-device-pixel-ratio:0) {
    select {padding-right:18px}
}

label {position:relative}
label:after {
    content:'';
    font:0px "Consolas", monospace;
    color:#aaa;
    -webkit-transform:rotate(90deg);
    -moz-transform:rotate(90deg);
    -ms-transform:rotate(90deg);
    transform:rotate(90deg);
    right:8px; top:2px;
    padding:0 0 2px;
    border-bottom:1px solid #ddd;
    position:absolute;
    pointer-events:none;
}
label:before {
    content:'';
    right:6px; top:0px;
    width:20px; height:20px;
    background:#f8f8f8;
    position:absolute;
    pointer-events:none;
    display:block;
}

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
padding:0.5px 15px; /*add some padding to the inside of the button*/
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
input.button:hover, input#gobutton:focus{
background-color :#399630; /*make the background a little darker*/
/*reduce the drop shadow size to give a pushed button effect*/
-webkit-box-shadow: 0 0 1px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 1px rgba(0,0,0, .75);
box-shadow: 0 0 1px rgba(0,0,0, .75);
}

html { background-image:url('back1.jpg');background-attachment:fixed; }
body { border-radius: 25px;margin-left:1.5cm;margin-right:1.5cm; text-indent:9.8cm;background-image: url('background1.jpg'); }
</style>
</head>

</html>


<?php

session_start();
if(!isset($_SESSION['username'])){
require('connect.php');
if(isset($_POST['registerbutton'])){
$pwd1=$_POST['pwd1'];
$pwd2=$_POST['pwd2'];
if($pwd1==$pwd2){
	$fname=mysql_escape_string($_POST['fname']);
	$lname=mysql_escape_string($_POST['lname']);
	$email=mysql_escape_string($_POST['email']);
	$uname=mysql_escape_string($_POST['uname']);
	$password=mysql_escape_string($_POST['pwd1']);
	$language=mysql_escape_string($_POST['language']);
	
	if(empty($uname)||empty($password)||empty($fname)){echo "Username, password and Firstname fields are mandatory!";exit();}
	$password=md5($password);
	
	$sql='select * from USERS where uname="'.$uname.'";';
	$result=mysql_query($sql);
	if(mysql_num_rows($result)!=0){ echo "The username is taken, choose another!"; exit(); }
	$sql='insert into USERS(fname,lname,uname,email,language,password) values("'.$fname.'","'.$lname.'","'.$uname.'","'.$email.'","'.$language.'","'.$password.'");';
	mysql_query($sql);
	echo "You were successfully registered on TheCodegolfSite.";
	mysql_close($conn);
}
else {echo "The passwords do not match. Go back and try again.";exit();}
}
else{
$form='<body><br><hr>
<h1 style="text-indent:9.6cm;font:family:verdana;color:green;"><< Register to start golfing! >></h1><hr>
<form method="POST" action="register.php" style="font-family:Courier New;">
<table border="0" cellpadding="3" style="cell-spacing:5px;border-collapse:collapse;">
<tr><td>First Name:</td><td style="text-indent:1cm;"><input class="textbox" type="text" name="fname"></td></tr>
<tr><td>Last Name:</td><td style="text-indent:1cm;"><input class="textbox" type="text" name="lname"></td></tr>
<tr><td>Username:</td><td style="text-indent:1cm;"><input class="textbox" type="text" name="uname"></td></tr>
<tr><td>Email:</td><td style="text-indent:1cm;"><input class="textbox" type="email" name="email"></td></tr>
<tr><td>Password:</td><td style="text-indent:1cm;"><input class="textbox" type="password" name="pwd1"></td></tr><br>
<tr><td>Confirm Password:</td><td style="text-indent:1cm;"><input class="textbox" type="password" name="pwd2"></td></tr>
<tr><td>Favourite language:</td><td style="text-indent:1cm;"> 
<label>
<select name="language">
  <option value="C">C</option>
  <option value="C++">C++</option>
  <option value="Python">Python</option>
  <option value="JAVA">JAVA</option>
  <option value="Ruby">Ruby</option>
  <option value="Perl">Perl</option>
  <option value="PHP">PHP</option>
  <option value="Scala">Scala</option>
  <option value="Scheme">Scheme</option>
  <option value="Haskell">Haskell</option>
  <option value="BASH">BASH</option>
  <option value="AWK">AWK</option>
  <option value="Perl">Perl</option>
  <option value="Intercal">Intercal</option>
  <option value="Brainfuck">Brainfuck</option>
  <option value="Whitespace">Whitespace</option>
  <option selected>Choose lang</option>
</select> 
</label>
<input class="button" type=submit name="registerbutton" value="Register" style="background-color:green;font-family:Courier New;color:white;"></td></tr>
<tr><td></td><td></td></tr>
</table>
</form>
<p style="margin-left:0cm;"><hr></p>
</body>';
echo $form;
	}
}
else{
echo 'You are already a registered member on the site!<br><br>Redirecting to homepage...
<head>
<title>Error!</title>
<meta http-equiv="refresh" content="2;url=homepage.php">
</head>';
}
?>

