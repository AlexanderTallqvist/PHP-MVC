<?php

/**
 * @file
 * The User Model.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */


namespace App\Models;

use App\Libraries\Model;


class User extends Model {


  /**
   * The isLoggedIn method.
   * A method that checks if the user session is set.
   *
   * @return boolean
   * Returns true or false, depending on if the
   * user is logged in or not.
   */
  public static function isLoggedIn() {
    if (isset($_SESSION['user_id'])) {
      return true;
    } else {
      return false;
    }
  }


  /**
   * The createUserSession method.
   * A method that sets user data to the session
   * superglobal.
   *
   * @param array $user
   * An array containg user data.
   *
   * @return void
   */
  public function createUserSession($user) {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->name;
  }


  /**
   * The destroyUserSession method.
   * A method that unsets user data from the session
   * superglobal.
   *
   * @return void
   */
  public function destroyUserSession() {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    session_destroy();
  }


  /**
   * The getUserSessionId method.
   * A method that gets the user ID from the
   * session superglobal.
   *
   * @return string
   * The user id from the session super global.
   */
  public function getUserSessionId() {
    if (isset($_SESSION['user_id'])) {
      return $_SESSION['user_id'];
    }
  }


  /**
   * The login method.
   * A method that attempts to login a user.
   *
   * @param string $email
   * The email that the user entered to the login form.
   *
   * @param string $password
   * The password that the user entered to the login form.
   *
   * @return mixed
   * Returns false if the login attempt failed. Returns an user
   * array if successful.
   */
  public function login($email, $password) {
    $row = self::findUserByEmail($email);

    if ($row) {
      $hashed_password = $row->password;
      if (password_verify($password, $hashed_password)) {
        return $row;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }


  /**
   * The findUserByEmail method.
   * A method that attempts to find a user by their email.
   *
   * @param string $email
   * The user email.
   *
   * @return mixed
   * Returns false if the user couldn't be found. Returns an user
   * array if successful.
   */
  public function findUserByEmail($email) {
    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(":email", $email);
    $row = $this->db->singleResult();

    if ($this->db->rowCount() > 0) {
      return $row;
    } else {
      return false;
    }
  }


  /**
   * The findUserById method.
   * A method that attempts to find a user by their email.
   *
   * @param string $user_iod
   * The user ID.
   *
   * @return mixed
   * Returns false if the user couldn't be found. Returns an user
   * array if successful.
   */
  public function findUserById($user_id) {
    $this->db->query("SELECT * FROM users WHERE id = :id");
    $this->db->bind(":id", $user_id);
    $row = $this->db->singleResult();

    if ($this->db->rowCount() > 0) {
      return $row;
    } else {
      return false;
    }
  }


  /**
   * The registerUser method.
   * A method that attempts to register a user
   * to the database.
   *
   * @param array $data
   * An array containing form data for the user registration.
   *
   * @return boolean
   * Returns true or false, depending on if the registration
   * was successful or not.
   */
  public function registerUser($data) {

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $this->db->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");
    $this->db->bind(":name", $data['name']);
    $this->db->bind(":email", $data['email']);
    $this->db->bind(":password", $data['password']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * The validateRegisterForm method.
   * A "parent" method for the "Register User" form validation.
   *
   * @param array $data
   * An array containing data from the "Register User" form.
   *
   * @return array
   * Returns back the same data array with validated data.
   */
  public function validateRegisterForm($data) {

    $data['name_error'] = self::validateName($data['name']);
    $data['email_error'] = self::validateEmail($data['email'], true);
    $data['password_error'] = self::validatePassword($data['password']);
    $data['confirm_password_error'] = self::validateConfirmPassword($data['password'], $data['confirm_password']);

    return $data;
  }


  /**
   * The validateLoginForm method.
   * A "parent" method for the "Login User" form validation.
   *
   * @param array $data
   * An array containing data from the "Login User" form.
   *
   * @return array
   * Returns back the same data array with validated data.
   */
  public function validateLoginForm($data) {

    $data['email_error'] = self::validateEmail($data['email']);
    $data['password_error'] = self::validatePassword($data['password'], false);

    return $data;
  }


  /**
   * The invalidLogin method.
   * Gets error messages for wrong username & password combinations.
   *
   * @param array $data
   * An array containing data from the "Login User" form.
   *
   * @return array
   * Returns back the same data array with validated data.
   */
  public function invalidLogin($data) {

    $data['email_error'] = 'Wrong username or password.';
    $data['password_error'] = 'Wrong username or password.';

    return $data;
  }


  /**
   * The validateName method.
   * A validator method for form name.
   *
   * @param string $name
   * A string containing the form name.
   *
   * @return string
   * Returns an error string if needed.
   */
  public function validateName($name) {

    if (empty($name)) {
      return "Plase enter a name.";
    }
  }


  /**
   * The validateEmail method.
   * A validator method for form email.
   *
   * @param string email
   * A string containing the form email.
   *
   * @param boolean $check_existing
   * A boolean indicating if we should look for duplicate emails
   * in the database.
   *
   * @return string
   * Returns an error string if needed.
   */
  public function validateEmail($email, $check_existing = false) {

    if (empty($email)) {
      return "Plase enter an email.";
    }

    if (self::findUserByemail($email) && $check_existing) {
      return "The email is already in use.";
    }
  }


  /**
   * The validatePassword method.
   * A validator method for form password.
   *
   * @param string password
   * A string containing the form password.
   *
   * @param boolean $check_length
   * A boolean indicating if we should throw an error if
   * the password is too short.
   *
   * @return string
   * Returns an error string if needed.
   */
  public function validatePassword($password, $check_length = true) {

    if (empty($password)) {
      return "Plase enter a password.";
    }

    if (strlen($password) < 6 && $check_length) {
      return "The password should be longer than 6 characters.";
    }
  }


  /**
   * The validateConfirmPassword method.
   * A validator method for form confirm password.
   *
   * @param string password
   * A string containing the form password password.
   *
   * @param string $confirm_password
   * A string containing the form confirm password.
   *
   * @return string
   * Returns an error string if needed.
   */
  public function validateConfirmPassword($password, $confirm_password) {
    if (empty($password)) {
      return "Plase confirm your password.";
    }

    if ($password != $confirm_password) {
      return "The two passwords do not match.";
    }
  }
}
