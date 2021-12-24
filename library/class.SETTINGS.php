<?php
   
class SETTINGS{

    public static function isAdvisingOn(){
        
        global $APP_DB;

        $sql = "SELECT * from site_settings";
        $state = $APP_DB->query($sql);
        
        while($row = mysqli_fetch_assoc($state)){
            if($row['settings_name'] == 'advising_state'){
                return $row['settings_value'];
            }
        }
        

    }

}

