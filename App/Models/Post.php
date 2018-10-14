<?php

namespace App\Models;

use App\Libraries\Model;

/**
 * @file
 * The Post Model.
 */

class Post extends Model {

  /**
   * Example function for using the DB class
   */
  public function getPosts() {
    $this->db->query("SELECT * FROM POST");
    return $this->db->resultSet();
  }
}
