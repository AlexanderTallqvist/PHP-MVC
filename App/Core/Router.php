<?php

/**
 * @file
 * The Main Router Class.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */


namespace App\Core;

use App\Helpers\Messages;
use App\Helpers\Redirect;


class Router {


  /**
   * An array containing all of our routes.
   * @var array
   */
  protected $routes = [];


  /**
   * An array containing parameters for our routes.
   * @var array
   */
  protected $params = [];


  /**
   * The getParams method.
   * Getter for our url parameters.
   *
   * @return array
   * An array containing url parameters.
   */
  public function getParams() {
    return $this->params;
  }


  /**
   * The getRoutes method.
   * Getter for our routes.
   *
   * @return array
   * An array containing routes.
   */
  public function getRoutes() {
    return $this->routes;
  }


   /**
    * The fetchUrl method.
    * Extracts the URL values and escapes sanitize them.
    *
    * @return string
    * An sanitized URL string.
    */
   public function fetchUrl() {
     if (isset($_GET['url'])) {
       $url = rtrim($_GET['url'], "/");
       $url = filter_var($url, FILTER_SANITIZE_URL);
       return $url;
     } else {
       return "";
     }
   }


 /**
  * The addAllowedRoute method.
  * Method for stroring allowed routes and their parameters.
  *
  * @param string $urlRoute
  * The URL string.
  *
  * @param array $params
  * Parameters that have been assigned to our URL,
  * (AKA Controllers and Actions).
  *
  * @return void
  */
  public function addAllowedRoute($urlRoute, $params = []) {
    $urlRoute = self::formatRoutes($urlRoute);
    $this->routes[$urlRoute] = $params;
  }


  /**
   * The formatRoutes method.
   * Formats a route with needed regular expression.
   *
   * @param string $urlRoute
   * The URL string.
   *
   * @return string
   * A formatted route string.
   */
  public function formatRoutes($urlRoute) {
    // Convert the route to a regular expression: escape forward slashes
    $urlRoute = preg_replace('/\//', '\\/', $urlRoute);
    // Convert variables with custom regular expressions e.g. {id:\d+}
    $urlRoute = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $urlRoute);
    // Add start and end delimiters, and case insensitive flag
    $urlRoute = '/^' . $urlRoute . '$/i';

    return $urlRoute;
  }


  /**
   * The match method.
   * Matches urls with routes in our routing table, and sets their
   * parameters if needed.
   *
   * @param string $url
   * The route URL.
   *
   * @return boolean
   * Returns true if we find a match,
   * otherwise false.
   */
  public function match($url) {

    foreach ($this->routes as $route => $params) {

      if (preg_match($route, $url, $matches)) {

        foreach ($matches as $key => $match) {

          if (is_string($key)) {
              $params[$key] = $match;
          }
        }
        $this->params = $params;
        return true;
      }
    }
    return false;
  }


  /**
   * The dispatch method.
   * A method that calls controller methods with parameters
   * if a registered route is found in our route table.
   *
   * @return void
   */
  public function dispatch() {
    $url = $this->fetchUrl();

    if ($this->match($url)) {
      $controller = $this->params['controller'];
      $controller = 'App\Controllers\\' . $controller;

      if (class_exists($controller)) {
        $controller_object = new $controller($this->params);
        $action = $this->params['action'];

        if (method_exists($controller_object, $action)) {

          if (array_key_exists('id', $this->params)) {
            call_user_func_array([$controller_object,$action],[$this->params['id']]);
          } else {
            $controller_object->$action();
          }
        } else {
          self::routeNotFound();
        }
      } else {
        self::routeNotFound();
      }
    } else {
      self::routeNotFound();
    }
  }


  protected static function routeNotFound() {
    Messages::flashMessage('route_not_found');
    Redirect::transfer('/');
  }

}
