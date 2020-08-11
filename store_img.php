<?php 
   if($_POST){
      $item = $_POST["Item"];
      $room = $_POST["Room"];
      $store = $_POST["Store"];
      $points = $_POST["Point"];
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["Image"]["name"]);
      $images = $target_file;

      $image = $_POST["Image"];

      

      echo "\n".$image;

      $file = fopen("test.txt","w");
      $text = "$item, $room, $store, $points, $images";
      echo $text;
      // fwrite($file,$text);
      // fclose($file);
    

      if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
         echo "\nThe file ". basename( $_FILES["Image"]["name"]). " has been uploaded.";
     } else {
         echo "\nSorry, there was an error uploading your file.";
     }
    // print_r($_POST);
    // echo $_POST["image"];
    // $target_dir = "uploads/";
    // $target_file = $target_dir . basename($_FILES["Image"]["name"]);
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   }
?>