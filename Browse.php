<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

.center {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 200px;
  border: 3px solid red;
  margin: 200px;
  
  border-radius: 25px;
  
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
  font-size: 30px;  
}

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

table, th, td {
  border: 1px solid black;
}
</style>
<script>
function update_table(str) {
    if (str.length == 0) {
        document.getElementById("status").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("status").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gochange.php?q=" + str, true);
        xmlhttp.send();
    }
}
function myFunction(str,str2)
{
    console.log(str);
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("status").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gochange.php?q=" + str+"&q2="+str2, true);
        xmlhttp.send();
}
</script>
</head>
<?php require 'connect.php';?>

<?php
    session_start(); 
    if(isset($_GET['id']))
    {
        //echo $_GET['id'];
        $tmp = $_GET['id'];
    }
?>
<?php
date_default_timezone_set('Asia/Taipei');
//當前日期
$sdefaultDate = date("Y-m-d");
// echo $sdefaultDate;
// echo $sdefaultDate.'<br>';
 
//$first =1 表示每週星期一为開始日期 0表示每週日为開始日期
$first=1;
 
//获取当前周的第几天 周日是 0 周一到周六是 1 - 6
$w=date('w',strtotime($sdefaultDate));

 
//取本周开始日期，如果$w是0，則表示周日，減去 6 天
$week_start=date('Y-m-d',strtotime("$sdefaultDate -".($w ? $w - $first : 6).' days'));
// echo $week_start.'<br>';
//本周结束日期
$week_end=date('Y-m-d',strtotime("$week_start +6 days"));
$next_week = date('Y-m-d',strtotime("$week_end +1 days"));
$last_week = date('Y-m-d',strtotime("$week_start -7 days")); 
// echo $week_end.'<br>';
// 瀏覽教室占用
// if(isset($_GET['id'])) 
?>
<body>

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
  <li><a class="active" href="Browse.php">Browse</a></li>
  <li><a href="Request.php">Request</a></li>
  <li><a href="Register.php">Register</a></li>
  <li><a href="Update.php">Update_Password</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="logout.php">Logout</a><li>
</ul>
<br>
<?php

if(isset($_SESSION['staff']))
{    
echo '<table id="status">';
echo '<tr><th>歸還狀態</th><th>借用人</th><th>班級</th><th>節次</th><th>目的</th><th>設備</th><th>借用日期</th><th>歸還時間</th><th>負責單位</th><th>負責人</th></tr>';
foreach($pdo->query('select * from apply order by return_ok') as $row)
{
    if($row['return_ok']==-1)
    {    
        echo '<tr>';
        echo '<td><input type="checkbox" value="'.$row['ID'].'" onclick="myFunction(this.value,-1)"></td>';
        echo '<td>',$row['name'],'</td>';
        echo '<td>',$row['class'],'</td>';
        echo '<td>',$row['section'],'</td>';
        echo '<td>',$row['purpose'],'</td>';
        echo '<td>',$row['device'],'</td>';
        echo '<td>',$row['date'],'</td>';
        echo '<td>',$row['return_time'],'</td>';
        echo '<td>',$row['unit'],'</td>';
        echo '<td>',$row['uperson'],'</td>';
        echo '<tr>';
    }
    else
    {
        echo '<tr bgcolor="#ddd">';
        echo '<td><input type="checkbox" value="'.$row['ID'].'" onclick="myFunction(this.value,1)" checked></td>';
        echo '<td>',$row['name'],'</td>';
        echo '<td>',$row['class'],'</td>';
        echo '<td>',$row['section'],'</td>';
        echo '<td>',$row['purpose'],'</td>';
        echo '<td>',$row['device'],'</td>';
        echo '<td>',$row['date'],'</td>';
        echo '<td>',$row['return_time'],'</td>';
        echo '<td>',$row['unit'],'</td>';
        echo '<td>',$row['uperson'],'</td>';
        echo '</tr>';
    }        
}
echo '</table>';
}
else
{
    echo '<div class="center"><p>Not yet Login</p></div>';
}    
?>


