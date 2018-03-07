<?php

# LOAD CONFIGURATION
require_once "config/config.php";

# AUTOLOADER FOR LIBRARIES
spl_autoload_register(function($className) {
  require_once "libraries/" . $className . ".php";
});

# AKA
// require_once "libraries/Core.php";
// require_once "libraries/Controller.php";
// require_once "libraries/Database.php";
