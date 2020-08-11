<?php 
    session_start();
    $sn = $_SESSION['name'];
    // echo "<h1>$sn</h1>";
    //AUTH
    require_once("auth.php");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
    // DELETE ENTRY FROM SESSIONS
    
        $sql = "DELETE FROM tbl_sessions WHERE sessions_name='$sn'";
        // echo $sql;
            if ($conn->query($sql) === TRUE) {
                echo "room deleted successfully";
              } else {
                echo "Error deleting record: " . $conn->error;
              }

        $conn->close();
    $_SESSION = array();
    session_destroy();
    header('location:/home/index.php');
?>