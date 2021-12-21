<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 0; // determines which page is currently ON on the subheader

// Restrict the view to only Faculty
if (!USERS::isLoggedFaculty()) {
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
    <title>Welcome | Faculty Panel</title>
</head>

<body>
    <?php include "../template/header.php"; ?>
    <?php include "../template/sub_header.php"; ?>

    <section class="landing_welcome">
        Welcome <?php echo USERS::getUserName(); ?>
        <div class="landing_welcome_border_bottom"></div>
    </section>


    <div class="container_panel">
        <?php
        if (isset($_GET['submitted_grades']) && $_GET['submitted_grades'] = 1) {
        ?>

            <div class="message">
                Successfully Submitted Grades!
            </div>

        <?php
        }
        if (isset($_GET['submitted_attendance']) && $_GET['submitted_attendance'] = 1) {
        ?>

            <div class="message">
                Successfully Submitted Attendace !
            </div>

        <?php
        }
        ?>
    </div>



</body>

</html>