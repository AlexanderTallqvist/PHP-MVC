<?php

/**
 * @file
 * The Post Model.
 */

class Post {

  /**
   * The class constructor
   */
   function __construct() {
     $this->db = new Database;
   }
  /**
   * An instance of our database connection.
   */
  private $db;
}
