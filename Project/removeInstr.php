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
	<h1> Delete Classes </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<form method = "post" action = "removeInstr.php">
			<div class = "check">
			User Id <input method = "post" name = "uId" type = "text"> <br/>
			Class Id <input method = "post" name = "cId" type = "text"> <br/>
			</div> <br/>  
			<input type = "submit" method = "post" name = "add" value = "Delete Class"> <br/>
		</form>
		<br/>
		<br/>
		
	
		<?php
			
			if(isset($_POST['add']))
			{
				$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
				$dbpass = trim($fileText);
				
				$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");

				
				if(mysqli_connect_error())
				{
					echo 'connection error <br/>';
					
				}
				else
				{				
					$user = $_POST['uId'];
					$class = $_POST['cId'];
					
					$q = "DELETE FROM Teaches WHERE userId = " . $user . " AND classId = " . $class;
					
					if($DB->query($q))
					{
						echo '<br/> Class Removed';
				
					}
					else
					{
					
						echo '<br/> Error Deleting Class ' . $q ;
					}
				
			
				}
			}
			
			
			
		?>
	
	

	</td>
	
</tr>

</table>

</body>
</html>