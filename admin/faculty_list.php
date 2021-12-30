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
    <title>Faculty List | Admin Panel</title>
</head>

<body>
    <?php include "../template/header.php"; ?>
    <?php include "../template/sub_header.php"; ?>

    <div class="container_panel container_left_fix">
        <?php
        if (isset($_GET['search']) && $_GET['search'] != "") {
        ?>
            <div class="left_container">Showing result for <?php echo $_GET['search']; ?></div>
        <?php
        }
        ?>
        <form action="faculty_list.php" method="get">
            <div class="container-right">
                <div>
                    <input class="search_input" placeholder="Type Initial" type="text" name="search">
                </div>
                <input class="btn btn-blue" type="submit" value="Search By ID">
            </div>
        </form>
        <table class="full_page_table">
            <tr>
                <th>Name</th>
                <th>ID</th>
                <th>Department</th>
                <th>Profile</th>
            </tr>
            <?php if (isset($_GET['search']) && $_GET['search'] != "") {
                $result = $APP_DB->query("select name, initial, department_name from faculty_profile where initial LIKE '%" . $_GET['search'] . "%'  order by  initial");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['initial'] ?></td>
                            <td><?php echo $row['department_name'] ?></td>
                            <td><a href="./show_faculty_profile.php?initial=<?php echo $row['initial']; ?>" class="btn">View</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
                <?php
            } else {
                $result = $APP_DB->query("select name, initial, department_name from faculty_profile order by (initial) asc");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['initial'] ?></td>
                            <td><?php echo $row['department_name'] ?></td>
                            <td><a href="./show_faculty_profile.php?initial=<?php echo $row['initial']; ?>" class="btn">View</a></td>
                        </tr>
            <?php
                    }
                }
            }
            ?>
        </table>
    </div>
    

</body>

</html>