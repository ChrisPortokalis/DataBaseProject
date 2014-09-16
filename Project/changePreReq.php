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
	<h1> Delete or Add Prerequisites</h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<br/>
		
		<form action = "changePreReq.php" method = "post">
			Requiring Class Num: <input type = "text" name = "classId" method = "post"> <br/>
			Prerequisite: <input type = "text" name = "classId2" method = "post">	<br/>
			
			<input type = "submit" value = "Add Prereq" name = "add">
			<input type = "submit" value = "Delete Prereq" name = "del">
		</form>
		
		<br/>
		<br/>
		
		<?php
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
		
				
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
		
			
			if(isset($_POST['add']))
			{	
				$classId = $_POST['classId'];
				$prereq = $_POST['classId2'];
			
				echo '<br/> <br/>';
				
				$show = "INSERT INTO Prerequisite VALUES ( '" . $classId . "', '" . $prereq . "' );";
				
				if($DB->query($show))
				{
					
					echo 'Prerequisite Added';
				
				}
				else
				{
				
					echo 'Error With query';
				}
			}
			else if(isset($_POST['del']))
			{
				echo '<br/> <br/>';
				
				$classId = $_POST['classId'];
				$prereq = $_POST['classId2'];
				
				$show = "DELETE FROM Prerequisite WHERE requiringClassNum = '" . $classId . "' AND requiredClassNum = '" . $prereq . "'";
				
				if($DB->query($show))
				{
					
					echo 'Prerequisite Deleted';
				
				}
				else
				{
				
					echo 'Error With query';
				}
			
			
			
			
			}
			
			
		?>
	</td>
</tr>
</table>
</body>
</html>