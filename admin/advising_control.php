<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 1; // determines which page is currently ON on the subheader

// Restrict the view to only Admin
if (!USERS::isLoggedAdmin()) {
    header("Location: ../index.php");
    exit;
}


if (isset($_POST['toggle_form'])) {
    $result = $APP_DB->query("SELECT offer_status FROM course_list WHERE course_id='" . $_POST['toggle_what'] . "'");
    $status = $result->fetch_object()->offer_status;
    $toggle_val = (int)(!(boolval($status)));
    $result = $APP_DB->query("UPDATE course_list SET offer_status=$toggle_val WHERE course_id='" . $_POST['toggle_what'] . "'", true);
    header("Location: ./advising_control.php");
    exit;
}


if (isset($_POST['new_course_create_form'])) {
    $val_id = $_POST['course_id'];
    $val_name = $_POST['course_name'];
    $val_onoff = (int)(isset($_POST['OnOff']));
    $result = $APP_DB->query("SELECT * FROM course_list WHERE course_id='" . $_POST['course_id'] . "'");
    $count = mysqli_num_rows($result);
    if ($count != 0) {
        die("Already that course exists!");
    } else {
        $APP_DB->query("INSERT INTO course_list(course_id,course_name,offer_status) VALUES('" . $val_id . "','" . $val_name . "',$val_onoff);");
        $APP_DB->query("INSERT INTO teaches(course_id, who_is_teaching) VALUES('" . $val_id . "', '" . $_POST['taught_by'] . "');", true);
        header("Location: ./advising_control.php");
        exit;
    }
}


if (isset($_POST['save_advising_settings'])) {
    $APP_DB->query("UPDATE site_settings SET settings_value='" . $_POST['advising_state'] . "' WHERE settings_name='advising_state'");
    header("Location: ./advising_control.php");
    exit;
}


function get_fac_teach_name($course_id)
{
    global $APP_DB;
    $result = $APP_DB->query("SELECT who_is_teaching FROM teaches WHERE course_id='" . $course_id . "'");
    if (mysqli_num_rows($result) == 0) {
        echo "None";
    } else {
        $row = mysqli_fetch_assoc($result);
        echo $row['who_is_teaching'];
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
    <title>Welcome | Admin Panel</title>
</head>

<body>
    <?php include "../template/header.php"; ?>
    <?php include "../template/sub_header.php"; ?>

    <div class="container_panel">
        <div class="course_assign"></div>
        <?php if (isset($_POST['create_new_course_form']) && $_POST['create_new_course'] == true) { ?>

            <h2 class="table_desc">Create A New Course</h2>
            <form method="POST">
                <div class="course_assign_row">
                    <label class="course_assign_name" for="course_id" class="">Course ID: </label>
                    <input class="course_assign_input" type="text" required name="course_id" id="course_id"><br>
                </div>

                <div class="course_assign_row">
                    <label class="course_assign_name" for="course_name">Course Name: </label>
                    <input class="course_assign_input" type="text" required name="course_name" id="course_name"><br>
                </div>

                <div class="course_assign_row">
                    <label class="course_assign_name" for="OnOff">Taught By?</label>
                    <select class="course_assign_input" name="taught_by" id="taught_by">
                        <?php
                        $result = $APP_DB->query("SELECT username FROM faculties");
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['username'] ?>"><?php echo $row['username'] ?></option>
                        <?php } ?>
                    </select><br>
                </div>

                <div class="course_assign_row">
                    <label class="course_assign_name" for="OnOff">Is Offering?</label>
                    <input class="course_assign_input" type="checkbox" name="OnOff" id="OnOff"><br>
                </div>

                <input class="btn btn-green btn-green-create" type="submit" name="new_course_create_form" value="Create Course"> <br>
            </form>

        <?php } else { ?>
            <?php
            $result = $APP_DB->query("SELECT settings_value FROM site_settings WHERE settings_name='advising_state'");
            $advising_state = $result->fetch_object()->settings_value;

            function auto_select_this_radio($val)
            {
                global $advising_state;
                if ($val == $advising_state) echo "checked";
            }
            ?>
            <form method="POST">
                <h2 class="table_desc">Advising Settings:</h2>
                <input type="radio" name="advising_state" id="advising_state_off" value="0" <?php auto_select_this_radio(0); ?>>
                <label for="advising_state_off">Off</label><br>
                <input type="radio" name="advising_state" id="advising_state_on" value="1" <?php auto_select_this_radio(1); ?>>
                <label for="advising_state_off">On</label><br>
                <input type="radio" name="advising_state" id="advising_state_end" value="2" <?php auto_select_this_radio(2); ?>>
                <label for="advising_state_off">Ended</label><br>
                <input class="btn btn-green" type="submit" name="save_advising_settings" value="Save">
            </form><br><br>

            <h2 class="table_desc">Course Settings:

            </h2>

            <form method="POST">
                <input type="hidden" name="create_new_course" value="true">
                <input class="btn btn-green" type="submit" name="create_new_course_form" value="Create New Course"><br> <br>
            </form>

            <form action="advising_control.php" method="get">
            <div class="container-right">
                <div>
                    <input class="search_input" placeholder="Type Course ID" type="text" name="search">
                </div>
                <input class="btn btn-blue" type="submit" value="Search By ID">
            </div>
        </form>

        



            <table class="full_page_table">
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Is Offering</th>
                    <th>Taught By</th>
                    <th>Offer Control</th>
                </tr>

                <?php
                if (isset($_GET['search']) && $_GET['search'] != "") {
                    $result = $APP_DB->query("SELECT course_id, course_name, offer_status from course_list WHERE course_id LIKE '%" . $_GET['search'] . "%'  order by  course_name");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                ?>
                            <tr>
                                <td><?php echo $row['course_id']; ?></td>
                                <td><?php echo $row['course_name'] ?></td>
                                <td><?php echo $row['offer_status'] ?></td>
                                <td><?php echo get_fac_teach_name($row['course_id']); ?></td>
                                <td>
                            <form method="POST">
                                <input type="hidden" name="toggle_what" value="<?php echo $row['course_id']; ?>">


                                <?php

                                if ($row['offer_status'] == 1) {
                                ?>
                                    <input class="btn btn-red" type="submit" name="toggle_form" value="Turn Off">
                                <?php
                                } else {
                                ?>
                                    <input class="btn btn-green" type="submit" name="toggle_form" value="Turn On">
                                <?php
                                }


                                ?>


                            </form>
                        </td>
                               
                            </tr>
                    <?php
                        }
                    }
                    ?>
                    <?php
                }

                else{
               
                $result = $APP_DB->query("SELECT * FROM course_list");
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['course_id']; ?></td>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo (($row['offer_status'] == 1) ? "YES" : "NO"); ?></td>
                        <td><?php echo get_fac_teach_name($row['course_id']); ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="toggle_what" value="<?php echo $row['course_id']; ?>">


                                <?php

                                if ($row['offer_status'] == 1) {
                                ?>
                                    <input class="btn btn-red" type="submit" name="toggle_form" value="Turn Off">
                                <?php
                                } else {
                                ?>
                                    <input class="btn btn-green" type="submit" name="toggle_form" value="Turn On">
                                <?php
                                }


                                ?>


                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                    
                <?php
                }
                ?>

            </table><br>

        <?php } ?>
    </div>
</body>

</html>