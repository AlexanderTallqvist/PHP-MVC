<?php require APPROOT . "/views/inc/header.php"; ?>
  <div class="posts--main">
    <h1 class="posts--main__title">All the Posts</h1>
    <a href="<?php echo URLROOT; ?>/posts/add">Add post</a>
    <div class="posts--main__list">
      <?php foreach($data['posts'] as $post) : ?>
        <div class="posts--main__list__item">
          <h2 class="posts--main__list__item__title"><?php echo $post->title; ?></h2>
          <span class="posts--main__list__item__author">Author: <?php echo $post->name; ?></span>
          <span class="posts--main__list__item__created">Created: <?php echo $post->postCreated; ?></span>
          <div class="posts--main__list__item__content"><?php echo $post->title; ?></div>
          <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="posts--main__list__item__more">Read more</a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>
