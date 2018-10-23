<?php require APPROOT . "/views/inc/header.php"; ?>
  <div class="posts--add">
    <h1 class="posts--add--title">Add a new Post</h1>
    <p class="posts--add--description">Create a new post.</p>
    <a href="<?php echo URLROOT; ?>/posts" class="posts--add--back">Go Back</a>
    <form class="posts--add--form" action="<?php echo URLROOT; ?>/posts/add" method="post">

      <div class="posts--add--form__group">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?php echo $data['title'] ?>" class="<?php echo empty($data['title_error']) ? "correct" : "invalid" ?>">
        <span><?php echo $data['title_error'] ?></span>
      </div>

      <div class="posts--add--form__group">
        <label for="body">Body</label>
        <textarea name="body" class="<?php echo empty($data['body_error']) ? "correct" : "invalid" ?>"><?php echo $data['body'] ?></textarea>
        <span><?php echo $data['body_error'] ?></span>
      </div>

      <div class="posts--add--form__buttons">
        <input class="posts--add--form__buttons__submit" type="submit" value="Submit Post">
      </div>
    </form>
  </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>
