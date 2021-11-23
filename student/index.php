<?php 
    // Start the Application
    include "../app.php";

    // Define the Template Variables
    $template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy

    // Restrict the view to only Admin
    if(!USERS::isLoggedStudent()){
        header("Location: ../index.php");
        exit;
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
    <link rel="stylesheet" href="../src/css/styles.css">
    <title>Welcome | Admin Panel</title>
</head>
<body>
    <?php include "../template/header.php"; ?>
    Welcom to student panel, <a href="../logout.php">Logout?</a>? 
</body>
</html>