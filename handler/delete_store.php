<?php 
if($_POST){
        $store_name = $_POST["store"];
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // GET ALL DETAILS
        
        $sql = "SELECT * FROM store WHERE store_name='$store_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["store_id"];
                
                echo $id;
            }
            } else {
            echo "0 results";
            }
            


        // DELETE ENTRY FROM store
    
        $sql = "DELETE FROM store WHERE store_id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "store deleted successfully";
              } else {
                echo "Error deleting record: " . $conn->error;
              }

        $conn->close();
    
    }
?>