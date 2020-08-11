<?php 
print_r($_REQUEST);
echo"\n=============POST==================\n";
print_r($_POST);
echo "\n=========== FILES==================\n";
print_r($_FILES);

  //    if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
   //       echo "The file ". basename( $_FILES["Image"]["name"]). " has been uploaded.";
   //   } else {
   //       echo "Sorry, there was an error uploading your file.";
   //   }
?>