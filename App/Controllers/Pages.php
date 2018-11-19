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
      "title" => "Share A Thought",
      'description' => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece
                        of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,
                        a Latin professor at Hampden-Sydney College.",
    ];

    View::renderTwig("pages/index", $data);
  }

  /**
   * The about method.
   */
  public function about() {
    $data = [
      "title" => "About Us"
    ];
    View::renderTwig("pages/about", $data);
  }
}
