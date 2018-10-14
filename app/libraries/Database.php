<?php

namespace App\Libraries;

use \PDO;

/**
 * @file
 * The database class.
 * Used for fetching, inserting and updating data
 * in the database.
 */

 class Database {

 /**
  * The class constructor.
  */
  function __construct() {
    $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
    $options = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    # Create a new PDO instance
    try {
      $this->dbHandler = new PDO($dsn, $this->user, $this->password, $options);
    } catch (\PDOException $e) {
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

 /**
  * The database host.
  */
  private $host = DB_HOST;

  /**
   * The database user.
   */
  private $user = DB_USER;

  /**
   * The database password.
   */
  private $password = DB_PASSWORD;

  /**
   * The database username.
   */
  private $dbname = DB_NAME;

  /**
   * The database handeler.
   */
  private $dbHandler;

  /**
   * The database statement.
   */
  private $statement;

  /**
   * The database error message.
   */
  private $error;

  /**
   * The main query method.
   *
   * @param  string $sql
   * An SQL query string.
   */
  public function query($sql) {
    $this->statement = $this->dbHandler->prepare($sql);
  }

  /**
   * The bind method.
   *
   * @param  string $param
   * The query parameters.
   *
   * @param  string $value
   * The query values.
   *
   * @param  string $type
   * The PDO type for the value.
   */
  public function bind($param, $value, $type = null) {

    # Set a type value if one inst provided
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }
    $this->statement->bindValue($param, $value, $type);
  }

  /**
   * The execute method.
   * Execute the prepared statement.
   *
   * @return PDO
   * Returns database results.
   */
  public function execute() {
    return $this->statement->execute();
  }

  /**
   * The resultSet method.
   * Fetch a result set containg all the data.
   *
   * @return array
   * Returns an array of objects containing database results.
   */
  public function resultSet() {
    $this->execute();
    return $this->statement->fetchAll(PDO::FETCH_OBJ);
  }


  /**
   * The singleResult method.
   * Fetch a single record from the database.
   *
   * @return array
   * Returns a single record from the database.
   */
  public function singleResult() {
    $this->execute();
    return $this->statement->fetch(PDO::FETCH_OBJ);
  }

  /**
   * The rowCount method.
   * Fetch the row count for the returned values.
   *
   * @return int
   * The amount of rows found in the database.
   */
  public function rowCount() {
    return $this->statement->rowCount();
  }
}
