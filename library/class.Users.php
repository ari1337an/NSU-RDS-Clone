<?php 

class USERS{
    public static function isLogged(){
        return isset($_COOKIE['logged_user']) && isset($_COOKIE['user_role']);
    }
    public static function isLoggedAdmin(){
        return USERS::isLogged() && $_COOKIE['user_role'] == 0;
    }
    public static function isLoggedFaculty(){
        return USERS::isLogged() && $_COOKIE['user_role'] == 1;
    }
    public static function isLoggedStudent(){
        return USERS::isLogged() && $_COOKIE['user_role'] == 2;
    }
    public static function getUserName(){
        if(!USERS::isLogged()) return -1;
        return $_COOKIE['logged_user'];
    }
    public static function calculateCgpa($id)
    {
        global $APP_DB;
        $res = $APP_DB->query("
            SELECT round(avg(grade_value),2) as 'cgpa', count(*) as 'total_course'
            FROM grades
            GROUP by given_to
            HAVING given_to=" . $id);
        // var_dump($res);
        $cgpa = 0.0;
        $total_credit = 0;
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $total_course = $row['total_course'];
            $cgpa = $row['cgpa'];
            $total_credit = $total_course * 3;
        }
        $query_grade = $APP_DB->query("
    UPDATE student_profile
    SET cgpa=$cgpa, credits=$total_credit
    WHERE id=$id ");
        if ($query_grade) {
            
        } else die("Update Failed!");
    }
}