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
	<h1> View Prerequisites </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<br/>
		
		<form action = "viewPreReq.php" method = "post">
			Class Num: <input type = "text" name = "classId" method = "post"> <br/>
			<input type = "submit" value = "View Pre-Reqs" name = "sub">
		</form>
		
		<br/>
		<br/>
		
		<?php
			
			if(isset($_POST['sub']))
			{
				$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
				$dbpass = trim($fileText);
				
				$classId = $_POST['classId'];
				
				$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
				
				$show = "SELECT classNum FROM Class WHERE classNum = '" . $classId . "'";
				
				$table = $DB->query($show);
				
				$row = $table->fetch_array(MYSQLI_NUM);
				
				echo $row[0];
				echo ' PreRequisites <br/>';
				
				$preR = "SELECT requiredClassNum FROM Prerequisite WHERE requiringClassNum  = '" . $classId . "'";
				
				$table2 = $DB->query($preR);
				
				echo "<table class = 'show' align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> classNum </th> ";
				
				genTable($table2);
				
				echo '<br/> <br/>';
			}
			
			
		?>
	</td>
</tr>
</table>
</body>
</html>