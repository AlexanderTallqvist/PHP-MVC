<?php

/**
 * @file
 * The Users Controller.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */


namespace App\Controllers;

use App\Libraries\View;
use App\Models\User;
use App\Helpers\Redirect;
use App\Helpers\Messages;


class Users {


  /**
   * Contains an instance of the User Model.
   * @var User
   */
  private $userModel;


  /**
   * The class constructor.
   */
  function __construct() {
    $this->userModel = new User;
  }


  /**
   * The register method.
   * Called @ /users/register
   * Methods: GET, POST
   *
   * @return void
   */
  public function register() {

    $METHOD = $_SERVER['REQUEST_METHOD'];

    switch ($METHOD) {

      case 'POST':

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

        $data = $this->userModel->validateRegisterForm($data);

        if (empty($data['name_error']) && empty($data['email_error'])
        && empty($data['password_error']) && empty($data['confirm_password_error'])) {

          if ($this->userModel->registerUser($data)) {
            Messages::flashMessage('register_success', 'You are registered and can now log in.', 'message--success');
            Redirect::transfer('users/login');

          } else {
            Messages::flashMessage('register_fail', 'The registration could not be compleated.', 'message--warning');
            Redirect::transfer('users/register');
          }

        } else {
          View::renderTwig('users/register', $data);
        }

        break;

      default:

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

        View::renderTwig("users/register", $data);

        break;
    }
  }


  /**
   * The login method.
   * Called @ /users/login
   * Methods: GET, POST
   *
   * @return void
   */
  public function login() {

    $METHOD = $_SERVER['REQUEST_METHOD'];

    switch ($METHOD) {

      case 'POST':

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_error' => '',
          'password_error' => '',
        ];

        $data = $this->userModel->validateLoginForm($data);

        if (empty($data['email_error']) && empty($data['password_error'])) {
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if ($loggedInUser) {
            $this->userModel->createUserSession($loggedInUser);
            Messages::flashMessage('login_success', 'You have successfully logged in.', 'message--success');
            Redirect::transfer('posts');

          } else {
            $data = $this->userModel->invalidLogin($data);
            View::renderTwig('users/login', $data);
          }

        } else {
          View::renderTwig('users/login', $data);
        }

        break;

      default:

        $data = [
          'email' => '',
          'password' => '',
          'email_error' => '',
          'password_error' => '',
        ];

        View::renderTwig("users/login", $data);

        break;
    }

  }


  /**
   * The logout method.
   * Called @ /users/logout
   * Methods: GET
   *
   * @return void
   */
  public function logout() {
    $this->userModel->destroyUserSession();
    Redirect::transfer('users/login');
  }

}
