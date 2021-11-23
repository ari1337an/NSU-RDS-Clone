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
