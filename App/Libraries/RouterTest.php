<?php
namespace App\Libraries;
/**
 * Router
 *
 * PHP version 7.0
 */
class RouterTest
{
    /**
     * Associative array of routes (the routing table)
     * @var array
     */
    protected $routes = [];
    /**
     * Parameters from the matched route
     * @var array
     */
    protected $params = [];
    /**
     * Add a route to the routing table
     *
     * @param string $route  The route URL
     * @param array  $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function addAllowedRoute($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);
        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }
    /**
     * Get all the routes from the routing table
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }
    /**
     * Match the route to the routes in the routing table, setting the $params
     * property if a route is found.
     *
     * @param string $url The route URL
     *
     * @return boolean  true if a match found, false otherwise
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
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
     * Get the currently matched parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
    /**
     * Dispatch the route, creating the controller object and running the
     * action method
     *
     * @param string $url The route URL
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
              if (array_key_exists('id', $this->params)) {
                call_user_func_array([
                  $controller_object,
                  $action],
                  [$this->params['id']]
                );
              } else {
                $controller_object->$action();
              }
          } else {
              die("Something went wrong.");
          }
      } else {
          die("Something went wrong.");
      }
    }


    /**
     * The fetchUrl function
     * Extracts the URL values and escapes the values.
     *
     * @return array
     * An array containing URL data, such as the requested
     * controller, the method, and parameters.
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

}
