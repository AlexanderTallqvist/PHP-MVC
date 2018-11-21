<?php

/**
 * @file
 * The Pages Controller.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */


namespace App\Controllers;

use App\Libraries\View;
use App\Models\User;
use App\Models\Page;
use App\Helpers\Redirect;


class Pages {


  /**
   * Contains an instance of the Page Model.
   * @var Page
   */
  private $pageModel;


  /**
   * The class constructor.
   */
  function __construct() {
    $this->pageModel = new Page;
  }


  /**
   * The index method.
   * Called @ /
   *
   * @return void
   */
  public function index() {

    if (User::isLoggedIn()) {
      Redirect::transfer('posts');
    }

    $data = $this->pageModel->getLandingPage();

    View::renderTwig("pages/index", $data);
  }


  /**
   * The index method.
   * Called @ /about
   *
   * @return void
   */
  public function about() {

    $data = $this->pageModel->getAboutPage();

    View::renderTwig("pages/about", $data);
  }
}
