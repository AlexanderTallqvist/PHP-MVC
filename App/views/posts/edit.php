<?php require APPROOT . "/views/inc/header.php"; ?>
  <div class="posts--edit">
    <h1 class="posts--edit--title">Edit your post</h1>
    <p class="posts--edit--description">You can edit your post here.</p>
    <a href="<?php echo URLROOT; ?>/posts" class="posts--edit--back">Go Back</a>
    <form class="posts--edit--form" action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post_id']; ?>" method="post">

      <div class="posts--edit--form__group">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?php echo $data['title'] ?>" class="<?php echo empty($data['title_error']) ? "correct" : "invalid" ?>">
        <span><?php echo $data['title_error'] ?></span>
      </div>

      <div class="posts--edit--form__group">
        <label for="body">Body</label>
        <textarea name="body" class="<?php echo empty($data['body_error']) ? "correct" : "invalid" ?>"><?php echo $data['body']; ?></textarea>
        <span><?php echo $data['body_error'] ?></span>
      </div>

      <div class="posts--edit--form__buttons">
        <input class="posts--edit--form__buttons__submit" type="submit" value="Submit Post">
      </div>
    </form>
  </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>
