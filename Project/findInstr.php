<!DOCTYPE html>
<?php session_start();
	  require("projFuncs.php");
	  checkLogin('admin');
	  menuBar();
?>
<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h1> Chris Portokalis </h1>
	<h1> Instructors </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
		
		<?php
		
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
			
			if(mysqli_connect_error())
			{
				echo 'connection error <br/>';
				
			}
			else
			{
				$q = "SELECT name FROM Instructor";
				
				$table = $DB->query($q);
				
				echo ' <br/> <br/>';
				echo "<table class = 'show' style = 'font-size:10px' align = 'center' border = '1' cellpadding = '10' >";
				echo "<th bgcolor= '#585858'> Name </th>";
				genTable($table);
			}
		
		?>
	
	
		
	</td>
	
</tr>

</table>

</body>
</html>