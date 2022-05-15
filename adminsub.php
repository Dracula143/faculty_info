<!DOCTYPE html>
<html style=" background: url(Images/subjects.png) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Subjects Teached </title>
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
		echo '<h3 class="h2"> Subjects Teached </h3>';
		echo '<table id="t1" class="cert">
				<tr>
					<th> Name </th>
					<th> Academic Year </th>
					<th> Class </th>
					<th> Section </th>
					<th> Sem </th>
					<th> Pass Percentage </th>
					<th> Feedback </th>
					<th> Edit </th>
					<th> Delete </th>
				</tr>';
		$f = "SELECT fuid, fname FROM faculty_details";
		$fr = mysqli_query($con, $f);
		while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="9" style="background-color: grey; ">'.$fd["fname"].'</th></tr>';
			$sid = $fd["fuid"];
			$s = " SELECT *FROM subjects where suid='$sid' ";
			$sr = mysqli_query($con, $s);
			while($sd = mysqli_fetch_array($sr))
			{
					$a = urldecode($sd["suid"]);
					$a1 = urlencode($sd["sname"]);
					$a2 = urlencode($sd["syear"]);
					$a3 = urlencode($sd["sclass"]);
					$a4 = urlencode($sd["ssem"]);
					$a5 = urlencode($sd["ssec"]);
					?>
					<tr>
						<td><?php echo $sd["sname"];?> </td>
						<td> <?php echo $sd["syear"];?> </td>
						<td> <?php echo $sd["sclass"];?> </td>
						<td> <?php echo $sd["ssec"];?> </td>
						<td> <?php echo $sd["ssem"];?> </td>
						<td> <?php echo $sd["spassp"];?> </td>
						<td> <?php echo $sd["sfeed"];?> </td>
						<th><a style="text-decoration: none;" href="adminsub.php?upd0=<?php echo $a; ?>&upd1=<?php echo $a1; ?>&upd2=<?php echo $a2; ?>&upd3=<?php echo $a3; ?>&upd4=<?php echo $a4; ?>&upd5=<?php echo $a5; ?>"> Y </a></th>
						<th><a style="text-decoration: none;" href="adminsub.php?del0=<?php echo $a; ?>&del1=<?php echo $a1; ?>&del2=<?php echo $a2; ?>&del3=<?php echo $a3; ?>&del4=<?php echo $a4; ?>&del5=<?php echo $a5; ?>"> X </a></th>
               		</tr>
            <?php
      		}
      	}
      	?>
		<tr>
			<td style="text-align: center;" colspan="9"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3"> Insert Subject </h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1" >Subject Name </label>
        <input class="i1" type="text" placeholder="Enter Subject Name" name="cn" required> <br>

        <label class="l1" > Acedamic Year </label>
        <input class="i1" type="text" placeholder="Year Subject Teached" name="cy" pattern="((?:[0-9]{4})-(?:[0-9]{2}))" required> <br>

        <label class="l1" > Class </label>
        <input class="i1" type="text" placeholder="Enter Class Year" name="cl" required> <br>

        <label class="l1" > Section </label>
        <input class="i1" type="text" placeholder="Enter Section" name="cs" required> <br>

        <label class="l1" > Semester </label>
        <input class="i1" type="text" name="ce" required> <br>

        <label class="l1" > Total Strength </label>
        <input class="i1" type="number" name="ct" autocomplete="off" required> <br>

        <label class="l1" > Passed Student </label>
        <input class="i1" type="number" name="cp" autocomplete="off" required> <br>

        <label class="l1" > Student Feedback </label>
        <input class="i1" type="number" name="cf" autocomplete="off" required>

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
			$ct = $_POST['ct'];
			$cp = $_POST['cp'];
			$cf = $_POST['cf'];
			$ca = round((intval($cp)/intval($ct))*100);
			$sql1 = "SELECT * FROM subjects where suid='$ci' and sname='$cn' and syear='$cy' and sclass='$cl' and ssec='$cs' and ssem='$ce'";
			if(mysqli_num_rows(mysqli_query($con, $sql1)) != 1)
			{
				$add = "INSERT INTO subjects set suid='$ci', sname='$cn', syear='$cy', sclass='$cl', ssec='$cs', ssem='$ce', sstrength='$ct', spass='$cp', spassp='$ca', sfeed='$cf' ";
				if(mysqli_query($con, $add))
				{
					echo '<script>alert("Inserted Successfully"); location.href="adminsub.php";</script>';
				}else {
					echo '<script>alert("Error while inserting"); location.href="adminsub.php";</script>';
				}
			}
			if(mysqli_num_rows(mysqli_query($con, $sql1)) == 1)
			{
				echo '<script>alert("Subject Already in Database"); location.href="adminsub.php";</script>';
			}
		}
		if(!empty($_GET['upd0']) && $_GET['upd0'] && !empty($_GET['upd1']) && $_GET['upd1'] && !empty($_GET['upd2']) && $_GET['upd2'] && !empty($_GET['upd3']) && $_GET['upd3'] && !empty($_GET['upd4']) && $_GET['upd4'] && !empty($_GET['upd5']) && $_GET['upd5'])
		{
			$x = $_GET['upd0'];
			$x1 = $_GET['upd1'];
			$x2 = $_GET['upd2'];
			$x3 = $_GET['upd3'];
			$x4 = $_GET['upd4'];
			$x5 = $_GET['upd5'];
			$sql = "SELECT * FROM subjects where suid='$x' and sname='$x1' and syear='$x2' and sclass='$x3' and ssem='$x4' and ssec='$x5'";
			$wur = mysqli_query($con, $sql);
			$wud = mysqli_fetch_array($wur);
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update Subject</h3>

        	<label class="l1" > Unique ID </label>
        	<input class="i1" type="text" value="'.$wud["suid"].'" placeholder="Enter Unique ID of Faculty" name="uci" required> <br>

        	<label class="l1" >Subject Name </label>
        	<input class="i1" type="text" value="'.$wud["sname"].'" placeholder="Enter Subject Name" name="ucn" required> <br>

        	<label class="l1" >Acedamic Year </label>
        	<input class="i1" type="text" value="'.$wud["syear"].'" pattern="((?:[0-9]{4})-(?:[0-9]{2}))" placeholder="Enter Class Year" name="ucy" required> <br>

        	<label class="l1" > Class </label>
        	<input class="i1" type="text" value="'.$wud["sclass"].'" placeholder="Enter Section" name="ucl" required> <br>

        	<label class="l1" > Class Section </label>
        	<input class="i1" type="text" value="'.$wud["ssec"].'" placeholder="Enter Section" name="ucs" required> <br>

        	<label class="l1" > Semester </label>
        	<input class="i1" type="text" value="'.$wud["ssem"].'" name="uce" required> <br>

        	<label class="l1" > Total Strength </label>
        	<input class="i1" type="number" value="'.$wud["sstrength"].'" name="uct" autocomplete="off" required> <br>

        	<label class="l1" > Passed Student </label>
        	<input class="i1" type="number" value="'.$wud["spass"].'" name="ucp" autocomplete="off" required> <br>

        	<label class="l1" > Student Feedback </label>
        	<input class="i1" type="number" value="'.$wud["sfeed"].'" name="ucf" autocomplete="off" required>

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
			$uct = $_POST['uct'];
			$ucp = $_POST['ucp'];
			$ucf = $_POST['ucf'];
			$uca = round((intval($ucp)/intval($uct))*100);
			if($uci != $x || $ucn != $x1 || $ucy != $x2 || $ucl != $x3 || $ucs != $x5 || $uce != $x4)
			{
				$sql2 = "SELECT * FROM subjects where suid='$uci' and sname='$ucn' and syear='$ucy' and sclass='$ucl' and ssec='$ucs' and ssem='$uce' ";
				if(mysqli_num_rows(mysqli_query($con, $sql2)) != 1)
				{
					$uadd = "UPDATE subjects set suid='$uci', sname='$ucn', syear='$ucy', sclass='$ucl', ssec='$ucs', ssem='$uce', sstrength='$uct', spass='$ucp', spassp='$uca', sfeed='$ucf' where suid='$x' and sname='$x1' and syear='$x2' and sclass='$x3' and ssem='$x4' and ssec='$x5' ";
					if (mysqli_query($con, $uadd))
					{
						echo '<script>alert("Updated Successfully"); location.href="adminsub.php"</script>';
					}
					else
					{
						echo '<script>alert("Error while updating"); location.href="adminsub.php"</script>';
					}
				}
				if(mysqli_num_rows(mysqli_query($con, $sql2)) == 1)
				{
					echo '<script>alert("Subject already in Database"); location.href="adminsub.php"</script>';
				}
			}
			if($uci == $x && $ucn == $x1 && $ucy == $x2 && $ucl == $x3 && $ucs == $x5 && $uce == $x4)
			{
				$uadd = "UPDATE subjects set suid='$uci', sname='$ucn', syear='$ucy', sclass='$ucl', ssec='$ucs', ssem='$uce', sstrength='$uct', spass='$ucp', spassp='$uca', sfeed='$ucf' where suid='$x' and sname='$x1' and syear='$x2' and sclass='$x3' and ssem='$x4' and ssec='$x5' ";
				if (mysqli_query($con, $uadd))
				{
					echo '<script>alert("Updated Successfully"); location.href="adminsub.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while updating"); location.href="adminsub.php"</script>';
				}
			}
		}
		if(!empty($_GET['del0']) && $_GET['del0'] && !empty($_GET['del1']) && $_GET['del1'] && !empty($_GET['del2']) && $_GET['del2'] && !empty($_GET['del3']) && $_GET['del3'] && !empty($_GET['del4']) && $_GET['del4'] && !empty($_GET['del5']) && $_GET['del5'])
		{
			$b = $_GET['del0'];
			$b1 = $_GET['del1'];
			$b2 = $_GET['del2'];
			$b3 = $_GET['del3'];
			$b4 = $_GET['del4'];
			$b5 = $_GET['del5'];
			$dadd = "DELETE FROM subjects where suid='$b' and sname = '$b1' and syear='$b2' and sclass='$b3' and ssem='$b4' and ssec='$b5' ";
			if(mysqli_query($con, $dadd))
			{
				echo '<script>alert("Deleted Successfully"); location.href="adminsub.php";</script>';
			}else{
				echo '<script>alert("Error while Deleting"); location.href="adminsub.php";</script>';
			}
		}
    ?>
</body>
</html>