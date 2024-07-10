<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>

<button id="myBtn">Open Modal</button>

<div id="myModal" class="modal">

  <div class="modal-content" id="formdata">
    <span class="close">&times;</span>
        <label for="fname">Transaction No:</label><br>
        <input type="number" id="transno" name="fname"><br>
        <label for="lname">Transaction Date:</label><br>
        <input type="date" id="transdate" name="lname"><br><br>
        <label for="fname">Detail Items</label>
        <button type="button" id="myBtndetail">Add Item</button><br>
        <div id="itemslist">
        <div class="items">
            <label for="fname">Item Name:</label><br>
            <input type="text" class="itemname" name="fname"><br>
            <label for="lname">Quantity:</label><br>
            <input type="number" class="quantity" name="lname"><br><br>
        </div>
        </div>
        <button type="button" value="button" onclick="send()">submit</button>
  </div>

</div>

<h2>HTML Table</h2>

<div id="datalist">
<table>
  <tr>
    <th>Transaksi</th>
    <th>Total Item</th>
    <th>Total Quantity </th>
    <th>Action </th>
  </tr>
</table>
</div>

<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");

btn.onclick = function() {
  modal.style.display = "block";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

var myBtndetail = document.getElementById("myBtndetail");
myBtndetail.onclick = function() {
    var e = $('<div class="items"><label for="fname">Item Name:</label><br><input type="text" class="itemname" name="fname"><br><label for="lname">Quantity:</label><br><input type="text" class="quantity" name="lname"><br><br></div>');
    $('#itemslist').append(e);   
}
</script>


    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

    function send() {
      var itemname = $('.itemname').map( function(){return $(this).val(); }).get();
      var quantity = $('.quantity').map( function(){return $(this).val(); }).get();
      var transno = $("#transno").val();
      var transdate = $("#transdate").val();
      
      $.ajax({
          url: "http://localhost:8080/api/trans",
          type: "POST",
          data: {
            itemname:itemname,
            quantity:quantity,
            transno:transno,
            transdate:transdate
          },
          error: function() {
              console.log("error");
          },
          success: function(data, statusText, success) {

    modal.style.display = "none";
            list();
          }
      });
    }

    function list() {
      
      $.ajax({
          url: "http://localhost:8080/api/indexdata",
          type: "GET",
          error: function() {
              console.log("error");
          },
          success: function(data, statusText, success) {
             $("#datalist").html(data.data);
          }
      });
    }


    function update() {
      var itemname = $('.itemname').map( function(){return $(this).val(); }).get();
      var quantity = $('.quantity').map( function(){return $(this).val(); }).get();
      var transno = $("#transno").val();
      var transdate = $("#transdate").val();
      var idd = $("#idd").val();
      
      $.ajax({
          url: "http://localhost:8080/api/trans/updatedata",
          type: "POST",
          data: {
            itemname:itemname,
            quantity:quantity,
            transno:transno,
            transdate:transdate,
            id:idd
          },
          error: function() {
              console.log("error");
          },
          success: function(data, statusText, success) {

    modal.style.display = "none";
    
    $("#formdata").html(`<span class="close">&times;</span>
        <label for="fname">Transaction No:</label><br>
        <input type="number" id="transno" name="fname"><br>
        <label for="lname">Transaction Date:</label><br>
        <input type="date" id="transdate" name="lname"><br><br>
        <label for="fname">Detail Items</label>
        <button type="button" id="myBtndetail">Add Item</button><br>
        <div id="itemslist">
        <div class="items">
            <label for="fname">Item Name:</label><br>
            <input type="text" class="itemname" name="fname"><br>
            <label for="lname">Quantity:</label><br>
            <input type="number" class="quantity" name="lname"><br><br>
        </div>
        </div>
        <button type="button" value="button" onclick="send()">submit</button>`);

            list();
          }
      });
    }

    function list() {
      
      $.ajax({
          url: "http://localhost:8080/api/indexdata",
          type: "GET",
          error: function() {
              console.log("error");
          },
          success: function(data, statusText, success) {
             $("#datalist").html(data.data);
          }
      });
    }

    function edit(id) {
      
      $.ajax({
          url: "http://localhost:8080/api/trans/update",
          type: "POST",
          data: {
            id:id
          },
          error: function() {
              console.log("error");
          },
          success: function(data, statusText, success) {
             $("#formdata").html(data.data);
  modal.style.display = "block";

var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
  modal.style.display = "none";
}
          }
      });
    }



    function deletedata(id) {
      
      $.ajax({
          url: "http://localhost:8080/api/trans/delete",
          type: "DELETE",
          data: {
            id:id
          },
          error: function() {
              console.log("error");
          },
          success: function(data, statusText, success) {
            list();
          }
      });
    }

$( document ).ready(function() {
    list();
});
  </script>
  </body>
</html>