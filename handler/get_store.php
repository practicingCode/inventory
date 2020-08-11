<?php 
// IN > NAME
//        OUT > DETAILS
    if($_POST){
        $store_name = $_POST["store"];
        // $store_name = "Under Bed";
        // echo $store_name;
        $store_name = str_replace('_', ' ', $store_name);
        // echo $location_name;
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM store WHERE store_name='$store_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["store_id"];
                $store_name =$row["store_name"];
                $name2 =  str_replace('_', ' ', $store_name);
                $room_id = $row["room_id"];
                
            }
            } else {
            echo "0 results";
            }


        $sql = "SELECT room_name FROM room WHERE room_id=$room_id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                $room_name =$row["room_name"];
                
            }
            } else {
            echo "0 results";
            }
        $conn->close();
        $res = "$id, $name2, $room_id, $room_name";
        echo $res;
        
    }

?>