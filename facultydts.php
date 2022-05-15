<!DOCTYPE html>
<html style=" background: url(Images/personal.png) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Profile </title>
	<link rel="stylesheet" type="text/css" href="css/faculty.css">
	<link rel="stylesheet" type="text/css" href="css/facultymenu.css">
	<script type="text/javascript">
		function upd() {
			document.getElementById('f1').style.display = 'block';
			document.getElementById('t1').style.display = 'none';
		}
	</script>
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
			<td> Age </td>
			<th> <?php echo $dd['fage']; ?> </th>
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
		<tr>
			<th colspan="2"><button class="b1" id="b1" onclick="upd()" > Update </button></th>
		</tr>
	</table>
	<form class="f1" id="f1" action="" method="POST" style="display: none;" enctype="multipart/form-data">
			<h3 class="h3">Update Personal Details </h3>

        	<label class="l1"> Name </label>
        	<input class="i1" type="text" value="<?php echo $dd['fname']; ?>" name="ucn" required> <br>

        	<label class="l1"> Date of Birth </label>
        	<input class="i1" type="date" value="<?php echo $dd['fdob']; ?>" name="ucy" required> <br>

	        <label class="l1"> Gender </label>
	        <input class="i1" type="text" name="ucs" value="<?php echo $dd['fgen']; ?>" required> <br>

	        <label class="l1"> Phone Number </label>
	        <input class="i1" type="text" name="uce" value="<?php echo $dd['fphn']; ?>" required> <br>

	        <label class="l1"> email </label>
	        <input class="i1" type="email" name="ucf" autocomplete="off" value="<?php echo $dd['femail']; ?>" required> <br>

	        <input class="submit" type="submit" name="upd">
	</form>
	<?php
	if(isset($_POST['upd']))
		{
			$ucn=$_POST['ucn'];
			$ucs=$_POST['ucs'];
			$uce=$_POST['uce'];
			$ucy=$_POST['ucy'];
			$ucf=$_POST['ucf'];
			$ucq=date('Y-m-d');
			$uag=date_diff(date_create($ucy), date_create($ucq))->format("%y Years");
			$wu1 = "UPDATE faculty_details SET fname='$ucn', fdob='$ucy', fgen='$ucs', fage='$uag', fphn='$uce', femail='$ucf' where fuid='$uid' ";
			if (mysqli_query($con, $wu1))
			{
				echo '<script>alert("Profile Updated Successfully"); location.href="facultydts.php"</script>';
			}
			else
			{
				echo '<script>alert("Error while updating"); location.href="facultydts.php"</script>';
			}
		}
	?>
</body>
</html>