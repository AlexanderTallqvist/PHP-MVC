<?php

namespace App\Libraries;

use App\Libraries\Database;

/**
 * @file
 * The Post Model.
 */

class Model {

  /**
   * The class constructor
   */
   function __construct() {
     $this->db = new Database;
   }

  /**
   * An instance of our database connection.
   */
  protected $db;

}
