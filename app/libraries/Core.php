<?php

/**
 * @file
 * The Core App Class
 * Creates the URL and loads the core controller
 * URL Format: /controller/method/parameter
 */

class Core {

  /**
   * The class constructor.
   * Fetches URL data using getURL(), and uses said data
   * to load controllers and their methods.
   */
  function __construct() {
    $url = $this->getUrl();

    # Check if controller exists
    if (file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
      $this->currentController = ucwords($url[0]);
      unset($url[0]);
    }

    # Instanciate our controller class
    require_once("../app/controllers/" . $this->currentController . ".php");
    $this->currentController = new $this->currentController;
  }

  /**
   * The current controller class.
   * Default value: Pages
   */
  protected $currentController = "Pages";

  /**
   * The current method.
   * Default value: index
   */
  protected $currentMethod = "index";

  /**
   * The URL parameters.
   * Default value: []
   */
  protected $parameters = [];

  /**
   * The getUrl function
   * Extracts the URL values and escapes the values.
   *
   * @return array
   * An array containing URL data, such as the requested
   * controller, the method, and parameters.
   */
  public function getUrl() {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], "/");
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode("/", $url);
      return $url;
    }
  }


}
