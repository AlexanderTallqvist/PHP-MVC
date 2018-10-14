<?php

namespace App\Helpers;


/**
 * @file
 * The Redirect Helper.
 */

class Redirect {

  public static function transfer($page) {
    header('location: ' . URLROOT . "/" . $page);
  }

}
