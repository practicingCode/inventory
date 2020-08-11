<?php 

    if($_POST){
        $entry_id = $_POST["entry_id"];
        
        
        //SQL
        require_once("auth.php");
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        

        // //GET COMMENTS:
        $sql = "SELECT * FROM comment WHERE entry_id=$entry_id ORDER BY comment_time DESC";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            $res = array();
            while($row = $result->fetch_assoc()) {
                $id = $row["comment_id"];
                $auth_id =$row["auth_id"];
                $comment =$row["comment"];
                $time =$row["comment_time"];                

                
                //==========================================================================
                // GET owner name
                $get_room = "SELECT owner_name FROM authenticate WHERE auth_id =$auth_id";
                    $rez = $conn->query($get_room);
                        if ($rez->num_rows > 0) {
                            // output data of each row
                            while($rows = $rez->fetch_assoc()) {
                                $name = $rows["owner_name"];
                                
                                }
                            }
                
                $all = array('id' => $id, 'user' => $name, 'comment' => $comment, 'time' => $time);
                array_push($res, $all);
                
                }
            }
        $conn->close();
        
        echo json_encode($res);
    }

?>
