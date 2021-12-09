<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 5; // determines which page is currently ON on the subheader

// Restrict the view to only Admin
if (!USERS::isLoggedAdmin()) {
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
    <title>Attendance | Faculty Panel</title>
</head>

<body>
    <?php include "../template/header.php"; ?>
    <?php include "../template/sub_header.php"; ?>


    <section>
        <form method="POST">
            <table>
                <tr>
                    <th>name</th>
                </tr>
                <tr>
                    <th>Initial</th>
                </tr>
                <tr>td</tr>
            </table>
            <input type="hidden" name="form_submitted_by" value="<?php echo USERS::getUserName(); ?>">
            <input type="submit" name="request_for_attendance" value="Submit">
        </form>
    </section>



</body>

</html>