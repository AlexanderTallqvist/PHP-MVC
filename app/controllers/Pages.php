<?php

/**
 * @file
 * The Pages Controller.
 * The Pages controller functions as the default controller,
 * and gets called if no URL parameters for a controller are set.
 */

class Pages extends Controller {

  /**
   * The class constructor.
   */
  function __construct() {
    $this->postModel = $this->model("Post");
  }

  /**
   * The index method.
   * Gets called by default if no other method
   * is specified in the URL.
   */
  public function index() {
    $posts = $this->postModel->getPosts();

    $data = [
      "title" => "Welcome",
      "posts" => $posts,
    ];

    $this->view("pages/index", $data);
  }

  /**
   * The about method.
   */
  public function about() {
    $data = [
      "title" => "About Us"
    ];
    $this->view("pages/about", $data);
  }
}
