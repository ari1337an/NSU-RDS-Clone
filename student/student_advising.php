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

// Todo: Check if Adivising is ON and act appropiately 
if(SETTINGS::fetch_settings("advising_state") == 0){
    die("Advising Hasn't Started Yet!");
}else if(SETTINGS::fetch_settings("advising_state") == 2){
    die("Advising Has Ended!");
}

$current_saved_courses = array();
$current_temp_courses = array();

function load_course_from_db(){
    global $current_saved_courses, $APP_DB;
    $current_saved_courses = array(); // clear the list
    $result = $APP_DB->query("SELECT course_id FROM taking WHERE who_is_taking=".USERS::getUserName()."");
    while($row = mysqli_fetch_assoc($result)){ 
        array_push($current_saved_courses, $row['course_id']);
    }
}

function load_course_from_cookie(){
    global $current_temp_courses;
    $current_temp_courses = array(); // Clear the list
    if(isset($_COOKIE['selected_course'])){
        $tmpxx = json_decode($_COOKIE['selected_course'],true);
        foreach($tmpxx as $tmpp){
            array_push($current_temp_courses, $tmpp);
        }
    }
}

function get_course_name($id){
    global $APP_DB;
    $result = $APP_DB->query("SELECT course_name FROM course_list WHERE course_id='".$id."'");
    return $result->fetch_object()->course_name;
}

// Load the currently taken courses from the database into the array 
load_course_from_db();

// Load the currently non saved courses into the array
load_course_from_cookie();

if(isset($_POST['ADD'])){
    load_course_from_cookie();
    if(in_array($_POST['taken'],$current_saved_courses) == false && in_array($_POST['taken'], $current_temp_courses) == false){
        array_push($current_temp_courses, $_POST['taken']);
        setcookie('selected_course',json_encode($current_temp_courses),time()+3600);
        load_course_from_cookie();
    }
    header("Location: ./student_advising.php");
    exit;
}

if(isset($_POST['SAVE'])){
    load_course_from_cookie();
    foreach($current_temp_courses as $s){
        $APP_DB->query("INSERT INTO taking(course_id, who_is_taking) VALUES ('$s',".USERS::getUserName().")",true);
    }
    setcookie('selected_course',"",time()-100);
    header("Location: ./index.php?advising_complete=true");
    exit;
}

if(isset($_POST['clrcookie'])){
    setcookie('selected_course',"",time()-100);
    header("Location: ./student_advising.php");
    exit;
}

if(isset($_GET['delete_course_tmp'])){
    $current_temp_courses = array(); // Clear the list
    if(isset($_COOKIE['selected_course'])){
        $tmpxx = json_decode($_COOKIE['selected_course'],true);
        foreach($tmpxx as $tmpp){
            if($tmpp != $_GET['delete_course_tmp']) array_push($current_temp_courses, $tmpp);
        }
    }
    setcookie('selected_course',json_encode($current_temp_courses),time()+3600);
    header("Location: ./student_advising.php");
    exit;
}

if(isset($_GET['delete_course_saved'])){
    $current_saved_courses = array(); // clear the list
    $result = $APP_DB->query("DELETE FROM taking WHERE course_id='".$_GET['delete_course_saved']."' AND who_is_taking=".USERS::getUserName()."");
    header("Location: ./student_advising.php");
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


    <div class="container_panel">
       <div class="center_panel">
           <h2 class="table_desc">Advising Panel</h2>
       </div>
       <div class="left_container">
            <h2 class="table_desc">Course Taken</h2>
                <?php 
                $result = $APP_DB->query("
                    SELECT taking.course_id AS course_id, course_list.course_name as course_name 
                    FROM taking JOIN course_list ON taking.course_id=course_list.course_id
                    AND taking.who_is_taking=".USERS::getUserName().";
                ");
                if(mysqli_num_rows($result) == 0 && sizeof($current_temp_courses) == 0){
                    echo "No Course Taken!";
                }else{
                    ?>
                    <table class="full_page_table">
                        <tr>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Saved</th>
                            <th>Action</th>
                        </tr>
                 <?php  while($row = mysqli_fetch_assoc($result)){ ?>
                            <tr>
                                <td><?php echo $row['course_id'];?></td>
                                <td><?php echo $row['course_name'];?></td>
                                <td>YES</td>
                                <td><a href="?delete_course_saved=<?php echo $row['course_id'];?>">Drop & Save</a></td>
                            </tr>    
                <?php   }
                        
                        load_course_from_cookie();
                        foreach($current_temp_courses as $course){ ?>
                            <tr>
                                <td><?php echo $course; ?></td>
                                <td><?php echo get_course_name($course); ?></td>
                                <td>NO</td>
                                <td><a href="?delete_course_tmp=<?php echo $course; ?>">Delete</a></td>
                            </tr>             
                <?php  } ?>
                    </table>
                    <?php
                }
                ?>
        </div>

        <div class="right_container">
             <h2 class="table_desc">Select Course</h2>
            <form action="student_advising.php" method="post">
                <label for="take">Select What You Want to Take: </label>
                <select name="taken">
                <?php
            
                $result = $APP_DB->query("SELECT * FROM course_list");
                $all_courses_list = array();
                while($row = $result->fetch_assoc()){
                    $all_courses_list[] = $row; 
                }
                foreach($all_courses_list as $course){
                    ?>
                    <option value="<?php echo $course['course_id'];?>"><?php echo $course['course_id'];?></option>
                    <?php
                }
                ?>
                </select>

                <input type="submit" value="ADD" name="ADD"> <br> <br>
                <input class="btn_save_advising" type="submit" value="SAVE" name="SAVE">

            </form>
            
    <form method="POST">
        <input class="btn_clr_tmp_advising" type="submit" name="clrcookie" value="Clear Cookies">
    </form>
        </div>

       
    </div>




</body>

</html>