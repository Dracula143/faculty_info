<!DOCTYPE html>
<html style=" background: url(Images/workload.png) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Workload </title>
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
		echo '<h3 class="h2"> Workload </h3>';
		echo '<table id="t1" class="cert">';
		echo	'<tr>
					<th> Acedamic Year </th>
					<th> Sem </th>
					<th> No.of Subjects </th>
					<th> Theory </th>
					<th> Lab </th>
					<th> Total </th>
					<th> Fraction </th>
					<th> File </th>
					<th> Edit </th>
					<th> Delete </th>
				</tr>';
		$f = "SELECT fuid, fname FROM faculty_details ";
		$fr = mysqli_query($con, $f);
		while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="10" style="background-color: grey; ">'.$fd["fname"].'</th></tr>';
			$o = $fd['fuid'];
			$w = "SELECT * FROM workload where wuid='$o' ";
			$wr = mysqli_query($con, $w);
			while($wv = mysqli_fetch_array($wr))
			{
					$a = urldecode($wv["wuid"]);
					$a1 = urlencode($wv["wyear"]);
					$a2 = urlencode($wv["wsem"]);
				?>
					<tr>
						<td> <?php echo $wv["wyear"]; ?> </td>
						<td> <?php echo $wv["wsem"]; ?> </td>
						<td> <?php echo $wv["wsub"]; ?> </td>
						<td> <?php echo $wv["wtheory"]; ?> </td>
						<td> <?php echo $wv["wlab"]; ?> </td>
						<td> <?php echo $wv["wtotal"]; ?> </td>
						<td> <?php echo $wv["wfrac"]; ?> </td>
						<td><a style="text-decoration: none;" href="workload/<?php echo $wv["wfile"]; ?>" target='_blank' > <?php echo $wv["wfile"]; ?></a></td>
						<th><a style="text-decoration: none;" href="adminwl.php?upd0=<?php echo $a; ?>&upd1=<?php echo $a1; ?>&upd2=<?php echo $a2; ?>"> Y </a></th>
						<th><a style="text-decoration: none;" href="adminwl.php?del0=<?php echo $a; ?>&del1=<?php echo $a1; ?>&del2=<?php echo $a2; ?>"> X </a></th>
               		</tr>
            <?php
      		}
      	}
      	?>
		<tr>
			<td style="text-align: center;" colspan="10"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3"> Insert Workload </h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1" > Acedamic Year </label>
        <input class="i1" type="text" placeholder=" Enter Acedamic Year" pattern="((?:[0-9]{4})-(?:[0-9]{2}))" name="cn" required> <br>

        <label class="l1" > Semester </label>
        <input class="i1" type="number" placeholder=" Enter Semester " name="cy" required> <br>

        <label class="l1" > No. of Subjects </label>
        <input class="i1" type="text" placeholder="Enter number of Subjects Teached" name="cl" required> <br>

        <label class="l1" > Theory Class/Week </label>
        <input class="i1" type="number" name="cs" required> <br>

        <label class="l1" > No. of Labs/week </label>
        <input class="i1" type="number" name="ce" required> <br>

        <label class="l1" > Supporting File </label>
        <input class="i1" type="file" name="cf" required> <br>     

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
			$ca = $ce + $cs;
			$cf = $_FILES['cf']['name'];
			$f1 = "SELECT fdes FROM faculty_details where fuid='$ci' ";
			$fr1 = mysqli_query($con, $f1);
			$fd1 = mysqli_fetch_array($fr1);
			if($fd1['fdes'] == 'Associate Professor')
			{
				$cr1 = intval($ca)/12;
				$cr = number_format($cr1, 2, '.', '');
			}
			if ($fd1['fdes'] == 'Professor')
			{
				$cr1 = intval($ca)/8;
				$cr = number_format($cr1, 2, '.', '');
			}
			if($fd1['fdes'] == 'Assistant Professor')
			{
				$cr1 = intval($ca)/16;
				$cr = number_format($cr1, 2, '.', '');
			}
			$qsa = "SELECT * FROM workload where wuid = '$ci' and wyear ='$cn' and wsem='$cy' ";
			$qsar = mysqli_query($con, $qsa);
			if(mysqli_num_rows($qsar) != 1)
			{
				$fT = $_FILES['cf']['tmp_name'];
    			$fY = $_FILES['cf']['type'];
    			$fNC = explode(".", $cf);
    			$fE = strtolower(end($fNC));
    			$nFN = "$ci-$cf";
    			$afE = 'pdf';
    			if ($fE == $afE)
    			{
      				$uFD = './workload/';
      				$dp = $uFD . $nFN;
      				if (!file_exists($dp))
      				{
      					if(move_uploaded_file($fT, $dp)) 
      					{
      						$add = "INSERT INTO workload set wuid='$ci', wyear='$cn', wsem='$cy', wsub='$cl', wtheory='$cs', wlab='$ce', wtotal='$ca', wfrac='$cr', wfile='$nFN' ";
      						if(mysqli_query($con, $add))
      						{
      							echo '<script>alert("Inserted Successfully"); location.href="adminwl.php";</script>';
      						} else {
      							echo '<script>alert("Error while inserting"); location.href="adminwl.php";</script>';
							}
      					}
    				}
    				if(file_exists($dp))
      				{
      					echo '<script>alert("File already Exists in Database"); location.href="adminwl.php";</script>';
      				}
      			}
    			if($fE != $afE)
      			{
      				echo '<script>alert("File extension must be pdf"); location.href="adminwl.php";</script>';
      			}
      		}
      		if(mysqli_num_rows($qsar) == 1)
      		{
      			echo '<script> alert("Workload already exists in database"); location.href = "adminwl.php"; </script>';
      		}
		}
		if(isset($_GET['upd0']) && $_GET['upd0'] && isset($_GET['upd1']) && $_GET['upd1'] && isset($_GET['upd2']) && $_GET['upd2'])
		{
			$x = $_GET['upd0'];
			$x1 = $_GET['upd1'];
			$x2 = $_GET['upd2'];
			$sql = "SELECT *FROM workload where wuid='$x' and wyear='$x1' and wsem='$x2' ";
			$wur = mysqli_query($con, $sql);
			$wud = mysqli_fetch_array($wur);
			$pcf = $wud["wfile"];
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3"> Update Workload </h3>

        	<label class="l1" > Unique ID </label>
        	<input class="i1" type="text" value="'.$wud["wuid"].'" placeholder="Enter Unique ID of Faculty" name="uci" required> <br>

        	<label class="l1" > Year </label>
        	<input class="i1" type="text" value="'.$wud["wyear"].'" placeholder=" Enter Year " pattern="((?:[0-9]{4})-(?:[0-9]{2}))" name="ucn" required> <br>

        	<label class="l1" > Semester </label>
        	<input class="i1" type="number" value="'.$wud["wsem"].'" placeholder=" Enter Semester " name="ucy" required> <br>

        	<label class="l1" > No. of Subjects </label>
        	<input class="i1" type="text" value="'.$wud["wsub"].'" placeholder="Enter number of Subjects Teached" name="ucl" required> <br>

        	<label class="l1" > Theory Class/Week </label>
        	<input class="i1" type="number" value="'.$wud["wtheory"].'" name="ucs" required> <br>

        	<label class="l1" > No. of Labs/week </label>
        	<input class="i1" type="number" value="'.$wud["wlab"].'" name="uce" required> <br>

        	<label class="l1" > Supporting File </label>
        	<input class="i1" type="file" name="ucf"> <br>

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
			$uca = $uce + $ucs;
			$ucf = $_FILES['cf']['name'];
			$uf1 = "SELECT fdes FROM faculty_details where fuid='$uci' ";
			$ufr1 = mysqli_query($con, $uf1);
			$ufd1 = mysqli_fetch_array($ufr1);
			if($ufd1['fdes'] == 'Associate Professor')
			{
				$ucr1 = intval($uca)/12;
				$ucr = number_format($ucr1, 2, '.', '');
			}
			if ($ufd1['fdes'] == 'Professor')
			{
				$ucr1 = intval($uca)/8;
				$ucr = number_format($ucr1, 2, '.', '');
			}
			if($ufd1['fdes'] == 'Assistant Professor')
			{
				$ucr1 = intval($uca)/16;
				$ucr = number_format($ucr1, 2, '.', '');
			}
			if($uci != $x || $ucn != $x1 || $ucy != $x2)
			{
				if(mysqli_num_rows(mysqli_query($con, " SELECT * FROM workload where wuid = '$uci' and wyear ='$ucn' and wsem='$ucy' ")) != 1)
				{
					if($_FILES['ucf']['error'] != UPLOAD_ERR_NO_FILE) 
					{
						$uafE = 'pdf';
						$ufT = $_FILES['ucf']['tmp_name'];
    					$ufY = $_FILES['ucf']['type'];
    					$ufNC = explode(".", $ucf);
 						$ufE = strtolower(end($ufNC));
    					if ($ufE == $uafE) {
    						$cpd = "workload/".$pcf;
    						unlink($cpd);
    						$unFN = "$uci-$ucf";
      						$uuFD = './workload/';
      						$udp = $uuFD . $unFN;
      						if(move_uploaded_file($ufT, $udp)) {
      							$uadd = "UPDATE workload set wuid='$uci', wyear='$ucn', wsem='$ucy', wsub='$ucl', wtheory='$ucs', wlab='$uce', wtotal='$uca', wfrac='$ucr', wfile='$unFN' where wuid='$x' and wyear='$x1' and wsem='$x2' ";
      							if(mysqli_query($con, $uadd)) {
      								echo '<script>alert("Updated Successfully"); location.href="adminwl.php";</script>';
      							} else {
      								echo '<script>alert("Error while Updating"); location.href="adminwl.php";</script>';
      							}
      						}
      					}
      					if($ufE != $uafE)
      					{
      						echo '<script>alert("File extension must be pdf"); location.href="adminwl.php";</script>';
      					}
      				}
      				if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE) {
      					$uadd1 = "UPDATE workload set wuid='$uci', wyear='$ucn', wsem='$ucy', wsub='$ucl', wtheory='$ucs', wlab='$uce', wtotal='$uca', wfrac='$ucr' where wuid='$x' and wyear='$x1' and wsem='$x2' ";
      					if(mysqli_query($con, $uadd1))
      					{
      						echo '<script>alert("Updated Successfully"); location.href="adminwl.php";</script>';
      					} else {
      						echo '<script>alert("Error while Updating"); location.href="adminwl.php";</script>';
      					}
      				}
      			}
      			if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM workload where wuid = '$uci' and wyear ='$ucn' and wsem='$ucy' ")) == 1)
      			{
      				echo '<script>alert("Workload already exists in database"); location.href="adminwl.php";</script>';
      			}
      		}
      		if($uci == $x && $ucn == $x1 && $ucy == $x2)
      		{
      			if($_FILES['ucf']['error'] != UPLOAD_ERR_NO_FILE) 
				{
					$uafE = 'pdf';
					$ufT = $_FILES['ucf']['tmp_name'];
    				$ufY = $_FILES['ucf']['type'];
    				$ufNC = explode(".", $ucf);
 					$ufE = strtolower(end($ufNC));
    				if ($ufE == $uafE) {
    					$cpd = "workload/".$pcf;
    					unlink($cpd);
    					$unFN = "$uci-$ucf";
      					$uuFD = './workload/';
      					$udp = $uuFD . $unFN;
      					if(move_uploaded_file($ufT, $udp)) {
      						$uadd = "UPDATE workload set wuid='$uci', wyear='$ucn', wsem='$ucy', wsub='$ucl', wtheory='$ucs', wlab='$uce', wtotal='$uca', wfrac='$ucr', wfile='$unFN' where wuid='$x' and wyear='$x1' and wsem='$x2' ";
      						if(mysqli_query($con, $uadd)) {
      							echo '<script>alert("Updated Successfully"); location.href="adminwl.php";</script>';
      						} else {
      							echo '<script>alert("Error while Updating"); location.href="adminwl.php";</script>';
      						}
      					}
      				}
      				if($ufE != $uafE)
      				{
      					echo '<script>alert("File extension must be pdf"); location.href="adminwl.php";</script>';
      				}
      			}
      			if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE) {
      				$uadd1 = "UPDATE workload set wuid='$uci', wyear='$ucn', wsem='$ucy', wsub='$ucl', wtheory='$ucs', wlab='$uce', wtotal='$uca', wfrac='$ucr' where wuid='$x' and wyear='$x1' and wsem='$x2' ";
      				if(mysqli_query($con, $uadd1))
      				{
      					echo '<script>alert("Updated Successfully"); location.href="adminwl.php";</script>';
      				} else {
      					echo '<script>alert("Error while Updating"); location.href="adminwl.php";</script>';
      				}
      			}
      		}
      	}
		if(isset($_GET['del0']) && $_GET['del0'] && isset($_GET['del1']) && $_GET['del1'] && isset($_GET['del2']) && $_GET['del2'])
		{
			$b = $_GET['del0'];
			$b1 = $_GET['del1'];
			$b2 = $_GET['del2'];
			$dadd = "SELECT *FROM workload where wuid='$b' and wyear='$b1' and wsem='$b2' ";
			$rsSelect = mysqli_query($con,$dadd);
			$getRow = mysqli_fetch_assoc($rsSelect);
			$getName = $getRow['wfile'];
			$createDeletePath = "workload/".$getName;
			if(unlink($createDeletePath))
			{
				$sqle = "DELETE FROM workload where wuid='$b' and wyear='$b1' and wsem='$b2' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script> alert("Deleted Successfully"); 
					location.href="adminwl.php" </script>';
				}
				else
				{
					echo '<script> alert("Error while Deleting"); 
					location.href="adminwl.php" </script>';
				}
			}
		}
    ?>
</body>
</html>