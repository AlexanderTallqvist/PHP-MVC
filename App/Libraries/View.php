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

  public static function renderTwig($view, $data = []) {
    static $twig = null;

    if ($twig === null) {
        $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/views');
        $twig = new \Twig_Environment($loader);
        $twig->addGlobal('session', $_SESSION);
    }

    echo $twig->render($view . ".html", $data);
  }
}
