<html>
<head>
<title>Success</title>
<style>
html { background-image:url('../back1.jpg');background-attachment:fixed; }
body { border-radius: 25px;margin-left:1.5cm;margin-right:1.5cm; background-image: url('../background1.jpg'); }
#indent{ font-family:Courier New;margin-left:7cm;margin-right:6cm;color:maroon; }
</style>
</head>

<body>
<?php
echo '<br><p id="indent">Try printing the string "SUCCESS" in as few letters as possible.<br><br>
<b>Score:</b><br>
Score equals (1 x number of non-linefeed characters)+(2 x number of linefeed characters).<br><br><hr>';
require('buttons.php');
echo '</p><br>';
?>
</body>
</html>

