<!DOCTYPE html>

<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h1> Chris Portokalis </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	<form action = "signIn.php">
		<input style = "float: left" type = "submit" value = "Back" action = "signIn.php" /> <br/> <br/>
	</form>
		
		<form method = "post" action = "signUp.php">
		User Name: <input method = "post" align = "center" type = "text" name = "user"> </input> <br/>
		Password: <input  method = "post" align = "center" type = "password" name = "passw"/>
		ID:<input method = "post" align = "Center" type = "text" name = "Id"> <br/>
		
		<div class = "check" align = "center">
			   <input method = "post" align = "center" type = "checkbox" name = "student"/>Student    <br/>
			  <input method = "post" align = "center" type = "checkbox" name = "instr"/>Instructor  <br/>
			 <input method = "post" align = "center" type = "checkbox" name = "admin"/>Administrator <br/>
		</div>
		<br/>
		<br/>
		<input type = "submit" name = "SignUp" value = "Sign Up" method = "post"> </input>
	
		</form>
	
		<?php
		
		if(isset($_POST['SignUp']))
		{
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$password = trim($fileText);
			$user = "portoka";
		
			$db = new mysqli("cs.okstate.edu", $user, $password, $user);
			
			if(mysqli_connect_error())
			{
				//header("Location: https://localhost/sudoku2/");
						
				exit;
						
				echo "Database Connection Error";
						
			}
			else
			{
				$newUser = $_POST['user'];
				$password = $_POST['passw'];
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
				
				$db->query($insQuery);
			
			
			}
		}
		?>
	

	</td>
	
</tr>

</table>

</body>
</html>