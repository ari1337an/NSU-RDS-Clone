<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 2; // determines which page is currently ON on the subheader

// Restrict the view to only Admin
if (!USERS::isLoggedStudent()) {
    header("Location: ../index.php");
    exit;
}
       $current = USERS::getUserName();
       $result = $APP_DB->query("SELECT * FROM course_list");
       $courses = array();
       while($row = $result->fetch_assoc()){
           $courses[] = $row; 
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

    <form action="student_advising.php">
        <select>
        <?php
      
        
        foreach($courses as $course){
            ?>
            <option value="<?php echo $course['course_id'];?>"><?php echo $course['course_id'];?></option>
            <?php
        }
        ?>
        </select>

        <input type="submit" value="Add" name="Add">
        <input type="submit" value="Save" name="Save">

    </form>
    



    

     
</body>

</html>