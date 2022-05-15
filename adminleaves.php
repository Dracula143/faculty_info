<!DOCTYPE html>
<html style=" background: url(Images/leaves.png) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Leaves </title>
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
		echo '<h3 class="h2"> Leaves </h3>';
		echo '<table id="t1" class="cert">';
		echo '<tr>
					<th> Academic Year </th>
					<th> No.of Days </th>
					<th> From </th>
					<th> Upto </th>
					<th> Balance </th>
					<th> Reason </th>
					<th> Edit </th>
					<th> Delete </th>
				</tr>';
		$f = "SELECT fuid, fname FROM faculty_details ";
		$fr = mysqli_query($con, $f);	
		while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="8" style="background-color: grey; ">'.$fd["fname"].'</th></tr>';
			$uidi = $fd['fuid'];
			$l = "SELECT * FROM leaves where luid='$uidi' ORDER BY lstart asc ";
			$lr = mysqli_query($con, $l);
			while($ld = mysqli_fetch_array($lr))
			{
					$a = urldecode($ld["luid"]);
					$a1 = urlencode($ld["lstart"]);
					$a2 = urlencode($ld['lyear']);
					$a3 = urlencode($ld['ltime']);
				?>
					<tr>
						<td> <?php echo $ld["lyear"] ?> </td>
						<td> <?php echo $ld["ltime"] ?> </td>
						<td> <?php echo $ld["lstart"] ?> </td>
						<td> <?php echo $ld["lend"] ?> </td>
						<td> <?php echo $ld["lremain"] ?> </td>
						<td> <?php echo $ld["lrason"] ?> </td>
						<th><a style="text-decoration: none;" href="adminleaves.php?upd0=<?php echo $a; ?>&upd1=<?php echo $a1; ?>&upd2=<?php echo $a2; ?>"> Y </a></th>
						<th><a style="text-decoration: none;" onclick="javascript: return confirm('Do you wnat to delete the leave');" href="adminleaves.php?del0=<?php echo $a; ?>&del1=<?php echo $a1; ?>&del2=<?php echo $a2; ?>&del3=<?php echo $a3; ?>"> X </a></th>
               		</tr>
            <?php
      		}
      	}
      	?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr>
	</table>
	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3"> Insert Leaves </h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1" > Academic Year </label>
        <input class="i1" type="text" placeholder="Year Leave Taken" pattern="((?:[0-9]{4})-(?:[0-9]{2}))" name="cy" required> <br>

        <label class="l1" > Leave Reason </label>
        <input class="i1" type="text" placeholder="Enter Leave Reason" name="cl" required> <br>

        <label class="l1" > Start Date </label>
        <input class="i1" type="date" name="cs"  required> <br>

        <label class="l1" > Upto Date </label>
        <input class="i1" type="date" name="ce"  required> <br>

        <input class="submit" type="submit" name="add">
    </form>
    	<?php
    	if(isset($_POST['add']))
		{
			$ci = $_POST['ci'];
			$cy = $_POST['cy'];
			$cl = $_POST['cl'];
			$cs = $_POST['cs'];
			$ce = $_POST['ce'];
			$ca = date_diff(date_create($cs), date_create($ce))->d+1;
			$sql1 = "SELECT ltime FROM leaves where luid='$ci' and lyear='$cy' ";
			$sqlr1 = mysqli_query($con, $sql1);
			$j = 0;
			while($sdq1 = mysqli_fetch_array($sqlr1))
			{
				$j += intval($sdq1["ltime"]);
			}
			$cr = 14-$j-intval($ca);
			$sql2 = " SELECT *FROM leaves where luid='$ci' and lyear='$cy' and lstart='$cs' and lend='$ce' ";
			if(mysqli_num_rows(mysqli_query($con, $sql2)) != 1)
			{
				$add = "INSERT INTO leaves set luid='$ci', lyear='$cy', lrason='$cl', lstart='$cs', lend='$ce', lremain='$cr', ltime='$ca' ";
				if(mysqli_query($con, $add))
				{
					echo '<script>alert("Inserted Successfully");location.href="adminleaves.php";</script>';
				} else {
					echo '<script>alert("Error while inserting"); location.href="adminleaves.php";</script>';
				}
			}
			if(mysqli_num_rows(mysqli_query($con, $sql2)) == 1)
			{
				echo '<script>alert("Leave ready in Data base"); location.href="adminleaves.php";</script>';
			}
		}
		if(!empty($_GET['upd0']) && !empty($_GET['upd1']) && !empty($_GET['upd2']) )
		{
			$x = $_GET['upd0'];
			$x1 = $_GET['upd1'];
			$x2 = $_GET['upd2'];
			$sql = "SELECT * FROM leaves where luid='$x' and lstart='$x1' and lyear='$x2' ";
			$wur = mysqli_query($con, $sql);
			$wud = mysqli_fetch_assoc($wur);
			$x3 = $wud['ltime'];
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3"> Update Leaves </h3>

        	<label class="l1" > Unique ID </label>
        	<input class="i1" type="text" value="'.$wud["luid"].'" placeholder="Enter Unique ID of Faculty" name="uci" required> <br>

        	<label class="l1" > Leave Year </label>
        	<input class="i1" type="text" value="'.$wud["lyear"].'" placeholder="Year Leave Taken" pattern="((?:[0-9]{4})-(?:[0-9]{2}))" name="ucy" required> <br>

        	<label class="l1" > Leave Reason </label>
        	<input class="i1" type="text" value="'.$wud["lrason"].'" placeholder="Enter Leave Reason" name="ucl" required> <br>

        	<label class="l1" > Start Date </label>
        	<input class="i1" type="date" value="'.$wud["lstart"].'" name="ucs" required> <br>

        	<label class="l1" > Upto Date </label>
        	<input class="i1" type="date" value="'.$wud["lend"].'" name="uce" required> <br>

	        <input class="submit" type="submit" name="change">
	            </form>';
    	}
		if(isset($_POST['change']))
		{
			$uci = $_POST['uci'];
			$ucy = $_POST['ucy'];
			$ucl = $_POST['ucl'];
			$ucs = $_POST['ucs'];
			$uce = $_POST['uce'];
			$uca = (date_diff(date_create($ucs), date_create($uce)))->d+1;
			$sql5 = "SELECT ltime FROM leaves where luid='$x' and lyear='$x2' and lstart < '$x1' ";
			$sqlr5 = mysqli_query($con, $sql5);
			$p = 0;
			while($sdq1 = mysqli_fetch_array($sqlr5))
			{
				$p1 = $sdq1['ltime'];
				$p += intval($p1);
			}
			$ucr = 14-$p-intval($uca);
			$ucr1 = intval($uca) - intval($x3);
			if($uci != $x || $ucs != $x1)
			{
				$sql6 = "SELECT *FROM leaves where luid='$uci' and lstart='$ucs' and lyear='$ucy' ";
				if(mysqli_num_rows(mysqli_query($con, $sql6)) != 1)
				{
					$uedit = "SELECT lremain, lstart FROM leaves where lyear='$ucy' and lstart > '$x1' ";
					$uer = mysqli_query($con, $uedit);
					while($uder = mysqli_fetch_array($uer))
					{
						$g1 = $uer['lremain'];
						$g2 = $uer['lstart'];
						$g3 = $ucr1 + $g1;
						mysqli_query($con, "UPDATE leaves SET lremain='$g3' where luid='$uci' and lyear='$ucy' and lstart='$g2' ");
					}
					$uadd = "UPDATE leaves set luid='$uci', lyear='$ucy', lrason='$ucl', lstart='$ucs', lend='$uce', lremain='$ucr', ltime='$uca' where luid='$x' and lstart='$x1' and lyear='$x2' ";
					if(mysqli_query($con, $uadd))
					{
						echo '<script>alert("Updated Successfully"); location.href="adminleaves.php";</script>';
					} else {
						echo '<script>alert("Error while Updating"); location.href="adminleaves.php";</script>';
					}
				}
				if(mysqli_num_rows(mysqli_query($con, $sql6)) == 1)
				{
					echo '<script>alert("Leave Already exists"); location.href="adminleaves.php";</script>';
				}
			}
			if($uci == $x && $ucs == $x1)
			{
				$uedit = "SELECT lremain, lstart FROM leaves where lyear='$ucy' and lstart > '$x1' ";
				$uer = mysqli_query($con, $uedit);
				while($uder = mysqli_fetch_array($uer))
				{
					$g1 = $uder['lremain'];
					$g2 = $uder['lstart'];
					$g3 = $ucr1 + $g1;
					mysqli_query($con, "UPDATE leaves SET lremain='$g3' where luid='$uci' and lyear='$ucy' and lstart='$g2' ");
				}
				$uadd = "UPDATE leaves set luid='$uci', lyear='$ucy', lrason='$ucl', lstart='$ucs', lend='$uce', lremain='$ucr', ltime='$uca' where luid='$x' and lstart='$x1' and lyear='$x2' ";
				if(mysqli_query($con, $uadd))
				{
					echo '<script>alert("Updated Successfully"); location.href="adminleaves.php";</script>';
				} else {
					echo '<script>alert("Error while Updating"); location.href="adminleaves.php";</script>';
				}
			}
		}
		if(!empty($_GET['del0']) && !empty($_GET['del1']) && !empty($_GET['del2']))
		{
			$b = $_GET['del0'];
			$b1 = $_GET['del1'];
			$b2 = $_GET['del2'];
			$b3 = $_GET['del3'];
			$uedit = "SELECT lremain, lstart FROM leaves where luid='$b' and lyear='$b2' and lstart > '$b1' ";
			$uer = mysqli_query($con, $uedit);
			while($uder = mysqli_fetch_array($uer))
			{
				$g1 = $uder['lremain'];
				$g2 = $uder['lstart'];
				$g3 = $b3 + $g1;
				mysqli_query($con, "UPDATE leaves SET lremain='$g3' where luid='$b' and lyear='$b2' and lstart='$g2' ");
			}
			$dadd = "DELETE FROM leaves where luid='$b' and lstart='$b1' ";
			if(mysqli_query($con, $dadd))
			{
				echo '<script> alert("Deleted Successfully");
				location.href = "adminleaves.php"; </script>';
			}else{
				echo '<script> alert("Error while Deleting");
				location.href = "adminleaves.php"; </script>';
			}
		}
    ?>
</body>
</html>