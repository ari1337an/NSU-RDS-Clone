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


if (isset($_POST['password']) && isset($_POST['dept']) && isset($_POST['phone']) && isset($_POST['nid']) && isset($_POST['birth_reg_no'])) {

    $pass = $_POST["password"];
    $dept = $_POST["dept"];
    $phone = $_POST["phone"];
    $NID = $_POST["nid"];
    $birth_reg_no = $_POST["birth_reg_no"];

    $result = $APP_DB->query("SELECT count(*) as count FROM faculties WHERE username='" . $_POST['form_submitted_for'] . "'");
    $cnt = $result->fetch_object()->count;

    if ($cnt == 0) {
        echo "User Doesn't exist";
    } else {

        if ($cnt > 0 && ctype_digit($phone) && ctype_digit($NID) && ctype_digit($birth_reg_no)) {
            $query = "
            UPDATE faculties
            SET password='$pass'
            where username='" . $_POST['form_submitted_for'] . "'";
            $query2 = "
            UPDATE faculty_profile
            SET department_name='" . $dept . "', phone_number=" . $phone . ", nid=" . $NID . ", birth_reg_no=" . $birth_reg_no . "
            WHERE initial='" . $_POST['form_submitted_for'] . "'";

            if ($APP_DB->query($query) && $APP_DB->query($query2)) {
                echo "Profile Updated for " . $_POST['form_submitted_for'] . " !";
            } else {
                die("Failed!");
            }
        } else {
            die("Invalid Input!");
        }
        header("Location: ./index.php?updated_profile=1");
        exit;
    }
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
        <h2 class="table_desc">Edit Faculty Profile</h2>
        <div class="profile_info">
            <form action="edit_faculty_profile.php" method="post">
                <?php
                $fac_initial = $_POST['form_submitted_for'];
                $password_res = $APP_DB->query("
            SELECT PASSWORD from faculties where USERNAME='" . $_POST['form_submitted_for'] . "'
            ");
                $pass = null;
                if (mysqli_num_rows($password_res) == 1) {
                    while ($row = mysqli_fetch_assoc($password_res)) {
                        $pass = $row['PASSWORD'];
                    }
                }
                $result = $APP_DB->query("
    SELECT * from faculty_profile where initial='" . $_POST['form_submitted_for'] . "';
");

                if (mysqli_num_rows($result) > 0) {
                    while ($val = mysqli_fetch_assoc($result)) {
                ?>

                        <div class="profile_info_row">
                            <div class="profile_info_name">Full Name:</div>
                            <div class="profile_info_value"><?php echo $val['name']; ?></div>
                        </div>

                        <div class="profile_info_row">
                            <div class="profile_info_name">Initial:</div>
                            <div class="profile_info_value"><?php echo $val['initial']; ?></div>
                        </div>
                        <div class="profile_edit_row">
                            <label class="profile_edit_name">Password:</label>
                            <input class="profile_edit_input" type="password" name="password" value=<?php echo $pass ?> required><br>
                        </div>
                        <div class="profile_edit_row">
                            <label class="profile_edit_name">Department Name:</label>
                            <input class="profile_edit_input" type="text" name="dept" value=<?php echo $val['department_name'] ?> required><br>
                        </div>
                        <div class="profile_edit_row">
                            <label class="profile_edit_name">Phone No:</label>
                            <input class="profile_edit_input" type="text" name="phone" value=<?php echo $val['phone_number'] ?> required><br>
                        </div>
                        <div class="profile_edit_row">
                            <label class="profile_edit_name">NID:</label>
                            <input class="profile_edit_input" type="text" name="nid" value=<?php echo $val['nid'] ?> required><br>
                        </div>
                        <div class="profile_edit_row">
                            <label class="profile_edit_name">Birth Registration Number:</label>
                            <input class="profile_edit_input" type="text" name="birth_reg_no" value=<?php echo $val['birth_reg_no'] ?> required><br>
                        </div>

                <?php
                    }
                }
                ?>
                <input type="hidden" name="form_submitted_for" value="<?php echo $fac_initial; ?>">
                <input class="btn btn-green btn-green-create" type="submit" value="Update">

            </form>
        </div>
        <br>




    </div>



</body>

</html>