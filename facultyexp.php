<!DOCTYPE html>
<html style=" background: url(Images/exp.png) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Experience </title>
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
		$edu = "SELECT * FROM experience where expid = '$uid'";
		$edur = mysqli_query($con, $edu);
	?>
	<h3 class="h2"> Experience </h3>
	<table id="t1" class="cert">
		<tr>
			<th> School/College </th>
			<th> Designation </th>
			<th> Year of Joining</th>
			<th> Year of Leaving </th>
			<th> Experience </th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
		<?php
			while ($wv = mysqli_fetch_array($edur))
			{
				$nam = urlencode($wv["ejyear"]);
			?>	
			<tr>
				<td><?php echo $wv["ename"];  ?></td>
				<td><?php echo $wv["edes"];   ?></td>
				<td><?php echo $wv["ejyear"]; ?></td>
				<td><?php echo $wv["eeyear"]; ?></td>
				<td><?php echo $wv["etime"];  ?></td>
				<th><a style="text-decoration: none;" href="facultyexp.php?update_id=<?php echo $nam; ?>" id="upd" > Y </a></th>
                <th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the Experience <?php echo $wv['ename']; ?>');" href="facultyexp.php?del_id=<?php echo $nam; ?>" > X </a></th>
            </tr>
        <?php } ?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3">Insert Experience Details</h3>

        <label class="l1"> School/College/Company </label>
        <input class="i1" type="text" name="cn" placeholder="Enter Previous employer name" required> <br>

        <label class="l1"> Designation </label>
        <input class="i1" type="text" name="cy" placeholder="Enter Designation Previously worked" required> <br>

        <label class="l1"> Year of Joining </label>
        <input class="i1" type="text" name="cs" placeholder="Enter Joining Year" pattern="(?:[0-9]{4})" title="Must be a calender year" required> <br>

        <label class="l1"> Year of Leaving </label>
        <input class="i1" type="text" name="ce" placeholder="Enter Leaving year" pattern="(?:[0-9]{4})" title="Must be a calender year" required><br>

        <input class="submit" type="submit" name="add">
    </form>
    <?php
    	if(isset($_POST['add']))
		{
			$cn = $_POST['cn'];
			$cy = $_POST['cy'];
			$cs = $_POST['cs'];
			$ce = $_POST['ce'];
			$ct = (intval($ce) - intval($cs));
			$qsa = "SELECT * FROM experience where ejyear='$cs' and expid='$uid'";
			$qsar = mysqli_query($con, $qsa);
			if(mysqli_num_rows($qsar) != 1)
			{
				$sql2 = "INSERT into experience SET ename='$cn', etime='$ct', ejyear='$cs', eeyear='$ce', edes='$cy', expid='$uid'";
				if (mysqli_query($con, $sql2))
				{
					echo '<script>alert("Experience Added Successfully"); location.href="facultyexp.php"</script>';
				}
				else
				{
					echo '<script> alert("Error while Adding");
					location.href="facultyexp.php" </script>';
				}
			}
			if(mysqli_num_rows($qsar) == 1)
      		{
      			echo '<script>alert("Experience Details Already exist."); location.href="facultyexp.php";</script>';
      		}
      	}
		if(!empty($_GET['update_id']) && $_GET['update_id'])
		{
			$uci = $_GET['update_id'];
			$sql1 = "SELECT * FROM experience where expid='$uid' and ejyear = '$uci'";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
        		<h3 class="h3">Update Form for Experience Details </h3>

        		<label class="l1"> School/College/Company </label>
       			<input class="i1" type="text" value="'.$wud["ename"].'" name="ucn" required> <br>

        		<label class="l1"> Designation </label>
        		<input class="i1" type="text" name="ucy" value="'.$wud["edes"].'" required> <br>

        		<label class="l1"> Year of Joining </label>
        		<input class="i1" type="text" name="ucs" value="'.$wud["ejyear"].'" pattern="(?:[0-9]{4})" title="Must be a calender year" required> <br>

        		<label class="l1"> Year of Leaving </label>
        		<input class="i1" type="text" name="uce" value="'.$wud["eeyear"].'" pattern="(?:[0-9]{4})" title="Must be a calender year" required> <br>

        		<input class="submit" type="submit" name="upd">
    			</form>';
    	}
     	?>
    	<?php
		if(isset($_POST['upd']))
		{
			$ucn = $_POST['ucn'];
			$ucy = $_POST['ucy'];
			$ucs = $_POST['ucs'];
			$uce = $_POST['uce'];
			$uct = (intval($uce) - intval($ucs));
			if($ucs != $uci) 
			{ 
				$sqlz = "SELECT * FROM experience where expid='$uid' and ejyear = '$uci' ";
				if(mysqli_num_rows(mysqli_query($con, $sqlz)) != 1)
				{
					$wu2 = "UPDATE experience SET ename='$ucn', etime='$uct', ejyear='$ucs', eeyear='$uce', edes='$ucy' where expid='$uid' and ejyear='$uci'";
					if (mysqli_query($con, $wu2))
					{
						echo '<script>alert("Experience Details Updated Successfully"); location.href="facultyexp.php"</script>';
					}
					else
					{
						echo '<script>alert("Error while updating"); location.href="facultyexp.php"</script>';
					}
				}
				if(mysqli_num_rows(mysqli_query($con, $sqlz)) == 1)
				{
					echo '<script>alert("Experience Details Already exist."); location.href="facultyexp.php";</script>';
				}
			}
			if($ucs == $uci) 
			{
				$wu2 = "UPDATE experience SET ename='$ucn', etime='$uct', ejyear='$ucs', eeyear='$uce', edes='$ucy' where expid='$uid' and ejyear='$uci'";
				if (mysqli_query($con, $wu2))
				{
					echo '<script>alert("Experience Details Updated Successfully"); location.href="facultyexp.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while updating"); location.href="facultyexp.php"</script>';
				}
			}
		}
		if(!empty($_GET['del_id']) && $_GET['del_id']) //code to delete the selected workshop
		{
			$m = $_GET['del_id'];
			$sqle = "DELETE FROM experience where expid='$uid' and ejyear = '$m' ";
			if(mysqli_query($con, $sqle))
			{
				echo '<script>alert("Deleted Successfully"); location.href="facultyexp.php"</script>';
			}
			else
			{
				echo '<script>alert("Error while Deleting"); location.href="facultyexp.php"</script>';
			}
		}
		?>
</body>
</html>