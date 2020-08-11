
    <?php 
    require_once("auth.php");


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT room_name FROM room";
    $result = $conn->query($sql);
    $room_name = [];
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $add_me = $row["room_name"];
          array_push($room_name, $add_me);
        }
      } else {
        echo "0 results";
      }

        $conn->close();
        
    
    ?>
    
        <select class="form-control" id="rooms" name="rooms">
            <?php
                  echo "<option>select a room</option>";
            // GENERATES <option>
                foreach ($room_name as $x){
                    $x =  str_replace('_', ' ', $x);
                    echo "<option>$x</option>";
                }
            ?>
        </select>