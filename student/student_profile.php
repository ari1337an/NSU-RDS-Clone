<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 1; // determines which page is currently ON on the subheader

// Restrict the view to only Admin
if (!USERS::isLoggedStudent()) {
  header("Location: ../index.php");
  exit;
}

USERS::calculateCgpa(USERS::getUserName());


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
  $result = $APP_DB->query("SELECT * FROM student_profile WHERE id = '$current'");
  while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $name = $row['name'];
    $fathers_name = $row['fathers_name'];
    $mothers_name = $row['mothers_name'];
    $dept = $row['department_name'];
    $degree = $row['degree'];
    $cgpa = $row['cgpa'];
    $phone_no = $row['phone_number'];
    $birth = $row['birth_reg_no'];
    $credits = $row['credits'];
    $date_of_birth = $row['dob'];
    $nid = $row['nid'];
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
        <div class="profile_info_name">ID:</div>
        <div class="profile_info_value"><?php echo $id; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">Father's Name:</div>
        <div class="profile_info_value"><?php echo $fathers_name; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">Mother's Name:</div>
        <div class="profile_info_value"><?php echo $mothers_name; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">Date of Birth:</div>
        <div class="profile_info_value"><?php echo $date_of_birth; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">Department:</div>
        <div class="profile_info_value"><?php echo $dept; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">Degree:</div>
        <div class="profile_info_value"><?php echo $degree; ?></div>
      </div>

      <div class="profile_info_row">
        <div class="profile_info_name">CGPA:</div>
        <div class="profile_info_value"><?php echo $cgpa; ?></div>
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