<?php

# REQUIRE OUR BOOTSTRAP FILE
require_once "../app/bootstrap.php";

// Start our session
session_start();

# INITIALIZE THE CORE LIBRARY
$init = new App\Libraries\Core;

# INITIALIZE THE FLASH MESSAGES
$messages = new App\Helpers\Messages;
