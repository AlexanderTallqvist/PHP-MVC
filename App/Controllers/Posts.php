<?php

/**
 * @file
 * The Posts Controller.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */


namespace App\Controllers;

use App\Libraries\View;
use App\Models\User;
use App\Models\Post;
use App\Helpers\Redirect;
use App\Helpers\Messages;


class Posts {


  /**
   * Contains an instance of the Post Model.
   * @var Post
   */
  private $postModel;


  /**
   * Contains an instance of the User Model.
   * @var User
   */
  private $userModel;


  /**
   * The class constructor.
   */
  function __construct() {

    if (!User::isLoggedIn()) {
      Redirect::transfer('users/login');
      exit;
    } else {
      $this->postModel = new Post;
      $this->userModel = new User;
    }
  }


  /**
   * The index method.
   * Called @ /posts
   *
   * @return void
   */
  public function index() {

    $posts = $this->postModel->getPosts();

    $data = [
      "title" => "Recent Thoughts",
      'posts' => $posts,
    ];

    View::renderTwig("posts/index", $data);
  }


  /**
   * The add method.
   * Called @ /posts/add
   * Methods: GET, POST
   *
   * @return void
   */
  public function add() {

    $METHOD = $_SERVER['REQUEST_METHOD'];

    switch ($METHOD) {

      case 'POST':

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          "title" => trim($_POST['title']),
          "body" => trim($_POST['body']),
          "user_id" => $this->userModel->getUserSessionId(),
          "title_error" => "",
          "body_error" => ""
        ];

        $data = $this->postModel->validateAddForm($data);

        if (empty($data['title_error']) && empty($data['body_error'])) {

          if ($this->postModel->addPost($data)) {
            Messages::flashMessage('post_success');
            Redirect::transfer('posts');

          } else {
            Messages::flashMessage('post_error');
            Redirect::transfer('posts');
          }

        } else {
          View::renderTwig("posts/add", $data);
        }

        break;

      default:

        $data = [
          "title" => "",
          'body' => "",
          "title_error" => "",
          "body_error" => ""
        ];

        View::renderTwig("posts/add", $data);

        break;
    }
  }


  /**
   * The show method.
   * Called @ /posts/show/{id}
   * Methods: GET
   *
   * @param int $post_id
   * The ID of the post that we're trying to view.
   *
   * @return void
   */
  public function show($post_id) {

    $post = $this->postModel->getPostById($post_id);

    if ($post) {
      $user = $this->userModel->findUserById($post->user_id);

      $data = [
        'post' => $post,
        'user' => $user
      ];
      View::renderTwig("posts/show", $data);

    } else {
      Messages::flashMessage('post_not_found');
      Redirect::transfer('posts');
    }
  }


  /**
   * The edit method.
   * Called @ /posts/edit/{id}
   * Methods: GET, POST
   *
   * @param int $post_id
   * The ID of the post that we're trying to edit.
   *
   * @return void
   */
  public function edit($post_id) {

    $METHOD = $_SERVER['REQUEST_METHOD'];

    switch ($METHOD) {

      case 'POST':

        $post = $this->postModel->getPostById($post_id);

        if ($post === false || $post->user_id !== $this->userModel->getUserSessionId()) {
          Messages::flashMessage('post_error');
          Redirect::transfer('posts');

        } else {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
            "post_id" => $post_id,
            "title" => trim($_POST['title']),
            "body" => trim($_POST['body']),
            "user_id" => $this->userModel->getUserSessionId(),
            "title_error" => "",
            "body_error" => ""
          ];

          $data = $this->postModel->validateEditForm($data);

          if (empty($data['title_error']) && empty($data['body_error'])) {

            if ($this->postModel->editPost($data)) {
              Messages::flashMessage('post_edited');
              Redirect::transfer('posts');

            } else {
              Messages::flashMessage('post_error');
              Redirect::transfer('posts');
            }

          } else {
            View::renderTwig("posts/edit", $data);
          }
        }

        break;

      default:

        $post = $this->postModel->getPostById($post_id);

        if ($post === false || $post->user_id !== $this->userModel->getUserSessionId()) {
          Redirect::transfer('posts');

        } else {
          $data = [
            "title" => $post->title,
            "body" => $post->body,
            "post_id" => $post_id,
            "title_error" => "",
            "body_error" => ""
          ];

          View::renderTwig("posts/edit", $data);
        }

        break;
    }
  }


  /**
   * The delete method.
   * Called @ /posts/delete/{id}
   * Methods: POST
   *
   * @param int $post_id
   * The ID of the post that we're trying to delete.
   *
   * @return void
   */
  public function delete($post_id) {

    $METHOD = $_SERVER['REQUEST_METHOD'];

    switch ($METHOD) {

      case 'POST':

        $post = $this->postModel->getPostById($post_id);

        if ($post === false || $post->user_id !== $this->userModel->getUserSessionId()) {
          Messages::flashMessage('post_error');
          Redirect::transfer('posts');

        } elseif (!empty($post) && $this->postModel->deletePostById($post_id)) {
          Messages::flashMessage('post_deleted');
          Redirect::transfer('posts');

        } else {
          Messages::flashMessage('post_error');
          Redirect::transfer('posts');
        }

        break;

      default:
        Redirect::transfer('posts');

        break;
    }
  }

}
