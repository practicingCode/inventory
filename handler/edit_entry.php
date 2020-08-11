<?php 
// IN > NAME
//        OUT > DETAILS
    if($_POST){
        $id = $_POST["entry_id"];
        $name = $_POST["name"];
        $r = $_POST["room"];
        $s = $_POST["store"];
        $p = $_POST["point"];
        $wd = $_POST["wd"];
        $ed = $_POST["ed"];
        $qty = $_POST["qt"];
        print_r ($_POST);
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //GET ROOM ID
        $get = "SELECT room_id FROM room WHERE room_name='$r'";
        $result = $conn->query($get);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $r = $row["room_id"];
                }
            }

        //GET STORE ID
        $get = "SELECT store_id FROM store WHERE store_name='$s'";
        $result = $conn->query($get);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $s = $row["store_id"];
                }
            }
        
        //GET POINT ID
        $get = "SELECT point_id FROM points WHERE point_name='$p'";
        $result = $conn->query($get);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $p = $row["point_id"];
                }
            }
        
        $ids = "room_id=$r, store_id=$s, point_id=$p,";
        $sql = "UPDATE entries set $ids item='$name', alert_warranty=DATE'$wd', alert_est_consumption=DATE'$ed', quantity=$qty WHERE entry_id=$id";
        //date blank scenarios
            if($wd==""){
                $sql = "UPDATE entries set $ids item='$name', alert_est_consumption=DATE'$ed', quantity=$qty WHERE entry_id=$id";
                if($ed==""){
                    $sql = "UPDATE entries set $ids item='$name', quantity=$qty WHERE entry_id=$id";
                }
            }
            if($ed==""){
                $sql = "UPDATE entries set $ids item='$name', alert_est_consumption=DATE'$ed', quantity=$qty WHERE entry_id=$id";
            }
       
        $result = $conn->query($sql);

        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
        // if ($result->num_rows > 0) {
        //     // output data of each row
        //     while($row = $result->fetch_assoc()) {
        //         $id = $row["entry_id"];
        //         $name =$row["item"];
        //         $name2 =  str_replace('_', ' ', $name);
        //         $room_id =$row["room_id"];
        //         $store_id =$row["store_id"];
        //         $point_id = $row["point_id"];
        //         $images = $row['images'];

        //         //added 20200803
        //         $s_date = $row["time_in"];
        //         $w_date = $row["alert_warranty"];
        //         $e_date = $row["alert_est_consumption"];
        //         $qty = $row["quantity"];
        //         $pdf = $row["supporting_docs"];
		
                
		// //==========================================================================
		// // GET ROOM
		// $get_room = "SELECT room_name FROM room WHERE room_id ='$room_id'";
        // 	$res = $conn->query($get_room);
        //         if ($res->num_rows > 0) {
        //             // output data of each row
        //             while($row = $res->fetch_assoc()) {
        //                 $room = $row["room_name"];
                        
        //                 }
        //             }//end of ROOM
		
		// //==========================================================================
		// // GET STORE
		// $get_store = "SELECT store_name FROM store WHERE store_id ='$store_id'";
        // 	$res = $conn->query($get_store);
        //         if ($res->num_rows > 0) {
        //             // output data of each row
        //             while($row = $res->fetch_assoc()) {
        //                 $store = $row["store_name"];
        //                 // echo $store;
        //                 }
        //             }//end of STORE
                
		// //==========================================================================
		// // GET POINT
        //             $get_point = "SELECT point_name FROM points WHERE point_id=$point_id";
        //             $resu = $conn->query($get_point);
                    
        //             if ($resu->num_rows > 0) {
        //                 // output data of each row
        //                 while($row = $resu->fetch_assoc()) {
        //                     $point = $row["point_name"];
        //                     // echo $store;
        //                     }
        //                 }//end of store
        //     }
        //     } else {
        //     echo "0 results";
        //     }
        // $conn->close();
        // $res = "$id, $name2, $room, $store, $point, $images, $s_date, $w_date, $e_date, $qty, $pdf";
        // echo $res;
    }

?>
