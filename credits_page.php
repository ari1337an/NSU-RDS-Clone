<?php
require 'app.php';
$template_vars["get_hierarchy"] = "./";
if (USERS::isLogged()) {
    if (USERS::isLoggedAdmin()) {
        header("Location: ./admin/index.php");
        exit;
    } else if (USERS::isLoggedStudent()) {
        header("Location: ./student/index.php");
        exit;
    } else if (USERS::isLoggedFaculty()) {
        header("Location: ./faculty/index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/css/styles.css">
    <title>Credits</title>
</head>

<body>
    <?php include 'template/header.php'; ?>
    <div class="avatar-details">
        <div class="user-image">
            <img class="user-avatar" src="./src/img/fahid.jpg" alt="" width="250px" height="250px">
        </div>
        <div class="user-details">
            <div class="user-name">Fahid Shadman Karim</div>
            <div class="user-id">1911110642</div>
            <div class="user-email"><a href="mailto: fahid.karim@northsouth.edu"> fahid.karim@northsouth.edu</a></div>
        </div>
    </div>
    <div class="avatar-details">
        <div class="user-image">
            <img class="user-avatar" src="./src/img/arian.jpg" alt="" width="250px" height="250px">
        </div>
        <div class="user-details">
            <div class="user-name">Md Sahadul Hasan Arian</div>
            <div class="user-id">2011084642</div>
            <div class="user-email"><a href="mailto: hasan.arian@northsouth.edu"> hasan.arian@northsouth.edu</a></div>
        </div>
    </div>
    <div class="avatar-details">
        <div class="user-image">
            <img class="user-avatar" src="./src/img/sifat.jpg" alt="" width="250px" height="250px">
        </div>
        <div class="user-details">
            <div class="user-name">Faisal Ahmed Sifat</div>
            <div class="user-id">2011188642</div>
            <div class="user-email"><a href="mailto: faisal.ahmed20@northsouth.edu"> faisal.ahmed20@northsouth.edu</a></div>
        </div>
    </div>
</body>

</html>