<?php
   $dbhost = 'athena.nitc.ac.in';
   $dbuser = 'b120542cs';
   $dbpass = 'pass';
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   if(!$conn)
   die('Could not connect: '.mysql_error());
   mysql_select_db('db_b120542cs');
?>
