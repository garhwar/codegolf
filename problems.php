<head><title>Problems</title>
<style>
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

a:hover{color:maroon;}
html { background-image:url('back1.jpg');background-attachment:fixed; }
body { border-radius: 25px;margin-left:1.5cm;margin-right:1.5cm; background-image: url('background1.jpg'); }
</style></head>


<?php
require('connect.php');
$sql='select * from PROBLEMS;';
$result=mysql_query($sql);
echo '<table border="1" cellpadding="5" style="margin-left:8cm;border:1px solid green;border-collapse:collapse;"><caption>Solve from our list of problems</caption><tr><th>ID</th><th>Code</th><th>Name</th><th>Best Score</th><th>Golfer</th><th>Golfed in</th></tr>';
while($row=mysql_fetch_array($result)){
	echo '<tr><td>'.$row['pid'].'</td><td><a style="text-decoration:none;" href="problems/'.$row['pcode'].'.php">'.$row['pcode'].'</a></td><td>'.$row['pname'].'</td><td>'.$row['best_score'].'</td><td>'.$row['golfer'].'</td><td>'.$row['golfed_in'].'</td></tr>';
	}


//create login session here
session_start();
if(isset($_SESSION['username'])){
	$uname=$_SESSION['username'];
	echo '<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	require('logout_button.html');
	$sql='select fname,lname from USERS where uname="'.$uname.'";';
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	echo 'Welcome <b><i>'.$row['fname'].' '.$row['lname'].'</i></b>!<br><br>';
}
else if(isset($_POST['loginbutton'])){
	echo '<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	$uname=mysql_escape_string($_POST['uname']);
	$password=mysql_escape_string($_POST['pwd']);
	$password=md5($password);
	$sql='select * from USERS where uname="'.$uname.'" and password="'.$password.'";';

	$result=mysql_query($sql);
	if(mysql_num_rows($result)==1){
	require('logout_button.html');
	$sql='select fname,lname from USERS where uname="'.$uname.'";';
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	echo 'Welcome <b><i>'.$row['fname'].' '.$row['lname'].'</i></b>!<br><br>';
	$_SESSION['username']=$uname;
	}
	else {echo '<br><p style="text-indent:8cm;font-family:Courier New;color:brown;">Invalid login! Either username or password incorrect.<br></p><p style="text-indent:8cm;font-family:Courier New;color:brown;">Please login or register to submit your solutions.<p>';
	echo '<form method="POST" action="login.php">
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name="loginbutton" value="Login">
		</form>';
	echo '<form method="POST" action="register.php">
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name="loginbutton" value="Register">
		</form><br>';}
}
else{
	echo '<br><p style="text-indent:8cm;font-family:Courier New;color:maroon;">Please login or register to submit your solutions.<p>';
	echo '<form method="POST" action="login.php">
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name="loginbutton" value="Login">
		</form>';
	echo '<form method="POST" action="register.php">
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name="loginbutton" value="Register">
		</form><br>';
}
echo '<hr><br>';
?>


