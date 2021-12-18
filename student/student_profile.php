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
    $result = $APP_DB->query("SELECT * FROM student_profile WHERE id = '$current'");
    while ($row = $result->fetch_assoc()) {
      $id = $row['id'];
      $name = $row['name'];
      $fathers_name = $row['fathers_name'];
      $mothers_name = $row['mothers_name'];
      $dept = $row['department_name'];
      $degree = $row['degree'];
      $cgpa = $row['cgpa'];
      $birth = $row['birth_reg_no'];
      $credits = $row['credits'];
      $date_of_birth = $row['dob'];
      $nid = $row['nid'];
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
       Information
    </div>

    <br>
    <br>

    <div class="profile-user-info">
      <div class="profile-info-row">
        <div class="profile-info-name">Full Name:<?php echo "  " . $name ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">ID:<?php echo "  " . $id ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-Degree">Father's Name:<?php echo "  " . $fathers_name ?></div>
        <div class="profile-info-Degree-name">
        </div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-Credits">Mother's Name:<?php echo "  " . $mothers_name ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">Department:<?php echo "  " . $dept ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">Degree:<?php echo "  " . $degree ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">Credits:<?php echo "  " . $credits ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">CGPA:<?php echo "  " . $cgpa ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">NID:<?php echo "  " . $nid ?></div>
      </div>
      <br>
      <div class="profile-info-row">
        <div class="profile-info-ID">Birth Registration Number:<?php echo "  " . $birth ?></div>
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