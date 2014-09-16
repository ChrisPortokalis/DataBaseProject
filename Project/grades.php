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
	<h1> View Grades </h1>
	
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
				
														
				echo '<form method = "post" action = "grades.php"> Class <select method = "post" name = "class">';
				echo '<option> Classes </option>';
				
				$sched = "SELECT classNum FROM Class as c NATURAL JOIN Takes as t WHERE userId = " . $_SESSION['userId'];
				
				$table = $DB->query($sched);
				
				while($content = $table->fetch_array(MYSQLI_NUM))
				{
					foreach($content as $key => $value)
					{
						echo "<option name = '" . $value . "' value = '" . $value . "'>" . $value . "</option>";
					}
			
				}
				
				echo '</select>';
				echo '<input type = "submit" name = "sub" value = "View Grades"/> </form>';
				
								if(isset($_POST['sub']))
				{
					$option = $_POST['class'];
					
					$classes = "SELECT classId FROM Takes WHERE userId = " . $_SESSION['userId'] . " AND classId IN (SELECT classId FROM Class WHERE classNum = '" . $option . "')";
				
					$table2 = $DB->query($classes);
					
					$row2 = $table2->fetch_array(MYSQLI_NUM);
					
					$Id = $row2[0];
					
					
					$grades = "SELECT * FROM Assignment as a NATURAL JOIN AssignmentGrade as ag WHERE a.classId = " . $Id . " AND ag.studentId = " . $_SESSION['userId'];
					
					if($DB->query($grades))
					{
						$table3 = $DB->query($grades);
						echo '<br/> <br/>';
						echo '<table class = "show" border = "1" cellpadding = "10">';
						echo '<th> class ID </th> <th> Assignment </th> <th> total points </th> <th> points earned </th> <th> percentage </th>';
						
						while($row3 = $table3->fetch_array(MYSQLI_ASSOC))
						{
							
							
							echo '<tr>';
							
							echo '<td>';
							echo $row3['classId'];
							echo '</td>';
							echo '<td>';
							echo $row3['assignmentName'];
							echo '</td>';
							echo '<td>';
							echo $row3['numPoints'];
							echo '</td>';
							echo '<td>';
							echo $row3['points'];
							echo '</td>';
							echo '<td>';
							
							$percent = ($row3['points']/$row3['numPoints'])*100;
							
							echo $percent . "%";
							
							echo '</td>';
							echo '</tr>';
				
						
						}
						echo '</table>';
					}
					else
					{
						echo '<br/>';
						echo "No Grades";
					
					}
					
				
				}
							
		?>

	</td>
	</tr>
</table>
</body>
</html>		
		
		