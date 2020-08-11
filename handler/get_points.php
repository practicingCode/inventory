<?php 

    if($_POST){
        $store_name = $_POST["store"];
        // $store_name = "Under Bed";
        $store_name = str_replace('_', ' ', $store_name);
        
        // $store_name = "Jabez store";
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT store_id FROM store WHERE store_name='$store_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $store_id = $row["store_id"];
                
            }
            } else {
            echo "0 results";
            }

        $stores = "SELECT point_name FROM points WHERE store_id='$store_id'";
        $result = $conn->query($stores);
        
        $array = [];
        $string = "";
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $point_name = $row["point_name"];
                $string .= "$point_name,";
                
                // array_push($array, $store_name);
            }
            } else {
            echo "0 results";
            }

        $conn->close();
        // echo "The store id is: $store_id";
        echo "$string";
    
        
    }

?>