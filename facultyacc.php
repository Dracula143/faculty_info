<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="css/faculty.css">
	<link rel="stylesheet" type="text/css" href="css/facultymenu.css">
</head>
<body>
	<?php
		session_start();
		$uid = $_SESSION['id'];
		include 'db.php';
		include 'facultymenu.php';
		$d = "SELECT * FROM faculty_details where fuid = '$uid'";
		$dr = mysqli_query($con, $d);
		$dd = mysqli_fetch_array($dr);

		$edu = "SELECT * FROM education where euid = '$uid'";
		$edur = mysqli_query($con, $edu);

		$exp = "SELECT * FROM experience where expid = '$uid' ";
		$expr = mysqli_query($con, $exp);
	?>
	<h3 class="h2"> Personal Details </h3>
	<table id="t1" class="cert">
		<tr>
			<td> Unique ID </td>
			<th> <?php echo $dd['fuid']; ?> </th>
		</tr>
		<tr>
			<td> Name </td>
			<th> <?php echo $dd['fname']; ?> </th>
		</tr>
		<tr>
			<td> Designation </td>
			<th> <?php echo $dd['fdes']; ?> </th>
		</tr>
		<tr>
			<td> Date of Birth </td>
			<th> <?php echo $dd['fdob']; ?> </th>
		</tr>
		<tr>
			<td> Gender </td>
			<th> <?php echo $dd['fgen']; ?> </th>
		</tr>
		<tr>
			<td> Phone Number </td>
			<th> <?php echo $dd['fphn']; ?> </th>
		</tr>
		<tr>
			<td> Email </td>
			<th> <?php echo $dd['femail']; ?> </th>
		</tr>

	</table>
	<h3 class="h2"> Education </h3>
	<table id="t1" class="cert">
		<tr>
			<th> School/College </th>
			<th> Board/University </th>
			<th> Program </th>
			<th> Branch </th>
			<th> Year of Passout </th>
			<th> Percentage </th>
		</tr>
		<?php
			while ($edud = mysqli_fetch_array($edur))
			{
				echo '<tr>
				<td> '.$edud["edname"].' </td>
				<td> '.$edud["edboard"].' </td>
				<td> '.$edud["edprogram"].' </td>
				<td> '.$edud["edbranch"].' </td>
				<td> '.$edud["edpyear"].' </td>
				<td> '.$edud["edpcntg"].' </td>
               	</tr>';
     		}
		?>
	</table>
	<h3 class="h2"> Experience </h3>
	<table id="t1" class="cert">
		<tr>
			<th> School/College/Company </th>
			<th> Designation </th>
			<th> Year of Joining </th>
			<th> Year of Ending </th>
			<th> Experience in Years </th>
		</tr>
		<?php
			while ($expd = mysqli_fetch_array($expr))
			{
				echo '<tr>
				<td> '.$expd["ename"].' </td>
				<td> '.$expd["edes"].' </td>
				<td> '.$expd["ejyear"].' </td>
				<td> '.$expd["eeyear"].' </td>
				<td> '.$expd["etime"].' </td>
               	</tr>';
     		}
		?>
	</table>
</body>
</html>