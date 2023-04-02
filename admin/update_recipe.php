<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
};

if(isset($_POST['update'])){

   $rid = $_POST['rid'];
   $rid = filter_var($rid, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $rdesc = $_POST['rdesc'];
   $rdesc = filter_var($rdesc, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $ingredqty = $_POST['ingredqty'];
   $ingredqty = filter_var($ingredqty, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $serves = $_POST['serves'];
   $serves = filter_var($serves, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $instr = $_POST['instr'];
   $instr = filter_var($instr, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $update_recipe = $conn->prepare("UPDATE `recipes` SET recipeName = ?, recipeDesc = ?, ingredqty = ?, serves = ?, recipeInstr = ?, category = ? WHERE recipeID = ?");
   $update_recipe->execute([$name, $rdesc, $ingredqty, $serves, $instr, $category, $rid]);

   $message[] = 'recipe updated!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'images size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `recipes` SET image = ? WHERE recipeID = ?");
         $update_image->execute([$image, $rid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../uploaded_img/'.$old_image);
         $message[] = 'image updated!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update recipe</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- update recipe section starts  -->

<section class="update-recipe">

   <h1 class="heading">update recipe</h1>

   <?php
      $update_id = $_GET['update'];
      $show_recipes = $conn->prepare("SELECT * FROM `recipes` WHERE recipeID = ?");
      $show_recipes->execute([$update_id]);
      if($show_recipes->rowCount() > 0){
         while($fetch_recipes = $show_recipes->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="rid" value="<?= $fetch_recipes['recipeID']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_recipes['recipeName']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_recipes['image']; ?>">
      <img src="../uploaded_img/<?= $fetch_recipes['image']; ?>" alt="">
      <span>update recipeName</span>
      <input type="text" required placeholder="enter recipe recipeName" name="name" maxlength="100" class="box" value="<?= $fetch_recipes['recipeName']; ?>">
      <span>update recipe description</span>
      <textarea type="text" required placeholder="enter recipe descriptions" name="rdesc" maxlength="10000000" class="box" style="height: 200px"><?= $fetch_recipes['recipeDesc']; ?></textarea>
      <span>update ingredients</span>
      <textarea type="text" required placeholder="enter recipe ingredients and quantity" name="ingredqty" maxlength="10000000" class="box" style="height: 400px"><?= $fetch_recipes['ingredQty']; ?></textarea>
      <span>update serves</span>
      <input type="number" min="0" max="9999999999" required placeholder="enter recipe serves" name="serves" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_recipes['serves']; ?>">
      <span>update instructions</span>
      <textarea type="text" required placeholder="enter recipe instructions" name="instr" maxlength="10000000" class="box" style="height: 500px"><?= $fetch_recipes['recipeInstr']; ?></textarea>
      <span>update category</span>
      <select name="category" class="box" required>
         <option value="starters">starters</option>
         <option value="main dishes">main dishes</option>
         <option value="snacks">snacks</option>
         <option value="desserts">desserts</option>
      </select>
      <span>update image</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="recipes.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no recipes added yet!</p>';
      }
   ?>

</section>

<!-- update recipe section ends -->



<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>