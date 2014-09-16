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
	<h1> View Assignment Grades </h1>
	
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
			
			$assignment = $_POST['option'];
			
			
			$grades = "SELECT * FROM Assignment as a NATURAL JOIN AssignmentGrade WHERE a.assignmentName = '" . $assignment . "' AND classId IN (SELECT classId FROM Teaches WHERE userId = " . $_SESSION['userId'] . ")";
			echo '<h1>' , $assignment, '</h1>';
					
						$table3 = $DB->query($grades);
						echo '<br/> <br/>';
						echo '<table class = "show" border = "1" cellpadding = "10">';
						echo '<th> student ID </th> <th> Assignment </th> <th> points earned </th> <th>total points </th> <th> percentage </th>';
						
						while($row3 = $table3->fetch_array(MYSQLI_ASSOC))
						{
							
							
							echo '<tr>';
							
							echo '<td>';
							echo $row3['studentId'];
							echo '</td>';
							echo '<td>';
							echo $row3['assignmentName'];
							echo '</td>';
							echo '<td>';
							echo $row3['points'];
							echo '</td>';
							echo '<td>';
							echo $row3['numPoints'];
							echo '</td>';
							echo '<td>';
							
							$percent = ($row3['points']/$row3['numPoints'])*100;
							
							echo $percent . "%";
							
							echo '</td>';
							echo '</tr>';
				
						
						}
						echo '</table>';
		
		?>
		
		<br/>
		<br/>
	</td>
</tr>
</table>
</body>
</html>