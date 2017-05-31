<head>
<title>Ranks</title>
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
session_start();
if(isset($_SESSION['username'])){ echo '<br>';require('logout_button.html'); }
require('connect.php');
$sql='select distinct PROBLEMS.pcode,pname from RANKS,PROBLEMS where RANKS.pcode=PROBLEMS.pcode;';
$result=mysql_query($sql);
$flag=1;
while($row=mysql_fetch_array($result)){
echo '<table border="1" style="border-collapse:collapse;width:30%;margin:0px 0px 0px 390px;"><caption style="color:brown;font-family:Courier New;">'.$row[1].'</caption>';
if($flag)echo '<tr><th><b>Username</b></th><th><b>Language</b></th><th><b>Score</b></th></tr>';
$sql1='select uname,language,best_score from RANKS where pcode="'.$row[0].'" order by best_score limit 20;';
$result2=mysql_query($sql1);
while($row2=mysql_fetch_array($result2))
	echo '<tr><td style="color:#006400;font-family:Courier New;"><i>'.$row2[0].'</i></td><td>'.$row2[1].'</td><td>'.$row2[2].'</td></tr>';
echo '<br></table>';
$flag=0;
}
?>
