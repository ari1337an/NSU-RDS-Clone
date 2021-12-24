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


    <div class="container_panel">
      <h3>Information</h3>
      Full Name:<?php echo "  " . $name ?> <br>
      ID:<?php echo "  " . $id ?> <br>
      Father's Name:<?php echo "  " . $fathers_name ?> <br>
      Mother's Name:<?php echo "  " . $mothers_name ?> <br>
      Department:<?php echo "  " . $dept ?> <br>
      Degree:<?php echo "  " . $degree ?> <br>
      CGPA:<?php echo "  " . $cgpa ?> <br>
      NID:<?php echo "  " . $nid ?> <br>
      Birth Registration Number:<?php echo "  " . $birth ?> <br>
      Gender:<?php echo "  " . $gender ?> <br>
      Citizenship:<?php echo "  " . $citzenship ?> <br>
    </div>

  




    
</body>

</html>