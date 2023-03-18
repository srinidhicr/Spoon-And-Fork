<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>about us</h3>
   <p><a href="index.php">home</a> <span> / about</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>SPOON & FORK</h3>
         <p>S&K is a food blog website that is all about the love of food and the joy of sharing it with others. Here, we believe that food is more than just sustenance; it is a way to connect with others, to explore different cultures and flavors, and to celebrate life's simple pleasures. Our name, Spoon and Fork shortened as S&K, represents the tools that we use to enjoy and savor our food. Whether you are a seasoned chef or a home cook, we invite you to join us on our culinary journey and discover new recipes, techniques, and inspiration that will take your love of food to the next level. Come and share in the joy of food with S&K!</p>
         <a href="menu.php" class="btn">our recipes</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>select recipe</h3>
         <p>It's time to select your favorite recipe and gather all the necessary ingredients! Whether you're in the mood for something sweet or savory, simple or complex, there's a recipe out there that's just right for you. So put on your apron, turn up your favorite tunes, and let's get cooking! From farm-fresh produce to savory spices, let's gather all the fixings we need to create a masterpiece in the kitchen. </p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>start cooking</h3>
         <p>Let's fire up those burners and start cooking up a storm! Whether you're a seasoned chef or a beginner in the kitchen, there's no better time to put your cooking skills to the test. With the sizzle of the pan and the aroma of fresh herbs, we'll create a masterpiece that will tantalize our taste buds and make our mouths water. So let's chop, sauté, and simmer our way to a delicious meal that's sure to impress.</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy the food</h3>
         <p>From the sizzling stove to your plate, the aroma of your dish is sure to captivate! Our recipes are tried and true, and they'll never let you down. So take a bite, savor the flavor, and let your taste buds dance with delight. From the first mouth-watering morsel to the last savory crumb, you'll love every bite of your homemade masterpiece. So go ahead, indulge in your culinary creation and enjoy the fruits of your labor.</div>

   </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <h1 class="title">customer's reviews</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <img src="images/pic-1.png" alt="">
            <p>"I've tried so many new dishes thanks to Spoon and Fork, and I've loved every single one. The blog has helped me expand my culinary horizons, and I'm grateful for that."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Jacob Smith</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-2.png" alt="">
            <p>"I stumbled upon Spoon and Fork by accident, and I'm so glad I did! The recipes are easy to make, and the flavors are out of this world. I've already recommended this blog to all my friends."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Madison Brown</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-3.png" alt="">
            <p>"Spoon and Fork has changed the way I think about cooking. The recipes are always creative, and the photos make everything look so appetizing. I'm always excited to try something new from this blog."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Michael Johnson</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-4.png" alt="">
            <p>"As someone who is new to cooking, Spoon and Fork has been a lifesaver! The step-by-step instructions and helpful tips have made me feel confident in the kitchen, and I'm now making meals that I never thought I could."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Anjali Desai</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-5.png" alt="">
            <p>"The recipes on Spoon and Fork are incredible! They're easy to follow, and the results are always delicious. My family can't get enough of the meals I make from this blog."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Aarav Sharma</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-6.png" alt="">
            <p>"I've been using Spoon and Fork for years now, and I can honestly say that it's my go-to resource for recipe inspiration. From quick weeknight dinners to fancy dinner parties, this blog has it all!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Lee Ji-Yeon</h3>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- reviews section ends -->



















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>