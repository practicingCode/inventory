<!DOCTYPE html>
<html lang="en">
<head>
  <title>Point Content Manager</title>
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
<h1> Point Content Manager </h1>
<form>
<!-- 
  
    OPTIMIZE:
      - Optimize by shortening link (use ref to shorten )
      - When adding new UTMS, include in log.js, SQL, utm.php
-->
    <div class="container">
        <div class="row">
            <div class="col-2">
              
                <?php include "handler/room_drop2.php"; ?>
                
            </div>
            <div class="col-7">
                <input type="text" class="form-control" id="point" placeholder="Add a point">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary" onclick="send_it(getAll())">Submit</button>
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
        var point = "";
        var room = "";
        var roomie = "";
        var store = "";
        function getAll(){
            point = document.getElementById("point").value;
            var r = document.getElementById("rooms");
            room = r.options[r.selectedIndex].value;
            var s = document.getElementById("store");
            store = s.options[s.selectedIndex].value;
            
            return point;
            }

        
        function storeDrop(){
          //GET ROOM VAL
          var r = document.getElementById("rooms");
          roomie = r.options[r.selectedIndex].value;
          
          //AJAX 
          const bcd = new XMLHttpRequest();
                  bcd.onload = function(){
                    res = this.responseText;
                    console.log(res);
                    ca = res.split(',');
                    len = ca.length-1;
                    
                    //Get gen point
                    rooms = document.getElementById("rooms");
                    papa = rooms.parentNode;
                    grandpa = papa.parentNode;

                    // CREATE DIV
                    div = document.createElement("div");
                    txt = document.createTextNode("Store");
                    div.appendChild(txt);
                    
                    
                    
                    //CREATE DROP
                      //SELECT
                     var new_table = document.createElement('select')
                     new_table.setAttribute("class","col");
                     new_table.setAttribute("class","dropdown btn");
                     new_table.setAttribute("id", "store");
                     
                     
                     //FIRST SELECT
                     new_text = document.createTextNode("select");
                        var opt = document.createElement("option");
                        opt.text = "select";
                        opt.value = "";
                        new_table.options.add(opt);
                        
                      
                    grandpa.insertBefore(new_table, papa.nextSibling);
                    // grandpa.insertBefore(div, papa.nextSibling); //label
                      //OPTIONS
                        for(i=0;i<len;i++){
                          var opt = document.createElement("option");
                          opt.text = ca[i];
                          opt.value = ca[i];
                          new_table.options.add(opt)
                          
                        } 

          

                  };
                  text = "room="+roomie;
                  bcd.open("POST", "handler/get_stores.php"); 
                  bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                  bcd.send(text);
          
    }

        function send_it(point){
            const bcd = new XMLHttpRequest();
                  bcd.onload = function(){
                    res = this.responseText;
                    console.log(res);
                    
                  };
                  text = "point="+point+"&room="+room+"&store="+store;
                  bcd.open("POST", "handler/gen_point.php"); 
                  bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                  bcd.send(text);
                  
                  //GENERATE IT
                  tbody = document.getElementById("table_body");
                  point = point;
                  entries = 0;
                  date = new Date();;
                  
                  //INSERT
                  entry = document.createElement("tr");
                  td1 = document.createElement("td");
                  td1.innerText = point;
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
            
            //GET point
            point = row_id.replace(/&.*$/,"");
            // point = point.replace(/_/g, " "); // REMOVES _ replace with " "
            
            // AJAX DELETE CAMAPAIGN
            const bcd = new XMLHttpRequest();
                    bcd.onload = function(){
                      res = this.responseText;
                      console.log(res);
                      
                    };
                    text = "point="+point;
                    bcd.open("POST", "handler/delete_point.php"); 
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
          
          //GET point
          point = row_id.replace(/&.*$/,"");
          point = point.replace(/_/g, " ");
          //get title   
          title = document.getElementById("ModalTitle");
          //change title
          title.innerText = point;
          //get body
          // body = document.getElementById("ModalBody");
          details = document.getElementById("details");
          //GET INFO THROUGH AJAX / PHP
          var get_point = "";
          const bcd = new XMLHttpRequest();
                    bcd.onload = function(){
                      get_point = this.responseText;
                      console.log(get_point);
                      ca = get_point.split(',');
                      a = ca[2];

                      submit_entry = `
                      <h2> Details: </h2>
                      <p>ID:`+ ca[0] +`</p>
                      <p>Name:`+ point +`</p>
                      <p>Room Name:`+ ca[3]+` </p>
                      <p>Room ID: `+ a +`</p>
                      
                      
                      
                      `;
                      details.innerHTML = submit_entry;
                      // - DELETE
                      
                    };
                    text = "point="+point;
                    bcd.open("POST", "handler/get_point.php"); 
                    bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                    bcd.send(text);
              }
    </script> 
    <table id="table" class="table table-hover">
      <thead>
          <th>Point Name</th>
          <th>Store</th >
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
          $get_all = "SELECT * FROM points";
   
       
          $result = $conn->query($get_all);
          $id = 0;
          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $id = $row["point_id"];
                $name =$row["point_name"];
                $name2 =  str_replace('_', ' ', $name);
                $entries =$row["entries"];
                $store_id = $row["store_id"];
                $store_id = intval($store_id);
            
                  $get_store = "SELECT store_name FROM store WHERE store_id=$store_id";
   
       
                  $r = $conn->query($get_store);
                  $store = "";
                
                  if ($r->num_rows > 0) {
                      // output data of each row
                      while($rows = $r->fetch_assoc()) {
                        $store = $rows["store_name"];
                        // echo $store;
                      }
                  }else {
                    echo "0 results";
                  }

                echo "
                <tr id='$name2&$id' data-toggle='modal' data-target='#myModal' onclick='modifyModal(this)'>
                  <td>$name2</td>
                  <td>$store</td>
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
