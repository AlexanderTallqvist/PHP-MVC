<?php

/**
 * @file
 * The Users Controller.
 */

class Users extends Controller {

  /**
   * The class constructor.
   */
  function __construct() {

  }

  /**
   * The register method.
   */
  public function register() {

    // Check for post to the register route
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

    } else {
      $data = [
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'name_error' => '',
        'email_error' => '',
        'password_error' => '',
        'confirm_password_error' => '',
      ];

      // Load the view
      $this->view("users/register", $data);
    }
  }


  /**
   * The login method.
   */
  public function login() {

    // Check for post to the login route
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

    } else {
      $data = [
        'email' => '',
        'password' => '',
        'email_error' => '',
        'password_error' => '',
      ];

      // Load the view
      $this->view("users/login", $data);
    }
  }

}
