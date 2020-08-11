<?php 
    if($_POST){
        $store_name = $_POST["store"];
        $room_name = $_POST["room"];
        // $store_name = "Beside Window";
        // $room_name = "test roomie";
        $store_name = str_replace('_', ' ', $store_name);
        $room_name = str_replace('_', ' ', $room_name);
        
        // echo "\n $store_name \n $room_name";
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $find_id = "SELECT room_id FROM room WHERE room_name='$room_name'";
        $result = $conn->query($find_id);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["room_id"];
                
            }
            } else {
            echo "0 results";
            }

        $sql = "INSERT INTO store(store_name, room_id) VALUES('$store_name', $id)";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        echo "\nStore generated";
        
        $conn->close();
    }
?>