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
   <title>category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="recipes">

   <h1 class="title">food category</h1>

   <div class="box-container">

      <?php
         $category = $_GET['category'];
         $select_recipes = $conn->prepare("SELECT * FROM `recipes` WHERE category = ?");
         $select_recipes->execute([$category]);
         if($select_recipes->rowCount() > 0){
            while($fetch_recipes = $select_recipes->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="rid" value="<?= $fetch_recipes['recipeID']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_recipes['recipeName']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_recipes['image']; ?>">
         <a href="quick_view.php?rid=<?= $fetch_recipes['recipeID']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-faves" name="add_to_faves"></button>
         <img src="uploaded_img/<?= $fetch_recipes['image']; ?>" alt="">
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