<?php

namespace App\Controllers;

use App\Libraries\View;
use App\Models\User;
use App\Helpers\Redirect;

/**
 * @file
 * The Pages Controller.
 * The Pages controller functions as the default controller,
 * and gets called if no URL parameters for a controller are set.
 */

class Pages {


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

    if(User::isLoggedIn()) {
      Redirect::transfer('posts');
    }

    $data = [
      "title" => "PHP MVC PROJECT",
      'description' => "This is our description",
    ];
    //$test = new View;
    View::render("pages/index", $data);
  }

  /**
   * The about method.
   */
  public function about() {
    $data = [
      "title" => "About Us"
    ];
    View::render("pages/about", $data);
  }
}
