<?php

namespace App\Controllers;

use App\Libraries\View;
use App\Models\User;
use App\Models\Post;
use App\Helpers\Redirect;
use App\Helpers\Messages;

/**
 * @file
 * The Posts Controller.
 */

class Posts {


  /**
   * The class constructor.
   */
  function __construct() {
    if(!User::isLoggedIn()) {
      Redirect::transfer('users/login');
    }

    $this->postModel = new Post;
    $this->userModel = new User;
  }

  /**
   * The index method.
   * Gets called by default if no other method
   * is specified in the URL.
   */
  public function index() {

    $posts = $this->postModel->getPosts();

    $data = [
      "title" => "Our posts page",
      'posts' => $posts,
    ];

    View::render("posts/index", $data);
  }

  public function add() {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        "title" => trim($_POST['title']),
        "body" => trim($_POST['body']),
        "user_id" => $_SESSION['user_id'],
        "title_error" => "",
        "body_error" => ""
      ];

      $data['title_error'] = $this->postModel->validateTitle($data['title']);
      $data['body_error']  = $this->postModel->validateBody($data['body']);

      if (empty($data['title_error']) && empty($data['body_error'])) {
        if ($this->postModel->addPost($data)) {
          Messages::flashMessage('post_success', 'Post submitted.');
          Redirect::transfer('posts');
        } else {
          die('SOMETHING WENT WRONG');
        }
      } else {
        View::render("posts/add", $data);
      }

    } else {
      $data = [
        "title" => "",
        'body' => "",
        "title_error" => "",
        "body_error" => ""
      ];

      View::render("posts/add", $data);
    }
  }

  public function show($post_id) {

    $post = $this->postModel->getPostById($post_id);

    if ($post) {
      $user = $this->userModel->findUserById($post->user_id);

      $data = [
        'post' => $post,
        'user' => $user
      ];
      View::render("posts/show", $data);

    } else {
      Messages::flashMessage('post_not_found', 'Post not found.');
      Redirect::transfer('posts');
    }
  }


  public function edit($post_id) {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        "post_id" => $post_id,
        "title" => trim($_POST['title']),
        "body" => trim($_POST['body']),
        "user_id" => $_SESSION['user_id'],
        "title_error" => "",
        "body_error" => ""
      ];

      $data['title_error'] = $this->postModel->validateTitle($data['title']);
      $data['body_error']  = $this->postModel->validateBody($data['body']);

      if (empty($data['title_error']) && empty($data['body_error'])) {
        if ($this->postModel->editPost($data)) {
          Messages::flashMessage('post_edited', 'Post edited succesfully.');
          Redirect::transfer('posts');
        } else {
          die('SOMETHING WENT WRONG');
        }
      } else {
        View::render("posts/edit", $data);
      }

    } else {

      $post = $this->postModel->getPostById($post_id);
      if ($post === false || $post->user_id !== $_SESSION['user_id']) {
        Redirect::transfer('posts');
      } else {
        $data = [
          "title" => $post->title,
          "body" => $post->body,
          "post_id" => $post_id,
          "title_error" => "",
          "body_error" => ""
        ];

        View::render("posts/edit", $data);
      }
    }
  }

}
