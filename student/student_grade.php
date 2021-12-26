<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 4; // determines which page is currently ON on the subheader

// Restrict the view to only Student
if (!USERS::isLoggedStudent()) {
    header("Location: ../index.php");
    exit;
}

function val_to_letter($val){
    if($val == "4.0") return "A";
    if($val == "3.7") return "A-";
    if($val == "3.3") return "B+";
    if($val == "3.0") return "B";
    if($val == "2.7") return "B-";
    if($val == "2.3") return "C+";
    if($val == "2.0") return "C";
    if($val == "1.7") return "C-";
    if($val == "1.3") return "D+";
    if($val == "1.0") return "D";
    if($val == "0.0") return "F";
}

function letter_to_val($letter){
    if($letter == "A") return "4.0";
    if($letter == "A-") return "3.7";
    if($letter == "B+") return "3.3";
    if($letter == "B") return "3.0";
    if($letter == "B-") return "2.7";
    if($letter == "C+") return "2.3";
    if($letter == "C") return "2.0";
    if($letter == "C-") return "1.7";
    if($letter == "D+") return "1.3";
    if($letter == "D") return "1.0";
    if($letter == "F") return "0.0";
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
    <title>Grades | Student Panel</title>
</head>

<body>
    <?php include "../template/header.php"; ?>
    <?php include "../template/sub_header.php"; ?>


    <div class="container_panel">
    <table class="full_page_table">
        <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Grade</th>
        </tr>

<?php 

$result = $APP_DB->query("
    SELECT g.course_id as 'course_id', c.course_name as 'course_name', g.grade_value as 'grade_value'
    FROM grades as g JOIN course_list as c ON g.course_id=c.course_id
    WHERE given_to='".USERS::getUserName()."';
");

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        ?>
            <tr>
                <td><?php echo $row['course_id'];?></td>
                <td><?php echo $row['course_name'];?></td>
                <td><?php echo val_to_letter($row['grade_value']);?></td>
            </tr>
        <?php
    }
}

?>

    </table>
    </div>


</body>

</html>