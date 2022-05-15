<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Faculty Details</title>
	<link rel="stylesheet" type="text/css" href="css/faculty.css">
	<link rel="stylesheet" type="text/css" href="css/facultymenu.css">
</head>
<body> 
	<?php
		session_start();
		$uid = $_SESSION['id'];
		include 'db.php';
		include 'adminmenu.php';	
		?>
		<h3 class="h2"> Faculty Details </h3>
		<table id="t1" class="cert">	
				<tr>
					<th> Unique ID </th>
					<th> Name </th>
					<th> Date of Birth </th>
					<th> Gender </th>
					<th> Designation </th>
					<th> Phone </th>
					<th> Email </th>
					
				</tr>
		<?php
		$f = "SELECT * FROM faculty_details ";
		$fr = mysqli_query($con, $f);
		while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr>
					<td> '.$fd["fuid"].' </td>
					<td> '.$fd["fname"].' </td>
					<td> '.$fd["fdob"].' </td>
					<td> '.$fd["fgen"].' </td>
					<td> '.$fd["fdes"].' </td>
					<td> '.$fd["fphn"].' </td>
					<td> '.$fd["femail"].' </td>
               		</tr>';
      	}
      	echo '</table>';
      	echo '<h3 class="h2"> Education </h3>';
		echo '<table id="t1" class="cert">';
		echo '
				<tr>
					<th> College/School </th>
					<th> Board/Univeristy </th>
					<th> Program </th>
					<th> Branch </th>
					<th> Passout Year </th>
					<th> Percentage </th>
				</tr>';
		$q = "SELECT fname, fuid FROM faculty_details ";
		$qr = mysqli_query($con, $q);
		while($qd = mysqli_fetch_array($qr))
		{
			echo '<tr> <th colspan="6" style="background-color: grey; ">'.$qd["fname"].'</th></tr>';
			$o = $qd['fuid'];
			$e = "SELECT * FROM education where euid='$o' ";
			$er = mysqli_query($con, $e);
			while($ed = mysqli_fetch_array($er))
			{
					echo '<tr>
						<td> '.$ed["edname"].' </td>
						<td> '.$ed["edboard"].' </td>
						<td> '.$ed["edprogram"].' </td>
						<td> '.$ed["edbranch"].' </td>
						<td> '.$ed["edpyear"].' </td>
						<td> '.$ed["edpcntg"].' </td>
               		</tr>';
      		}
      	}
      	echo '</table>';
      	echo '<h3 class="h2"> Experience </h3>';
		echo '<table id="t1" class="cert">';
		echo '
				<tr>
					<th> College/School/Company </th>
					<th> Designation </th>
					<th> Start Year </th>
					<th> End Year </th>
					<th> Experience </th>
				</tr>';
		$r = "SELECT fname, fuid FROM faculty_details ";
		$rr = mysqli_query($con, $r);		
		while($rd = mysqli_fetch_array($rr))
		{
			echo '<tr> <th colspan="5" style="background-color: grey; ">'.$rd["fname"].'</th></tr>';
			$o1 = $rd['fuid'];
			$ex = "SELECT * FROM experience where expid='$o1' ";
			$exr = mysqli_query($con, $ex);
			while($exd = mysqli_fetch_array($exr))
			{
					echo '<tr>
					<td> '.$exd["ename"].' </td>
					<td> '.$exd["edes"].' </td>
					<td> '.$exd["ejyear"].' </td>
					<td> '.$exd["eeyear"].' </td>
					<td> '.$exd["etime"].' </td>
					</tr>';
      		}
      	}
      	echo '</table>';
	?>
	</body>
</html>