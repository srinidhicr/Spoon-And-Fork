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
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>



<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>FOOD BLOG</span>
               <h3>SPOON & FORK</h3>
               <a href="menu.php" class="btn">see recipes</a>
            </div>
            <div class="image1">
               <img src="images/home-fb1.jpg" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>FOOD BLOG</span>
               <h3>SPOON & FORK</h3>
               <a href="menu.php" class="btn">see recipes</a>
            </div>
            <div class="image1">
               <img src="images/home-fb2.jpg" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>FOOD BLOG</span>
               <h3>SPOON & FORK</h3>
               <a href="menu.php" class="btn">see recipes</a>
            </div>
            <div class="image1">
               <img src="images/home-fb3.png" alt="">
            </div>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<section class="category">

   <h1 class="title">food category</h1>

   <div class="box-container">

      <a href="category.php?category=starters" class="box">
         <img src="images/cat-1.png" alt="">
         <h3>starters</h3>
      </a>

      <a href="category.php?category=main dishes" class="box">
         <img src="images/cat-2.png" alt="">
         <h3>main dishes</h3>
      </a>

      <a href="category.php?category=snacks" class="box">
         <img src="images/cat-3.png" alt="">
         <h3>snacks</h3>
      </a>

      <a href="category.php?category=desserts" class="box">
         <img src="images/cat-4.png" alt="">
         <h3>desserts</h3>
      </a>

   </div>

</section>




<section class="recipes">

   <h1 class="title">latest dishes</h1>

   <div class="box-container">

      <?php
         $select_recipes = $conn->prepare("SELECT * FROM `recipes` LIMIT 6");
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

   <div class="more-btn">
      <a href="menu.php" class="btn">view all</a>
   </div>

</section>


















<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>