<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <title> Faculty Login Page</title>
        <script type="text/javascript">
            function frpwd()
            {
                document.getElementById('f2').style.display = 'block';
                document.getElementById('f1').style.display = 'none';
            }
        </script>
    </head>
    <body >
        <div class="d2" style="justify-content: center;">
            <?php
            session_start();
            include 'db.php';
            include 'loginmenu.php';
            if(isset($_POST['login']))
            {
                $fuid = $_POST['uid'];
                $fpassword = $_POST['pass'];
                $_SESSION['id'] = $_POST['uid'];
                $sql = "SELECT *FROM faculty_details where fuid='$fuid' and fpwd='$fpassword'";
                $result = mysqli_query($con,$sql);
                $u = mysqli_fetch_array($result);
                if($fuid === $u['fuid'] && $fpassword === $u['fpwd'])
                {
                    echo '<script>alert("Login Sucessfull"); location.href="facultyb.php"</script>';
                }
                if($fuid !== $u['fuid'] || $fpwd !== $u['fpwd'])
                {
                    echo '<script>alert("Unique ID or Password doesnt match"); location.href="facultylogin.php"</script>';
                }
            }
            if(isset($_POST['change']))
            {
                $dob = $_POST['dob'];
                $fuid = $_POST['fuid'];
                $npass = $_POST['npass'];
                $cpass = $_POST['cpass'];
                $sql1 =  "SELECT *FROM faculty_details where fuid='$fuid' and fdob='$dob' ";
                $r = mysqli_query($con, $sql1);
                if(mysqli_num_rows($r) == 1)
                {
                    if($npass == $cpass)
                    {
                        $sql2 = "UPDATE faculty_details SET fpwd='$npass' WHERE fuid='$fuid' and fdob='$dob'";
                        if(mysqli_query($con, $sql2))
                        {
                            echo '<script>alert("Password changed Successfully"); location.href="facultylogin.php"</script>';
                        }
                    }
                    if($npass != $cpass)
                    {
                        echo '<script>alert("New Passwords are not same"); location.href="facultylogin.php"</script>';
                    }
                }
                if(mysqli_num_rows($r) !== 1)
                {
                    echo '<script> alert("Unique Id or Date of Birth is incorrect"); location.href="facultylogin.php"</script>';
                }
            }
            ?>
            <div class="d3" style="margin-top: 10px;">
                <form class="f1" id="f1" action="" method="POST" autocomplete="off">
                    <h3>Faculty Login</h3>

                    <label class="l1">Unique ID</label>
                    <input class="i1" type="text" placeholder="Enter Unique ID" name="uid" id="username" required>

                    <label class="l1">Password</label>
                    <input class="i1" type="password" placeholder="Enter Password" name="pass" id="password" required>

                    <button class="b1" type="button" onclick="frpwd()" id="b1">Forget Password</button>

                    <input class="submit" type="submit" name="login">
                </form>

                <form class="f1" id="f2" action="" method="POST" autocomplete="off" style=" display: none;">
                    <h3>Forgot Password</h3>

                    <label class="l1">Unique ID</label>
                    <input class="i1" type="text" placeholder="Enter Unique ID" name="fuid" required>

                    <label class="l1">Date of Birth</label>
                    <input class="i1" type="date" name="dob"  required>

                    <label class="l1">New Password</label>
                    <input class="i1" type="password" placeholder="Enter New Password" name="npass" required>
            
                    <label class="l1">Re-Enter Password</label>
                    <input class="i1" type="password" placeholder="Re-Enter New Password" name="cpass" required>
        
                    <input class="submit" type="submit" name="change">
                </form>
            </div>
        </div>
    </body>
</html>