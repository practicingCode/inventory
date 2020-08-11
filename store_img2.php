<?php 
   if($_POST){
      // $item = $_POST["Item"];
      // $room = $_POST["Room"];
      // $store = $_POST["Store"];
      // $points = $_POST["Point"];
      // $target_dir = "uploads/";
      // $target_file = $target_dir . basename($_FILES["Image"]["name"]);
      // $images = $target_file;

      

      
      
      // $image =implode(", ", $_POST);
      // echo $image;

      $images = $_FILES["Image"];   
      $file = fopen("test.png","w");
      $text = base64_decode($images);
      echo $images;

      fwrite($file,$text);
      fclose($file);
    
   }
?>