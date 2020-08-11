<?php 
// IN > NAME
//        OUT > DETAILS
    if($_POST){
        $room_name = $_POST["room"];
        // $room_name = "Jabez Room";
        $room_name = str_replace('_', ' ', $room_name);
        // echo $location_name;
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM room WHERE room_name='$room_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["room_id"];
                $name =$row["room_name"];
                $name2 =  str_replace('_', ' ', $name);
                $stores =$row["stores"];
                $points =$row["points"];
                $entries = $row["entries"];
            }
            } else {
            echo "0 results";
            }

        $conn->close();
        $res = "$id, $name2, $stores, $points, $entries";
        echo $res;
    }

?>