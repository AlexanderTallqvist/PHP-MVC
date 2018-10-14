<?php

namespace App\Models;

use App\Libraries\Model;

/**
 * @file
 * The User Model.
 */

class User extends Model {

  /**
   * Find user by email
   */
  public function findUserByEmail($email) {
    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(":email", $email);
    $this->db->singleResult();

    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Register user
   */
  public function registerUser($data) {
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
}
