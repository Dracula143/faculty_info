<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Faculty Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/facultymenu.css">
        <link rel="stylesheet" type="text/css" href="css/faculty.css">
</head>
<body style="margin: 0px 0px 0px 0px; background-image: url(Images/college.png);">
        <?php
                session_start();
                $uid = $_SESSION['id'];
                include 'db.php';
                include 'facultymenu.php';
        ?>
</body>
</html>
