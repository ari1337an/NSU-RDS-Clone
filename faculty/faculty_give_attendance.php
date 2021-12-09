<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 3; // determines which page is currently ON on the subheader

// Restrict the view to only Admin
if (!USERS::isLoggedFaculty()) {
    header("Location: ../index.php");
    exit;
}
if(isset($_POST['present_student'])){

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
    <title>Welcome | Student Panel</title>
</head>

<body>
    <?php include "../template/header.php"; ?>
    <?php include "../template/sub_header.php"; ?>

    <!-- <section class="welcome_text">
        Welcome <?php echo USERS::getUserName(); ?>
        <div class="welcome_border_bottom"></div>
    </section> -->

    <div class="assigned-student-list">
        <form action="submit_attendance.php" method="get">
        <?php
        if (USERS::isLoggedFaculty()) {
            // $current = $template_vars["course_name"];
            $current = $_POST['selected_course'];
            // echo $current . " ";
            $result = $APP_DB->query("SELECT * FROM taking WHERE course_id='$current'");
            $all_students = [];
            while($row = $result->fetch_assoc()){
                $student_id = $row['who_is_taking'];
                $all_students[] = $row;
                // echo $student_id . " ";
                echo "<input type = \"checkbox\" name=\"present_student\" value=\"$student_id\" checked>";
                echo "<label>$student_id</label>";
                echo "<br>";
            }
            ?>
            <input type="submit">
            </form>
            <?php
        }
        ?>
            
    </div>

</body>

</html>