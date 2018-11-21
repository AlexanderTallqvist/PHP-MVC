<?php

/**
 * @file
 * The Main Model Class.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */
 

namespace App\Libraries;

use App\Libraries\Database;


class Model {

  /**
   * An instance of our database connection.
   * @var PDO
   */
  protected $db;


  /**
   * The class constructor
   */
   function __construct() {
     $this->db = new Database;
   }

}
