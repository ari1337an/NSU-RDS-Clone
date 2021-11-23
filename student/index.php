<?php

if (isset($_COOKIE['user_id'])) {
    echo "User is logged in and his user role code is" . $_COOKIE['user_role'] . " and username is " . $_COOKIE['logged_user'];
} else {
    echo "you didnt login";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../include/css/styles.css">
    <title>Welcome</title>
</head>

<body>
    <?php
    $imageLocation = '../include/img/logo-wide.png';
    $headerLocation = "../template/header.php";
    include $headerLocation ?>
</body>

</html>