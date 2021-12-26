<?php
   
class SETTINGS{

    public static function init_settings($name, $default){
        global $APP_DB;
        if(mysqli_num_rows($APP_DB->query("SELECT * FROM site_settings WHERE settings_name='$name'")) == 0){
            $APP_DB->query("INSERT INTO site_settings(settings_name,settings_value) VALUE ('$name','$default')");
        }
    }

    public static function fetch_settings($name){
        global $APP_DB;
        $result = $APP_DB->query("SELECT * FROM site_settings");
        while($row = mysqli_fetch_assoc($result)){
            if($row['settings_name'] == $name){
                return $row['settings_value'];
            }
        }
    }

}

