<!DOCTYPE html>
<?php session_start();
	  require("projFuncs.php");
	  checkLogin('student');
	   menuBar();
	if(isset($_SESSION['User']))
	{
		studentInfo($_SESSION['User']);
	}
	
?>
<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h1> Chris Portokalis </h1>
	<h1> View Schedule </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<br/>
		<br/>
		<?php
			
				$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
				$dbpass = trim($fileText);
				
				$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
				
				echo 'Schedule <br/>';
				
				$sched = "SELECT classNum, grade FROM Class as c JOIN Takes as t ON (c.classId = t.classId) WHERE userId = " . $_SESSION['userId'];
				
				$table = $DB->query($sched);
				
				echo "<table class = 'show' align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> Class Num </th> <th> Grade </th>";
				
				genTable($table);
				
				echo '<br/> <br/>';
			
		?>
	</td>
</tr>
</table>
</body>
</html>