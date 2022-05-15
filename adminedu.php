<!DOCTYPE html>
<html style=" background: url(Images/education.png) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Education </title>
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
		echo '<h3 class="h2"> Education </h3>';
		echo '<table id="t1" class="cert">';
		echo '
				<tr>
					<th> College/School </th>
					<th> Board/Univeristy </th>
					<th> Program </th>
					<th> Branch </th>
					<th> Passout Year </th>
					<th> Percentage </th>
					<th> Edit </th>
					<th> Delete </th>
				</tr>';
		$f = "SELECT fuid, fname FROM faculty_details ";
		$fr = mysqli_query($con, $f);
		while($fd = mysqli_fetch_array($fr))
		{
			echo '<tr> <th colspan="8" style="background-color: grey; ">'.$fd["fname"].'</th></tr>';
			$o = $fd['fuid'];
			$e = "SELECT * FROM education where euid='$o' ";
			$er = mysqli_query($con, $e);
			while($ed = mysqli_fetch_array($er))
			{
					$a = urlencode($ed["euid"]);
					$a1 = urlencode($ed["edpyear"]);
					$a2 = urlencode($ed["edprogram"]);
					$a3 = urlencode($ed["edbranch"]);
					?>
					<tr>
						<td> <?php $ed["edname"]; ?> </td>
						<td> <?php $ed["edboard"]; ?> </td>
						<td> <?php $ed["edprogram"]; ?> </td>
						<td> <?php $ed["edbranch"]; ?> </td>
						<td> <?php $ed["edpyear"]; ?> </td>
						<td> <?php $ed["edpcntg"]; ?> </td>
						<th><a style="text-decoration: none;" href="adminedu.php?upd0=<?php $a ?>&upd1=<?php echo $a1; ?>&upd2=<?php echo $a2; ?>&upd3=<?php echo $a3; ?> "> Y </a></th>
						<th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the Education');" href="adminedu.php?del0=<?php echo $a; ?>&del1=<?php echo $a1; ?>&del2=<?php echo $a2; ?>&del3=<?php echo $a3; ?> "> X </a></th>
               		</tr>';
            <?php
      		}
      	}
      	?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr>
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3"> Insert Education </h3>

        <label class="l1" > Unique ID </label>
        <input class="i1" type="text" placeholder="Enter Unique ID of Faculty" name="ci" required> <br>

        <label class="l1" > College/School </label>
        <input class="i1" type="text" placeholder=" Enter College Name " name="cn" required> <br>

        <label class="l1" > Board/University </label>
        <input class="i1" type="text" placeholder=" Enter Board/University " name="cy" required> <br>

        <label class="l1" > Program </label>
        <input class="i1" type="text" placeholder="Enter Program" name="cl" required> <br>

        <label class="l1" > Branch </label>
        <input class="i1" type="text" placeholder="Enter Branch" name="cs" required> <br>

        <label class="l1" > Passout Year </label>
        <input class="i1" type="number" placeholder="Enter Passout Year" name="ce" required> <br>

        <label class="l1" > Percentage </label>
        <input class="i1" type="number" placeholder="Enter Percentage" name="cf" required> <br>     

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
			$qsa = "SELECT * FROM education where edpyear='$cf' and edprogram='$cs' and edbranch='$ce' and euid='$ci'";
			$qsar = mysqli_query($con, $qsa);
			if(mysqli_num_rows($qsar) != 1)
			{
       	 		$add = "INSERT INTO education set euid='$ci', edname='$cn', edboard='$cy', edprogram='$cl', edbranch='$cs', edpyear='$ce', edpcntg='$cf' ";
       	 		if(mysqli_query($con, $add))
				{
					echo '<script>alert("Inserted Successfully"); location.href="adminedu.php";</script>';
				}else{
					echo '<script>alert("Error while inserting"); location.href="adminedu.php";</script>';
				}
			}
			if(mysqli_num_rows($qsar) == 1)
			{
				echo '<script>alert("Education Details already exists in the database"); location.href="adminedu.php";</script>';
			}
		}
		if(!empty($_GET['upd0']) && !empty($_GET['upd1']) && !empty($_GET['upd2']) && !empty($_GET['upd3']))
		{
			$uci = $_GET['upd0'];
			$uci1 = $_GET['upd1'];
			$uci2 = $_GET['upd2'];
			$uci3 = $_GET['upd3'];
			$sql1 = "SELECT * FROM education where euid='$uci' and edpyear = '$uci1' and edprogram='$uci2' and edbranch='$uci3' ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3"> Update Education </h3>

        	<label class="l1" > Unique ID </label>
    	    <input class="i1" type="text" value="'.$wud["euid"].'" placeholder="Enter Unique ID of Faculty" name="ciu" required> <br>

    	    <label class="l1" > College/School </label>
    	    <input class="i1" type="text" value="'.$wud["edname"].'" placeholder=" Enter College Name " name="ucn" required> <br>

    	    <label class="l1" > Board/University </label>
    	    <input class="i1" type="text" value="'.$wud["edboard"].'" placeholder=" Enter Board/University " name="ucy" required> <br>

    	    <label class="l1" > Program </label>
    	    <input class="i1" type="text" value="'.$wud["edprogram"].'" placeholder="Enter Program" name="ucl" required> <br>

    	    <label class="l1" > Branch </label>
    	    <input class="i1" type="text" value="'.$wud["edbranch"].'" placeholder="Enter Branch" name="ucs" required> <br>

    	    <label class="l1" > Passout Year </label>
    	    <input class="i1" type="number" value="'.$wud["edpyear"].'" placeholder="Enter Passout Year" name="uce" required> <br>

    	    <label class="l1" > Percentage </label>
    	    <input class="i1" type="number" value="'.$wud["edpcntg"].'" placeholder="Enter Percentage" name="ucf" required> <br>

	        <input class="submit" type="submit" name="change">
	            </form>';
    	}
		if(isset($_POST['change']))
		{
			$ciu = $_POST['ciu'];
			$ucn = $_POST['ucn'];
			$ucy = $_POST['ucy'];
			$ucl = $_POST['ucl'];
			$ucs = $_POST['ucs'];
			$uce = $_POST['uce'];
			$ucf = $_POST['ucf'];
			if($ciu != $uci || $uce != $uci1 || $ucl != $uci2 || $ucs != $uci3)
       	 	{
       	 		if(mysqli_num_rows(mysqli_query($con, " SELECT * FROM education where euid='$ciu' and edpyear='$uce' and edprogram='$ucl' and edbranch='$ucs' ")) != 1)
       	 		{
       	 			$uadd = "UPDATE education set euid='$ciu', edname='$ucn', edboard='$ucy', edprogram='$ucl', edbranch='$ucs', edpyear='$uce', edpcntg='$ucf' where euid='$x' and edpyear='$x1' and edprogram='$x2' and edbranch='$x3' ";
       	 			if(mysqli_query($con, $uadd))
					{
						echo '<script>alert("Updated Successfully"); location.href="adminedu.php";</script>';
					} else {
						echo '<script>alert("Error while updating"); location.href="adminedu.php";</script>';
					}
				}
				if(mysqli_num_rows(mysqli_query($con, " SELECT * FROM education where euid='$ciu' and edpyear='$uce' and edprogram='$ucl' and edbranch='$ucs' ")) == 1)
				{
					echo '<script>alert("Education Details already exists"); location.href="adminedu.php";</script>';
				}
			}
			if($ciu == $uci && $uce == $uci1 && $ucl == $uci2 && $ucs == $uci3)
			{
				$uadd = "UPDATE education set euid='$ciu', edname='$ucn', edboard='$ucy', edprogram='$ucl', edbranch='$ucs', edpyear='$uce', edpcntg='$ucf' where euid='$x' and edpyear='$x1' and edprogram='$x2' and edbranch='$x3' ";
       	 		if(mysqli_query($con, $uadd))
				{
					echo '<script>alert("Updated Successfully"); location.href="adminedu.php";</script>';
				} else {
					echo '<script>alert("Error while updating"); location.href="adminedu.php";</script>';
				}
			}
		}				
		if(!empty($_GET['del0']) && !empty($_GET['del1']) && !empty($_GET['del2']) && !empty($_GET['del3'])) //code to delete the selected workload
		{
			$m = $_GET['del0'];
			$m1 = $_GET['del1'];
			$m2 = $_GET['del2'];
			$m3 = $_GET['del3'];
			$sqle = "DELETE FROM education where euid='$m' and edpyear = '$m1' and edprogram='$m2' and edbranch='$m3' ";
			if(mysqli_query($con, $sqle))
			{
				echo '<script>alert("Deleted Successfully"); location.href="adminedu.php"</script>';
			}
			else
			{
				echo '<script>alert("Error while Deleting"); location.href="adminedu.php"</script>';
			}
		}
    ?>
</body>
</html>