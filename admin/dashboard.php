<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <div class="box">
      <h3>welcome!</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>

   <div class="box">
      <?php
         $select_recipes = $conn->prepare("SELECT * FROM `recipes`");
         $select_recipes->execute();
         $numbers_of_recipes = $select_recipes->rowCount();
      ?>
      <h3><?= $numbers_of_recipes; ?></h3>
      <p>recipes added</p>
      <a href="recipes.php" class="btn">see recipes</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <p>users accounts</p>
      <a href="users_accounts.php" class="btn">see users</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p>admins</p>
      <a href="admin_accounts.php" class="btn">see admins</a>
   </div>

   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $numbers_of_messages; ?></h3>
      <p>new messages</p>
      <a href="messages.php" class="btn">see messages</a>
   </div>

   </div>

</section>

<!-- admin dashboard section ends -->





<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>