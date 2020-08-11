<?php 
if($_POST){
        $point_name = $_POST["point"];
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // GET ALL DETAILS
        
        $sql = "SELECT * FROM points WHERE point_name='$point_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["point_id"];
                
                echo $id;
            }
            } else {
            echo "0 results";
            }
            

        // DELETE ENTRY FROM point
    
        $sql = "DELETE FROM points WHERE point_id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "point deleted successfully";
              } else {
                echo "Error deleting record: " . $conn->error;
              }

        $conn->close();
    
    }
?>