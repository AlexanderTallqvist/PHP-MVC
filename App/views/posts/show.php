<?php require APPROOT . "/views/inc/header.php"; ?>
  <div class="posts--show">
    <a class="posts--show--back" href="<?php echo URLROOT; ?>/posts">Go Back</a>
    <div class="posts--show--container">
      <h1 class="posts--show--container__title"><?php echo $data['post']->title; ?></h1>
      <div class="posts--show--container__author">Author: <?php echo $data['user']->name; ?></div>
      <div class="posts--show--container__created">Created: <?php echo $data['post']->created_date; ?></div>
      <div class="posts--show--container__body"><?php echo $data['post']->body; ?></div>
      <?php if($data['post']->user_id === $_SESSION['user_id']) : ?>
        <hr>
        <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id ?>" class="posts--show--container__edit">Edit this post</a>
        <form class="posts--show--container__delete" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id ?>" method="post">
          <input type="submit" value="Delete this post">
        </form>
      <?php endif; ?>
    </div>
  </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>
