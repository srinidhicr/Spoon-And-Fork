<?php

if(isset($_POST['add_to_faves'])){

   if($user_id == ''){
      header('location:login.php');
   }else{

      $rid = $_POST['rid'];
      $rid = filter_var($rid, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $check_faves_numbers = $conn->prepare("SELECT * FROM `faves` WHERE name = ? AND user_id = ?");
      $check_faves_numbers->execute([$name, $user_id]);

      if($check_faves_numbers->rowCount() > 0){
         $message[] = 'already added to faves!';
      }else{
         $insert_faves = $conn->prepare("INSERT INTO `faves`(user_id, rid, name, image) VALUES(?,?,?,?)");
         $insert_faves->execute([$user_id, $rid, $name, $image]);
         $message[] = 'added to faves!';
         
      }

   }

}

?>