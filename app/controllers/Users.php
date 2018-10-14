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

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

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

      $data['name_error'] = $this->userModel->validateName($data['name']);
      $data['email_error'] = $this->userModel->validateEmail($data['email'], true);
      $data['password_error'] = $this->userModel->validatePassword($data['password']);
      $data['confirm_password_error'] = $this->userModel->validateConfirmPassword($data['password'], $data['confirm_password']);

      if (empty($data['name_error']) && empty($data['email_error'])
      && empty($data['password_error']) && empty($data['confirm_password_error'])) {

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
      View::render("users/register", $data);
    }
  }


  /**
   * The login method.
   */
  public function login() {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_error' => '',
        'password_error' => '',
      ];

      $data['email_error'] = $this->userModel->validateEmail($data['email']);
      $data['password_error'] = $this->userModel->validatePassword($data['password']);

      // Make sure we have no errors
      if (empty($data['email_error']) && empty($data['password_error'])) {
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
      View::render("users/login", $data);
    }
  }


}
