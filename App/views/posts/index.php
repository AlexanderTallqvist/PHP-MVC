<?php require APPROOT . "/views/inc/header.php"; ?>
  <div class="posts--main">
    <h1 class="posts--main--title">Recent Posts</h1>
    <a class="posts--main--add" href="<?php echo URLROOT; ?>/posts/add">Add post</a>
    <div class="posts--main--list">
      <?php foreach($data['posts'] as $post) : ?>
        <div class="posts--main--list__item">
          <h2 class="posts--main--list__item__title"><?php echo $post->title; ?></h2>
          <span class="posts--main--list__item__author"><span>Author:</span> <?php echo $post->name; ?></span>
          <span class="posts--main--list__item__created"><span>Created:</span> <?php echo $post->postCreated; ?></span>
          <div class="posts--main--list__item__content"><?php echo $post->body; ?></div>
          <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="posts--main--list__item__more">Read more</a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>
