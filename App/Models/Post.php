<?php

/**
 * @file
 * The Post Model.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */


namespace App\Models;

use App\Core\Model;


class Post extends Model {


  /**
   * The getPosts method.
   * A method that fetches all the posts and related user
   * data from the database.
   *
   * @return array
   * Returns an array of post and user data.
   */
  public function getPosts() {
    $this->db->query("SELECT *,
                      posts.id as postId,
                      users.id as userId,
                      posts.created_date as postCreated,
                      users.created_date as userCreated
                      FROM posts
                      INNER JOIN users
                      ON posts.user_id = users.id
                      ORDER BY posts.created_date DESC
                    ");

    return $this->db->resultSet();
  }


  /**
   * The addPost method.
   * A method that inserts a new post
   * into the database.
   *
   * @param array $data
   * An array containing the post data.
   *
   * @return boolean
   * Returns true or false, depending on if the post
   * could be inserted into the database or not.
   */
  public function addPost($data) {

    $this->db->query("INSERT INTO posts (title, user_id, body) VALUES(:title, :user_id, :body)");
    $this->db->bind(":title", $data['title']);
    $this->db->bind(":user_id", $data['user_id']);
    $this->db->bind(":body", $data['body']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }


  /**
   * The editPost method.
   * A method that edits a post in the database.
   *
   * @param array $data
   * An array containing the post data.
   *
   * @return boolean
   * Returns true or false, depending on if the post
   * could be edited or not.
   */
  public function editPost($data) {

    # Make sure that the post exists

    $this->db->query("UPDATE posts SET title = :title, body = :body WHERE id = :id");
    $this->db->bind(":id", $data['post_id']);
    $this->db->bind(":title", $data['title']);
    $this->db->bind(":body", $data['body']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }


  /**
   * The getPostById method.
   * A method that fetches a post by a post ID.
   *
   * @param int $post_id
   * The post ID of the post that we're trying to fetch.
   *
   * @return mixed
   * Returns either a row containg the post data,
   * or false, indicating that the post couldn't be found.
   */
  public function getPostById($post_id) {
    $this->db->query("SELECT * FROM posts WHERE id = :id");
    $this->db->bind(":id", $post_id);

    $row = $this->db->singleResult();

    if ($this->db->rowCount() > 0) {
      return $row;
    } else {
      return false;
    }
  }


  /**
   * The deletePostById method.
   * A method that deletes a post in the database.
   *
   * @param int $post_id
   * The post ID of the post that we're trying to delete.
   *
   * @return boolean
   * Returns true or false, depending on if the post
   * could be deleted or not.
   */
  public function deletePostById($post_id) {
    $this->db->query("DELETE FROM posts WHERE id = :id");
    $this->db->bind(":id", $post_id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }


  /**
   * The validateAddForm method.
   * A "parent" method for the "New Post"  form validation.
   *
   * @param array $data
   * An array containing data from the "New Post" form.
   *
   * @return array
   * Returns back the same data array with validated data.
   */
  public function validateAddForm($data) {
    $data['title_error'] = self::validateTitle($data['title']);
    $data['body_error']  = self::validateBody($data['body']);

    return $data;
  }


  /**
   * The validateEditForm method.
   * A "parent" method for the "Edit Post"  form validation.
   *
   * @param array $data
   * An array containing data from the "Edit Post" form.
   *
   * @return array
   * Returns back the same data array with validated data.
   */
  public function validateEditForm($data) {
    $data['title_error'] = self::validateTitle($data['title']);
    $data['body_error']  = self::validateBody($data['body']);

    return $data;
  }


  /**
   * The validateTitle method.
   * A validator method for form title.
   *
   * @param string $title
   * A string containing the form title.
   *
   * @return string
   * Returns an error string if needed.
   */
  public function validateTitle($title) {
    if (empty($title)) {
      return "Plase enter a title.";
    }

    if (strlen($title) > 150) {
      return "The title should not be longer than 150 characters.";
    }
  }


  /**
   * The validateBody method.
   * A validator method for form body.
   *
   * @param string $body
   * A string containing the form body.
   *
   * @return string
   * Returns an error string if needed.
   */
  public function validateBody($body) {
    if (empty($body)) {
      return "The body text is empty.";
    }

    if (strlen($body) > 2000) {
      return "The body should not be longer than 2000 characters.";
    }
  }

}
