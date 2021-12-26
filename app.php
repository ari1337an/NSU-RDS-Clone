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

# Settings Classess
require PATH . './library/class.SETTINGS.php';

# Construct The Site Settings
SETTINGS::init_settings("advising_state",0);  // Default is Turned Off ,0 = turned off, 1 = turned on, 2 = Ended