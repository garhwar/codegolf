<head>
<title>Users</title>
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
a{ text-decoration:none;color:green; }
a:hover{ color:brown;text-decoration:underline; }
h1,h2,h3,h4,h5,h6{margin-left:2cm;font-family:Courier New;}
p,tr,td{font-family:Courier New;text-indent:0px;margin-left:2cm;margin-right:5cm;text-indent:20px;}
html { background-image:url('back1.jpg');background-attachment:fixed; }
body { border-radius: 25px;margin-left:1.5cm;margin-right:1.5cm; background-image: url('background1.jpg'); }
</style>
</head>

<?php
require('connect.php');
session_start();
if(isset($_SESSION['username'])){ echo '<br>';require('logout_button.html'); }
$sql='select fname,lname,uname,email,language from USERS order by fname;';
$result=mysql_query($sql);
echo '<br><table border="1" style="border-collapse:collapse;width:70%;margin:0px 0px 0px 175px;"><tr><th><b>Name</b></th><th><b>Username</b></th><th><b>Email</b></th><th><b>Favourite lang</b></th></tr>';
while($row=mysql_fetch_array($result)){
echo '<tr><td style="color:#006400;font-family:Courier New;"><i>'.$row[0].' '.$row[1].'</i></td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td></tr>';
}
echo "</table>";

?>
