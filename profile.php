<head>
<style>
input.button{
cursor:pointer; /*forces the cursor to change to a hand when the button is hovered*/
padding:0.8px 15px; /*add some padding to the inside of the button*/
background:#35b128; /*the colour of the button*/
border:1px solid #33842a; /*required or the default border for the browser will appear*/
/*give the button curved corners, alter the size as required*/
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
border-radius: 10px;
/*give the button a drop shadow*/
-webkit-box-shadow: 0 0 4px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 4px rgba(0,0,0, .75);
box-shadow: 0 0 4px rgba(0,0,0, .75);
}

input.button:hover, input.button:focus{
background-color :#399630; /*make the background a little darker*/
/*reduce the drop shadow size to give a pushed button effect*/
-webkit-box-shadow: 0 0 1px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 1px rgba(0,0,0, .75);
box-shadow: 0 0 1px rgba(0,0,0, .75);
}
</style>
</head>

<?php
require('connect.php');

session_start();
if(isset($_SESSION['username'])){  echo '<br>';require('logout_button.html'); }
if(isset($_POST['searchbutton']))
{ echo '<br>';$username=$_POST['username'];}
else $username=$_SESSION['username'];
$sql='select * from USERS where uname="'.$username.'";';
$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	echo '<p style="color:brown;margin-left:11.9cm;">DETAILS OF `<i>'.$username.'</i>`</p>
		<table class="basic" border="1" cellpadding="5" style="border-collapse:collapse;">
		<tr><td>Name:</td><td> <b><i>'.$row['fname'].' '.$row['lname'].'</i></b></td></tr>
		<tr><td>Username:</td><td> <b><i>'.$row['uname'].'</i></b></td></tr>
		<tr><td>Email:</td><td> <b><i>'.$row['email'].'</i></b></td></tr>
		<tr><td>Favourite language:</td><td> <b><i>'.$row['language'].'</i></b></td></tr>
		</table><br>';
	echo '<p style="color:brown;margin-left:11.2cm;">Statistics from <i>THECODEGOLFSITE</i></p>';
	$sql='select * from STATS where uname="'.$username.'" limit 50;';
	echo '<table class="stats" border="1" cellpadding="5" style="border-collapse:collapse;"><tr><th>Problem Code</th><th>Sumbissions</th><th>Accepted</th><th>Best Score</th></tr>';
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
	echo '<tr><td><a style="text-decoration:none;" href="problems/'.$row[1].'.php">'.$row[1].'</a></td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td></tr>';
	}
	echo "</table>";
	echo '<br><br><table border="1" style="border-collapse:collapse;margin-left:10.4cm;"><tr><td><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Total Submissions:</b> ';
        $sql='select sum(total_sub),sum(ac_sub) from STATS where uname="'.$username.'";';
        $result=mysql_query($sql);
        $row=mysql_fetch_array($result);
        echo $row[0].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>';
        echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Accepted:</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '.$row[1].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>';
	echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Accuracy:</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '.round($row[1]*100/$row[0],2).'%&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br><br></td></tr></table>';

?>

<html>
<head>
<title>
<?php
$sql='select fname,lname from USERS where uname="'.$username.'";';
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
echo $row[0].' '.$row[1];?>
</title>
</head>
<body style="font-family:Courier New;">
<style>
html { background-image:url('back1.jpg');background-attachment:fixed; }
body { border-radius: 25px;margin-left:1.5cm;margin-right:1.5cm; background-image: url('background1.jpg'); }
i{color:green;}
.basic{margin-left:9.5cm;margin-right:11cm;}
.stats{margin-left:9.5cm;margin-right:11cm;}
a:hover{color:brown;}
</style>
</body>
</html>
