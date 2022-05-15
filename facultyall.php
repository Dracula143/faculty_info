<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Certifications </title>
	<link rel="stylesheet" type="text/css" href="css/faculty.css">
	<link rel="stylesheet" type="text/css" href="css/facultymenu.css">
</head>
<body>
	<?php
		session_start();
		$uid = $_SESSION['id'];
		include 'db.php';
		include 'facultymenu.php';
	?>
	<table class="cert" >
		<tr>
			<th> Workshops </th>
			<th> Courses </th>
			<th> Seminar </th>
			<th> Conference </th>
			<th> Paper Publications </th>
			<th> Total </th>
		</tr>
		<tr>
		<?php
			$w = "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Workshop' ";
			$wr = mysqli_query($con, $w);
			$wc = mysqli_num_rows($wr);
			echo '<th><a style="text-decoration: none;" href="facultyws.php"> '.$wc.' </a></th>';

			$c = "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Course' ";
			$cr = mysqli_query($con, $c);
			$cc = mysqli_num_rows($cr);
			echo '<th><a style="text-decoration: none;" href="facultycc.php"> '.$cc.' </a></th>';

			$s = "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Seminar' ";
			$sr = mysqli_query($con, $s);
			$sc = mysqli_num_rows($sr);
			echo '<th><a style="text-decoration: none;" href="facultysem.php"> '.$sc.' </a></th>';

			$cc = "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Conference' ";
			$ccr = mysqli_query($con, $cc);
			$ccc = mysqli_num_rows($ccr);
			echo '<th><a style="text-decoration: none;" href="facultyconf.php"> '.$ccc.' </a></th>';

			$p = "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Paper Publication' ";
			$pr = mysqli_query($con, $p);
			$pc = mysqli_num_rows($pr);
			echo '<th><a style="text-decoration: none;" href="facultypp.php"> '.$pc.' </a></th>';

			$t = "SELECT * FROM certifications where cuid = '$uid' ";
			$tr = mysqli_query($con, $t);
			$tc = mysqli_num_rows($tr);
			echo '<th><a style="text-decoration: none;" href="facultyall.php"> '.$tc.' </a></th>';

		?>
		</tr>
	</table>
	<h3 class="h2"> Workshop </h3>
	<table id="t1" class="cert">
		<tr>
			<th> Title </th>
			<th> Year </th>
			<th> Duration </th>
			<th> Start </th>
			<th> End </th>
			<th> File </th>
		</tr>
		<?php
			while ($wd = mysqli_fetch_array($wr))
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
		?>
	</table>
	<h3 class="h2"> Certifications/Course </h3>
	<table id="t1" class="cert">
		<tr>
			<th> Title </th>
			<th> Year </th>
			<th> Duration </th>
			<th> Start </th>
			<th> End </th>
			<th> File </th>
		</tr>
		<?php
			while ($cd = mysqli_fetch_array($cr))
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
		?>
	</table>
	<h3 class="h2"> Seminar </h3>
	<table id="t1" class="cert">
		<tr>
			<th> Title </th>
			<th> Year </th>
			<th> Duration </th>
			<th> Start </th>
			<th> End </th>
			<th> File </th>
		</tr>
		<?php
			while ($sd = mysqli_fetch_array($sr))
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
		?>
	</table>
		<h3 class="h2"> Conference </h3>
		<table id="t1" class="cert">
		<tr>
			<th> Title </th>
			<th> Year </th>
			<th> Name of the Journal/Conference </th>
			<th> Volume </th>
			<th> UGC/SCOPUS/SCI Indexed </th>
			<th> File </th>
		</tr>
		<?php
			while ($ccd = mysqli_fetch_array($ccr))
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
		?>
	</table>
	<h3 class="h2"> Paper Presentations </h3>
	<table id="t1" class="cert">
		<tr>
			<th> Title </th>
			<th> Year </th>
			<th> Name of the Journal/Conference </th>
			<th> Volume </th>
			<th> UGC/SCOPUS/SCI Indexed </th>
			<th> File </th>
		</tr>
 		<?php
			while ($pd = mysqli_fetch_array($pr))
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
		?>
	</table>
</body>
</html>