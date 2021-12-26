<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 4; // determines which page is currently ON on the subheader

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
    <title>Grade | Faculty Panel</title>
</head>

<body>
    <?php include "../template/header.php"; ?>
    <?php include "../template/sub_header.php"; ?>

    <div class="container_panel">
    <table class="full_page_table">
        <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Take Attandance</th>
        </tr>
<?php 
$result = $APP_DB->query("
SELECT t.course_id as 'course_id', c.course_name as 'course_name'
FROM teaches as t JOIN course_list as c ON  t.course_id=c.course_id AND c.offer_status=1 AND t.who_is_teaching='".USERS::getUserName()."';
");
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['course_name']?></td>
            <td><a href="./submit_grades.php?course_id=<?php echo $row['course_id'];?>" class="btn">Submit</a></td>
        </tr>
        <?php
    }
}
?>    
    </table>
    </div>
 

</body>

</html>