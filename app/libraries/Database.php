<?php

  /**
   * @file
   * The database class.
   * Used for fetching, inserting and updating data
   * in the database.
   */

   class Database {

   /**
    * The class constructor
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
  }
