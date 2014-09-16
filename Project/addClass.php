<!DOCTYPE html>

<?php require("projFuncs.php");
	  session_start();
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
	
	<h3> Chris Portokalis </h3>
	<h3> New Class</h3>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<form action = "addClass.php" method = "post">
		
			Class Id <input type = "text" name = "classId" method = "post" > <br/>
			Class Name <input type = "text" name = "name" > <br/>
			Class Num <input type = "text" name = "num" > <br/>
			Sect Num <input type = "text" name = "secNum" > <br/>
			Semester <input type = "text" name = "sem" > <br/>
			Year <input type = "text" name = "year" > <br/>
			Credit Hours <input type = "text" name = "credit" > <br/>
			Max Enrollment <input type = "text" name = "max" > <br/>
		<div class = "check">
			   <input method = "post" align = "center" type = "checkbox" name = "open"/> Open   <br/>
			  <input method = "post" align = "center" type = "checkbox" name = "fin"/> Finished  <br/>
		</div>
			<br/>
			
			<input type = "submit" value = "Add Class" name = "sub" /> <br/>
		
			
		</form>
	
		<?php
		
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
		
			if(isset($_POST['sub']))
			{
				
				if(mysqli_connect_error())
				{
					echo 'connection error <br/>';
				
				}
				else
				{
					$classId = $_POST['classId'];
					$name = $_POST['name'];
					$cNum = $_POST['num'];
					$secNum = $_POST['secNum'];
					$sem = $_POST['sem'];
					$year = $_POST['year'];
					$cred = $_POST['credit'];
					$max = $_POST['max'];
					
					if(isset($_POST['open']))
					{
					
						$open = 1;
					
					}
					else
					{
						$open = 0;
					}
					
					if(isset($_POST['fin']))
					{
						$fin = 1;
					}
					else
					{
						$fin = 0;
					}
					
					$q = "INSERT INTO Class VALUES (" . $classId . ", '" . $name . "', '" . $cNum . "', " . $secNum . ", '" . $sem . "', " . $year . ", " . $cred . ", " . $max . ", " . $open . ", " . $fin . ");";
				
				
					if($DB->query($q))
					{
					
						echo '<br/> Class Added';
			
					}
					else
					{
						echo '<br/> Class NOT Added';
					
					}
	
	
						
	
				}
		
			}
	
		?>
	
	
	</td>
	
</tr>

</table>

</body>
</html>