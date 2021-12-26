<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 3; // determines which page is currently ON on the subheader

// Restrict the view to only Faculty
if (!USERS::isLoggedFaculty()) {
    header("Location: ../index.php");
    exit;
}
$count = $APP_DB->query("SELECT count(*) as count FROM teaches WHERE course_id='" . $_GET['course_id'] . "' AND who_is_teaching='" . USERS::getUserName() . "'")->fetch_object()->count;
if ($count != 1) {
    die("You don't teach at " . $_GET['course_id']);
}

if (isset($_POST['request_for_attendance'])) {
    $result = $APP_DB->query("
        SELECT t.course_id as 'course_id', s.id as 'student_id', s.name	as 'student_name'
        FROM taking as t JOIN student_profile as s ON t.who_is_taking=s.id
        AND t.course_id='" . $_GET['course_id'] . "';
    ");

    $form_submitted_by = $_POST['form_submitted_by'];
    $form_course_id = $_POST['form_course_id'];

    if (mysqli_num_rows($result) > 0) {
        $todays_date = date("Y-m-d"); //stores todays date.

        while ($row = mysqli_fetch_assoc($result)) {
            $cur_id = $row['student_id'];
            error_reporting(E_ERROR | E_PARSE); //suppress warning

            $cur_status = 0;
            if(isset($_POST[$cur_id])){
                $cur_status = 1;
            }
            $newresult = $APP_DB->query("
            SELECT at_which_date from attendance where at_which_date='" . $todays_date . "' and given_to=". $cur_id ."
            ");
            if(mysqli_num_rows($newresult) > 0){
                $APP_DB->query("
                UPDATE attendance 
                SET is_present=".$cur_status.", at_which_date='".$todays_date."' 
                WHERE given_to=".$cur_id."
                ");
            }else{
                $APP_DB->query("
                    INSERT INTO attendance(course_id,submitted_by, given_to, is_present, at_which_date)
                    VALUES('" . $form_course_id . "', '" . $form_submitted_by . "', '" . $cur_id . "', " . $cur_status . ", '" . $todays_date . "');
            ");
            }
        }
    }
    header("Location: ./index.php?submitted_attendance=1");
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

    <div class="container_panel center_panel">


    <h3>Submitting attendance For <?php echo $_GET['course_id']; ?></h3>

    <section>
        <form method="POST">
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Attendance</th>
                </tr>
                <?php
                $result = $APP_DB->query("
    SELECT t.course_id as 'course_id', s.id as 'student_id', s.name	as 'student_name'
    FROM taking as t JOIN student_profile as s ON t.who_is_taking=s.id
    AND t.course_id='" . $_GET['course_id'] . "';
");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['student_id']; ?></td>
                            <td><?php echo $row['student_name'] ?></td>
                            <td><input type="checkbox" name="<?php echo $row['student_id'] ?>" checked></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
            <input type="hidden" name="form_course_id" value="<?php echo $_GET['course_id']; ?>">
            <input type="hidden" name="form_submitted_by" value="<?php echo USERS::getUserName(); ?>">
            <input type="submit" name="request_for_attendance" value="Submit">
        </form>
    </section>



    
    </div>
</body>

</html>