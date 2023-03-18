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
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<!-- search form section starts  -->

<section class="search-form">
   <form method="post" action="">
      <input type="text" name="search_box" placeholder="search here..." class="box">
      <button type="submit" name="search_btn" class="fas fa-search"></button>
   </form>
</section>

<!-- search form section ends -->


<section class="recipes" style="min-height: 100vh; padding-top:0;">

<div class="box-container">

      <?php
         if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
         $search_box = $_POST['search_box'];
         $select_recipes = $conn->prepare("SELECT * FROM `recipes` WHERE name LIKE '%{$search_box}%'");
         $select_recipes->execute();
         if($select_recipes->rowCount() > 0){
            while($fetch_recipes = $select_recipes->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="rid" value="<?= $fetch_recipes['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_recipes['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_recipes['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_recipes['image']; ?>">
         <a href="quick_view.php?rid=<?= $fetch_recipes['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-faves" name="add_to_faves"></button>
         <img src="uploaded_img/<?= $fetch_recipes['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_recipes['category']; ?>" class="cat"><?= $fetch_recipes['category']; ?></a>
         <div class="name"><?= $fetch_recipes['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_recipes['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no recipes added yet!</p>';
         }
      }
      ?>

   </div>

</section>











<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>