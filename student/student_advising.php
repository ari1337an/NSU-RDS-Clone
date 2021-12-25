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

      if(isset($_COOKIE['selected_course'])){
        $current_courses=json_decode($_COOKIE['selected_course'], true);
      }
      else{
          $current_courses = array();
      }
       
       $course_taken = "";
       $current = USERS::getUserName();
     
       if(isset($_POST['ADD']) && isset($_POST['taken']) ){
    
        $course_taken = $_POST['taken'];
        if(in_array($course_taken,$current_courses) == false){
            $current_courses[] = $course_taken;
            setcookie('selected_course',json_encode($current_courses),time()+3600);
        }
       }
       if(isset($_POST['SAVE'])){
           $selected = json_decode($_COOKIE['selected_course'], true);
           $flag = 0 ;
           foreach($selected as $s){
               $sql = "INSERT INTO taking( course_id, who_is_taking) VALUES ('$s','$current')";
               if($APP_DB->query($sql) == true ){
                  $flag = 1;
               }
           }
           if($flag==1){
               echo "SAVED";
               setcookie('selected_course',"",time()-100);
               $current_courses = array();
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
    <title>Welcome | Student Panel</title>
</head>

<body>
    <?php include "../template/header.php"; ?>
    <?php include "../template/sub_header.php"; ?>

    <form action="student_advising.php" method = "post">
        <select name  = "taken">
        <?php
      
        foreach($courses as $course){
            ?>
            <option value="<?php echo $course['course_id'];?>"><?php echo $course['course_id'];?></option>
            <?php
        }
        ?>
        </select>

        <input type="submit" value="ADD" name="ADD">
        <input type="submit" value="SAVE" name="SAVE">

    </form>

  



    

     
</body>

</html>