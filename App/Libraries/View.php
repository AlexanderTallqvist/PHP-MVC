<?php

namespace App\Libraries;

use App\Helpers\Messages;


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
        $twig->addGlobal('messages', self::generateMessages());
    }

    echo $twig->render($view . ".html", $data);
  }

  private function generateMessages() {

    $message_types = [
      'register_success',
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
