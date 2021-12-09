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

  <section class="welcome_text">
    Welcome <?php echo USERS::getUserName(); ?>
    <div class="welcome_border_bottom"></div>

  </section>

  <div class="data">
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
    <div class="nav_bar">
      <ul>
        <li><a href="#">General Infromation</a></li>
        <li><a href="#">Personal Infromation</a></li>
      </ul>

    </div>

    <br><br>

    <div class="Gen">
      General Information
    </div>

    <br>
    <br>

    <div class="profile-user-info">
      <div class="profile-info-row">
        <div class="profile-info-name">Full Name:<?php echo "  " . $name ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">Faculty Initial:<?php echo "  " . $initial ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-Degree">Department Name:<?php echo "  " . $department_name ?></div>
        <div class="profile-info-Degree-name">
        </div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-Credits">Phone Number:<?php echo "  " . $phone_no ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">NID:<?php echo "  " . $nid ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">Birth Certificate Number:<?php echo "  " . $birth ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">Date of Birth:<?php echo "  " . $date_of_birth ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">Gender:<?php echo "  " . $gender ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">Citizenship:<?php echo "  " . $citzenship ?></div>
      </div>




    </div>



</body>

</html>