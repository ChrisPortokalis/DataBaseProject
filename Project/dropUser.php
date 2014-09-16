<!DOCTYPE html>

<?php require("projFuncs.php");
	  session_start();
	  checkLogin('admin');
	   
?>

<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h3> Chris Portokalis </h3>
	<h3> Delete User</h3>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
		<br/>
		<br/>
		<form action = "dropUser.php" method = "post">
		<div class = "check">
			User ID <input type = "text" name = "Id" method = "post"> <br/>
		</div>
			<br/>
			
			<input type = "submit" value = "Delete User" name = "sub" /> <br/>
	
			
		</form>
	
		<?php
		
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
		
			if(isset($_POST['sub']))
			{
				$userId = $_POST['Id'];
				
				if(mysqli_connect_error())
				{
					echo 'connection error <br/>';
				
				}
				else
				{
					$q = "DELETE FROM User WHERE userId = " . (string)$userId ;
						
					
					if($DB->query($q))
					{
						echo '<br/> User Deleted';
					
					}
					else
					{
					
						echo '<br/> Error Deleting User' . " " . $q;
					}
					
					
				}
		
			}
	
	
		?>
	
	
	</td>
	
</tr>

</table>

</body>
</html>