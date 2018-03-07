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
   * Gets called by default if no other methods
   * is specified in the URL.
   */
  public function index() {
    $data = ["title" => "Welcome"];
    $this->view("pages/index", $data);
  }

  /**
   * The about method.
   */
  public function about() {
    $this->view("pages/about", []);
  }
}
