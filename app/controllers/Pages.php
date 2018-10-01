<?php

/**
 * @file
 * The Pages Controller.
 * The Pages controller functions as the default controller,
 * and gets called if no URL parameters for a controller are set.
 */

class Pages extends Controller {

  /**
   * The class constructor.
   */
  function __construct() {

  }

  /**
   * The index method.
   * Gets called by default if no other method
   * is specified in the URL.
   */
  public function index() {

    $data = [
      "title" => "PHP MVC PROJECT",
    ];
    $this->view("pages/index", $data);
  }

  /**
   * The about method.
   */
  public function about() {
    $data = [
      "title" => "About Us"
    ];
    $this->view("pages/about", $data);
  }
}
