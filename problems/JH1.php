<?php
echo '<br><p id="indent">After seeing the popularity of the question size contest, a new version has been uploaded.<br>

The problem statement is really simple.You are given \'n\' and and then next n lines contain \'n\' numbers.You have to calculate p and q.<br>

\'p\' is the sum of numbers at even places ,but we add them only if they are positive.<br>

\'q\' is the sum of numbers at odd places,but we add them only when they are negative.<br>

Then you need to find the absolute value of p and q.<br>

If p is greater  than q or equal to q,then print "Some Mirrors Lie!".<br>

If q is greater than p, then print "Every Girl Lies!"<br><br>


<b>Input:</b><br>
First line contains a integer t=number of test cases.<br>
Then each test case contains a number n. and next line conatin \'n\' numbers separated by a space.<br>
1<=n<=100<br>
and the numbers are less than 10^18<br><br>

<b>Output:</b><br>
A single line for each test case as described above.<br><br>

<b>Example:</b><br>
Input:<br>
1<br>
5<br>
-1 2 -3 5 -4<br><br>

Output:<br>
Every Girl Lies!<br><br><hr>';

require('buttons.php');
echo '<br>';
?>

<html>
<head>
<title>Size Contest Reloaded!!!</title>
<style>
html { background-image:url('../back1.jpg');background-attachment:fixed; }
body { border-radius: 25px;margin-left:1.5cm;margin-right:1.5cm; background-image: url('../background1.jpg'); }
#indent{ font-family:Courier New;margin-left:7cm;margin-right:6cm;color:maroon; }
</style>
</head>
</html>

