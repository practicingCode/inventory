<?php 
if($_POST){
        $room_name = $_POST["room"];
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // GET ALL DETAILS
        
        $sql = "SELECT * FROM room WHERE room_name='$room_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["room_id"];
                
                echo $id;
            }
            } else {
            echo "0 results";
            }
            
        // DELETE ENTRY FROM room
    
        $sql = "DELETE FROM room WHERE room_id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "room deleted successfully";
              } else {
                echo "Error deleting record: " . $conn->error;
              }

        $conn->close();
    
    }
?>