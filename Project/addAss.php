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
	<h1> Update Assignments </h1>
	
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
			
			
				if(isset($_POST['subu']))
				{
					$assign = $_POST['upd'];
					$name = $_POST['Nname'];
					$weight = $_POST['Nweight'];
					
					$upd = "UPDATE Assignment SET assignmentName = '" . $name . "', numPoints = " . $weight . " WHERE assignmentName = '" . $assign . "'";
					
					if($DB->query($upd))
					{
					
						echo 'Assignment Updated';
					}
					else
					{
						echo 'Error: Assignment Not Updated ' . $upd;
					}
				
				
				
				}
				else if(isset($_POST['suba']))
				{
					$name = $_POST['Aname'];
					$weight = $_POST['Aweight'];
					$Id = $_SESSION['AclassId'];
					
					
					$add = "INSERT INTO Assignment VALUES ( " . $Id . ", '" . $name . "', " . $weight  . ");";
					
					if($DB->query($add))
					{
						echo 'Assignment Added';
					
					}
					else
					{
						echo 'Error Assignment Not Added ' . $add;
					
					}
				
				
			
				}
				else if(isset($_POST['subd']))
				{
					$assign = $_POST['del'];
					
					$del = "DELETE FROM Assignment WHERE assignmentName = '" . $assign . "' AND classId IN (SELECT classId FROM Teaches WHERE userId = " . $_SESSION['userId'] . ")"; 
					
					if($DB->query($del))
					{
						echo 'Assignment Deleted';
					
					}
					else
					{
						echo 'Error: Assignment Not Deleted';
					
					
					}
				
				
				
				}
				else
				{
					$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
					$dbpass = trim($fileText);
					
					$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
					
					echo '<form method = "post" action = "addAss.php"> Class <select name = "option">';
					
					$findAss = "SELECT classNum, classId FROM Class WHERE finished = 0 AND classId IN (SELECT classId FROM Teaches WHERE userId = " .  $_SESSION['userId'] . ")";
					
					echo '<option> Classes </option>';
					
					$table = $DB->query($findAss);
					
					while($row = $table->fetch_array(MYSQLI_NUM))
					{
						
						
							echo "<option name = '" . $row[0] . "' value = '" . $row[1] . "'>" . $row[0] . "</option>";
						
						
					}
					
					echo '</select>';
					echo '<input type = "submit" name = "sub" value = "View"/> </form>';
				}
			}
			
			if(isset($_POST['sub']))
			{
				$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
				$dbpass = trim($fileText);
			
				$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
			
				$option = $_POST['option'];
				
				
			
				$create = "SELECT assignmentName FROM Assignment WHERE classId = " . $option;
				echo 'Update Assignment';
				echo '<form method = "post" action = "addAss.php"> Assignments <select name = "upd">';
				echo '<option> Assignments </option>';
			
				$table = $DB->query($create);
			
				while($content = $table->fetch_array(MYSQLI_NUM))
				{
					foreach($content as $key => $value)
					{
						echo "<option name = '" . $value . "' value = '" . $value . "'>" . $value . "</option>";
					
					}
				}
				
				echo '</select> <br/>';
				echo 'New Name <input type = "text" name = "Nname"/> <br/>';
				echo 'New Weight <input type = "text" name = "Nweight"/> <br/>';
				echo '<input type = "submit" name = "subu" value = "Update" > </input> <br/>';
				echo '</form>';
				
				
				echo '<br/> <br/>';
				
				echo 'Add Assignment';
								
				echo '<form method = "post" action = "addAss.php">';
				echo '</select> <br/>';
				echo 'Name <input type = "text" name = "Aname"/> <br/>';
				echo 'Weight <input type = "text" name = "Aweight"/> <br/>';
				$_SESSION['AclassId'] = $option;
				echo '<input type = "submit" name = "suba" value = "Add" > </input> <br/>';
				echo '</form>';
				
				echo '<br/> <br/>';
				
				echo 'Delete Assignment';
				
				echo '<form method = "post" action = "addAss.php"> Assignments <select name = "del">';
				echo '<option> Assignments </option>';
				$create = "SELECT assignmentName FROM Assignment WHERE classId = " . $option;
				$table = $DB->query($create);
			
				while($content = $table->fetch_array(MYSQLI_NUM))
				{
					foreach($content as $key => $value)
					{
						echo "<option name = '" . $value . "' value = '" . $value . "'>" . $value . "</option>";
					
					}
				}
				echo '</select> <br/>';
				echo '<input type = "submit" name = "subd" value = "Delete" > </input> <br/>';
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