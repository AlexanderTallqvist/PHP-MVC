<?php

namespace App\Libraries;


/**
 * @file
 * The Core App Class.
 * Creates the URL and loads the core controller
 * URL Format: /controller/method/parameter.
 */

class Core {

  /**
   * The class constructor.
   * Fetches URL data using getURL(), and uses said data
   * to load controllers and their methods.
   */
   function __construct() {
    $url = $this->getUrl();

    # Check if controller exists in the first URL parameter
    if (file_exists("../App/Controllers/" . ucwords($url[0]) . ".php")) {
      $this->currentController = ucwords($url[0]);
      unset($url[0]);
    }

    # Instanciate our controller class
    $controller = "App\Controllers\\" . $this->currentController;
    $this->currentController = new $controller;

    # Check if a method exists in the second URL parameter
    if (isset($url[1])) {
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
        unset($url[1]);
      }
    }

    # Fetch URL parameters for the requested method
    $this->parameters = $url ? array_values($url) : [];

    # Call class method with parameters
    call_user_func_array([
      $this->currentController,
      $this->currentMethod],
      $this->parameters
    );
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
   * The URL parameters for the requested method.
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
