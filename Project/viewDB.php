<!DOCTYPE html>

<<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "style3.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h2> Chris Portokalis </h2>
	
	<?php
	
		$user = "portoka";
		$password = "dIyJPKC";
	
		$dbase = new mysqli("cs.okstate.edu", $user, $password, $user);
		
		if(mysqli_connect_error())
		{
			//header("Location: https://localhost/sudoku2/");
						
						
				echo "Table not created try again";
						
		}
		else
		{
		
		
			$create = "SELECT * FROM User";
			
			$table = $dbase->query($create);
			
						echo "<table align = 'center' border = '1' cellpadding = '10' >";
						echo "<th> userName </th> <th> userID </th> <th> student </th> <th> instructor </th> <th> admin </th> <th> salt </th> <th> hash </th>";
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

						
					
		
			
			echo 'Success';
			
			echo '<br/> <br/>';
			
			$create2 = "SELECT * FROM Student";
			
			$table = $dbase->query($create2);
			
				echo "<table align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> name </th> <th> userId </th> <th> major </th> <th> year </th>";
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
				
			$create2 = "SELECT * FROM Instructor";
			
			$table = $dbase->query($create2);
			
				echo "<table align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> name </th> <th> userId </th> <th> Dept. </th> <th> Tenure </th> <th> semester </th>";
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
				
				
			echo '<br/> <br/>';
			
			$create2 = "SELECT * FROM Teaches";
			
			$table = $dbase->query($create2);
			
				echo "<table align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> userId </th> <th> classId </th>";
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
				
				
			echo '<br/> <br/>';
			
		
			
			
			
			
			$create2 = "SELECT * FROM Class";
			
			$table = $dbase->query($create2);
			
				echo "<table align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> classId </th> <th> className </th> <th> classNum </th> <th> sectionNum </th> <th> semester </th> <th> year </th> <th> credit </th> <th> max </th> <th> finished </th> <th> closed </th>";
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
				
				
			$create2 = "SELECT * FROM Takes";
			
			$table = $dbase->query($create2);
			
				echo "<table align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> userId </th> <th> classId </th> <th> grade </th>";
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
				
				
			echo '<br/> <br/>';
			
			
			
			$create2 = "SELECT * FROM Prerequisite";
			
			$table = $dbase->query($create2);
			
				echo "<table align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> reuired </th> <th> requiring </th>";
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
				
				
			echo '<br/> <br/>';

			
			$create2 = "SELECT * FROM Takes";
			
			$table = $dbase->query($create2);
			
				echo "<table align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> classnum </th> <th> user </th>  <th> grad </th> ";
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
				
				
			echo '<br/> <br/>';
			
			$create2 = "SELECT * FROM Assignment";
			
			$table = $dbase->query($create2);
			
				echo "<table align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> classId </th> <th> Assignment </th>  <th> numPoints </th> ";
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
				
				
			echo '<br/> <br/>';
			
			$create2 = "SELECT * FROM AssignmentGrade";
			
			$table = $dbase->query($create2);
			
				echo "<table align = 'center' border = '1' cellpadding = '10' >";
				echo "<th> classId </th> <th> Assignment </th> <th> studentId </th> <th> numPoints </th> ";
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
				
				
			echo '<br/> <br/>';
			
			
		}
	
	?>
	
<br />
<br />
<br />

</body>
</html>