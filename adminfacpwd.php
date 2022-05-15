<!DOCTYPE html>
<html style=" background: url(Images/cp.png) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Faculty Password</title>
	<link rel="stylesheet" type="text/css" href="css/faculty.css">
	<link rel="stylesheet" type="text/css" href="css/facultymenu.css">
</head>
	<body>
		<?php
		session_start();
		$uid = $_SESSION['id'];
		include 'db.php';
		include 'adminmenu.php';
		$f = "SELECT * FROM faculty_details ";
		$fr = mysqli_query($con, $f);
		echo '<h3 class="h2"> Faculty Details </h3>';
		echo '<table id="t1" class="cert">';
		echo	'<tr>
					<th> Unique ID </th>
					<th> Name </th>
					<th> Date of Birth </th>
					<th> Gender </th>
					<th> Designation </th>
					<th> Phone </th>
					<th> Email </th>
					<th> Change Password </th>
				</tr>';
		while($fd = mysqli_fetch_array($fr))
		{
			$a = urldecode($fd["fuid"]);
		?>
		<tr>
			<td> <?php echo $fd["fuid"]; ?> </td>
			<td> <?php echo $fd["fname"]; ?> </td>
			<td> <?php echo $fd["fdob"]; ?> </td>
			<td> <?php echo $fd["fgen"]; ?> </td>
			<td> <?php echo $fd["fdes"]; ?> </td>
			<td> <?php echo $fd["fphn"]; ?> </td>
			<td> <?php echo $fd["femail"]; ?> </td>
			<th><a style="text-decoration: none;" href="adminfacpwd.php?upd0=<?php echo $a; ?>"> CP </a></th>
        </tr>
        <?php
        }
        if(isset($_GET['upd0']) && $_GET['upd0'])
		{
			$x = $_GET['upd0'];
			$sql = "UPDATE faculty_details set fpwd='$x' where fuid='$x' ";
			if(mysqli_query($con, $sql))
			{
				echo '<script>alert("Password Change Successfully");
						location.href="adminfacpwd.php"</script>';
			}
			else 
			{
				echo "<script> alert(error while changing Password);
						location.href=adminfacpwd.php </script>";
			}
		}
	?>
	</body>
</html>
