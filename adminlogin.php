<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <title> Admin Login Page</title>
    </head>
    <body>
        <?php
        session_start();
        include 'db.php';
        include 'loginmenu.php';
        if(isset($_POST['login']))
        {
            $auid = $_POST['uid'];
            $apassword = $_POST['pass'];
            $_SESSION['id'] = $_POST['uid'];
            $sql = "SELECT * FROM admin where auid='$auid' and apwd='$apassword'";
            $result = mysqli_query($con,$sql);
            while($u = mysqli_fetch_array($result))
            {
                if($auid === $u['auid'] && $apassword === $u['apwd'])
                {
                    echo '<script>alert("Login Sucessfull");
                    location.href="adminb.php"</script>';
                }
                if($auid !== $u['auid'] || $apassword !== $u['apwd'])
                {
                    echo '<script>alert("Unique ID or Password doesnt match");
                    location.href="adminlogin.php"</script>';
                }
            }
        }
        ?>
    <form class="f1" id="f1" action="" method="POST" autocomplete="off">
        <h3 class="h2"> Admin Login </h3>

        <label class="l1" >Unique ID</label>
        <input class="i1" type="text" placeholder="Enter Unique ID" name="uid" id="username" required>

        <label class="l1" for="password">Password</label>
        <input class="i1" type="password" placeholder="Enter Password" name="pass" id="password" required>

        <input class="submit" type="submit" name="login">
    </form>
</body>
</html>