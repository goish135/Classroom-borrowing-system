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
  width: 50%;
  
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
</style>
</head>
<?php require 'connect.php';?>

<?php

        
    /*
    if(isset($_GET['id']))
    {
        //echo $_GET['id'];
        $tmp = $_GET['id'];
    }
    */
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

    ?>  
    </div>
  </div>
  <li><a class="active" href="detail.php">教室&設備</a></li>  
  <li><a href="Overview.php">Overview</a></li>
  <li><a href="Browse.php">Browse</a></li>
  <li><a href="Request.php">Request</a></li>
  <li><a href="Register.php">Register</a></li>
  <li><a href="Update.php">Update_Password</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="logout.php">Logout</a><li>
</ul>
    <br>
    <?php
        session_start();
        if($_SESSION['staff']['unit_id']=="cs")
        {    
           echo '<table id="customers">';
           echo '<tr><td colspan="2" align="center">教室或設備的借用情形</td></tr>';
           echo '<tr><th>教室編號</th><th>教室名稱</th><th>教室位置</th><th>教室容量</th><th>借用情況</th><th>設備狀態</th></tr>';
    
        
        foreach($pdo->query("select * from classroom") as $row)
        {
            //echo '<tr onclick=showdetail("'.$row['croom_id'].'")>';
            echo '<tr>';
            echo '<td>'.$row['croom_id'].'</td>';
            echo '<td>'.$row['croom_name'].'</td>';
            echo '<td>'.$row['croom_location'].'</td>';
            echo '<td>'.$row['croom_capacity'].'</td>';
            
            echo '<td>';
            $sql = $pdo->prepare("select date,section from apply where return_ok=(-1) and class=? order by date");
            $sql->execute([$row['croom_id']]);
            foreach($sql->fetchAll() as $row2)
            {
              echo $row2['date']." ".$row2['section']."<br>";
            }
            echo '</td>';
            echo '<td>';
            $sql2 = $pdo->prepare("select * from facility where device_id=? order by status");
            $sql2 ->execute([$row['croom_id']]);
            
            foreach($sql2->fetchAll() as $row)
            {
                if($row['status']==0)
                {
                    echo '<font color=green>'.$row['device_name'].'</font><br>';
                }
                else
                {
                    echo '<font color=red>'.$row['device_name'].'</font><br>';
                }                    
            }
            echo '</td>';
            echo '</tr>';
        }
    
       echo '</table>';
       }
       else
       {
           echo '沒有權限';
       }
    ?>
</body>
</html>