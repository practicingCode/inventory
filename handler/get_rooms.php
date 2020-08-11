<?php 

    if($_POST){

        //SQL
        require_once("auth.php");
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
       
        $room = "SELECT room_name FROM room";
        $result = $conn->query($room);
        
        $array = [];
        $string = "";
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $room_name = $row["room_name"];
                $string .= "$room_name,";
                
                // array_push($array, $store_name);
            }
        } 

        $conn->close();
        // echo "The store id is: $store_id";
        echo "$string";
    
        
    }

?>