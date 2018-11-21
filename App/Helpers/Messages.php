<?php

/**
 * @file
 * The Messages Helper Class.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */


namespace App\Helpers;


class Messages {


  /**
   * Contains flash-message keys,
   * their messages and classes.
   * @var array
   */
  private static $messages = [

    'post_success' => [
      'message' => "Post submitted.",
      'class' => 'message--success'
    ],
    'post_error' => [
      'message' => "Something went wrong.",
      'class' => 'message--warning'
    ],
    'post_not_found' => [
      'message' => "Post not found.",
      'class' => 'message--default'
    ],
    'post_edited' => [
      'message' => "Post edited succesfully.",
      'class' => 'message--success'
    ],
    'post_deleted' => [
      'message' => "Post removed succesfully.",
      'class' => 'message--success'
    ],
    'register_success' => [
      'message' => "You are registered and can now log in.",
      'class' => 'message--success'
    ],
    'register_fail' => [
      'message' => "The registration could not be compleated.",
      'class' => 'message--warning'
    ],
    'login_success' => [
      'message' => "You have successfully logged in.",
      'class' => 'message--success'
    ],
  ];


  /**
   * The getMessageAndClassByType method.
   * A method fetches a flesh-message class and message.
   *
   * @param string $type
   * They key for the flash-message.
   *
   * @return array
   * An array containing a flash message and a class.
   */
  private function getMessageAndClassByType($type) {

    $data = self::$messages;
    return $data[$type];
  }


  /**
   * The flashMessage method.
   * A method that either saves a message in the session
   * superglobal, or returns a flas-message, and unsets the session.
   *
   * @param string $name
   * The key for the flash-message.
   *
   * @param boolean $insert
   * A boolean indicating if we want to set or get a flash message.
   *
   * @return mixed
   * Returns an array with the flash message if requested.
   */
  public static function flashMessage($name, $insert = true) {

      if (!empty($name) && $insert && empty($_SESSION[$name])) {

        $messageAndClass = self::getMessageAndClassByType($name);
        $_SESSION[$name] = $messageAndClass['message'];

      } elseif (!empty($name) && !$insert && !empty($_SESSION[$name])) {

        $messageAndClass = self::getMessageAndClassByType($name);;

        $message = [
          'class' => $messageAndClass['class'],
          'content' => $messageAndClass['message'],
          'id' => 'flash-message',
        ];

        unset($_SESSION[$name]);

        return $message;
      }
  }


  /**
   * The getAllFlashMessages method.
   * A method that loops through all the flash keys,
   * and attempts to get their content if set.
   *
   * @return array
   * An array containing flash messages and a classes.
   */
  public static function getAllFlashMessages() {

    $return_messages = [];

    foreach (self::$messages as $key => $value) {
      $new_message = self::flashMessage($key, false);
      if (!empty($new_message['content'])) {
        array_push($return_messages, $new_message);
      }
    }

    return $return_messages;
  }

}
