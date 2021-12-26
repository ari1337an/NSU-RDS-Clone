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
    <title>Faculty | Admin Panel</title>
</head>

<body>
    <?php include "../template/header.php"; ?>
    <?php include "../template/sub_header.php"; ?>

    <div class="container_panel">

    <div class="view_faculty">
        <h3>Faculty Profile</h3>
        <br>
        <form action="edit_faculty_profile.php" method="post">
            <?php
            $result = $APP_DB->query("
    SELECT * from faculty_profile where initial='" . $_GET['faculty_initial'] . "';
");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>

 
                    <label>Name: <?php echo $row['name'] ?></label><br>
                    <br>
                    <label>Initial: <?php echo $row['initial'] ?></label><br>
                    <br>
                    <label>Date of Birth: <?php echo $row['dob'] ?></label><br>
                    <br>
                    <label>Department Name: <?php echo $row['department_name'] ?></label><br>
                    <br>
                    <label>Phone No: <?php echo $row['phone_number'] ?></label><br>
                    <br>
                    <label>NID: <?php echo $row['nid'] ?></label><br>
                    <br>
                    <label>Birth Registration Number: <?php echo $row['birth_reg_no'] ?></label><br>
                    <br>
                    <label>Gender: <?php echo $row['gender'] ?></label><br>
                    <br>
                    <label>citizenship: <?php echo $row['citizenship'] ?></label><br>
                    <br>


            <?php
                }
            }
            ?>
            <input type="hidden" name="form_submitted_for" value="<?php echo $_GET['faculty_initial']; ?>">
            <input type="submit" name="request_for_edit" value="Edit Profile">

        </form>
    </div>
    <br>


    </div>


</body>

</html>