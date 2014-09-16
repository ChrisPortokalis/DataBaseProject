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
	<h1> Unenroll </h1>
	
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
		
				if(isset($_POST['sub']))
				{
				
					$option = $_POST['class'];
					
					$q = "DELETE FROM Takes WHERE userId = " . $_SESSION['userId'] . " AND classId IN (SELECT classId FROM Class WHERE classNum = '" . $option . "')";
				
					if($DB->query($q))
					{
					
						echo '<br/> Class Dropped';
					}
					else
					{
						echo '<br/> Error: Class Not Dropped';
					
					}
				
				}
					
				
				echo '<form method = "post" action = "unenroll.php"> Class <select method = "post" name = "class">';
				echo '<option> Classes </option>';
				
				$sched = "SELECT classNum FROM Class as c NATURAL JOIN Takes as t WHERE userId = " . $_SESSION['userId'] . " AND finished = 0";
				
				$table = $DB->query($sched);
				
				while($content = $table->fetch_array(MYSQLI_NUM))
				{
					foreach($content as $key => $value)
					{
						echo "<option name = '" . $value . "' value = '" . $value . "'>" . $value . "</option>";
					}
			
				}
				
				echo '</select>';
				echo '<input type = "submit" name = "sub" value = "Unenroll"/> </form>';
				
				
					
		?>

	</td>
	</tr>
</table>
</body>
</html>				
				
				
				
				

				
				