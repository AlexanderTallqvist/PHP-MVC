<?php

namespace App\Models;

use App\Libraries\Model;

/**
 * @file
 * The User Model.
 */

class User extends Model {


  public function createUserSession($user) {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->name;
  }


  public function isLoggedIn() {
    if (isset($_SESSION['user_id'])) {
      return true;
    } else {
      return false;
    }
  }


  /**
   * Login user
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
   * Find user by email
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
   * Register user
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
   * Validate registration name
   */
  public function validateName($name) {

    if (empty($name)) {
      return "Plase enter a name.";
    }
  }

  /**
   * Validate registration email
   */
  public function validateEmail($email, $checkExisting = false) {

    if (empty($email)) {
      return "Plase enter an email.";
    }

    if (self::findUserByemail($email) && $checkExisting) {
      return "The email is already in use.";
    }
  }

  /**
   * Validate registration password
   */
  public function validatePassword($password) {

    if (empty($password)) {
      return "Plase enter a password.";
    }

    if (strlen($password) < 6) {
      return "The password should be longer than 6 characters.";
    }
  }

  /**
   * Validate registration name
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
