<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Search Certifications </title>
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
		include 'facultymenu.php';
	?>
	<form class="f1" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
		<label > Select Type </label>

		<select class="s1" name="ctype" >
			<option value="Workshop">Wokshop</option>
			<option value="Seminar">Seminar</option>
			<option value="Course">Course/Certificates</option>
			<option value="Conference">Conferences</option>
			<option value="Paper Publication">Paper Published</option>
		</select>
		<input class="submit" type="submit" name="view">
	</form>
	<?php 
		if(isset($_POST['view']))
		{
			$ctype = $_POST['ctype'];
			$c = "SELECT *FROM certifications where cuid='$uid' and ctype='$ctype' ";
			$cr = mysqli_query($con, $c);
			echo '<h3 class="h2">'.$ctype.'</h3>';
			if($ctype === 'Workshop' || $ctype === 'Seminar' || $ctype === 'Course') {
				?>
			<table id="t1" class="cert">
				<tr>
					<th> Name </th>
					<th> Year </th>
					<th> Duration </th>
					<th> Start </th>
					<th> End </th>
					<th> File </th>
				</tr>
			<?php
			while ($wv = mysqli_fetch_array($cr)) {
			?>	
				<tr>
					<td><?php echo $wv["cname"]; ?> </td>
					<td><?php echo $wv["cyear"]; ?></td>
					<td><?php echo $wv["cstart"]; ?></td>
					<td><?php echo $wv["cend"]; ?></td>
					<td><?php echo $wv["cdur"]; ?></td>
					<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </a></td>
            	</tr>
            <?php
			}
		?>
		</table>
		<?php
		}
		if($ctype === 'Conference' || $ctype === 'Paper Publication') {
				?>
			<table id="t1" class="cert">
				<tr>
					<th> Name </th>
					<th> Year </th>
					<th> Name of the Journal/Conference </th>
					<th> Volume </th>
					<th> UGC/SCOPUS/SCI Indexed </th>
					<th> File </th>
				</tr>
			<?php
			while ($wv = mysqli_fetch_array($cr)) {
			?>	
				<tr>
					<td><?php echo $wv["cname"]; ?> </td>
					<td><?php echo $wv["cyear"]; ?></td>
					<td><?php echo $wv["cjournal"]; ?></td>
					<td><?php echo $wv["cvol"]; ?></td>
					<td><?php echo $wv["cindex"]; ?></td>
					<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </a></td>
            	</tr>
            <?php
			}
		?>
		</table>
		<?php
		}
	}
	?>
</body>
</html>