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
      <h3>Information</h3>
      Full Name:<?php echo "  " . $name ?><br>
      Faculty Initial:<?php echo "  " . $initial ?><br>
      Department Name:<?php echo "  " . $department_name ?><br>
      Phone Number:<?php echo "  " . $phone_no ?><br>
      NID:<?php echo "  " . $nid ?><br>
      Birth Certificate Number:<?php echo "  " . $birth ?><br>
      Date of Birth:<?php echo "  " . $date_of_birth ?><br>
      Gender:<?php echo "  " . $gender ?><br>
      Citizenship:<?php echo "  " . $citzenship ?><br>
    </div>



</body>

</html>