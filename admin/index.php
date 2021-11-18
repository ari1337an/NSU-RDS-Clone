<?php 

if(isset($_COOKIE['user_id'])){
    echo "User is logged in and his user role code is" . $_COOKIE['user_role'] . " and username is " . $_COOKIE['logged_user'];
}else{
    echo "you didnt login";
}