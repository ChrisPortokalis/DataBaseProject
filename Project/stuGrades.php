<!DOCTYPE html>
<?php session_start();
	  require("projFuncs.php");
	  checkLogin('instructor');
	  menuBar();
	  echo '<br/>';
	  instrInfo($_SESSION['User']);
?>
<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h1> Chris Portokalis </h1>
	<h1> View Students Grades </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
		<br/>
		<br/>
		
		<?php
		
			if(!isset($_POST['sub']))
			{	
				$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
				$dbpass = trim($fileText);
				
				$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
				
				echo '<form method = "post" action = "stuGrades.php"> Class <select name = "option">';
				
				$findAss = "SELECT classNum, classId FROM Class WHERE classId IN (SELECT classId FROM Teaches WHERE userId = " .  $_SESSION['userId'] . ")";
				
				echo '<option> Classes </option>';
				
				$table = $DB->query($findAss);
				
				while($content = $table->fetch_array(MYSQLI_NUM))
				{
					
					
						echo "<option name = '" . $content[0] . "' value = '" . $content[1] . "'>" . $content[0] . "</option>";
					
					
				}
				
				echo '</select>';
				echo '<input type = "submit" name = "sub" value = "View"/> </form>';
			}
			
			if(isset($_POST['sub']))
			{
				$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
				$dbpass = trim($fileText);
			
				$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
			
				$option = $_POST['option'];
				
				
			
				$create = "SELECT assignmentName FROM Assignment WHERE classId  = " . $option;
				
				echo '<form method = "post" action = "stuGrades_Assignment.php"> Assignments <select name = "option">';
				
				echo '<option> Assignments </option>';
			
				$table = $DB->query($create);
			
				while($content = $table->fetch_array(MYSQLI_NUM))
				{
					foreach($content as $key => $value)
					{
						echo "<option name = '" . $value . "' value = '" . $value . "'>" . $value . "</option>";
					
					}
				}
				
				echo '</select>';
				echo '<input type = "submit" name = "sub" value = "View" > </input>';
				echo '</form>';
				
			}
		
		?>
		
		<br/>
		<br/>
	</td>
</tr>
</table>
</body>
</html>