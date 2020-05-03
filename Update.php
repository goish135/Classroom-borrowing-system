<?php require 'connect.php'?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.center2 {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 200px;
  border: 3px solid red;
  margin: 200px;
  
  border-radius: 25px;
  
  text-shadow: -1px 0 red, 0 1px red, 1px 0 red, 0 -1px red;
  font-size: 30px;  
}
.center {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 30px;
  padding-left: 20%;
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
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
input[type=password], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}



input[type=submit]:hover {
  background-color: #45a049;
}

.center {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 30px;
  padding-left: 20%;
}
</style>
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
    echo '<li><a href="Update.php" class="active">Update_Password</a></li>';
  }

  if(isset($_SESSION['staff']) && $_SESSION['staff']['role']=="0")
  {
    echo '<li><a href="Request.php">Request</a></li>';  
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
<br>
<?php require "connect.php" ?>

<?php
    
    
    
    if(isset($_SESSION['staff']))
    {
        echo '<div class="center">';
        $name = $_SESSION['staff']['name'];
        $id = $_SESSION['staff']['id'];
        $pw = $_SESSION['staff']['pw'];
        echo '<form action="update_out.php" method="post">';
        echo '<table>';
        echo '<tr><td>名稱:</td><td>'.$_SESSION['staff']['name'].'</td></tr>';
        echo '<tr><td>編號:</td><td>'.$_SESSION['staff']['id'].'</td></tr>';
        echo '<tr><td>密碼:</td><td><input type="text" value="'.$_SESSION['staff']['pw'].'" name="pw"></td></tr>';
        echo '<tr><td><input type="submit" value="更改密碼"></td></tr>';
        echo '</table>';
        echo '</form>';
        echo '</div>';
    }
    else
    {
        echo '<div class="center2"><p>Not yet Login</p></div>';
    }
     
    
?>







