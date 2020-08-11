<?php 
    if($_POST){
        $room_name = $_POST["room"];
        $room_name = str_replace('_', ' ', $room_name);
        echo $room_name;
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO room(room_name) VALUES('$room_name')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>