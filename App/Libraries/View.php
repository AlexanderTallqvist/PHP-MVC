<?php

/**
 * @file
 * The Main View Class.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */


namespace App\Libraries;

use App\Helpers\Messages;


class View {


  /**
   * The render method.
   * A method that renders data with a php template.
   *
   * @param string $view
   * The php template that we want to use.
   *
   * @param array $data
   * An array containing data that we want to render.
   *
   * @return void
   */
  public static function render($view, $data = []) {
    if (file_exists("../App/Views/" . $view . ".php")) {
      require_once("../App/Views/" . $view . ".php");
    } else {
      die("View does not exist.");
    }
  }


  /**
   * The renderTwig method.
   * A method that renders data with a twig template.
   *
   * @param string $view
   * The php template that we want to use.
   *
   * @param array $data
   * An array containing data that we want to render.
   *
   * @return void
   */
  public static function renderTwig($view, $data = []) {
    static $twig = null;

    if ($twig === null) {
        $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/Views');
        $twig = new \Twig_Environment($loader);
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('messages', Messages::getAllFlashMessages());
    }

    echo $twig->render($view . ".html", $data);
  }

}
