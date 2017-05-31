<?php
session_start();
session_destroy();
echo '<p style="color:brown;font-family:Trebuchet MS;">Your have now logged out!<br></p>Redirecting to homepage...';
?>
<html>
<head>
<title>Logout</title>
<meta http-equiv="refresh" content="2;url=../homepage.php">
</head>
</html>
