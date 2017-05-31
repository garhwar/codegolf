<html>
<head>
<style>
body { border-radius: 25px;margin-left:8cm;margin-right:10cm; }
</style>
</head>
<body >
<?php
session_start();
if(isset($_SESSION['username'])){
require('../../connect.php');
session_start();
$language=$_POST['language'];
$code=$_POST['code'];
$problemcode=$_POST['problemcode'];
$username=$_SESSION['username'];
$file=fopen($problemcode,"w") or die("Unable to open file!");
fwrite($file,$code);
fclose($file);

$code=mysql_escape_string($code);		//for use in mysql queries

$verdict=0;					//just making sure code-rejection is defaulted 

/*update STATS table*/
$sql='select * from STATS where pcode="'.$problemcode.'" and uname="'.$username.'";';
$result=mysql_query($sql);
if(mysql_num_rows($result)==1){
	$sql='update STATS set total_sub=total_sub+1 where pcode="'.$problemcode.'" and uname="'.$username.'";';
	mysql_query($sql);
	}
else{
	$sql='insert into STATS values("'.$username.'","'.$problemcode.'",1,0,10000);';
	mysql_query($sql);
	}
   
$out=fopen('../verdict.php','w') or die('xxxxxxxxxx');
fwrite($out,'<head><title>Verdict</title><head><body style="margin-left:9cm;margin-right:9cm">');

fwrite($out,'<b style="font-family:Trebuchet-MS;">Server Response:</b><br><br>');
if($language=="C"){
	$path=$problemcode;
	$command='mv '.$path.' '.$path.'.c';
	exec($command);				//add extension to the file as per language
	$compile='gcc '.$path.'.c 2>&1';
	
	/*compile the program and display output*/
	$compile_msg=exec($compile);
        if(!$compile_msg)fwrite($out,'<p style="font-family:Trebuchet-MS;color:green;">Compilation Successful!</p>');
	else { fwrite($out,'<p style="font-family:Trebuchet-MS;color:red;">Compile Error!<hr></p>'); header('location:../verdict.php');exit(); }

	/*write the output to out.$problemcode*/
	$filein=fopen('in'.$problemcode,"r") or die("Unable to open input file!");
	$line=fgets($filein);
	if(strstr($line,"none")){
	$execute='timeout 2 ./a.out > out'.$problemcode.' 2>&1';
	exec($execute);
	}
	else{
	//$execute='chown -R www-data:www-data /var/www/project/problems/solutions';
	//exec($execute);
	$execute='timeout 2 ./a.out < in'.$problemcode.' > out'.$problemcode;
	exec($execute);
	}
	fclose($filein);

	/*match the outfile with ansfile*/
	$file1=file_get_contents('out'.$problemcode);
	$file2=file_get_contents('ans'.$problemcode);
	if($file1==$file2){
	fwrite($out, '<p style="font-family:Trebuchet-MS;color:green;">Answer accepted!</p>');
	$size=filesize($problemcode.='.c');
	$verdict=1;
	}
	else fwrite($out, '<p style="font-family:Trebuchet-MS;color:red;">Wrong Answer!</p><hr><br>Tip: Try including a newline at the end of output.(IT IS A BUG, deal with it)');
	/*destroy the source file and outfile*/
        file_put_contents($problemcode.'.c', "");
        file_put_contents('out'.$problemcode, "");
}

elseif($language=="C++"){
	$path=$problemcode;
	$command='mv '.$path.' '.$path.'.cpp';
	exec($command);				//add extension to the file as per language
	$compile='g++ '.$path.'.cpp 2>&1';
	
	/*compile the program and display output*/
	$compile_msg=exec($compile);
        if(!$compile_msg)fwrite($out,'<p style="font-family:Trebuchet-MS;color:green;">Compilation Successful!</p>');
        else { fwrite($out,'<p style="font-family:Trebuchet-MS;color:red;">Compile Error!<hr></p>'); header('location:../verdict.php');exit(); }

	/*write the output to out.$problemcode*/
	$filein=fopen('in'.$problemcode,"r") or die("Unable to open input file!");
	$line=fgets($filein);
	if(strstr($line,"none")){
	$execute='timeout 2 ./a.out > out'.$problemcode;
	exec($execute);
	}
	else{
	//$execute='chown -R www-data:www-data /var/www/project/problems/solutions';
	//exec($execute);
	$execute='timeout 2 ./a.out <in'.$problemcode.' > out'.$problemcode;
	exec($execute);
	}
	fclose($filein);

 	/*match the outfile with ansfile*/
        $file1=file_get_contents('out'.$problemcode);
        $file2=file_get_contents('ans'.$problemcode);
        if($file1==$file2){
        fwrite($out, '<p style="font-family:Trebuchet-MS;color:green;">Answer accepted!</p>');
        $size=filesize($problemcode.'.cpp');
        $verdict=1;
        }
        else fwrite($out, '<p style="font-family:Trebuchet-MS;color:red;">Wrong Answer!</p><hr><br>Tip: Try including a newline at the end of output.(IT IS A BUG, deal with it)');


        /*destroy the source file and outfile*/
        file_put_contents($problemcode.'.cpp', "");
        file_put_contents('out'.$problemcode, "");

}
elseif($language=="Python"){
	$path=$problemcode;
	$command='mv '.$path.' '.$path.'.py';
	exec($command);				//add extension to the file as per language

	/*compile, run and write the output to out.$problemcode*/
	$filein=fopen('in'.$problemcode,"r") or die("Unable to open input file!");
	$line=fgets($filein);
	if(strstr($line,"none")){
	$execute='timeout 2 python '.$problemcode.'.py > out'.$problemcode.' 2>&1';
	$compile_msg=exec($execute);
	}
	else{
	//execute='chown -R www-data:www-data /var/www/project/problems/solutions';
	//exec($execute);
	$execute='timeout 2 python '.$problemcode.'.py in'.$problemcode.' > out'.$problemcode.' 2>&1';
	exec($execute);
	}

	/*match the outfile with ansfile*/
	$file1=file_get_contents('out'.$problemcode);
	$file2=file_get_contents('ans'.$problemcode);
	if($file1==$file2){
	fwrite($out,'<p style="font-family:Trebuchet-MS;color:green;">Compilation Successful! <br> Answer accepted!</p>');
	$size=filesize($problemcode.'.py');
	$verdict=1;
	}
	else{
	if(strstr($file1,$problemcode))
	fwrite($out,'<p style="font-family:Trebuchet-MS;color:red;">Compile Error!</p><br>Your program outputs:<br><table border="1" style="border-collapse:collapse;"><tr><td><pre>'.$file1.'</pre><td></tr></table>');
	else fwrite($out,'<p style="font-family:Trebuchet-MS;color:green;">Compilation Successful!</p><p style="font-family:Trebuchet-MS;color:red;">Wrong Answer!</p><br><hr>');
        }
	/*destroy the source file and outfile*/
        file_put_contents($problemcode.'.py', "");
        file_put_contents('out'.$problemcode, "");

}
elseif($language=="AWK"){
	$path=$problemcode;
	$command='mv '.$path.' '.$path.'.awk';
	exec($command);				//add extension to the file as per language

	/*compile, run and write the output to out.$problemcode*/
	$filein=fopen('in'.$problemcode,"r") or die("Unable to open input file!");
	$line=fgets($filein);
	if(strstr($line,"none")){
	$execute='timeout 2 awk -f '.$problemcode.'.awk > out'.$problemcode.' 2>&1';
	if(exec($execute))echo "Time limit Exceeded!<br>";
	}
	else{
	//$execute='chown -R www-data:www-data /var/www/project/problems/solutions';
	//exec($execute);
	$execute='timeout 2 awk -f '.$problemcode.'.awk in'.$problemcode.' > out'.$problemcode.' 2>&1';
	if(exec($execute))echo "Time limit Exceeded!<br>";
	}

        /*match the outfile with ansfile*/
        $file1=file_get_contents('out'.$problemcode);
        $file2=file_get_contents('ans'.$problemcode);
        if($file1==$file2){
        fwrite($out,'<p style="font-family:Trebuchet-MS;color:green;">Compilation Successful! <br> Answer accepted!</p>');
        $size=filesize($problemcode.'.awk');
        $verdict=1;
        }
        else{
        if(strstr($file1,$problemcode))
        fwrite($out,'<p style="font-family:Trebuchet-MS;color:red;">Compile Error!</p><br>Your program outputs:<br><table border="1" style="border-collapse:collapse;"><tr><td><pre>'.$file1.'</pre><td></tr></table>');
        else fwrite($out,'<p style="font-family:Trebuchet-MS;color:green;">Compilation Successful!</p><p style="font-family:Trebuchet-MS;color:red;">Wrong Answer!</p><br><hr>');
        }

	/*destroy the source file and outfile*/
        file_put_contents($problemcode.'.awk', "");
        file_put_contents('out'.$problemcode, "");

}
	

/*update RANKS table*/
if($verdict){
fwrite($out,'<i><b style="font-family:Trebuchet-MS;">Your golf-score for this problem was &nbsp</i><font size="80" color="orange">'.$size.'</font>&nbsp.</b>');
fwrite($out,'<?php require("notes.php"); ?><hr></body>');
fclose($out);

$sql='select * from RANKS where pcode="'.$problemcode.'" and uname="'.$username.'" and language="'.$language.'";';
$result=mysql_query($sql);
if(mysql_num_rows($result)==1){
	$row=mysql_fetch_array($result);
	$score=$row['best_score'];
	if($size<$score){
	$sql='update RANKS set best_score='.$size.',best_code="'.$code.'" where pcode="'.$problemcode.'" and uname="'.$username.'" and language="'.$language.'";'; mysql_query($sql);}
	}
else{
	$sql='insert into RANKS values("'.$problemcode.'","'.$username.'","'.$language.'",'.$size.',"'.$code.'");';
	mysql_query($sql);
	}
}

/*update STATS table again after verdict has been passed*/
if($verdict)mysql_query('update STATS set ac_sub=ac_sub+1 where pcode="'.$problemcode.'" and uname="'.$username.'"');
$sql='select * from STATS where pcode="'.$problemcode.'" and uname="'.$username.'"';
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$score=$row['best_score'];
if($size<$score){
	$sql='update STATS set best_score='.$size.' where pcode="'.$problemcode.'" and uname="'.$username.'";';
	mysql_query($sql);
	}

/*update best_score in the PROBLEMS table */
$sql='select * from RANKS where pcode="'.$problemcode.'" group by best_score;';
$result=mysql_query($sql);
$row=mysql_fetch_array($result); $score=$row[3];$name=$row[1];$lang=$row[2];
$sql='update PROBLEMS set PROBLEMS.best_score='.$score.', golfer="'.$name.'" , golfed_in="'.$lang.'" where PROBLEMS.pcode="'.$problemcode.'";';
mysql_query($sql);
echo '<hr>';
}
else{
	/*user not logged in*/
	echo '<p style="font-family:Trebuchet MS;color:red;">Please login or register to submit your solutions.<p>';
	echo '<form method="POST" action="login.php">
		<input style="background-color:green;font-family:Trebuchet MS;color:white;" type=submit name="loginbutton" value="Login">
		</form>';
	echo '<form method="POST" action="register.php">
		<input style="background-color:green;font-family:Trebuchet MS;color:white;" type=submit name="loginbutton" value="Register">
		</form>';
	echo '<form method="POST" action="../../homepage.php">
		<input style="background-color:green;font-family:Trebuchet MS;color:white;" type=submit name="homebutton" value="Homepage">
		</form><hr><br>';
	
}
header('location:../verdict.php');
?>
</body>
</html>
