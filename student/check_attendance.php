<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 3; // determines which page is currently ON on the subheader

// Restrict the view to only Faculty
if (!USERS::isLoggedStudent()) {
    header("Location: ../index.php");
    exit;
}

$count = $APP_DB->query("SELECT count(*) as count FROM taking WHERE course_id='" . $_GET['course_id'] . "' AND who_is_taking='" . USERS::getUserName() . "'")->fetch_object()->count;
if ($count != 1) {
    die("You are not enrolled in " . $_GET['course_id']);
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

    <div class="container_panel center_panel">


    <h3>Attendance For <?php echo $_GET['course_id']; ?></h3>

    <section>
        <form method="POST">
            <table>
                <tr>
                    <th>Submission Date</th>
                    <th>Attended</th>
                </tr>
                <?php
                $result = $APP_DB->query("
    select a.at_which_date as 'lecture_date', a.is_present as 'status'
from attendance as a
where a.course_id='" . $_GET['course_id'] . "' and a.given_to=" . USERS::getUserName() . ";
");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $stat = null;
                        if($row['status'])$stat = "YES";
                        else $stat = "NO";
                ?>
                        <tr>
                            <td><?php echo $row['lecture_date']; ?></td>
                            <td><?php echo $stat ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </form>
    </section>



    </div>
</body>

</html>