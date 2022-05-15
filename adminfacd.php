<!DOCTYPE html>
<html style=" background: url(Images/personal.png) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Faculty Details </title>
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
			$f = "SELECT * FROM faculty_details ";
			$fr = mysqli_query($con, $f);

			$e = "SELECT * FROM education ";
			$er = mysqli_query($con, $e);

			$ex = "SELECT * FROM experience ";
			$exr = mysqli_query($con, $ex);

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
					<th> Edit </th>
					<th> Delete </th>
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
			<th><a style="text-decoration: none;" href="adminfacd.php?upd0=<?php echo $a; ?>"> Y </a></th>
			<th><a style="text-decoration: none;" onclick="javascript: return confirm('Do you want to delete the faculty <?php echo $fd["fname"];?>(<?php echo $fd["fuid"];?>)');" href="adminfacd.php?del0=<?php echo $a; ?>"> X </a></th>
        </tr>
        <?php
          	}
      	?>
		<tr>
			<td style="text-align: center;" colspan="9"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3"> Insert Faculty </h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1" > Name </label>
        <input class="i1" type="text" placeholder=" Enter Name of Faculty " name="cn" required> <br>

        <label class="l1" > Date of Birth </label>
        <input class="i1" type="date" name="cy" required> <br>

        <label class="l1" > Gender </label>
        <input class="i1" type="text" placeholder="Enter Gender" name="cl" required> <br>

        <label class="l1" > Designation </label>
        <input class="i1" type="text" placeholder="Enter Designation" name="cs" required> <br>

        <label class="l1" > Phone Number </label>
        <input class="i1" type="number" placeholder="Enter Phone Number" name="ce" required> <br>

        <label class="l1" > Email </label>
        <input class="i1" type="email" placeholder="Enter Email" name="cf" required> <br>     

        <input class="submit" type="submit" name="add">
    </form>
    	<?php
    	if(isset($_POST['add']))
		{
			$ci = $_POST['ci'];
			$cn = $_POST['cn'];
			$cy = $_POST['cy'];
			$cl = $_POST['cl'];
			$cs = $_POST['cs'];
			$ce = $_POST['ce'];
			$cf = $_POST['cf'];
			$cq = date('Y-m-d');
			$ca = date_diff(date_create($cy), date_create($cq))->format("%y Years");
			$sqlz = "SELECT *FROM faculty_details where fuid='$ci' ";
			if(mysqli_num_rows(mysqli_query($con, $sqlz)) != 1)
			{
				$add = "INSERT INTO faculty_details set fuid='$ci', fname='$cn', fdob='$cy', fgen='$cl', fdes='$cs', fphn='$ce', femail='$cf', fpwd='$ci', fage='$ca' ";
       	 		if(mysqli_query($con, $add))
				{
					echo '<script>alert("Inserted Successfully"); location.href="adminfacd.php";</script>';
				}else{
					echo '<script>alert("Error while inserting"); location.href="adminfacd.php";</script>';
				}
			}
			if(mysqli_num_rows(mysqli_query($con, $sqlz)) == 1)
			{
				echo '<script>alert("Faculty already Exists"); location.href="adminfacd.php";</script>';
			}
		}
		if(isset($_GET['upd0']) && $_GET['upd0'])
		{
			$x = $_GET['upd0'];
			$sql = "SELECT *FROM faculty_details where fuid='$x' ";
			$wur = mysqli_query($con, $sql);
			$wud = mysqli_fetch_array($wur);
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3"> Update Faculty </h3>

        	<label class="l1" > Unique ID </label>
	        <input class="i1" type="text" value="'.$wud["fuid"].'" placeholder="Enter Unique ID of Faculty" name="uci" required> <br>

	        <label class="l1" > Name </label>
	        <input class="i1" type="text" value="'.$wud["fname"].'" placeholder=" Enter Faculty Name" name="ucn" required> <br>

	        <label class="l1" > Date of Birth </label>
	        <input class="i1" type="date" value="'.$wud["fdob"].'" name="ucy" required> <br>

	        <label class="l1" > Gender </label>
	        <input class="i1" type="text" value="'.$wud["fgen"].'" placeholder="Enter Gender" name="ucl" required> <br>

	        <label class="l1" > Designation </label>
	        <input class="i1" type="text" value="'.$wud["fdes"].'" placeholder="Enter Designation" name="ucs" required> <br>

	        <label class="l1" > Phone Number </label>
	        <input class="i1" type="number" value="'.$wud["fphn"].'" placeholder="Enter Phone Number" name="uce" required> <br>

	        <label class="l1" > Email </label>
	        <input class="i1" type="email" value="'.$wud["femail"].'" placeholder="Enter Email" name="ucf" required> <br>

	        <input class="submit" type="submit" name="change">
	            </form>';
    	}
		if(isset($_POST['change']))
		{
			$uci = $_POST['uci'];
			$ucn = $_POST['ucn'];
			$ucy = $_POST['ucy'];
			$ucl = $_POST['ucl'];
			$ucs = $_POST['ucs'];
			$uce = $_POST['uce'];
			$ucf = $_POST['ucf'];
			$ucq = date('Y-m-d');
			$uca = date_diff(date_create($ucy), date_create($ucq))->format("%y Years");
			if($uci != $x)
			{
				$usqlz = "SELECT * FROM faculty_details where fuid='$x' ";
				if(mysqli_num_rows(mysqli_query($con, $usqlz)) != 1)
				{
					$uadd = "UPDATE faculty_details set fuid='$uci', fname='$ucn', fdob='$ucy', fgen='$ucl', fdes='$ucs', fphn='$uce', femail='$ucf', fage='$uca' where fuid='$x' ";
       	 			if(mysqli_query($con, $uadd))
					{
						echo '<script>alert("Updated Successfully"); location.href="adminfacd.php";</script>';
					}
					else
					{
						echo '<script>alert("Error while Updating"); location.href="adminfacd.php";</script>';
					}
				}
				if(mysqli_num_rows(mysqli_query($con, $usqlz)) == 1)
				{
					echo '<script>alert("Faculty already Exists"); location.href="adminfacd.php";</script>';
				}
			}
			if($uci == $x)
			{
       	 		$uadd = "UPDATE faculty_details set fuid='$uci', fname='$ucn', fdob='$ucy', fgen='$ucl', fdes='$ucs', fphn='$uce', femail='$ucf' where fuid='$x' ";
       	 		if(mysqli_query($con, $uadd))
				{
					echo '<script>alert("Updated Successfully"); location.href="adminfacd.php";</script>';
				}
				else
				{
					echo '<script>alert("Error while Updating"); location.href="adminfacd.php";</script>';
				}
			}
		}
		if(isset($_GET['del0']) && $_GET['del0'])
		{
			$b = $_GET['del0'];
			$cdel = "SELECT cfile FROM certifications where cuid='$b' ";
			while ($cdeld = mysqli_fetch_array(mysqli_query($con, $cdel))) {
				unlink("certs/".$cdeld['cfile']);
			}
			$cdel1 = "SELECT wfile FROM workload where wuid='$b' ";
			while ($cdeld1 = mysqli_fetch_array(mysqli_query($con, $cdel1))) {
				unlink("workload/".$cdeld1['wfile']);
			}
			$sqle = "DELETE FROM faculty_details where fuid='$b';";
			$sqle .= " DELETE FROM workload where wuid='$b';";
			$sqle .= " DELETE FROM certifications where cuid='$b';";
			$sqle .= " DELETE FROM leaves where luid='$b';";
			$sqle .= " DELETE FROM subjects where suid='$b';";
			$sqle .= " DELETE FROM education where euid='$b';";
			$sqle .= " DELETE FROM experience where expid='$b' ";

			if(mysqli_multi_query($con, $sqle))
			{
				echo '<script>alert("Deleted Successfully"); location.href="adminfacd.php"</script>';
			}
			else
			{
				echo '<script>alert("Error while Deleting"); location.href="adminfacd.php"</script>';
			}
		}
    ?>
</body>
</html>