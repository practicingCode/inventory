<!DOCTYPE html>
<html lang="en">
<head>
  <title>Room Content Manager</title>
  <meta charset="utf-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1">  -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>
<style>
  .data{
    /* background-color: #d7d7d7; */
    background-color: white;
    outline: none;
    border: none;
    color: #c0c0c0;
  }

  .black{
    color: black;
  }

  .space{
    margin-right: 10px;
    margin-left: 0px;
  }
</style>
</head>
<?php include "nav.php"; ?>
<h1> Room Content Manager </h1>
<form>
<!-- 
  
    OPTIMIZE:
      - Optimize by shortening link (use ref to shorten )
      - When adding new UTMS, include in log.js, SQL, utm.php
-->
    <div class="container">
        <div class="row">
            <div class="col-9">
                <input type="text" class="form-control" id="room" placeholder="Add a room">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary" onclick="send_it(getroom())">Submit</button>
            </div>
        </div>
        </form>
    </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="ModalBody">
        <ul class="nav nav-tabs" id="tabContent">
          <!-- <li class="active btn btn-light space" type="button"><a href="#links" data-toggle="tab" class="black">Links</a></li> -->
          <li class="active btn btn-light space" type="button"><a href="#details" data-toggle="tab" class="black">Details</a></li>
          <li class="active btn btn-light space" type="button"><a href="#chart" data-toggle="tab" class="black">Chart</a></li>
        </ul>

        <div class="tab-content">
            <!-- <div class="tab-pane active" id="links">Links</div> -->
            <div class="tab-pane active" id="details">Details</div> 
            <div class="tab-pane" id="chart"><h1>Chart</h1></div> 
            <div class="tab-pane" id="clipboard"><input type="text" value="Hello World" id="myInput"></div>
        </div>
      </div>
    </div>
  </div>
</div>

    <script>
        var room = "";
        function getroom(){
            room = document.getElementById("room").value;
            return room;
            }
        
        function send_it(room){
            const bcd = new XMLHttpRequest();
                  bcd.onload = function(){
                    res = this.responseText;
                    console.log(res);
                    
                  };
                  text = "room="+room;
                  bcd.open("POST", "handler/gen_room.php"); 
                  bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                  bcd.send(text);
                  
                  //GENERATE IT
                  tbody = document.getElementById("table_body");
                  room = room;
                  entries = 0;
                  date = new Date();;
                  
                  //INSERT
                  entry = document.createElement("tr");
                  td1 = document.createElement("td");
                  td1.innerText = room;
                  td2 = document.createElement("td");
                  td2.innerText = entries;
                  td3 = document.createElement("td");
                  td3.innerText = date;
                  entry.appendChild(td1);
                  entry.appendChild(td2);
                  entry.appendChild(td3);
                  tbody.appendChild(entry);

                }

        function removeRow(elem){
          if(window.confirm("are you sure you want to delete this?")){
            //GET ALL IN ROW
            row_id = elem.parentNode.parentNode.id;
            row = document.getElementById(row_id);
            
            //GET room
            room = row_id.replace(/&.*$/,"");
            // room = room.replace(/_/g, " "); // REMOVES _ replace with " "
            
            // AJAX DELETE CAMAPAIGN
            const bcd = new XMLHttpRequest();
                    bcd.onload = function(){
                      res = this.responseText;
                      console.log(res);
                      
                    };
                    text = "room="+room;
                    bcd.open("POST", "handler/delete_room.php"); 
                    bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                    bcd.send(text);
                  
            // REMOVE ROW IN UI
            row.remove();
          }
        }

        function copyText(id) {
          // link = me.innerText;
          // alert(typeof link);
          // /* Get the text field */
          var copyText = document.getElementById(id);
          //modify hidden clipboard
          // copyText.value = link;

          // /* Select the text field */
          copyText.select();

          // /* Copy the text inside the text field */
          document.execCommand("copy");

          // /* Alert the copied text */
          alert("Copied the text: \n" + copyText.value);
        }

        function modifyModal(elem){
          //GET ROW
          row_id = elem.id;
          row = document.getElementById(row_id);
          
          //GET room
          room = row_id.replace(/&.*$/,"");
          room = room.replace(/_/g, " ");
          //get title   
          title = document.getElementById("ModalTitle");
          //change title
          title.innerText = room;
          //get body
          // body = document.getElementById("ModalBody");
          details = document.getElementById("details");
          //GET INFO THROUGH AJAX / PHP
          var get_room = "";
          const bcd = new XMLHttpRequest();
                    bcd.onload = function(){
                      get_room = this.responseText;
                      console.log(get_room);
                      ca = get_room.split(',');
                      
                      submit_entry = `
                      <h2> Details: </h2>
                      <p>ID:`+ ca[0] +`</p>
                      <p>Name:`+ room +`</p>
                      <p>Stores: `+ ca[2] +`</p>
                      <p>Points: `+ ca[3] +` </p>
                      <p>Entries: `+ ca[4] +` </p>
                      `;
                      details.innerHTML = submit_entry;
                      // - DELETE
                      
                    };
                    text = "room="+room;
                    bcd.open("POST", "handler/get_room.php"); 
                    bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                    bcd.send(text);

                    
        }
    </script> 
    <table id="table" class="table table-hover">
      <thead>
          <th>Room Name</th>
          <th>Stores</th >
          <th>Entries</th >
          <th></th>
      </thead>
      <tbody id="table_body">  
    <?php
      require_once("handler/auth.php");
  
  
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          $get_all = "SELECT * FROM room";
   
       
          $result = $conn->query($get_all);
          $id = 0;
          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $id = $row["room_id"];
                $name =$row["room_name"];
                $name2 =  str_replace('_', ' ', $name);
                
                $stores =$row["stores"];
                $points = $row["points"];
                $entries =$row["entries"];

                echo "
                <tr id='$name&$id' data-toggle='modal' data-target='#myModal' onclick='modifyModal(this)'>
                  <td>$name2</td>
                  <td>$stores</td>
                  <td>$entries</td>
                  <td><button onclick='removeRow(this)' type='button' class='close' aria-label='Close'><span aria-hidden='true'>×</span></button></td>
                </tr>";
              }
            } else {
              echo "0 results";
            }
      $conn->close();
       
    ?>
      </tbody>
    </table>
</html>

