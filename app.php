<?php

// Define the Path of the Application in Server
if (!defined( 'PATH' ) ) {
	define( 'PATH', __DIR__ . '/' );
}

// Incldue this file once and it will auto include all library and configurations

# Configs
require PATH . 'configs/config.database.php';

# Classes
require PATH . './library/class.DB.php';
require PATH . './library/class.Users.php';


# Load the Libraries
$APP_DB = new DB(new CONFIG_DB());

require PATH . './library/class.SETTINGS.php';

# ReConstruct The Site Settings
if(mysqli_num_rows($APP_DB->query("SELECT * FROM site_settings WHERE settings_name='advising_state'")) == 0){
	$APP_DB->query("INSERT INTO site_settings(settings_name,settings_value) VALUE ('advising_state','0')"); // Default is Turned Off
	// 0 = turned off
	// 1 = turned on
	// 2 = Ended
}
