<?php

// Incldue this file once and it will auto include all library and configurations

# Configs
require './configs/config.database.php';

# Classes
require './library/class.DB.php';
require './library/class.Users.php';

# Load the Libraries
$APP_DB = new DB(new CONFIG_DB());
