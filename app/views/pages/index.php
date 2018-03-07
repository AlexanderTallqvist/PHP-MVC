<?php require APPROOT . "/views/inc/header.php"; ?>
  <h1><?php echo $data['title']; ?></h1>
  <ul>
    <?php foreach ($data["posts"] as $post): ?>
      <?php echo "<li>" . $post->title . "</li>"; ?>
    <?php endforeach; ?>
  </ul>
<?php require APPROOT . "/views/inc/footer.php"; ?>
