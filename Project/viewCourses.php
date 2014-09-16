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
	<h1> View Courses Taught </h1>
	
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
			
			
			$create = "SELECT * FROM Class WHERE classId IN (SELECT classId FROM Teaches WHERE userId = " . $_SESSION['userId'] . ")";
			
			$table = $DB->query($create);
			
				echo "<table class = 'show' align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> classId </th> <th> className </th> <th> classNum </th> <th> sectionNum </th> <th> semester </th> <th> year </th> <th> credit </th> <th> max </th> <th> open </th> <th> finished </th>";
				while($content = $table->fetch_array(MYSQLI_NUM))
				{
					echo "<tr>";
					foreach($content as $key => $value)
					{
						echo "<td>" . $value . "</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
		
		?>
		
		<br/>
		<br/>
	</td>
</tr>
</table>
</body>
</html>