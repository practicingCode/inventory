    <!DOCTYPE html>
    <html lang="en">
    <head>
    <title>Inventory Management System</title>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1">  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Load d3.js -->
    <script src="https://d3js.org/d3.v4.js"></script>
    <!-- -date time picker -->
    <link rel="stylesheet" href="build/css/bootstrap-datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="build/js/bootstrap-datetimepicker.min.js"></script>
<style>
    .user{
        position:absolute;
        font-size:15px;
        top: 0px;
        left: 0px;
    }
    .comment{
        font-size: 25px;
    }
    .timestamp{
        position:absolute;
        font-size: 15px;
        bottom: 0px;
        right: 0px;
    }
    .deletecmt{
        position:absolute;
        font-size: 15px;
        top: 0px;
        right: 5px;
    }
    .img{
        border-radius: 8px;
	display: block;
  	margin-left: auto;
  	margin-right: auto;
  	width: 50%;
     }
    .logo{
  	font-family: 'Covered By Your Grace';
  	font-size: 200px;
	}
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
    <h1> Inventory Management System </h1>
    <form >
    <!-- 
    
        OPTIMIZE:
        - Optimize by shortening link (use ref to shorten )
        - When adding new UTMS, include in log.js, SQL, utm.php
    -->
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <input type="text" class="form-control" id="query" placeholder="Find" ><!-- onchange="find()"> -->
                </div>
                <!-- <div class="col-3">
                    <button type="submit" class="btn btn-primary" onclick="find()">Submit</button>
                </div> -->
            </div>
            </form>
        </div>
        <p></p>

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
            <li class="active btn btn-light space" type="button"><a href="#comments" data-toggle="tab" class="black">Comments</a></li>
            <li class="active btn btn-light space" type="button"><a href="#chart" data-toggle="tab" class="black">Chart</a></li>
            </ul>
            
            <div class="tab-content">
                <!-- <div class="tab-pane active" id="links">Links</div> -->
                <div class="tab-pane active" id="details" >Details</div> 
                <div class="tab-pane" id="comments">Comments
                    <div>
                        <form>
                            <textarea rows="4" cols="40"; style="font-size: 15px;"id="comment" name="comment"></textarea>
                            <div class="btn btn primary" onclick="submit_comment();">send</div>
                        </form>
                    </div>
                    <div id="comment_block"></div>
                </div> 
                <div class="tab-pane" id="chart"><h1>Chart</h1></div> 
                <div class="tab-pane" id="clipboard"><input type="text" value="Hello World" id="myInput"></div>
            </div>
        </div>
        </div>
    </div>
    </div>

        <script>
            var room = "";
            function getquery(){
                query = document.getElementById("query").value;
                return query;
                }

                $(document).ready(function(){
                $("#query").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#table_body tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                });
            function find(){

                //alert("hello");
                tb = document.getElementById("table_body");
                tb.innerHTML = "";

                q = getquery()
            }
            

            //submit_comment
            function submit_comment(){
                comment = document.getElementById('comment').value;
                entry_id = document.getElementById('entry_id').innerHTML.substring(3);
                entry_id = parseInt(entry_id, 10);

                // alert(comment);
                // AJAX DELETE CAMAPAIGN
                const bcd = new XMLHttpRequest();
                        bcd.onload = function(){
                        res = this.responseText;

                        if (res.includes("New record created successfully")){
                            displayComments(entry_id);
                            alert(res);
                        }else{
                            alert(res);
                        }
                        
                        
                        };
                        
                        bcd.open("POST", "handler/submit_comment.php"); 
                        bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                        bcd.send("comment="+comment+"&entry_id="+entry_id);
                    
                
            }

            // handler/submit_comment.php
            function removeRow(elem){
            if(window.confirm("are you sure you want to delete this?")){
                //GET ALL IN ROW
                row_id = elem.parentNode.parentNode.id;
                row = document.getElementById(row_id);
                
                //GET room
                entry = row_id.replace(/&.*$/,"");
                
                // AJAX DELETE CAMAPAIGN
                const bcd = new XMLHttpRequest();
                        bcd.onload = function(){
                        res = this.responseText;
                        console.log(res);
                        
                        };
                        text = "entry="+entry;
                        bcd.open("POST", "handler/delete_entry.php"); 
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

            function delete_comment(id){
                name = "comment_num"+id;
                papa = document.getElementById(name);
                const bcd = new XMLHttpRequest();
                        bcd.onload = function(){
                        res = this.responseText;
                        if(res.includes("comment deleted successfully")){
                            papa.parentNode.removeChild(papa);
                            alert(res);
                        }else{
                            alert(res);
                        }
                        

                    };
                        text = "comment_id="+id;
                        bcd.open("POST", "handler/delete_comment.php"); 
                        bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                        bcd.send(text);

            }
            function displayComments(entry_id){
                comment_block = document.getElementById('comment_block');
                comment_block.innerHTML = "";
                get_entry = "";
                const bcd = new XMLHttpRequest();
                        bcd.onload = function(){
                        get_entry = JSON.parse(this.responseText);
                        console.log(get_entry);
                        // console.log(this.responseText);
                        
                        if(get_entry == null){}
                        else{
                            gel = get_entry.length;
                            comments = "";
                            for(i=0;i<gel;i++){
                            cmt = get_entry[i];
                                
                                comments += `
                                
                        <div id="comment_num`+ cmt['id'] +`" class="card container" style="background:lightblue;">
                            <div class="card-body text-center">
                            <div class="card-text">
                            <div class="cmt_id" hidden>`+ cmt['id'] +`</div>
                            <span class="deletecmt" onclick="delete_comment(`+ cmt['id'] +`)"> x </span>
                            <span class="user">`+ cmt['user'] +`</span>
                            <span class="comment">`+ cmt['comment'] +`</span>
                            <span class="timestamp">`+ cmt['time'] +`</span>
                                
                            </div>
                            </div>
                        </div>           
                        <br>        
                                `;
                            }
                            comment_block.innerHTML = "";
                            comment_block.innerHTML = comments;
                            // - DELETE
                        }
                        };
                        text = "entry_id="+entry_id;
                        bcd.open("POST", "handler/get_comments.php"); 
                        bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                        bcd.send(text);

            }
            function enable(id){    
                elem = document.getElementById(id);
                elem.readOnly = false;
                elem.required = true;
            }
            //date picker
            function dtp() {
                $('#wd').datetimepicker({format: 'YYYY-MM-DD'});
                $('#ed').datetimepicker({format: 'YYYY-MM-DD'});
            
            }

            function grep(){
                id = document.getElementById("entry_id").value;
                name = document.getElementById("name").value;
                r = document.getElementById("room").value;
                s = document.getElementById("store").value;
                p = document.getElementById("point").value;
                wd = document.getElementById("wd").value;
                ed = document.getElementById("ed").value;
                qt = document.getElementById("qt").value;

                message = "entry_id="+id+"&name="+name+"&room="+r+"&store="+s+"&point="+p+"&wd="+wd+"&ed="+ed+"&qt="+qt;
                // alert(message);
                const bcd = new XMLHttpRequest();
                            bcd.onload = function(){
                            get_entry = this.responseText;
                            console.log(get_entry);
                        };
                            
                            bcd.open("POST", "handler/edit_entry.php"); 
                            bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                            bcd.send(message);
            }
            
            function fetch_room(){
                const bcd = new XMLHttpRequest();
                            bcd.onload = function(){
                            get_entry = this.responseText;
                            console.log(get_entry);
                            
                            if(get_entry == null){}
                            else{
                            rm = get_entry.split(',');
                            length = rm.length;
                                target = document.getElementById("room");
                                for(i=0;i<length;i++){
                                    var opt = document.createElement("option");
                                    opt.text = rm[i];
                                    opt.value = rm[i];
                                    target.options.add(opt);
                                    

                                }
                                //while store and point
                                
                            }

                };
                    text = "entry="+entry;
                    bcd.open("POST", "handler/get_rooms.php"); 
                    bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                    bcd.send(text);

            }
            function fetch_store(){
                room = document.getElementById("room").value;
                s = document.getElementById("store");
                s.value = "";
                s.innerHTML = "";
                const bcd = new XMLHttpRequest();
                            bcd.onload = function(){
                            get_entry = this.responseText;
                            console.log(get_entry);
                            
                            if(get_entry == null){}
                            else{
                            st = get_entry.split(',');
                            length = st.length;
                                target = document.getElementById("store");
                                for(i=0;i<length;i++){
                                    var opt = document.createElement("option");
                                    opt.text = st[i];
                                    opt.value = st[i];
                                    target.options.add(opt);
                                
                                }
                                
                            }

                };
                    text = "room="+room;
                    bcd.open("POST", "handler/get_stores.php"); 
                    bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                    bcd.send(text);

            }
            function fetch_point(store){
                store= document.getElementById("store").value;
                p = document.getElementById("point");
                p.value = "";
                p.innerHTML = "";
                const bcd = new XMLHttpRequest();
                            bcd.onload = function(){
                            get_entry = this.responseText;
                            console.log(get_entry);
                            
                            if(get_entry == null){}
                            else{
                            pt = get_entry.split(',');
                            length = pt.length;
                                target = document.getElementById("point");
                                for(i=0;i<length;i++){
                                    var opt = document.createElement("option");
                                    opt.text = pt[i];
                                    opt.value = pt[i];
                                    target.options.add(opt);
                                
                                }
                                
                            }

                };
                    text = "store="+store;
                    bcd.open("POST", "handler/get_points.php"); 
                    bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                    bcd.send(text);

            }
            
            function modifyModal(elem){
                //GET ROW
                row_id = elem.id;
                row = document.getElementById(row_id);
                
                //GET entry
                entry = row_id.replace(/&.*$/,"");
                entry = entry.replace(/_/g, " ");
                //get title   
                title = document.getElementById("ModalTitle");
                //change title
                title.innerText = entry;
                //get body
                details = document.getElementById("details");
                //GET INFO THROUGH AJAX / PHP
                var get_entry = "";
                const bcd = new XMLHttpRequest();
                            bcd.onload = function(){
                            get_entry = this.responseText;
                            console.log(get_entry);
                            ca = get_entry.split(',');
                            
                            submit_entry = `<p></p>
                            <img class='img' src='`+ ca[5] +`'>
                            <h2> Details: </h2>
                            ID: <input id='entry_id' name='entry_id' disabled value='`+ ca[0] +`'></input>
                            
                            Name:<input id="name" name="name" class='ro'  onclick=enable('name') type='text' readonly="readonly" value='`+ entry +`' ></input>
                            Room: <select id="room" name="room" class='ro' type='text' onchange=fetch_store()> <option value='`+ ca[2] +`' selected>`+ ca[2] +`</option></select><br>
                            Store: <select id="store" name="store" class='ro'   onchange=fetch_point() type='text'><option value='`+ ca[3] +`' selected>`+ ca[3] +`</option></select><br>
                            Point: <select id="point" name="point" class='ro'  type='text'><option value='`+ ca[4] +`' selected>`+ ca[4] +`</option></select><br>

                            <p >Start date:</p><p> `+ ca[6] +`</p>
                            Warranty date: <input id="wd" name="wd" class='ro' maxlength="10"  type='text' value='`+ ca[7] +`' ></input>
                            Expiry date: <input id="ed" name="ed" class='ro' maxlength="10"  onclick=dtp() type='text'  value='`+ ca[8] +`' ></input>
                            Quantity: <input id="qt" name="qt" class='ro' maxlength="2" onclick=enable('qt') type='text' readonly="readonly" value='`+ ca[9] +`' ></input>
                            

                            <bold>Supporting Docs: </bold><br>
                            <a href="`+ ca[10] +`">`+ ca[10] +`</a>


                            <br>
                            <button class='btn btn-primary' onclick="grep()">submit</button>
                            
                            `;
                            details.innerHTML = submit_entry;
                            displayComments(ca[0]);
                            fetch_room()
                            
                            dtp();
                            // - DELETE
                            
                            };
                            text = "entry="+entry;
                            bcd.open("POST", "handler/get_entry.php"); 
                            bcd.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //header, important if not data wont actually be sent.
                            bcd.send(text);

                            
                }
            
        </script> 
        <table id="table" class="table table-hover">
        <thead>
            <th>Entry</th>
            <th>Room</th >
            <th>Store</th >
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
            //GETTING SESSIONS USER NAME
            $sn = $_SESSION['name'];
            $get_session_user_name = "SELECT sessions_user FROM tbl_sessions WHERE sessions_name='$sn'";
            $gsum = $get_session_user_name;
            $result = $conn->query($gsum);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $s_name = $row['sessions_user'];
                }
            }
            //GET USERS CODE
            $code = "SELECT owner_id FROM authenticate WHERE owner_name='$s_name'";
            
            $result = $conn->query($code);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $owner_id = $row['owner_id'];
                }
            }
            $get_all = "SELECT entry_id, item, room_id, store_id, access FROM entries WHERE access=1 OR access=0 AND owner_id = '$owner_id'";
    
            $result = $conn->query($get_all);
            $id = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $id = $row["entry_id"];
                    $Entry =$row["item"];
                    $Entry2 =  str_replace(' ', '_', $Entry);
                    $room_id = $row["room_id"];
                    $store_id =$row["store_id"];
                    $access = $row["access"];
                    
                    //============================================================
                    //GETTING ROOM
                    //-----------
                    $get_room = "SELECT room_name FROM room WHERE room_id=$room_id";

                    $res = $conn->query($get_room);
                    while($row = $res->fetch_assoc()) {
                        $room_name =$row["room_name"];
                        
                    }
                    //============================================================
                    //GETTING STORE
                    //-----------
                    $get_store = "SELECT store_name FROM store WHERE store_id=$store_id";

                    $resul = $conn->query($get_store);
                    while($row = $resul->fetch_assoc()) {
                        $store_name =$row["store_name"];
                        $store_name2 =  str_replace('_', ' ', $store_name);
                    }
                    
                    
                        //permissions allowed
                    echo "
                    <tr id='$Entry2&$id' data-toggle='modal' data-target='#myModal' onclick='modifyModal(this)'>
                    <td>$Entry</td>
                    <td>$room_name</td>
                    <td>$store_name2</td>
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

