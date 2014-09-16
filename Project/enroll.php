<!DOCTYPE html>
<?php session_start();
	  require("projFuncs.php");
	  checkLogin('student');
	   menuBar();
	if(isset($_SESSION['User']))
	{
		studentInfo($_SESSION['User']);
	}
	
?>
<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h1> Chris Portokalis </h1>
	<h1> View Schedule </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<br/>
		<?php
			
				$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
				$dbpass = trim($fileText);
				
				$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
				
				echo '<form method = "post" action = "enroll.php"> Class <select method = "post" name = "class">';
				
				$findClass = "SELECT classNum FROM Class WHERE open = 1";

				echo '<option> Classes </option>';
				
				$table = $DB->query($findClass);
				
				while($content = $table->fetch_array(MYSQLI_NUM))
				{
					foreach($content as $key => $value)
					{
						echo "<option name = '" . $value . "' value = '" . $value . "'>" . $value . "</option>";
					}

				}
				
				echo '</select>';
				echo '<input type = "submit" name = "sub" value = "Enroll"/> </form>';
				
				
				if(isset($_POST['sub']))
				{
					$option = $_POST['class'];
				
					$q = "SELECT requiredClassNum FROM Prerequisite WHERE requiringClassNum = '" . $option . "'";
					

					
					$q2 = "SELECT classNum FROM Class WHERE classId IN (SELECT classId FROM Takes WHERE userId = " . $_SESSION['userId'] . ")";
					$table3 = $DB->query($q2);
					$pre;
					
					$table2 = $DB->query($q);
					
					$i = -1;
					
					while($row = $table2->fetch_array(MYSQLI_NUM))
					{
						$preR[$i+1] = $row[0];	
						$inum = $i+1;
						$i++;
					}
					
					
					
					if($i >= 0)
					{
						$j = 0;
						while($row2 = $table3->fetch_array(MYSQLI_NUM))
						{
							foreach($preR as $res)
							{
								if($res == $row2[0])
								{
									$pre[$j] = true;
									$j++;
									break;
									
								}			
							}
						}	
					}
					
				$preCheck = true;
	
				if($i >= 0)
				{			
					if(count($preR) != count($pre))
					{
						$preCheck = false;
							
					}
					
				}
				else
				{
					$preCheck = true;
				}
				
				
					
					if($preCheck == true)
					{
						$find = "SELECT classId FROM Class WHERE classNum = '" . $option . "' AND open = 1";
						
						$new = $DB->query($find);
						
						$nRow = $new->fetch_array(MYSQLI_NUM);
					
						$query = "INSERT INTO Takes VALUES ( " . $_SESSION['userId'] . ", " . $nRow[0] . ", 'N' );";
						
						if($DB->query($query))
						{
							echo '<br/> Enrolled!';
						}
						else
						{
							echo '<br/> Error With Query';
						
						}
					
					}
					else
					{
					
						echo '<br/> Could not enroll due to prerequisite';
					
					
					}
					
					
					
					
				
				
				
				
				
				}
		?>
	</td>
	</tr>
</table>
</body>
</html>