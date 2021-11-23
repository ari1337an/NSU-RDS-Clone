<?php 

setcookie('logged_user', "", time() - 100);
setcookie('user_role', "0", time() - 100);  
setcookie('user_id', "", time() - 100);

header("Location: ./index.php");
exit;