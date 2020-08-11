<?php 
    if($_POST){
        $store_name = $_POST["store"];
        $room_name = $_POST["room"];
        $point_name = $_POST["point"];
        // $store_name = "Shelf Beside Window";
        // $room_name = "Jabez Room";
        // $point_name = "Box11";
        $store_name = str_replace('_', ' ', $store_name);
        $room_name = str_replace('_', ' ', $room_name);
        $point_name = str_replace('_', ' ', $point_name);
        // echo "\n $store_name \n $room_name";
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $find_id = "SELECT store_id FROM store WHERE store_name='$store_name'";
        $result = $conn->query($find_id);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["store_id"];
                
                
            }
            } else {
            echo "0 results";
            }
            echo $id;

        $sql = "INSERT INTO points(point_name, store_id) VALUES('$point_name', $id)";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        
        $conn->close();
    }
?>