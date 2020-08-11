<?php 
if($_POST){
        $cmt_id= $_POST["comment_id"];
        
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "DELETE FROM comment WHERE comment_id=$cmt_id";
            if ($conn->query($sql) === TRUE) {
                echo "comment deleted successfully";
              } else {
                echo "Error deleting comment: " . $conn->error;
              }

        $conn->close();
    
    }
?>