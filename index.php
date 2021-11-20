<?php

    require 'app.php'; // load the application

    function trying_to_login_student($username){ // all is int
        if(ctype_digit($username)){
            return true;
        }

        return false;

    }

    function trying_to_login_faculty($username){ // check if user exists in the faculty table 
        if(is_string($username) && $username != "admin"){
            return true;
        }
        
        return false;
    }

    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        // check if the user want to login as student, faculy or admin
        // go through the respective login functions

        if(trying_to_login_student($username)){
                
            $result = $APP_DB->query("SELECT count(*) as count FROM students WHERE username='$username' AND password='$password';");
            $how_many = $result->fetch_object()->count;
        
            if($how_many == 1 ){

                $result = $APP_DB->query("SELECT ID FROM students WHERE username='$username' AND password='$password';");
                $logged_user_id = $result->fetch_assoc()['ID'];

                setcookie('logged_user', $username, time() + (86400 * 30));
                setcookie('user_role', 2, time() + (86400 * 30)); // admin = 0, faculty = 1, student = 2
                setcookie('user_id', $logged_user_id, time() + (86400 * 30));

            }
            else{
                echo "Authentication error!";
            }

        }else if(trying_to_login_faculty($username)){

            $result = $APP_DB->query("SELECT count(*) as count FROM faculties WHERE username='$username' AND password='$password';");
            $how_many = $result->fetch_object()->count;
        
            if($how_many == 1){
                // Get the user ID of the logged in user from the database
                $result = $APP_DB->query("SELECT ID FROM faculties WHERE username='$username' AND password='$password';");
                $logged_user_id = $result->fetch_assoc()['ID'];

                // give login
                setcookie('logged_user', $username, time() + (86400 * 30));
                setcookie('user_role', 1, time() + (86400 * 30)); // admin = 0, faculty = 1, student = 2
                setcookie('user_id', $logged_user_id, time() + (86400 * 30));

                // finished login process now redirect to the dashboard/admin panel
                //header('Refresh: 0, url = ./admin/index.php');
            }else{
                echo "Authentication Error!";
            }

        }else{
            // Maybe an admin

            $result = $APP_DB->query("SELECT count(*) as count FROM admins WHERE username='$username' AND password='$password';");
            $how_many = $result->fetch_object()->count;
        
            if($how_many == 1){
                // Get the user ID of the logged in user from the database
                $result = $APP_DB->query("SELECT ID FROM admins WHERE username='$username' AND password='$password';");
                $logged_user_id = $result->fetch_assoc()['ID'];

                // give login
                setcookie('logged_user', $username, time() + (86400 * 30));
                setcookie('user_role', 0, time() + (86400 * 30)); // admin = 0, faculty = 1, student = 2
                setcookie('user_id', $logged_user_id, time() + (86400 * 30));

                // finished login process now redirect to the dashboard/admin panel
                //header('Refresh: 0, url = ./admin/index.php');
            }else{
                echo "Authentication Error!";
            }
        }
        

    }else{

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <form action="index.php" method="post">
        Username: <input type="text" name="username"> <br>
        Password: <input type="password" name="password"> <br>
        <input type="submit">
    </form>
</body>
</html>