<?php 
    if($_POST){
        $comment = $_POST["comment"];
        $entry_id = $_POST["entry_id"];
        
        session_start();
        $user_id =  $_SESSION["user_id"];
        
       
        //SQL
        require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "INSERT INTO comment(auth_id, entry_id, comment) VALUES($user_id, $entry_id, '$comment')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        // echo "\n$sql";
        
        $conn->close();
    }
?>