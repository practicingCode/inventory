<?php 
// IN > NAME
//        OUT > DETAILS
    if($_POST){
        $point_name = $_POST["point"];
        // $point_name = "Under Bed";
        // echo $point_name;
        $point_name = str_replace('_', ' ', $point_name);
        // echo $location_name;
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM points WHERE point_name='$point_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["point_id"];
                $point_name =$row["point_name"];
                $name2 =  str_replace('_', ' ', $point_name);
                $store_id = $row["store_id"];
                
            }
            } else {
            echo "0 results";
            }

        $sql = "SELECT store_name FROM store WHERE store_id=$store_id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                $store_name =$row["store_name"];
                
            }
            } else {
            echo "0 results";
            }
    
        $conn->close();
        $res = "$id, $name2, $store_id, $store_name";
        echo $res;
        // print_r($store_id);
    }

?>