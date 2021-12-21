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
        $result = $APP_DB->query("
            select sum(grade_value) as 'total_grade', count(*) as 'total_course'
            from grades
            GROUP by given_to
            HAVING given_to=" . $id . ";
        ");
    }
}