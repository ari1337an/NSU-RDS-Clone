<?php
// Start the Application
include "../app.php";

// Define the Template Variables
$template_vars["get_hierarchy"] = "../"; // take the script to the main hierarchy
$template_vars["active_id_sub_header"] = 4; // determines which page is currently ON on the subheader

// Restrict the view to only Faculty
if (!USERS::isLoggedFaculty()) {
    header("Location: ../index.php");
    exit;
}

// filter: check if the current logged user is teaching at this course
$count = $APP_DB->query("SELECT count(*) as count FROM teaches WHERE course_id='".$_GET['course_id']."' AND who_is_teaching='".USERS::getUserName()."'")->fetch_object()->count;
if($count != 1) {
    die("You don't teach at " . $_GET['course_id']);
}

function val_to_letter($val){
    if($val == "4.0") return "A";
    if($val == "3.7") return "A-";
    if($val == "3.3") return "B+";
    if($val == "3.0") return "B";
    if($val == "2.7") return "B-";
    if($val == "2.3") return "C+";
    if($val == "2.0") return "C";
    if($val == "1.7") return "C-";
    if($val == "1.3") return "D+";
    if($val == "1.0") return "D";
    if($val == "0.0") return "F";
}

function letter_to_val($letter){
    if($letter == "A") return "4.0";
    if($letter == "A-") return "3.7";
    if($letter == "B+") return "3.3";
    if($letter == "B") return "3.0";
    if($letter == "B-") return "2.7";
    if($letter == "C+") return "2.3";
    if($letter == "C") return "2.0";
    if($letter == "C-") return "1.7";
    if($letter == "D+") return "1.3";
    if($letter == "D") return "1.0";
    if($letter == "F") return "0.0";
}


function print_drop_down_for_grade_list($id){
    global $APP_DB;
    $result = $APP_DB->query("
        SELECT *
        FROM grades
        WHERE given_to='".$id."' AND course_id='".$_GET['course_id']."';
    ");
    $flag_exists = false;
    if(mysqli_num_rows($result) == 1) $flag_exists = true;
    if($flag_exists) {
        $val = mysqli_fetch_assoc($result)["grade_value"];
        $val = val_to_letter($val);

    }

    $grade_list = ["A", "A-", "B+", "B", "B-", "C+", "C", "C-","D+","D","F"]
    ?>
    <select name="grade_for_<?php echo $id;?>">
    <?php 
        foreach($grade_list as $grade_single){
            ?>
                <option value="<?php echo $grade_single;?>" <?php if($flag_exists && $val == $grade_single){echo "selected";}?>><?php echo $grade_single;?></option>
            <?php
        }
    ?>
        <option value="None" <?php if(!$flag_exists){echo "selected";}?>>None</option>
    </select>
    <?php 
}

function already_has_grade_for_this_student($id, $course_id, $submittedby){
    global $APP_DB;
    $result = $APP_DB->query("
        SELECT *
        FROM grades
        WHERE course_id='".$course_id."' AND given_to='".$id."' AND submitted_by='".$submittedby."';
    ");
    return mysqli_num_rows($result) == 1;
}


if(isset($_POST['request_for_grade_change'])){
    $result = $APP_DB->query("
        SELECT t.course_id as 'course_id', s.id as 'student_id', s.name	as 'student_name'
        FROM taking as t JOIN student_profile as s ON t.who_is_taking=s.id
        AND t.course_id='".$_GET['course_id']."';
    ");


    $form_submitted_by = $_POST['form_submitted_by'];
    $form_course_id = $_POST['form_course_id'];

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $cur_id = $row['student_id'];
            $index = "grade_for_" . $cur_id;
            $letter = $_POST[$index];
            if($letter == "None"){
                // check if exists in the database already
                // if do exists then delete it
                $APP_DB->query("
                    DELETE FROM grades
                    WHERE given_to='".$cur_id."' AND course_id='".$form_course_id."' AND submitted_by='".$form_submitted_by."';
                ");
                continue;
            }
            $val = letter_to_val($letter);

            if(already_has_grade_for_this_student($cur_id, $form_course_id, $form_submitted_by)){
                // run insert
                $APP_DB->query("
                    UPDATE grades
                    SET grade_value=".$val."
                    WHERE given_to='".$cur_id."' AND course_id='".$form_course_id."' AND submitted_by='".$form_submitted_by."';
                ");
            }else{
                // run insert
                $APP_DB->query("
                    INSERT INTO grades(course_id,submitted_by, given_to, grade_value)
                    VALUES('".$form_course_id."', '".$form_submitted_by."', '".$cur_id."', ".$val.");
                ");
            }

        }
    }
    header("Location: ./index.php?submitted_grades=1");
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
    <title>Grade | Faculty Panel</title>
</head>

<body>
    <?php include "../template/header.php"; ?>
    <?php include "../template/sub_header.php"; ?>

    
    <h3>Submitting Grades For <?php echo $_GET['course_id'];?></h3>

    <section>
    <form method="POST">
    <table>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Grade</th>
        </tr>
<?php 
$result = $APP_DB->query("
    SELECT t.course_id as 'course_id', s.id as 'student_id', s.name	as 'student_name'
    FROM taking as t JOIN student_profile as s ON t.who_is_taking=s.id
    AND t.course_id='".$_GET['course_id']."';
");

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['student_name']?></td>
            <td><?php print_drop_down_for_grade_list($row['student_id'])?></td>
        </tr>
        <?php
    }
}
?>  
    </table>
    <input type="hidden" name="form_course_id" value="<?php echo $_GET['course_id']; ?>">
    <input type="hidden" name="form_submitted_by" value="<?php echo USERS::getUserName(); ?>">
    <input type="submit" name="request_for_grade_change" value="Submit">
    </form>
    </section>
    
    

</body>

</html>