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
        <h2 class="table_desc">Faculty Profile</h2>
        <div class="profile_info">
            <form action="edit_faculty_profile.php" method="post">
                <?php
                $result = $APP_DB->query("
    SELECT * from faculty_profile where initial='" . $_GET['faculty_initial'] . "';
");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>




                        <div class="profile_info_row">
                            <div class="profile_info_name">Full Name:</div>
                            <div class="profile_info_value"><?php echo $row['name']; ?></div>
                        </div>

                        <div class="profile_info_row">
                            <div class="profile_info_name">Initial:</div>
                            <div class="profile_info_value"><?php echo $row['initial']; ?></div>
                        </div>

                        <div class="profile_info_row">
                            <div class="profile_info_name">Department:</div>
                            <div class="profile_info_value"><?php echo $row['department_name']; ?></div>
                        </div>
                        <div class="profile_info_row">
                            <div class="profile_info_name">Phone:</div>
                            <div class="profile_info_value"><?php echo $row['phone_number']; ?></div>
                        </div>

                        <div class="profile_info_row">
                            <div class="profile_info_name">NID:</div>
                            <div class="profile_info_value"><?php echo $row['nid']; ?></div>
                        </div>

                        <div class="profile_info_row">
                            <div class="profile_info_name">Birth Registration Number:</div>
                            <div class="profile_info_value"><?php echo $row['birth_reg_no']; ?></div>
                        </div>

                        <div class="profile_info_row">
                            <div class="profile_info_name">Gender:</div>
                            <div class="profile_info_value"><?php echo $row['gender']; ?></div>
                        </div>
                        <div class="profile_info_row">
                            <div class="profile_info_name">Citizenship:</div>
                            <div class="profile_info_value"><?php echo $row['citizenship']; ?></div>
                        </div>





                <?php
                    }
                }
                ?>
                <input type="hidden" name="form_submitted_for" value="<?php echo $_GET['faculty_initial']; ?>">
                <input class="btn btn-green btn-green-create" type="submit" name="request_for_edit" value="Edit Profile">
        </div>

    </div>

    </form>
    </div>
    <br>


    </div>


</body>

</html>