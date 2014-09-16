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
	<h1> Find Classes </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
		<br/>
		<br/>
	
		<form action = "classes.php" method = "post">
			User Id <input type = "text" name = "user" method = "post"> <br/>
			<input type = "submit" name = "find" value = "Find Classes" method = "post">
		
		</form>
		<br/>
		<br/>
		
		<?php
		
		if(isset($_POST['find']))
		{
		
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
			
			$userId = $_POST['user'];
			
			if(mysqli_connect_error())
			{
				echo 'connection error <br/>';
				
			}
			else
			{
				$name = "SELECT name FROM Instructor WHERE userId = " . $userId;
				
				$nTable = $DB->query($name);
				
				$nameRow = $nTable->fetch_array(MYSQLI_ASSOC);
				
				echo '<br/>';
				
				
				//echo "<table class = 'show' style = 'width: 370px' align = 'center' border = '1' cellpadding = '10' >";
				
				
				
				
				$q = "SELECT C.classId, C.classNum, C.className FROM Class as C WHERE C.classId IN (SELECT t1.classId FROM Teaches AS t1 WHERE userId = " . $userId . ")";
				
				if($table = $DB->query($q))
				{
					echo "<table class = 'show' style = 'font-size:10px' align = 'center' border = '1' cellpadding = '10' >";
					echo "<th style = 'position: center' >", $nameRow['name'], "</th> <tr> </tr>";
					echo "<th bgcolor= '#585858'> Class Id</th> <th bgcolor = '#585858'> Class Num </th> <th bgcolor = '#58585'> Class Name";
					genTable($table);
				}
				else
				{
					echo "Error with: " . $q;
				
				}

			
			
			
			}
		}
		
		?>
	
	
		
	</td>
	
</tr>

</table>

</body>
</html>