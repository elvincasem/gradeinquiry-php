<?php
/**
*	@author 	Ing. Israel Barragan C.  Email: ibarragan at behstant dot com
*	@since 		07-Nov-2013
*	##########################################################################################
*	Comments:
*	This file is to show how to retrieve records from a database with PDO
*	The records are shown in a HTML table.
*
*	Requires:
*	Connection.simple.php, get this file here: http://behstant.com/blog/?p=413
*   jQuery and Boostrap.
*
* 	LICENCE:
*	You can use this code to any of your projects as long as you mention where you
* 	downloaded it and the author which is me :) Happy Code.
*
* 	LICENCIA:
*	Puedes usar este código para tus proyectos, pero siempre tomando en cuenta que
* 	debes de poner de donde lo descargaste y el autor que soy yo :) Feliz Codificación.
*	##########################################################################################
*	@version
*	##########################################################################################
*	1.0	|	07-Nov-2013	|	Creation of new file to search a record.
*	##########################################################################################
*/
	require_once 'Connection.simple.php';
	$conn = dbConnect();
	$OK = true; // We use this to verify the status of the update.
	// If 'buscar' is in the array $_POST proceed to make the query.

	if (isset($_GET['idnumber'])) 
	{
		// Create the query
		$data = "%".$_GET['name']."%";
		$name = $_GET['name'];
		$idnumber = $_GET['idnumber'];
		$sql = "SELECT * FROM employee WHERE employee_id='$idnumber' AND lname like '$name'";
		// we have to tell the PDO that we are going to send values to the query
		$stmt = $conn->prepare($sql);
		// Now we execute the query passing an array toe execute();
		$results = $stmt->execute(array($name,$idnumber));
		// Extract the values from $result
		$rows = $stmt->fetchAll();
		$error = $stmt->errorInfo();
		//echo $error[2];
		echo  $sql;
		
	}
	// If there are no records.
	if(empty($rows)) {
	
		echo "<tr>";
			echo "<td colspan='4'>There were not records</td>";
		echo "</tr>";
	}
	else {
		
		//echo $employee_id;
		
		
		foreach ($rows as $row) {
		//record search query
			$sqlupdate = "UPDATE employee set views=views+1 WHERE employee_id ='$idnumber'";
			$update = $conn->prepare($sqlupdate);
			$update->execute();
			echo $sqlupdate;
			echo "<tr>";
				echo "<td>".$row['employee_id']."</td>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['fg']." (".$row['fgscale'].")</td>";
				echo "<td>".$idnumber."</td>";
			echo "</tr>";
		}
	}
?>