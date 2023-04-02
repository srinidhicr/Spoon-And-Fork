<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_faves.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1 class="title">about the recipe</h1>

   <?php
      $rid = $_GET['rid'];
      $select_recipes = $conn->prepare("SELECT * FROM `recipes` WHERE recipeID = ?");
      $select_recipes->execute([$rid]);
      if($select_recipes->rowCount() > 0){
         while($fetch_recipes = $select_recipes->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <img src="uploaded_img/<?= $fetch_recipes['image']; ?>" alt="">
      <a href="category.php?category=<?= $fetch_recipes['category']; ?>" class="cat"><?= $fetch_recipes['category']; ?></a>
      <div class="name"><?= $fetch_recipes['recipeName']; ?></div>
         </br>
      <h3 class="head">Description:</h3>
      <div class="content"><?= nl2br($fetch_recipes['recipeDesc']); ?></div>
         </br>
      <h3 class="head">Necessary Ingredients:</h3>
      <div class="content"><?= nl2br($fetch_recipes['ingredQty']); ?></div>
         </br>
      <h3 class="head">Steps to make your delicacy:</h3>
      <div class="content"><?= nl2br($fetch_recipes['recipeInstr']); ?></div>
         </br>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no recipes added yet!</p>';
      }
   ?>

<section class="recipes">

<h1 class="title">some more dishes</h1>

<div class="box-container">

   <?php
      $select_recipes = $conn->prepare("SELECT * FROM `recipes` LIMIT 3");
      $select_recipes->execute();
      if($select_recipes->rowCount() > 0){
         while($fetch_recipes = $select_recipes->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="rid" value="<?= $fetch_recipes['recipeID']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_recipes['recipeName']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_recipes['image']; ?>">
      <a href="quick_view.php?rid=<?= $fetch_recipes['recipeID']; ?>" class="fas fa-eye"></a>
      <button type="submit" class="fa-solid fa-heart" name="add_to_faves"></button>
      <img src="uploaded_img/<?= $fetch_recipes['image']; ?>" alt="">
      <a href="category.php?category=<?= $fetch_recipes['category']; ?>" class="cat"><?= $fetch_recipes['category']; ?></a>
      <div class="name"><?= $fetch_recipes['recipeName']; ?></div>

   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no recipes added yet!</p>';
      }
   ?>

</div>

</section>
















<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>