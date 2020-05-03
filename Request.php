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
form {
    display: inline;
}
</style>
<script>
function showdv(str)
{
	if (str.length==0)
	{ 
		document.getElementById("dvlist").innerHTML="先選擇教室";
		return;
	}    

	if (window.XMLHttpRequest)
	{
		// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	
		//IE6, IE5 浏览器执行的代码
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("dvlist").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","getdv.php?q="+str,true);
	xmlhttp.send();
}
</script>
</head>

<?php require 'connect.php';?>
<body>

<ul>
  <li><a href="main.php">Home</a></li>
   <div class="dropdown">
    <button class="dropbtn">Classroom 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <?php
      session_start();      
      foreach($pdo->query('select croom_id from classroom') as $row)
      {
          echo '<a href="status.php?class='.$row['croom_id'].'">'.$row['croom_id'].'</a>';
      }
      ?>
 
    </div>
  </div> 
<li><a href="Overview.php">Overview</a></li>
  <li><a href="Register.php">Register</a></li>
  
  <?php
  if(!isset($_SESSION['staff']))
  {
      echo '<li><a href="login.php">Login</a></li>';
  }
  
  if(isset($_SESSION['staff']) && $_SESSION['staff']['role']=="1")
  {    
    echo '<li><a href="detail.php" >教室&設備</a></li>'; 
    echo '<li><a href="Browse.php" >Browse</a></li>';
    echo '<li><a href="Update.php">Update_Password</a></li>';
  }

  if(isset($_SESSION['staff']) && $_SESSION['staff']['role']=="0")
  {
    echo '<li><a href="Request.php" class="active">Request</a></li>';  
  }

  if(isset($_SESSION['staff']) && $_SESSION['staff']['role']=="admin")
  {    
    echo '<li><a href="admin.php">管理帳密</a></li>';
  }  
  
  if(isset($_SESSION['staff']))
  {      
    echo '<li><a href="logout.php">Logout</a><li>';
  }    
  
  ?>   
</ul>
<?php

if(isset($_SESSION['staff']))
{    
   echo '<form action="confirm-output.php" method="post">';
   echo '<p>借用人: <input type="text" name="Name"></p>';

   echo '<p>';   
   echo '教室編號:'; 
   echo '<select name="classID" onchange="showdv(this.value)">';
   
      echo '<option value="">請選擇</option>';
      foreach($pdo->query('select croom_id from classroom') as $row)
      {
          //echo '<a href="status.php?class='.$row['croom_id'].'">'.$row['croom_id'].'</a>';
          echo '<option value="',$row['croom_id'],'">',$row['croom_id'],'</option>';
      }

   echo '</select>';
   echo '</p>';

   echo '<p>日期: <input type="date"  name="date"></p>';
   echo '<p>節次: </p>';


    $timeline =
    [
        '7:00-7:50',
        '8:10-9:00',
        '9:10-10:00',
        '10:10-11:00',
        '11:10-12:00',
        '12:10-13:00',
        '13:10-14:00',
        '14:10-15:00',
        '15:10-16:00',
        '16:10-17:00',
        '17:10-18:00',
        '18:20-19:10',
        '19:15-20:05',
        '20:10-21:00',
        '21:05-21:55'
    ];


    $section = 
    [
        'A','1','2','3','4','B','5','6','7','8','9','C','D','E','F'
    ];

    echo '<table style="width:100%">';
    $i = 0 ;
    foreach($section as $item)
    {
        if($i == 0)    
        {echo '<tr>';}
        if($i == 5)
        {echo '</tr>';$i=0;}
        echo '<td>';
        echo '<input type="checkbox" name="section[]" value="',$item,'">';
        echo $item;
        echo '</td>';
        $i++;
    }
    echo '</table>';

    echo '<p>用途:</p>';
    echo '<textarea name="purpose" rows="5" cols="30">';
    echo '</textarea>';
    echo '<p>借用設備:</p>';




    echo '<div id="dvlist" >先選擇教室</div>';
    echo '<br><br>';

    echo '<input type="submit" value="申請送出">';
    echo '</form>';
    echo '<form>';
    echo '<button onclick="window.print()">列印申請單</button>';
    echo '</form>';


}
else
{
    echo '<div class="center"><p>Not yet Login</p></div>';
}

?>
</body>
</html>
