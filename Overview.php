<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_next_prev#
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  background-color: #FF8800;
  color: white;
}

.next {
  background-color: #FF8800;
  color: white;
}

.round {
  border-radius: 50%;
}

#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  
}

#customers tr:nth-child(even){background-color: #f2f2f2;}



#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: red;
}

.active {
  background-color: #FFBB00;
}
.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 6px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
  
}

.dropdown:hover .dropdown-content {
  display: block;
  
}
/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 30%;
  padding: 15px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width:600px) {
  .column {
    width: 100%;
  }
}


.zoom:hover {
  -ms-transform: scale(1.5); /* IE 9 */
  -webkit-transform: scale(1.5); /* Safari 3-8 */
  transform: scale(1.5); 
}
</style>
<script>
function showdetail(str) {
    var floor = str.slice(2,3);
    console.log(floor);
    if(floor=="1")
    {
        document.getElementById("myImg").src="https://i.imgur.com/oFKHONM.jpg";
    }
    else if(floor=="3")
    {
        document.getElementById("myImg").src = "https://i.imgur.com/G0fsyE1.jpg";
    }
    else if(floor=="5")
    {
        document.getElementById("myImg").src = "https://i.imgur.com/kCLuhlH.jpg.jpg";
    }
    document.getElementById("myImg").style="display:block";
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("borrowed").innerHTML = this.responseText;
                
            }
        }
        xmlhttp.open("GET", "getdetail.php?q="+str, true);
        xmlhttp.send();
    }
}
</script>
</head>
<?php require 'connect.php';?>
<ul>
  <li><a  href="Home.php">Home</a></li>
   <div class="dropdown">
    <button class="dropbtn">Classroom 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
    <?php
      foreach($pdo->query('select croom_id from classroom') as $row)
      {
          echo '<a href="status.php?class='.$row['croom_id'].'">'.$row['croom_id'].'</a>';
      }
      /*
      <a href="status.php?class=<?php echo "EC1005" ?>">EC1005</a>
      <a href="#">EC1006</a>
      <a href="#">EC1014-2</a>
      <a href="#">EC2013-1</a>
      <a href="#">EC2013-2</a>
      <a href="#">EC2015</a>
      <a href="#">EC3015</a>
      <a href="#">EC3016</a>
      <a href="#">EC5000</a>
      <a href="#">EC5007</a>
      <a href="#">EC5012</a>
      <a href="#">EC5025</a>
      <a href="#">EC5026</a>
      <a href="#">EC9014</a>
      <a href="#">EC9032-1</a>
      <a href="#">EC9032-2</a>
      <a href="#">EC9013</a>
      */
    ?>  
    </div>
  </div> 
  <li><a class="active" href="Overview.php">Overview</a></li>
  <li><a href="Browse.php">Browse</a></li>
  <li><a href="Request.php">Request</a></li>
  <li><a href="Register.php">Register</a></li>
  <li><a href="Update.php">Update_Password</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="logout.php">Logout</a><li>
</ul>
<div class="row">
  <div class="column">
    <h2>教室資料表</h2>
    
    <span id="info">
    <table id="customers">
    <tr><th>教室編號</th><th>教室名稱</th><th>教室位置</th><th>教室容量</th></tr>
    <?php
        
        foreach($pdo->query("select * from classroom") as $row)
        {
            echo '<tr onclick=showdetail("'.$row['croom_id'].'")>';
            echo '<td>'.$row['croom_id'].'</td>';
            echo '<td>'.$row['croom_name'].'</td>';
            echo '<td>'.$row['croom_location'].'</td>';
            echo '<td>'.$row['croom_capacity'].'</td>';
            
            echo '</tr>';
        }
    ?>
    </table>
    </span>
  </div>
  
  <div class="column">
    <h2>預借情況</h2>
    <span id="borrowed">
    
    </span>
  </div>
   <div class="column">
    <h2>位置</h2>
    <img class="zoom" id="myImg" style="display:none" src="" width="100%" height="90%"></img>
  </div> 
</div>
</html>