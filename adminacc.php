<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Faculty Search </title>
	<link rel="stylesheet" type="text/css" href="css/faculty.css">
	<link rel="stylesheet" type="text/css" href="css/facultymenu.css">
	<script type="text/javascript">
		function add() {
			document.getElementById('f1').style.display = 'block';
			document.getElementById('t1').style.display = 'none';
			document.getElementById('f2').style.display = 'none';
		}
	</script>
</head>
<body>
	<?php
		session_start();
		$uid = $_SESSION['id'];
		include 'db.php';
		include 'adminmenu.php';
		$f = "SELECT fuid, fname FROM faculty_details";
		$fr = mysqli_query($con, $f);
	?>
	<form class="f1" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
		<label > Select Faculty </label>

		<select class="s1" name="fuid" >
			<?php while ($fd = mysqli_fetch_array($fr)) { ?>
			<option value="<?php echo $fd['fuid']; ?>"><?php echo $fd['fname']."(".$fd['fuid'].")"; ?></option> <?php } ?>
		</select>
		<input class="submit" type="submit" name="view">
	</form>
	<?php
		if(isset($_POST['view']))
		{
			$fuid = $_POST['fuid'];
			$dt = "SELECT *FROM faculty_details where fuid='$fuid' ";
			$dtr = mysqli_query($con, $dt);
			$dd = mysqli_fetch_array($dtr);
			
			$ed = "SELECT *FROM education where euid='$fuid' ";
			$edr = mysqli_query($con, $ed);

			$ex = "SELECT *FROM experience where expid='$fuid' ";
			$exr = mysqli_query($con, $ex);
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
			while ($edud = mysqli_fetch_array($edr))
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
			<th> School/College </th>
			<th> Designation </th>
			<th> Year of Joining </th>
			<th> Year of Ending </th>
			<th> Experience in Years </th>
		</tr>
		<?php
			while ($expd = mysqli_fetch_array($exr))
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
<?php } ?>
</body>
</html>