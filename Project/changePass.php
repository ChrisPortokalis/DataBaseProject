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
	<h3> Change Password </h3>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<form action = "changePass.php" method = "post">
		<div class = "check">
			
			User ID <input type = "text" name = "Id" method = "post"> <br/>
			Password <input type = "password" name = "passw" method = "post" > <br/>
			Confirm Password <input type = "password" name = "cpassw" method = "post"> <br/>
		</div>
			<br/>
			
			<input type = "submit" value = "Change Password" name = "sub" /> <br/>
		
			
		</form>
	
		<?php
		
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
		
			if(isset($_POST['sub']))
			{
				$password = $_POST['passw'];
				$cpassw = $_POST['cpassw'];
				$userId = $_POST['Id'];
				
				
				if(mysqli_connect_error())
				{
					echo 'connection error <br/>';
				
				}
				else
				{
					if($password == $cpassw)
					{
						$password = trim($password);
						$salt = uniqid(mt_rand(), true);
						$password = $password . $salt;
						$hash = hash('sha256', $password);
						
						$q = "UPDATE User SET salt = '" . $salt . "', passwordHash = '" . $hash . "' WHERE userId = " . $userId;
						
						
						
						if($DB->query($q))
						{
						
							echo '<br/> Password Changed';
						}
						else
						{
						
							echo '<br/> Error: Password not changed';
						}
					
					}
					else
					{
						echo '<br/> Passwords did not match. Try Again!';
					
					}
				}
			}
		?>
		
</td>
</tr>
</table>
</body>
</html>
				