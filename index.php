<html>
   <doctype charset="utf-8">
     <head>
       <title>Login Page</title>
       <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
     </head>
     <style>
      body{
          margin:0;
          padding:0;
          background-image: url(https://66.media.tumblr.com/32fa80f29098512921c4013b4128763e/tumblr_mqs2iiYB191qa6q9uo1_500.gif);
          background-size:cover;
          background-repeat:no-repeat;
        }
        input[type=password]{
          border:1px solid #9C9C9C;
          border-radius:3px;
          height:28px;
          width:45%;
          background-color:#FAF8F7;
        }
        input[type=text]{
          border:1px solid #9C9C9C;
          border-radius:3px;
          height:28px;
          width:45%;
          background-color:#FAF8F7;
        }
        input[type=submit]{
          border:1px solid #9C9C9C;
          border-radius:3px;
          height:28px;
          width:20%;
          background-color:#FAF8F7;
        }
        .wel{
          font-family: 'Montserrat', sans-serif;
          font-size:40px;
          color:#ffffff;
        }
        p{
          line-height:2px;
        }
        #card{
          margin-top:10%;
          background-color:#444444;
          height:300px;
          width:40%;
          opacity:0.8;
          border-radius:5px;
        }
     </style>
     <body><center>
       <div id="card"><br>
        <font class="wel">WELCOME</font><p>
          <form action="" method="POST">
            <input name="name" placeholder="User" type="text"><br><br>
            <input name="password" placeholder="password" type="password"><p>
            <input type="submit" value="Enter">
          </form>
        </div>
     </body>
</html>
<?php
if($_POST){
  $name = $_POST["name"];
  $passwords = $_POST["password"];

  // echo "<h2>$name, $passwords</h2>";
  // CONFIG
  require_once("handler/auth.php");
  // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

  //SQL
  // $sql = "SELECT * FROM authenticate WHERE owner_name='$name' AND passwords='$password'";
  $sql = "SELECT * FROM authenticate WHERE owner_name='$name' AND passwords='$passwords'";
  // echo "<h1>$sql</h1>";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
          $name = $row["owner_name"];
          $passwords = $row["passwords"];
          $id = $row["auth_id"];
          $owner_id = $row["owner_id"];
          // echo "<h1>$id, $owner_id</h1>";
          $text="$name$owner_id$passwords$id";
          $text = md5($text);
          $text = md5($text);
          $text = md5($text);
          echo "$text";

          //ADD TO SESSION TABLE
          $sequel = "INSERT INTO tbl_sessions (sessions_user, sessions_name) VALUES ('$name' , '$text') ";
          // echo "<h1>$sql</h1>";
          if ($conn->query($sequel) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sequel . "<br>" . $conn->error;
          }
          

            session_start();
            $_SESSION["name"] = $text;
            $_SESSION["user_id"] = $id;
            $_SESSION["user_code"] = $owner_id;
            // header('location:test.php?lmsg=true');
            header('location:room_content_manager.php');
            exit;
        }
      }else{
        echo "Username or password wrong, please try again or contact your system administrator";
      } 

}

?>