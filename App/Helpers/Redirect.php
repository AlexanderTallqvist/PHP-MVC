<?php

/**
 * @file
 * The Redirect Helper Class.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */


namespace App\Helpers;


class Redirect {


  /**
   * The transfer method.
   * Transfers a user to a new location.
   *
   * @param string $page
   * A string containing an URL location.
   *
   * @return void
   */
  public static function transfer($page = null) {
    header('location: ' . URLROOT . "/" . $page);
  }

}
