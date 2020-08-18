<?php include_once "infidel.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Teoh Family Storage</title>
  <meta charset="utf-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
  <link href='https://fonts.googleapis.com/css?family=Covered By Your Grace' rel='stylesheet'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.0.0/flatly/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="build/css/bootstrap-datetimepicker.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
  <script src="build/js/bootstrap-datetimepicker.min.js"></script>
        
   <!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>
</head>
<body>

<style>
    .arrow.active{
        animation: rotate 1s;
        -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg);}
        
    }
    @keyframes rotate{
        0%{}
        10%{-webkit-transform: rotate(10deg);-ms-transform: rotate(10deg);transform: rotate(10deg);}
        20%{-webkit-transform: rotate(20deg);-ms-transform: rotate(20deg);transform: rotate(20deg);}
        30%{-webkit-transform: rotate(30deg);-ms-transform: rotate(30deg);transform: rotate(30deg);}
        40%{-webkit-transform: rotate(40deg);-ms-transform: rotate(40deg);transform: rotate(40deg);}
        50%{-webkit-transform: rotate(50deg);-ms-transform: rotate(50deg);transform: rotate(50deg);}
        60%{-webkit-transform: rotate(60deg);-ms-transform: rotate(60deg);transform: rotate(60deg);}
        70%{-webkit-transform: rotate(70deg);-ms-transform: rotate(70deg);transform: rotate(70deg);}
        80%{-webkit-transform: rotate(80deg);-ms-transform: rotate(80deg);transform: rotate(80deg);}
        90%{-webkit-transform: rotate(90deg);-ms-transform: rotate(90deg);transform: rotate(90deg);}
        100%{-webkit-transform: rotate(90deg);-ms-transform: rotate(90deg);transform: rotate(90deg);}
        
    }
    #logo{
    font-family: 'Covered By Your Grace';
    font-size: 50px;
    padding: 0px;
    }

    .butt-file {
        position: relative;
        overflow: hidden;
    }
    .butt-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload{
        width: 100%;
    }
</style>
<script type="text/javascript">
   
    $(document).ready( function() {
            $(document).on('change', '.butt-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
            });

            $('.butt-file :file').on('fileselect', function(event, label) {
                
                var input = $(this).parents('.input-group').find(':text'),
                    log = label;
                
                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) {
                        img = document.getElementById("image_name");
                        img.value = log; 
                        img.hidden = false;

                        img_show = document.getElementById("img-upload");
                        img_show.hidden = false;
                    };
                }
            
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function(){
                readURL(this);
            }); 	
        });
</script>


<div class="container">
<p></p>
  <!-- Brand -->
  <a class="navbar-brand" id="logo" href="/home/find.php?">Teoh</a>

    <h2>Storage form</h2>
    <form action="store_me.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <label for="Item">Item:</label>
        <input type="text" class="form-control" id="Item" placeholder="Enter item name" name="Item">
        </div>
        <div class="form-group">
            <label for="Room">Room</label>
            <?php include "handler/room_drop2.php" ?>
            
        </div>
        <div class="container">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Upload Image</label>
                    
                        <span class="btn btn-default butt-file">
                            Browse… <input type="file" id="imgInp" name="Image"> <!-- accept="image/*;capture=camera   > -->
                        </span>
                        <input type="text" class="form-control" id="image_name"readonly hidden>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- UPLOADED IMAGE -->
        <div class="container">
            <div class="row">
            <!------ ADVANCED -------->
                <div class="col">
                    <p>
                        <span id="toggle-advanced" type="button" data-toggle="collapse" data-target="#advanced" aria-expanded="false" aria-controls="advanced">
                            <svg class="arrow" width="1em" height="1em" viewBox="0 -2 16 16" class="bi bi-caret-right-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                            </svg> Advanced
                        </span>
                    </p>
                <script>
                
                    $('#toggle-advanced').on('click', function(){
                        
                        $('.arrow').toggleClass('active');
                    });
                    
                    $(function () {
                            $('#awd').datetimepicker({format: 'YYYY-MM-DD'});
                            $('#aed').datetimepicker({format: 'YYYY-MM-DD'});
                        });
                </script>

            
                <div class="collapse" id="advanced">
                        <!--- ALERT WARRANTY DATE -->
                    <div class="form-group">
                        <label for="awd">Alert Warranty Date:</label>
                            <div class="input-group" style="width:100%; height:100%;">
                                <div class="input-group-addon">
                                    <svg transform="translate(-5,3)" width="1em" height="1em" viewBox="0 0 18 18" class="bi bi-calendar" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1zm1-3a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2z"/>
                                        <path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5zm9 0a.5.5 0 0 1 .5.5V1a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                </div>
                                <input type="text" width="60%" class="form-control" id="awd" placeholder="Warranty Date" name="awd">
                            </div>
                    </div> 

                        <!--- ALERT EXPIRY DATE ---->


                    <div class="form-group">
                        <label for="awd">Alert Expiry Date:</label>
                            <div class="input-group" style="width:100%; height:100%;">
                                <div class="input-group-addon">
                                    <svg transform="translate(-5,3)" width="1em" height="1em" viewBox="0 0 18 18" class="bi bi-calendar" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1zm1-3a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2z"/>
                                        <path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5zm9 0a.5.5 0 0 1 .5.5V1a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                </div>
                                <input type="text" width="60%" class="form-control" id="aed" placeholder="Expiry Date" name="aed">
                            </div>
                    </div> 
                        <!-- SUPPORTING DOCS -->
                        <label for="pdf_docs">PDF: </label>
                        <input type="file" name="myfile" id="pdf_docs">
                        <br>
                        <label for="qty">Quantity:</label>
                        <br>
                        <input type="number" id="qty" maxlength="2" min="0" name="qty" >
                        <p></p>
                        
                        
                </div>

            </div>
            <div class="row">
                <div class="col-1"></div>
                <img class="col-10" id='img-upload' hidden />
                <div class="col-1"></div>
            </div>
        </div>
        <div class="container">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
    </form>
      

</div>
</body>
</html>
<script>
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
                        div.setAttribute("id", "store_label");
                        div.appendChild(txt);
                        
                        
                        
                        //CREATE DROP
                        //SELECT
                        var new_table = document.createElement('select')
                        new_table.setAttribute("class","col");
                        new_table.setAttribute("class","form-control");
                        new_table.setAttribute("id", "store");
                        new_table.setAttribute("name", "store");
                        new_table.setAttribute("onchange","dropPoints()");
                        
                        //FIRST SELECT
                        new_text = document.createTextNode("select");
                            var opt = document.createElement("option");
                            opt.text = "select";
                            opt.value = "";
                            new_table.options.add(opt);
                            
                        check = document.getElementById('store');

                        if(check == null){

                        }else{
                            //wipe
                            parent = check.parentNode;
                            //remove label and object
                            lab = document.getElementById('store_label');
                            parent.removeChild(check);
                            parent.removeChild(lab);
                        }
                        grandpa.insertBefore(new_table, papa.nextSibling);
                        grandpa.insertBefore(div, papa.nextSibling); //label
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

    function dropPoints(){
            //GET ROOM VAL
            var r = document.getElementById("store");
            store = r.options[r.selectedIndex].value;
            
            
            //AJAX 
            const bcd = new XMLHttpRequest();
                    bcd.onload = function(){
                        res = this.responseText;
                        console.log(res);
                        ca = res.split(',');
                        len = ca.length-1;
                        
                        //Get gen point
                        stores = document.getElementById("store");
                        papa = stores.parentNode;
                        grandpa = papa.parentNode;

                        // CREATE DIV
                        div = document.createElement("div");
                        txt = document.createTextNode("Points");
                        div.setAttribute("id", "point_label");
                        div.appendChild(txt);
                        
                        
                        
                        //CREATE DROP for points
                        //SELECT
                        var new_table = document.createElement('select')
                        new_table.setAttribute("class","col");
                        new_table.setAttribute("class","form-control");
                        new_table.setAttribute("id", "point");
                        new_table.setAttribute("name", "point");
                        
                        
                        //FIRST SELECT
                        new_text = document.createTextNode("select");
                            var opt = document.createElement("option");
                            opt.text = "select";
                            opt.value = "";
                            new_table.options.add(opt);
                            
                        //check & wipe
                        check = document.getElementById("point");
                        if(check == null){

                        }else{
                            parent = check.parentNode;
                            lab = document.getElementById('point_label');

                            parent.removeChild(lab);
                            parent.removeChild(check);
                        }
                        
                        papa.insertBefore(new_table, stores.nextSibling);
                        papa.insertBefore(div, stores.nextSibling); //label
                        //OPTIONS
                            for(i=0;i<len;i++){
                            var opt = document.createElement("option");
                            opt.text = ca[i];
                            opt.value = ca[i];
                            new_table.options.add(opt)
                            
                            } 

            

                    };
                    text = "store="+store;
                    bcd.open("POST", "handler/get_points.php"); 
                    bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                    bcd.send(text);
            
        }


            var point = "";
            var room = "";
            var roomie = "";
            var store = "";

        // function getAll(){
        //     item = document.getElementById("Item").value;
        //     point = document.getElementById("point").value;
        //     var r = document.getElementById("rooms");
        //     room = r.options[r.selectedIndex].value;
        //     var s = document.getElementById("store");
        //     store = s.options[s.selectedIndex].value;

        //     //SEND ALL
        //     const bcd = new XMLHttpRequest();
        //               bcd.onload = function(){
        //                 res = this.responseText;
        //             };
        //               text = "store="+store+"&room="+room+"&point="+point+"&item="+item;
        //               bcd.open("POST", "handler/store_me.php"); 
        //               bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
        //               bcd.send(text);

        //     }
</script>
<?php 



$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["Image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    //STORE IMAGE
        $check = getimagesize($_FILES["Image"]["tmp_name"]);
            if($check !== false) {
                echo "<p style='color:green';>File is an image - " . $check["mime"] . ".</p>";
                $uploadOk = 1;
            } 
            else {
                echo "<p style='color:red';> File is not an image. </p>";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<p style='color:red';>Sorry, image already exists. </p>";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["Image"]["size"] > 4000000) {
            echo "<p style='color:red';>Sorry, your image is too large.</p>";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "<p style='color:red';>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<p style='color:red';>Sorry, your image was not uploaded.</p>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
                echo "<p style='color:green';>The image ". basename( $_FILES["Image"]["name"]). " has been uploaded.</p>";
            } else {
                echo "<p style='color:red';>Sorry, there was an error uploading your image.</p>";
                
            }
    //STORE PDF
        $pdf =  $_FILES['myfile']['name'];
        $pdf_dir = "uploads/docs/";
        $target_pdf = $pdf_dir . basename($_FILES["myfile"]["name"]);
        $pdf_file = $pdf_dir . $pdf;
        $pdf_ext = pathinfo($pdf, PATHINFO_EXTENSION);

         // the physical file on a temporary uploads directory on the server
        $pdf_name = $_FILES['myfile']['tmp_name'];
        $pdf_size = $_FILES['myfile']['size'];

        if (!in_array($pdf_ext, ['pdf'])) {
            echo "<p style='color:red';>You file extension must be .pdf</p>";
        } elseif ($_FILES['myfile']['size'] > 640000000) { // file shouldn't be larger than 64Megabyte
            echo "<p style='color:red';>File too large!</p>";
        } else {
            // move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($pdf_name, $target_pdf)) {
                echo "<p style='color:green';> PDF uploaded successfully</p>";          
            } else {
                echo "<p style='color:red';>Failed to upload PDF.</p>";
            }
        }
}
if($_POST){
    $item = $_POST["Item"];
    $room = $_POST["rooms"];
    $store = $_POST["store"];
    $points = $_POST["point"];
    $images = $target_file;

    $pdf = $pdf_file;
    $awd = $_POST["awd"];//alert warranty date
    $aed = $_POST["aed"];//alert expiry date
    $qty = $_POST["qty"];

    //connecting to SQL
    require_once("handler/auth.php");

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
//===================================================================================
// GET ROOM
//----------
    $get_a_room = "SELECT room_id FROM room WHERE room_name='$room'";
    $result = $conn->query($get_a_room);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $room_id = $row["room_id"];
        }
      } else {
        echo "<p style='color:red';>failed to find room</p>";
      }
//===================================================================================
// GET STORE
//----------
    $get_store = "SELECT store_id FROM store WHERE store_name='$store'";
      $result = $conn->query($get_store);
      
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $store_id = $row["store_id"];
          }
        } else {
          echo "<p style='color:red';>Failed to find store</p>";
        }
//===================================================================================
// GET POINT
//----------
    $get_point = "SELECT point_id FROM points WHERE point_name='$points'";
        $result = $conn->query($get_point);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $point_id = $row["point_id"];
            }
          } else {
            echo "<p style='color:red';>Failed to find point</p>";
          }
//===================================================================================
//INPUT
//-----

    
    $q = "room_id, store_id, point_id, item, images";
    $v = "$room_id, '$store_id', '$point_id', '$item', '$images'";
    
        if ($pdf == ""){}
        else {
            $q += ", supporting_docs";
            $v += ", '$pdf'";
        }
        
        if ($awd == ""){}
        else {
            $q += ", alert_warranty" ;
            $v += ", DATE'$awd'";
        }

        if ($aed == ""){}
        else {
            $q += ", alert_est_consumption";
            $v += ", DATE'$aed'";
        }

        if ($qty == ""){}
        else {
            $q += ", quantity" ;
            $v += ", $qty";
        }
        
    $sql = "INSERT INTO entries ($q)
    VALUES ($v)";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green';>New record created successfully</p>";
    } else {
        echo "<p style='color:red';>Error: " . $sql . "<br></p>" . $conn->error;
    }

    $conn->close();

}

?>
