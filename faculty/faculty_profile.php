<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 1; // determines which page is currently ON on the subheader

// Restrict the view to only Admin
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
  <title>Welcome | Student Panel</title>
</head>

<body>
  <?php include "../template/header.php"; ?>
  <?php include "../template/sub_header.php"; ?>

  <?php

  $current = USERS::getUserName();
  $result = $APP_DB->query("SELECT * FROM faculty_profile WHERE initial= '$current'");
  while ($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $initial = $current;
    $department_name = $row['department_name'];
    $phone_no = $row['phone_number'];
    $nid = $row['nid'];
    $birth = $row['birth_reg_no'];
    $date_of_birth = $row['dob'];
    $gender = $row['gender'];
    $citzenship = $row['citizenship'];
  }

  ?>

  <div class="container_panel">
    <h2 class="table_desc">Information</h2>
    <div class="profile_info">

      <div class="profile_info_row">
        <div class="profile_info_name">Full Name:</div>
        <div class="profile_info_value"><?php echo $name; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">Initial:</div>
        <div class="profile_info_value"><?php echo $initial; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">Department:</div>
        <div class="profile_info_value"><?php echo $department_name; ?></div>
      </div>
      <div class="profile_info_row">
        <div class="profile_info_name">Phone:</div>
        <div class="profile_info_value"><?php echo $phone_no; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">NID:</div>
        <div class="profile_info_value"><?php echo $nid; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">Birth Registration Number:</div>
        <div class="profile_info_value"><?php echo $birth; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">Gender:</div>
        <div class="profile_info_value"><?php echo $gender; ?></div>
      </div>
      <div class="profile_info_row">
        <div class="profile_info_name">Citizenship:</div>
        <div class="profile_info_value"><?php echo $citzenship; ?></div>
      </div>
    </div>

  </div>



</body>

</html>