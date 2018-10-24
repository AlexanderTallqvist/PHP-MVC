<?php

namespace App\Models;

use App\Libraries\Model;

/**
 * @file
 * The Post Model.
 */

class Post extends Model {


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


  public function editPost($data) {

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


  public function getPostById($post_id) {
    $this->db->query("SELECT * FROM posts where id = :id");
    $this->db->bind(":id", $post_id);

    $row = $this->db->singleResult();

    if ($this->db->rowCount() > 0) {
      return $row;
    } else {
      return false;
    }
  }


  public function validateTitle($title) {
    if (empty($title)) {
      return "Plase enter a title.";
    }
  }


  public function validateBody($body) {
    if (empty($body)) {
      return "The body text is empty.";
    }
  }
}
