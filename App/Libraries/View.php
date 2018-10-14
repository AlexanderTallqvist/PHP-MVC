<?php

namespace App\Libraries;

class View {

  public static function render($view, $data = []) {
    if (file_exists("../App/views/" . $view . ".php")) {
      require_once("../App/views/" . $view . ".php");
    } else {
      die("View does not exist.");
    }
  }
}
