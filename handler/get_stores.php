<?php 

    if($_POST){
        $room_name = $_POST["room"];
        $room_name = str_replace('_', ' ', $room_name);
        
        // $room_name = "Jabez Room";
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT room_id FROM room WHERE room_name='$room_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $room_id = $row["room_id"];
                
            }
            }
        $stores = "SELECT store_name FROM store WHERE room_id='$room_id'";
        $result = $conn->query($stores);
        
        $array = [];
        $string = "";
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $store_name = $row["store_name"];
                $string .= "$store_name,";
                
                // array_push($array, $store_name);
            }
            }
        $conn->close();
        // echo "The room id is: $room_id";
        echo "$string";
    
        
    }

?>