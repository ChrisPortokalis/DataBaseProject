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
	<title> Project: Christopher Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h1> Chris Portokalis </h1>
	<h1> Assign Grade </h1>
	
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
			
			
				if(isset($_POST['ass']))
				{
					$points = $_POST['points'];
					$sId = $_POST['sId'];
					$cId = $_SESSION['cId'];
					
					
					$insert = "INSERT INTO Takes VALUES (" . $sId .  ", " .  $cId . ", '" . $points . "' );";
					if($DB->query($insert))
					{
						
						echo 'Grade Inserted';
					}
					else
					{
						$upd = "UPDATE Takes SET grade  = '" . $points . "' WHERE classId = " . $cId . " AND userId = " . $sId;
						
						if($DB->query($upd))
						{
							echo 'Grade Updated';
							
						
						}
						else
						{
							echo 'Error With Query';
						}
						
					}
				
				
				
				}
				else
				{
					
					echo '<form method = "post" action = "assignGrade.php"> Class <select name = "option">';
					
					$findAss = "SELECT classNum, classId FROM Class WHERE finished = 0 AND classId IN (SELECT classId FROM Teaches WHERE userId = " .  $_SESSION['userId'] . ")";
					
					echo '<option> Classes </option>';
					
					$table = $DB->query($findAss);
					
					while($row = $table->fetch_array(MYSQLI_NUM))
					{
						
						
							echo "<option name = '" . $row[0] . "' value = '" . $row[1] . "'>" . $row[0] . "</option>";
						
						
					}
					
					echo '</select> <br/>';
					
									
					echo '<input type = "submit" name = "sub" value = "View"/> </form>';
				}
			}
			
			if(isset($_POST['sub']))
			{
				$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
				$dbpass = trim($fileText);
			
				$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
			
				$option = $_POST['option'];
				
				$_SESSION['cId'] = $option;
				
				
				echo '</select> <br/>';
				
				$findStu = "SELECT userId FROM Takes WHERE classId = " . $option;
				
				$table2 = $DB->query($findStu);
				echo '<form method = "post" action = "assignGrade.php">';
				
				echo 'Students <select name = "sId">';
				echo '<option> Students </option>';
				
				while($row = $table2->fetch_array(MYSQLI_NUM))
				{
					foreach($row as $value)
					{
						echo "<option name = '" . $value . "' value = '" . $value . "'>" . $value . "</option>";
					
					}
				
				
				}
				
				echo '</select> <br/>';
				echo 'Grade <input name = "points" type = "text" method = "post"/> <br/>';
				
				
				echo '<input type = "submit" value = "Update" name = "ass" />';
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