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
		include 'facultymenu.php';
		$edu = "SELECT * FROM education where euid = '$uid'";
		$edur = mysqli_query($con, $edu);
	?>
	<h3 class="h2"> Education </h3>
	<table id="t1" class="cert">
		<tr>
			<th> School/College </th>
			<th> Board/University </th>
			<th> Program </th>
			<th> Branch </th>
			<th> Year of Passout </th>
			<th> Percentage </th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
		<?php
			while ($wv = mysqli_fetch_array($edur))
			{
				$nam = urlencode($wv["edpyear"]);
				$nam1 = urlencode($wv["edprogram"]);
				$nam2 = urlencode($wv["edbranch"]);
			?>	
			<tr>
				<td><?php echo $wv["edname"]; ?> </td>
				<td><?php echo $wv["edboard"]; ?></td>
				<td><?php echo $wv["edprogram"]; ?></td>
				<td><?php echo $wv["edbranch"]; ?></td>
				<td><?php echo $wv["edpyear"]; ?></td>
				<td><?php echo $wv["edpcntg"]; ?></td>
				<th><a style="text-decoration: none;" href="facultyedu.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>&upd2=<?php echo $nam2; ?>" id="upd" > Y </a></th>
                <th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the Education <?php echo $wv['edprogram']; ?>, <?php echo $wv['edbranch']; ?>');" href="facultyedu.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>&del2=<?php echo $nam2; ?>" > X </a></th>
            </tr>
        <?php } ?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3">Insert Education Details</h3>

        <label class="l1"> School/College </label>
        <input class="i1" type="text" name="cn" placeholder="Enter School/College Studied" required> <br>

        <label class="l1"> Board/University </label>
        <input class="i1" type="text" name="cy" placeholder="Enter Board/University completed education under" required> <br>

        <label class="l1"> Program </label>
        <input class="i1" type="text" name="cs" placeholder="eg: b. Tech, Inter, 10th etc..," required> <br>

        <label class="l1"> Branch </label>
        <input class="i1" type="text" name="ce" placeholder="eg: Information Technology, MPC, General" required> <br>

        <label class="l1"> Year of Pass </label>
        <input class="i1" type="text" name="cf" placeholder="Enter Passing Year" pattern="(?:[0-9]{4})" min="1920" max="<?php echo date("Y"); ?>" title="Must be a calender year" autocomplete="off" required> <br>

        <label class="l1"> Percentage </label>
        <input class="i1" type="text" name="cp" placeholder="Enter percentage only" autocomplete="off" required> <br>

        <input class="submit" type="submit" name="add">
    </form>
    <?php
    	if(isset($_POST['add']))
		{
			$cn = $_POST['cn'];
			$cy = $_POST['cy'];
			$cs = $_POST['cs'];
			$ce = $_POST['ce'];
			$cp = $_POST['cp'];
			$cf = $_POST['cf'];
			$qsa = "SELECT * FROM education where edpyear='$cf' and edprogram='$cs' and edbranch='$ce' and euid='$uid'";
			$qsar = mysqli_query($con, $qsa);
			if(mysqli_num_rows($qsar) != 1)
			{
				$sql2 = "INSERT into education SET edname='$cn', edpyear='$cf', edprogram='$cs', edbranch='$ce', edboard='$cy', edpcntg='$cp', euid='$uid'";
				if (mysqli_query($con, $sql2))
				{
					echo '<script>alert("Education Added Successfully"); location.href="facultyedu.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Adding"); location.href="facultyedu.php"</script>';
				}
			}
			if(mysqli_num_rows($qsar) == 1)
      		{
      			echo '<script>alert("Education Details Already exist."); location.href="facultyedu.php";</script>';
      		}
		}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']) && !empty($_GET['upd2']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$uci2 = $_GET['upd2'];
			$sql1 = "SELECT * FROM education where euid='$uid' and edpyear = '$uci' and edprogram='$uci1' and edbranch='$uci2' ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
        		<h3 class="h3">Update Form for Education Details </h3>

        		<label class="l1"> School/College </label>
       			<input class="i1" type="text" placeholder="Enter School/College Studied" value="'.$wud["edname"].'"  name="ucn" required> <br>

        		<label class="l1"> Board/University </label>
        		<input class="i1" type="text" name="ucy" placeholder="Enter Board/University completed education under" value="'.$wud["edboard"].'" required> <br>

        		<label class="l1"> Program </label>
        		<input class="i1" type="text" name="ucs" placeholder="eg: b. Tech, Inter, 10th etc..," value="'.$wud["edprogram"].'" required> <br>

        		<label class="l1"> Branch </label>
        		<input class="i1" type="text" name="uce" placeholder="eg: Information Technology, MPC, General" value="'.$wud["edbranch"].'" required> <br>

        		<label class="l1"> Year of Pass </label>
        		<input class="i1" type="text" name="ucf" placeholder="Enter Passing Year" pattern="(?:[0-9]{4})" max="'.date("Y").'" title="Must be a calender year" value="'.$wud["edpyear"].'" autocomplete="off" required> <br>

        		<label class="l1"> Percentage </label>
        		<input class="i1" type="text" name="ucp" placeholder="Enter percentage only" value="'.$wud["edpcntg"].'" autocomplete="off" required> <br>

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
			$ucp = $_POST['ucp'];
			$ucf = $_POST['ucf'];
			if($ucf != $uci || $uce != $uci2 || $ucs != $uci1) 
			{ 
				$sqlz = "SELECT * FROM education where euid='$uid' and edpyear = '$uci' and edprogram='$uci1' and edbranch='$uci2' ";
				if(mysqli_num_rows(mysqli_query($con, $sqlz)) != 1)
				{
					$wu2 = "UPDATE education SET edname='$ucn', edpyear='$ucf', edprogram='$ucs', edbranch='$uce', edboard='$ucy', edpcntg='$ucp' where euid='$uid' and edpyear='$uci' and edprogram='$uci1' and edbranch='$uci2' ";
					if (mysqli_query($con, $wu2))
					{
						echo '<script>alert("Education Details Updated Successfully"); location.href="facultyedu.php"</script>';
					}
					else
					{
						echo '<script>alert("Error while updating"); location.href="facultyedu.php"</script>';
					}
				}
				if(mysqli_num_rows(mysqli_query($con, $sqlz)) == 1)
				{
					echo '<script>alert("Education Details Already exist."); location.href="facultyedu.php";</script>';
				}
			}
			if($ucf === $uci && $uce === $uci2 && $ucs === $uci1)
			{
				$wu2 = "UPDATE education SET edname='$ucn', edpyear='$ucf', edprogram='$ucs', edbranch='$uce', edboard='$ucy', edpcntg='$ucp' where euid='$uid' and edpyear='$uci' and edprogram='$uci1' and edbranch='$uci2' ";
				if (mysqli_query($con, $wu2))
				{
					echo '<script>alert("Education Details Updated Successfully"); location.href="facultyedu.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while updating"); location.href="facultyedu.php"</script>';
				}
			}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1']) && !empty($_GET['del2'])) //code to delete the selected workshop
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$m2 = $_GET['del2'];
			$sqle = "DELETE FROM education where euid='$uid' and edpyear = '$m' and edprogram='$m1' and edbranch='$m2' ";
			if(mysqli_query($con, $sqle))
			{
				echo '<script>alert("Deleted Successfully"); location.href="facultyedu.php"</script>';
			}
			else
			{
				echo '<script>alert("Error while Deleting"); location.href="facultyedu.php"</script>';
			}
		}
		?>
</body>
</html>