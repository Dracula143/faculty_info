<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/facultymenu.css">
        <link rel="stylesheet" type="text/css" href="css/faculty.css">
</head>
<body>
        <?php
                session_start();
                $uid = $_SESSION['id'];
                include 'db.php';
                include 'adminmenu.php';
        ?>
</body>
</html>
