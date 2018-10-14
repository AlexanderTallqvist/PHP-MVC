<?php

namespace App\Libraries;

/**
 * @file
 * The Base Controller.
 * The Base Controller functions as a base for all other controllers,
 * and proviedes default functionality like loading views and models.
 */

class Controller {

/**
 * The main model method.
 *
 * @param  string $model
 * The name of the requested model file.
 *
 * @return Class
 * An instance of the requested model class.
 */
  public function model($model) {
    $model = "App\Models\\" . $model;
    //require_once("../App/Models/" . $model . ".php");

    # Instantiate the model
    return new $model;
  }

 /**
  * The main view method.
  *
  * @param  string $view
  * The name of the requested view file.
  *
  * @param  array $data
  * An array containing data for our view template
  */
  public function view($view, $data) {
    if (file_exists("../App/views/" . $view . ".php")) {
      require_once("../App/views/" . $view . ".php");
    } else {
      die("View does not exist.");
    }
  }
}
