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


    <form method="POST">

        <table>
            <tr>
                <th>Faculty name</th>
                <th>Faculty Initial</th>
                <th>department</th>
                <th>phone number</th>
                <th>nid</th>
                <th>birth reg</th>
                <th>Date of birth</th>
                <th>gender</th>
                <th>citizenship</th>
            </tr>
            <?php
            $result = $APP_DB->query("
    SELECT * from faculty_profile where initial='" . $_GET['faculty_initial'] . "';
");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['initial'] ?></td>
                        <td><?php echo $row['department_name'] ?></td>
                        <td><?php echo $row['phone_number'] ?></td>
                        <td><?php echo $row['nid'] ?></td>
                        <td><?php echo $row['birth_reg_no'] ?></td>
                        <td><?php echo $row['dob'] ?></td>
                        <td><?php echo $row['gender'] ?></td>
                        <td><?php echo $row['citizenship'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
        <input type="hidden" name="form_submitted_by" value="<?php echo USERS::getUserName(); ?>">
        <input type="submit" name="request_for_attendance" value="Submit">
    </form>



</body>

</html>