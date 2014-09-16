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
	<h3> New User</h3>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<form action = "NewUser.php" method = "post">
		<div class = "check">
			User Name <input type = "text" name = "name" method = "post" > <br/>
			Password <input type = "password" name = "passw" method = "post" > <br/>
			Confirm Password <input type = "password" name = "cpassw" method = "post"> <br/>
			User ID <input type = "text" name = "Id" method = "post"> <br/>
		
		
			   <input method = "post" align = "center" type = "checkbox" name = "student"/>Student    <br/>
			  <input method = "post" align = "center" type = "checkbox" name = "instr"/>Instructor  <br/>
			 <input method = "post" align = "center" type = "checkbox" name = "admin"/>Administrator <br/>
		</div>
			<br/>
			
			<input type = "submit" value = "Add New User" name = "sub" /> <br/>
		
			
		</form>
	
		<?php
		
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
		
			if(isset($_POST['sub']))
			{
				$newUser = $_POST['name'];
				$password = $_POST['passw'];
				$cpassw = $_POST['cpassw'];
				
				
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
						
						if(isset($_POST['student']))
						{
							$stu = "1";
						}
						else
						{
							$stu = "0";
						}
						
						if(isset($_POST['instr']))
						{
							$instr = "1";
							
						}
						else
						{
							$instr = "0";
						}
						
						if(isset($_POST['admin']))
						{
						
							$admin = "1";
						}
						else
						{
							$admin = "0";
						}
										
						
						$userId = $_POST['Id'];
						
						$insQuery = "INSERT INTO User VALUES ('" . $newUser . "', " . (string)$userId . ", " . $stu . ", " . $instr . ", " . $admin . ", '" . $salt . "', '" . $hash . "')";
						
						if($DB->query($insQuery))
						{
						
							echo '<br/> New User Created';
						}
						else
						{
						
							echo '<br/> Error: New User not created';
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