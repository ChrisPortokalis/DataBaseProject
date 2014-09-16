<!DOCTYPE html>
<?php session_start(); 
	  require("projFuncs.php");
	  menuBar();
	  echo '<br/>';
	  if(isset($_POST['user']))
	  {
		instrInfo($_POST['user']);
	  }
	  else if(isset($_SESSION['User']))
	  {
		instrInfo($_SESSION['User']);
	  }
	    header('Cache-Control: max-age=900');
?>
<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h1> Chris Portokalis </h1>
	<h1> Instructor Page </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<table class = "menu" border = "1">
		<th> Menu </th>
			<tr> 
				<td>
					<ul>
						
						<div class = "check">
						<li> <a href = "viewCourses.php"> View Courses Taught</a></li>
						<li> <a href = "assignments.php"> View Assignments </a> </li>
						<li> <a href = "stuGrades.php"> View Assignment Grades </a> </li>
						<li> <a href = "addAss.php"> Change Assignments </a> </li>
						<li> <a href = "updateGrade.php"> Update Student Grades </a> </li>
						<li> <a href = "assignGrade.php"> Give Final Grades </a> </li>					
						</div>
						
					
					</ul>
				</td>
			
			</tr>
		</table>
	
	

	<?php
			
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
			
			
			if(mysqli_connect_error())
			{
				
				
				
				
			}
			else
			{
				if(!isset($_SESSION['User']))
				{
					$user = $_POST['user'];
					$passw = $_POST['passw'];
					$stuUser = "SELECT * FROM User WHERE instructor = true AND userName = '" . $user . "'";
					$table = $DB->query($stuUser);
					$row = $table->fetch_array(MYSQLI_NUM);
							
					if( $row[0] == $user )
					{
						$passw = $passw . $row[5];
						$passw= hash('sha256', $passw);
						
						if($row[6] == $passw)
						{
							$_SESSION['User'] = $user;
							$_SESSION['pass'] = $passw;
							
							
							$checkCreds = "SELECT student, instructor, administrator, userId FROM User WHERE userName = '". $user ."'";
							$table2 = $DB->query($checkCreds);
							$credRow = $table2->fetch_array(MYSQLI_NUM);
							
							if($credRow[0] == true)
							{
							
								$_SESSION['student'] = true;
							
							}
							if($credRow[1] == true)
							{
							
								$_SESSION['instructor'] = true;
							
							}
							if($credRow[2] == true)
							{
							
								$_SESSION['admin'] = true;
							
								
							}
							
							$id = $credRow[3];
							
							$_SESSION['userId'] = $id;
						}
						else
						{
							header("Location: signIn.php");
								
						}
									
					}
					else
					{
						echo "invalid User";
						echo '<br/>';
						echo $row[0];
						header("Location: signIn.php");
							
					}
				}	
				else
				{
					checkLogin('instructor');
						
				}
		
					
	
			}
			
			//checkLogin('instructor');
			
		if(isset($_POST['signOut']))
		{
				session_destroy();
				header("Location: signIn.php");
		}
		
			?>
	</td>
	
</tr>

</table>

</body>
</html>