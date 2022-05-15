<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Certifications</title>
	<link rel="stylesheet" type="text/css" href="css/faculty.css">
	<link rel="stylesheet" type="text/css" href="css/facultymenu.css">
</head>
<body>
	<?php
		session_start();
		$uid = $_SESSION['id'];
		include 'db.php';
		include 'adminmenu.php';
		$f = "SELECT fuid, fname FROM faculty_details ";
		$fr = mysqli_query($con, $f);
		while($fd = mysqli_fetch_array($fr))
		{
			echo '<h3 class="h2">'.$fd["fname"].'</h3>';
			echo '<table id="t1" class="cert">
					<tr>
						<th> Name </th>
						<th> Year </th>
						<th> Duration-Journal/Conference </th>
						<th> Start-Volume </th>
						<th> End-UGC/SCI Indexed </th>
						<th> File </th>
					</tr>';
			echo '<tr> <th colspan="6" style="background-color: grey; "> Workshop </th> </tr>';
			$uidi = $fd["fuid"];
			$w1 = "SELECT * FROM certifications where ctype = 'Workshop' and cuid= '$uidi' ";
			$wr1 = mysqli_query($con, $w1);
			while($wd = mysqli_fetch_array($wr1))
			{
					echo '<tr>
							<td> '.$wd["cname"].' </td>
							<td> '.$wd["cyear"].' </td>
							<td> '.$wd["cdur"].' </td>
							<td> '.$wd["cstart"].' </td>
							<td> '.$wd["cend"].' </td>
							<td><a href="certs/'.$wd["cfile"].'" target="_blank"> '.$wd["cfile"].' </td>
               			</tr>';
      		}
      		echo '<tr> <th colspan="6" style="background-color: grey;"> Courses/Certifications </th> </tr>';
			$w2 = "SELECT * FROM certifications where ctype = 'Course' and cuid= '$uidi' ";
			$wr2 = mysqli_query($con, $w2);
			while($cd = mysqli_fetch_array($wr2))
			{
					echo '<tr>
							<td> '.$cd["cname"].' </td>
							<td> '.$cd["cyear"].' </td>
							<td> '.$cd["cdur"].' </td>
							<td> '.$cd["cstart"].' </td>
							<td> '.$cd["cend"].' </td>
							<td><a href="certs/'.$cd["cfile"].'" target="_blank"> '.$cd["cfile"].' </td>
               			</tr>';
      		}
      		echo '<tr> <th colspan="6" style="background-color: grey;"> Seminar </th> </tr>';
      		$w3 = "SELECT * FROM certifications where ctype = 'Seminar' and cuid= '$uidi' ";
			$wr3 = mysqli_query($con, $w3);
			while($sd = mysqli_fetch_array($wr3))
			{
					echo '<tr>
							<td> '.$sd["cname"].' </td>
							<td> '.$sd["cyear"].' </td>
							<td> '.$sd["cdur"].' </td>
							<td> '.$sd["cstart"].' </td>
							<td> '.$sd["cend"].' </td>
							<td><a href="certs/'.$sd["cfile"].'" target="_blank"> '.$sd["cfile"].' </td>
               			</tr>';
      		}
      		echo '<tr> <th colspan="6" style="background-color: grey;"> Conference </th> </tr>';
      		$w4 = "SELECT * FROM certifications where ctype = 'Conference' and cuid= '$uidi' ";
			$wr4 = mysqli_query($con, $w4);
			while($ccd = mysqli_fetch_array($wr4))
			{
					echo '<tr>
							<td> '.$ccd["cname"].' </td>
							<td> '.$ccd["cyear"].' </td>
							<td> '.$ccd["cjournal"].' </td>
							<td> '.$ccd["cvol"].' </td>
							<td> '.$ccd["cindex"].' </td>
							<td><a href="certs/'.$ccd["cfile"].'" target="_blank"> '.$ccd["cfile"].' </td>
               			</tr>';
      		}
      		echo '<tr> <th colspan="6" style="background-color: grey;"> Paper Published </th> </tr>';
      		$w5 = "SELECT * FROM certifications where ctype = 'Paper Publication' and cuid= '$uidi' ";
			$wr5 = mysqli_query($con, $w5);
      		while($pd = mysqli_fetch_array($wr5))
			{
					echo '<tr>
							<td> '.$pd["cname"].' </td>
							<td> '.$pd["cyear"].' </td>
							<td> '.$pd["cjournal"].' </td>
							<td> '.$pd["cvol"].' </td>
							<td> '.$pd["cindex"].' </td>
							<td><a href="certs/'.$pd["cfile"].'" target="_blank"> '.$pd["cfile"].' </td>
               			</tr>';
      		}
      		echo '</table>';
		}
	?>
	</body>
</html>