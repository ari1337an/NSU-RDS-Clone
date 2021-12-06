<?php

require 'app.php'; // load the application


if(USERS::isLogged()){
    if(USERS::isLoggedAdmin()){
        header("Location: ./admin/index.php");
        exit;
    }else if(USERS::isLoggedStudent()){
        header("Location: ./student/index.php");
        exit;
    }else if(USERS::isLoggedFaculty()){
        header("Location: ./faculty/index.php");
        exit;
    }
}


function trying_to_login_student($username)
{ // all is int
    if (ctype_digit($username)) {
        return true;
    }

    return false;
}

function trying_to_login_faculty($username)
{ // check if user exists in the faculty table
    if (is_string($username) && $username != "admin") {
        return true;
    }

    return false;
}

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // check if the user want to login as student, faculy or admin
    // go through the respective login functions

    if (trying_to_login_student($username)) {

       
        $result = $APP_DB->query("SELECT count(*) as count FROM students WHERE username='$username' AND password='$password';");
        $how_many = $result->fetch_object()->count;

        if ($how_many == 1) {
            setcookie('logged_user', $username, time() + (86400 * 30));
            setcookie('user_role', 2, time() + (86400 * 30)); // admin = 0, faculty = 1, student = 2

            header("Location: ./student/index.php");
            exit;
        } else {
            echo "Authentication error!";
        }
    } else if (trying_to_login_faculty($username)) {

        $result = $APP_DB->query("SELECT count(*) as count FROM faculties WHERE username='$username' AND password='$password';");
        $how_many = $result->fetch_object()->count;

        if ($how_many == 1) {
            // give login
            setcookie('logged_user', $username, time() + (86400 * 30));
            setcookie('user_role', 1, time() + (86400 * 30)); // admin = 0, faculty = 1, student = 2

            // finished login process now redirect to the dashboard/admin panel
            //header('Refresh: 0, url = ./admin/index.php');
            header("Location: ./faculty/index.php");
            exit;
        } else {
            echo "Authentication Error!";
        }
    } else {
        // Maybe an admin
        $result = $APP_DB->query("SELECT count(*) as count FROM admins WHERE username='$username' AND password='$password';");
        $how_many = $result->fetch_object()->count;

        if ($how_many == 1) {
            // give login
            setcookie('logged_user', $username, time() + (86400 * 30));
            setcookie('user_role', 0, time() + (86400 * 30)); // admin = 0, faculty = 1, student = 2

            // finished login process now redirect to the dashboard/admin panel
            // header('Refresh: 0, url = ./admin/index.php');
            header("Location: ./admin/index.php");
            exit;
        } else {
            echo "Authentication Error!";
        }
    }
} 

// Define the Template Variables
$template_vars["get_hierarchy"] = "./"; // take the script to the main hierarchy

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
    <link rel="stylesheet" href="./src/css/styles.css">
    <title>Welcome</title>
</head>

<body>
    <?php include 'template/header.php'; ?>

    <!-- just to check if the subheader works -->
    <!-- <?php include 'template/sub_header.php'; ?>  -->

    <div class="login-center">
        <h3>NSU Portal: Login</h3>
        <form action="index.php" method="post">
            <div class="input-field">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-field">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
    
</body>

</html>