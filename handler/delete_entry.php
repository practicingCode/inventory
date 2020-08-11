<?php 
if($_POST){
        $entry_name = $_POST["entry"];
        $entry_name = str_replace('_', ' ', $entry_name);
        //SQL
        require_once("auth.php");
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // GET ALL DETAILS
        
        $sql = "SELECT entry_id FROM entries WHERE item='$entry_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["entry_id"];
                
                echo $id;
            }
            } else {
            echo "0 results";
            }
            
        // DELETE ENTRY FROM entry
    
        $sql = "DELETE FROM entries WHERE entry_id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "entry deleted successfully";
              } else {
                echo "Error deleting record: " . $conn->error;
              }

        $conn->close();
    
    }
?>