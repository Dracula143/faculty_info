<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>College Work</title>
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
		<h3 class="h2"> Subjects Teached </h3>
		<table id="t1" class="cert">
		<tr>
				<th> Name </th>
				<th> Year </th>
				<th> Class </th>
				<th> Sem </th>
				<th> Pass Percentage </th>
				<th> Feedback </th>
		</tr>	
		<?php
		$f = " SELECT fuid, fname FROM faculty_details ";
		$fr = mysqli_query($con, $f);
		while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="6" style="background-color: grey; ">'.$fd["fname"].'</th></tr>';
			$sid = $fd["fuid"];
			$s = " SELECT *FROM subjects where suid='$sid' ";
			$sr = mysqli_query($con, $s);
			while($sd = mysqli_fetch_array($sr))
			{
					echo '<tr>
					<td> '.$sd["sname"].' </td>
					<td> '.$sd["syear"].' </td>
					<td> '.$sd["sclass"].' </td>
					<td> '.$sd["ssem"].' </td>
					<td> '.$sd["spassp"].' </td>
					<td> '.$sd["sfeed"].' </td>
               		</tr>';
      		}
      	}
      	echo '</table>';
      	echo '<h3 class="h2"> Leaves </h3>';
		echo '<table id="t1" class="cert">';
		echo '
				<tr>
					<th> Type </th>
					<th> No.of Days </th>
					<th> From </th>
					<th> Upto </th>
					<th> Balance </th>
					<th> Reason </th>
				</tr>';
		$f1 = " SELECT fuid, fname FROM faculty_details ";
		$fr1 = mysqli_query($con, $f1);
		while($fd1 = mysqli_fetch_array($fr1))
		{
			echo '<tr> <th colspan="6" style="background-color: grey; ">'.$fd1["fname"].'</th></tr>';
			$sid = $fd1["fuid"];
			$s1 = " SELECT *FROM leaves where luid='$sid' ";
			$sr1 = mysqli_query($con, $s1);
			while($ld = mysqli_fetch_array($sr1))
			{
					echo '<tr>
						<td> '.$ld["lyear"].' </td>
						<td> '.$ld["ltime"].' </td>
						<td> '.$ld["lstart"].' </td>
						<td> '.$ld["lend"].' </td>
						<td> '.$ld["lremain"].' </td>
						<td> '.$ld["lrason"].' </td>
               		</tr>';
      		}
      	}
      	echo '</table>';
      	echo '<h3 class="h2"> Work Load </h3>';
		echo '<table id="t1" class="cert">';
		echo '
				<tr>
					<th> Year </th>
					<th> Sem </th>
					<th> No.of Subjects </th>
					<th> Theory </th>
					<th> Lab </th>
					<th> Total </th>
					<th> Fraction </th>
					<th> File </th>
				</tr>';
		$f2 = " SELECT fuid, fname FROM faculty_details ";
		$fr2 = mysqli_query($con, $f2);
		while($fd2 = mysqli_fetch_array($fr2))
		{
			echo '<tr> <th colspan="8" style="background-color: grey; ">'.$fd2["fname"].'</th></tr>';
			$sid = $fd2["fuid"];
			$s2 = " SELECT *FROM workload where wuid='$sid' ";
			$sr2 = mysqli_query($con, $s2);
			while($wd = mysqli_fetch_array($sr2))
			{
					echo '<tr>
					<td> '.$wd["wyear"].' </td>
					<td> '.$wd["wsem"].' </td>
					<td> '.$wd["wsub"].' </td>
					<td> '.$wd["wtheory"].' </td>
					<td> '.$wd["wlab"].' </td>
					<td> '.$wd["wtotal"].' </td>
					<td> '.$wd["wfrac"].' </td>
					<td><a style="text-decoration: none;" href="workload/'.$wd["wfile"].'"> '.$wd["wfile"].'</a></td>
            		</tr>';
			}
      	}
      	echo '</table>';
	?>
	</body>
</html>