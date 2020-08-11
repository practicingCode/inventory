<?php 
session_start();
$sessions_name = $_SESSION['name'];
$send_to = "index.php?lmsg=true";
// $send_to = "/home/find.php";
if(!isset($_SESSION['name']))
//if there is a name allow to check
{
//AUTH
require_once("handler/auth.php");

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
//query
	$sql = "SELECT * FROM tbl_sessions WHERE sessions_name='$sessions_name'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		//IF there is a name and it is relevant allow
		while($row = $result->fetch_assoc()) {
			header("location:$send_to");
			exit;
		}

	}else{
		echo "no such session";
	}
	
}
?>

<h1>YOUR IN!</h1>