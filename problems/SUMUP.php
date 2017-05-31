<?php
$problem='<br><p id="indent">	
Given an infinite series-<br>
1/3 + 2/21 + 3/91 + 4/273 + .....<br><br>
Find the sum upto Nth integer.<br><br>

<b>Input:</b><br>
Input consists of t (number of test cases), then t line follows, each containing an integer N (1 <= N <= 10,000).<br><br>

<b>Output:</b><br>
A single line containing the sum upto Nth integer (rounded upto 5 digits)<br><br>
<b>Score:</b><br>
Score equals (1 x number of non-linefeed characters)+(2 x number of linefeed characters).<br><br>
<b>Example:</b><br>

Input:<br>
5<br>
1<br>
2<br>
3<br>
4<br>
5<br><br>

Output:<br>
0.33333<br>
0.42857<br>
0.46154<br>
0.47619<br>
0.48387<br>';

echo $problem.'<br><br><hr>';
require('buttons.php');
echo '</p><br>';
?>

<html>
<head>
<title>Sum the Series</title>
<style>
html { background-image:url('../back1.jpg');background-attachment:fixed; }
body { border-radius: 25px;margin-left:1.5cm;margin-right:1.5cm; background-image: url('../background1.jpg'); }
#indent{ font-family:Courier New;margin-left:7cm;margin-right:6cm;color:maroon; }
</style>
</head>
</html>
