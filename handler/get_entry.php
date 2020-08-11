<?php 
// IN > NAME
//        OUT > DETAILS
    if($_POST){
        $entry_name = $_POST["entry"];
        $entry_name = str_replace('_', ' ', $entry_name);
        // echo $entry_name;
        // echo $location_name;
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM entries WHERE item='$entry_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["entry_id"];
                $name =$row["item"];
                $name2 =  str_replace('_', ' ', $name);
                $room_id =$row["room_id"];
                $store_id =$row["store_id"];
                $point_id = $row["point_id"];
                $images = $row['images'];

                //added 20200803
                $s_date = $row["time_in"];
                $w_date = $row["alert_warranty"];
                $e_date = $row["alert_est_consumption"];
                $qty = $row["quantity"];
                $pdf = $row["supporting_docs"];
		
                
		//==========================================================================
		// GET ROOM
		$get_room = "SELECT room_name FROM room WHERE room_id ='$room_id'";
        	$res = $conn->query($get_room);
                if ($res->num_rows > 0) {
                    // output data of each row
                    while($row = $res->fetch_assoc()) {
                        $room = $row["room_name"];
                        
                        }
                    }//end of ROOM
		
		//==========================================================================
		// GET STORE
		$get_store = "SELECT store_name FROM store WHERE store_id ='$store_id'";
        	$res = $conn->query($get_store);
                if ($res->num_rows > 0) {
                    // output data of each row
                    while($row = $res->fetch_assoc()) {
                        $store = $row["store_name"];
                        // echo $store;
                        }
                    }//end of STORE
                
		//==========================================================================
		// GET POINT
                    $get_point = "SELECT point_name FROM points WHERE point_id=$point_id";
                    $resu = $conn->query($get_point);
                    
                    if ($resu->num_rows > 0) {
                        // output data of each row
                        while($row = $resu->fetch_assoc()) {
                            $point = $row["point_name"];
                            // echo $store;
                            }
                        }//end of store
            }
            } else {
            echo "0 results";
            }
        $conn->close();
        $res = "$id, $name2, $room, $store, $point, $images, $s_date, $w_date, $e_date, $qty, $pdf";
        echo $res;
    }

?>
