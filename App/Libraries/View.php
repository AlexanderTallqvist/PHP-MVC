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
        $twig->addGlobal('messages', self::generateMessages());
    }

    echo $twig->render($view . ".html", $data);
  }


  /**
   * The generateMessages method.
   * A method that fetches flash messages from the
   * Message helper class.
   *
   * @return array $messages
   * An array containing flash messages.
   */
  private function generateMessages() {

    $message_types = [
      'register_success',
      'register_fail',
      'login_success',
      'post_success',
      'post_error',
      'post_not_found',
      'post_edited',
      'post_deleted',
    ];

    $messages = [];

    foreach ($message_types as $type) {
      $new_message = Messages::flashMessage($type);
      if (!empty($new_message['content'])) {
        array_push($messages, $new_message);
      }
    }

    return $messages;
  }

}
