<?php

namespace App\Controllers;

use App\Libraries\View;
use App\Models\User;

/**
 * @file
 * The Users Controller.
 */

class Users {

  /**
   * The class constructor.
   */
  function __construct() {
    $this->userModel = new User;
  }

  /**
   * The register method.
   */
  public function register() {

    // Check for post to the register route
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Init data
      $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'name_error' => '',
        'email_error' => '',
        'password_error' => '',
        'confirm_password_error' => '',
      ];

      if (empty($data['name'])) {
        $data['name_error'] = "Plase enter a name.";
      }
      if (empty($data['email'])) {
        $data['email_error'] = "Plase enter an email.";
      } else {
        if ($this->userModel->findUserByemail($data['email'])) {
          $data['email_error'] = "The email is already in use.";
        }
      }
      if (empty($data['password'])) {
        $data['password_error'] = "Plase enter a password.";
      } elseif (strlen($data['password']) < 6) {
        $data['password_error'] = "The password should be longer than 6 characters.";
      }
      if (empty($data['confirm_password'])) {
        $data['confirm_password_error'] = "Plase confirm your password.";
      } else {
        if ($data['password'] != $data['confirm_password']) {
          $data['confirm_password_error'] = "The two passwords do not match.";
        }
      }

      // Make sure we have no errors
      if (empty($data['name_error']) && empty($data['email_error'])
      && empty($data['password_error']) && empty($data['confirm_password_error'])) {

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        if ($this->userModel->registerUser($data)) {
          header('location: ' . URLROOT . '/user/login');
        } else {
          die("Something went wrong.");
        }

      } else {
        View::render('users/register', $data);
      }

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
      View::render("users/register", $data);
    }
  }


  /**
   * The login method.
   */
  public function login() {

    // Check for post to the login route
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Init data
      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_error' => '',
        'password_error' => '',
      ];

      if (empty($data['email'])) {
        $data['email_error'] = "Plase enter an email.";
      }
      if (empty($data['password'])) {
        $data['password_error'] = "Plase enter a password.";
      }

      // Make sure we have no errors
      if (empty($data['name_error']) && empty($data['email_error'])
      && empty($data['password_error']) && empty($data['confirm_password_error'])) {
        die("SUCCESS");
      } else {
        View::render('users/login', $data);
      }

    } else {
      $data = [
        'email' => '',
        'password' => '',
        'email_error' => '',
        'password_error' => '',
      ];

      // Load the view
      View::render("users/login", $data);
    }
  }

}
