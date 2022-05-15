<!DOCTYPE html>
<html style=" background: url(Images/Conference.png) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Conference </title>
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
		$cc = "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Conference' ";
		$ccr = mysqli_query($con, $cc);
		?>
		</tr>
	</table>
	<h3 class="h2"> Conference </h3>
	<table id="t1" class="cert" style="margin-top: 10px;">
		<tr class="tr1">
			<th> Title </th>
			<th> Year </th>
			<th> Conference </th>
			<th> Volume </th>
			<th> UGC/SCOPUS/SCI Indexed </th>
			<th> File </th>
			<th> Edit </th>
			<th> Delete </th>
		</tr>
		<?php
			while ($wv = mysqli_fetch_array($ccr))
			{
				$nam = urlencode($wv["cname"]);
				$nam1 = urlencode($wv["cyear"]);
			?>
			<tr>
				<td><?php echo $wv["cname"]; ?> </td>
				<td><?php echo $wv["cyear"]; ?></td>
				<td><?php echo $wv["cjournal"]; ?></td>
				<td><?php echo $wv["cvol"]; ?></td>
				<td><?php echo $wv["cindex"]; ?></td>
				<td><a style="text-decoration: none;" href="certs/<?php echo $wv["cfile"]; ?>" target="_blank"><?php echo $wv["cfile"]; ?> </td>
				<th><a style="text-decoration: none;" href="facultyconf.php?upd=<?php echo $nam; ?>&upd1=<?php echo $nam1; ?>" > Y </a></th>
                <th><a style="text-decoration: none;" onClick="javascript: return confirm('Do you want to delete the Conference <?php echo $wv['cname']; ?>');" href="facultyconf.php?del=<?php echo $nam; ?>&del1=<?php echo $nam1; ?>" > X </a></th>
            </tr>
        <?php } ?>
		<tr>
			<td style="text-align: center;" colspan="8"><button class="b1" id = "b1" onclick="add()" > Add </button> </td>
		</tr> 
	</table>

	 <form class="f1" id="f1" action="" method="POST" style="display: none" enctype="multipart/form-data">
        <h3 class="h3">Insert Conference</h3>

        <label class="l1"> Title </label>
        <input class="i1" type="text" placeholder="Enter Conference Title" name="cn" required><br>

        <label class="l1"> Year </label>
        <input class="i1" type="number" placeholder="Enter Year" name="cy" pattern="(?:[0-9]{4})" min="1920" max="<?php echo date("Y"); ?>" title="Must be a calender year" required> <br>

        <label class="l1"> Name of Journal/Conference</label>
        <input class="i1" type="text" name="cs" required> <br>

        <label class="l1"> Volume </label>
        <input class="i1" type="text" name="ce" required> <br>

        <label class="l1"> UGC/SCOPUS/SCI Indexed</label>
        <input class="i1" type="text" name="ct" required> <br>

        <label class="l1"> File </label>
        <input class="i1" type="file" name="cf" autocomplete="off" required> <br>

        <input class="submit" type="submit" name="add">
    </form>
    <?php
    	if(isset($_POST['add']))
		{
			$cn = $_POST['cn'];
			$cy = $_POST['cy'];
			$cs = $_POST['cs'];
			$ce = $_POST['ce'];
			$ct = $_POST['ct'];
			$cf = $_FILES['cf']['name'];
			$qsa = "SELECT * FROM certifications where cuid = '$uid' and ctype = 'Conference' and cname='$cn' and cyear='$cy' and cjournal='$cs' ";
			$qsar = mysqli_query($con, $qsa);
			if(mysqli_num_rows($qsar) != 1)
			{
				$fT = $_FILES['cf']['tmp_name'];
    			$fY = $_FILES['cf']['type'];
    			$fNC = explode(".", $cf);
    			$fE = strtolower(end($fNC));
    			$nFN = "$uid-$cf";
    			$afE = 'pdf';
    			if ($fE == $afE)
    			{
      				$uFD = './certs/';
      				$dp = $uFD . $nFN;
      				if (!file_exists($dp))
      				{
      					if(move_uploaded_file($fT, $dp)) 
      					{
      						$sql2 = "INSERT into certifications SET cfile='$nFN', cname='$cn', cindex='$ct', cjournal='$cs', cvol='$ce', cyear='$cy', ctype='Conference', cuid='$uid'";
      						if (mysqli_query($con, $sql2))
      						{
      							echo '<script>alert("Conference Added Successfully"); location.href="facultyconf.php"</script>';
      						}
      						else
      						{
      							echo '<script>alert("Error while Adding"); location.href="facultyconf.php"</script>';
      						}
      					}
      				}
      				if (file_exists($dp)) 
      				{
      					echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyconf.php";</script>';
      				}
      			}
      			if($fE != $afE)
      			{
      				echo '<script>alert("File extension must be pdf"); location.href="facultyconf.php";</script>';
      			}
      		}
      		if(mysqli_num_rows($qsar) == 1)
      		{
      			echo '<script>alert("Conference Already exist."); location.href="facultyconf.php";</script>';
      		}
      	}
		if(!empty($_GET['upd']) && !empty($_GET['upd1']))
		{
			$uci = $_GET['upd'];
			$uci1 = $_GET['upd1'];
			$sql1 = "SELECT * FROM certifications where cuid='$uid' and cname = '$uci' and ctype='Conference' and cyear='$uci1' ";
			$wur = mysqli_query($con, $sql1);
			$wud = mysqli_fetch_array($wur);
			$pcf = $wud['cfile'];
			echo '<form class="f1" id="f2" action="" method="POST" enctype="multipart/form-data">
			<h3 class="h3">Update Conference</h3>

        	<label class="l1"> Title </label>
        	<input class="i1" type="text" placeholder="Enter Conference Name" value="'.$wud["cname"].'" name="ucn" required> <br>

        	<label class="l1"> Year </label>
        	<input class="i1" type="number" placeholder="Enter Year" name="ucy" value="'.$wud["cyear"].'" pattern="(?:[0-9]{4})" min="1920" max="'.date("Y").'" title="Must be a calender year" required> <br>

	        <label class="l1"> Name of the Conference/Journal </label>
	        <input class="i1" type="text" name="ucs" value="'.$wud["cjournal"].'" required> <br>

	        <label class="l1" > Volume </label>
	        <input class="i1" type="text" name="uce" value="'.$wud["cvol"].'" required> <br>

	        <label class="l1"> UGC/SCOPUS/SCI Indexed</label>
        	<input class="i1" type="text" name="uct" value="'.$wud["cindex"].'" required> <br>

	        <label class="l1" > File </label>
	        <input class="i1" type="file" name="ucf" autocomplete="off"> <br>

	        <input class="submit" type="submit" name="upd">
	            </form>';
    	}
     	?>
    	<?php
		if(isset($_POST['upd']))
		{
			$ucn=$_POST['ucn'];
			$ucs=$_POST['ucs'];
			$uce=$_POST['uce'];
			$ucy=$_POST['ucy'];
			$uct=$_POST['uct'];
			if($ucn != $uci || $ucy != $uci1) 
			{ 
				$sqlz = "SELECT * FROM certifications where cuid='$uid' and cname = '$ucn' and ctype='Conference' and cyear='$ucy' and cjournal='$ucs' ";
				if(mysqli_num_rows(mysqli_query($con, $sqlz)) != 1)
				{
					if($_FILES['ucf']['error'] != UPLOAD_ERR_NO_FILE)
					{
						$uafE = 'pdf';
						$ucf = $_FILES['ucf']['name'];
						$ufT = $_FILES['ucf']['tmp_name'];
    					$ufY = $_FILES['ucf']['type'];
    					$ufNC = explode(".", $ucf);
 						$ufE = strtolower(end($ufNC));
    					if ($ufE == $uafE)
    					{
    						$cpd = "certs/".$pcf;
    						unlink($cpd);
    						$unFN = "$uid-$ucf";
      						$uuFD = './certs/';
      						$udp = $uuFD . $unFN;
      						if (!file_exists($udp))
      						{
       							if(move_uploaded_file($ufT, $udp)) 
      							{
									$wu12 = "UPDATE certifications SET cfile='$unFN', cname='$ucn', cindex='$uct', cjournal='$ucs', cvol='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci' and ctype='Conference' and cyear='$uci1' ";
									if (mysqli_query($con, $wu12))
									{
										echo '<script>alert("Conference Details Updated Successfully"); location.href="facultyconf.php"</script>';
									}
									else
									{
										echo '<script>alert("Error while updating"); location.href="facultyconf.php"</script>';
									}
								}
							}
							if (file_exists($udp))
      						{
      							echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyconf.php";</script>';
      						}
      					}
						if($ufE != $uafE)
      					{
      						echo '<script>alert("File extension must be pdf"); location.href="facultyconf.php";</script>';
      					}
					}
					if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
					{
						$wu21 = "UPDATE certifications SET cname='$ucn', cindex='$uct', cjournal='$ucs', cvol='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci' and ctype='Conference' and cyear='$uci1' ";
						if (mysqli_query($con, $wu21))
						{
							echo '<script>alert("Conference Details updated Successfully"); location.href="facultyconf.php"</script>';
						}
						else
						{
							echo '<script>alert("Error while updating"); location.href="facultyconf.php"</script>';
						}
					}
				}
				if(mysqli_num_rows($sqlzr) == 1)
				{
					echo '<script>alert("Conference Already exist."); location.href="facultyconf.php";</script>';
				}
			}
			if($ucn === $uci && $ucy === $uci1)
			{
				if($_FILES['ucf']['error'] != UPLOAD_ERR_NO_FILE)
				{
					$uafE = 'pdf';
					$ucf = $_FILES['ucf']['name'];
					$ufT = $_FILES['ucf']['tmp_name'];
    				$ufY = $_FILES['ucf']['type'];
    				$ufNC = explode(".", $ucf);
 					$ufE = strtolower(end($ufNC));
    				if ($ufE == $uafE)
    				{
    					$cpd = "certs/".$pcf;
    					unlink($cpd);
    					$unFN = "$uid-$ucf";
      					$uuFD = './certs/';
      					$udp = $uuFD . $unFN;
						if (file_exists($udp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href = "facultyconf.php";</script>';
      					}
      					if (!file_exists($udp))
      					{
       						if(move_uploaded_file($ufT, $udp)) 
      						{
								$wu1 = "UPDATE certifications SET cfile='$unFN', cname='$ucn', cindex='$uct', cjournal='$ucs', cvol='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci' and ctype='Conference' and cyear='$uci1' ";
								if (mysqli_query($con, $wu1))
								{
									echo '<script>alert("Conference Details Updated Successfully"); location.href="facultyconf.php"</script>';
								}
								else
								{
									echo '<script>alert("Error while updating"); location.href="facultyconf.php"</script>';
								}
							}
						}
						if (file_exists($udp))
      					{
      						echo '<script>alert("File name Already exist. Please rename file and Try Again"); location.href="facultyconf.php";</script>';
      					}
      				}
					if($ufE != $uafE)
      				{
      					echo '<script>alert("File extension must be pdf"); location.href="facultyconf.php";</script>';
      				}
				}
				if($_FILES['ucf']['error'] == UPLOAD_ERR_NO_FILE)
				{
					$wu2 = "UPDATE certifications SET cname='$ucn', cindex='$uct', cjournal='$ucs', cvol='$uce', cyear='$ucy' where cuid='$uid' and cname='$uci' and ctype='Conference' and cyear='$ucy' ";
					if (mysqli_query($con, $wu2))
					{
						echo '<script>alert("Conference Details updated Successfully"); location.href="facultyconf.php"</script>';
					}
					else
					{
						echo '<script>alert("Error while updating"); location.href="facultyconf.php"</script>';
					}
				}
      		}
		}
		if(!empty($_GET['del']) && !empty($_GET['del1'])) //code to delete the selected Conference
		{
			$m = $_GET['del'];
			$m1 = $_GET['del1'];
			$selectSql = "SELECT * from certifications where cuid='$uid' and cname = '$m' and ctype='Conference' and cyear='$m1' ";
			$rsSelect = mysqli_query($con, $selectSql);
			$getRow = mysqli_fetch_assoc($rsSelect);
			$getName = $getRow['cfile'];
			$createDeletePath = "certs/".$getName;
			if(unlink($createDeletePath))
			{
				$sqle = "DELETE FROM certifications where cuid='$uid' and cname = '$m' and ctype='Conference' and cyear='$m1' ";
				if(mysqli_query($con, $sqle))
				{
					echo '<script>alert("Deleted Successfully"); location.href="facultyconf.php"</script>';
				}
				else
				{
					echo '<script>alert("Error while Deleting"); location.href="facultyconf.php"</script>';
				}
			}
		}
		?>
</body>
</html>