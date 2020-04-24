
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
</style>
</head>
<?php require 'connect.php';?>



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
  <li><a href="detail.php">教室&設備</a></li>  
  <li><a href="Overview.php">Overview</a></li>
  <li><a href="Browse.php">Browse</a></li>
  <li><a href="Request.php">Request</a></li>
  <li><a href="Register.php">Register</a></li>
  <li><a href="Update.php">Update_Password</a></li>
  <li><a class="active" href="admin.php">管理帳密</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="logout.php">Logout</a><li>
</ul>
<br><br>
<table id="customers">
<tr><th>編號</th><th>姓名</th><th>單位編號</th><th>電郵</th><th>電話</th><th>密碼</th><th>權限</th><th>action1</th><th>action2</th></tr>
<?php
if(isset($_REQUEST['command']))
{
        switch($_REQUEST['command'])
        {
            case 'insert':
            $sql = $pdo->prepare('insert into user values(null,?,?,?,?,?,?,?)');
            $sql->execute([$_REQUEST['person_id'],$_REQUEST['name'],$_REQUEST['unit_id'],$_REQUEST['email'],$_REQUEST['phone'],$_REQUEST['pw'],$_REQUEST['role']]);
            break;
            case 'update':
            $sql = $pdo->prepare('update user set person_id=?,name=?,unit_id=?,email=?,phone=?,role=? where id=?');
            $sql->execute([$_REQUEST['person_id'],$_REQUEST['name'],$_REQUEST['unit_id'],$_REQUEST['email'],$_REQUEST['phone'],$_REQUEST['role'],$_REQUEST['id']]);
            break;
            case 'delete':
            $sql = $pdo->prepare('delete from user where id=?');
            $sql->execute([$_REQUEST['id']]);
            break;
            
        }
}

foreach($pdo->query('select * from user') as $row)
{
    echo '<tr>';
    echo '<form action="edit2.php" method="post">';
    
    echo '<input type="hidden" name="command" value="update">';
    echo '<input type="hidden" name="id" value="'.$row['id'].'">';
    echo '<td><input type="text" name="person_id" value="'.$row['person_id'].'"></td>';
    echo '<td><input type="text" name="name" value="'.$row['name'].'"></td>';
    echo '<td><input type="text" name="unit_id" value="'.$row['unit_id'].'"></td>';
    echo '<td><input type="text" name="email" value="'.$row['email'].'"></td>';
    echo '<td><input type="text" name="phone" value="'.$row['phone'].'"></td>';
    // echo '<input type="text" value=">'.$row['pw'].'">';
    echo '<td>secret</td>';
    echo '<td><input type="text" name="role" value="'.$row['role'].'"></td>';
    echo '<td><input type="submit" value="修改"></td>';
    echo '</form>';
    echo '<form action="edit2.php" method="post">';
    echo '<input type="hidden" name="command" value="delete">';
    echo '<input type="hidden" name="id" value="'.$row['id'].'">';
    echo '<td><input type="submit" value="刪除"></td>';
    echo '</form>';
    echo '</tr>';
}
?>

<tr>
<form action="edit2.php" method="post">
<input type="hidden" name="command" value="insert">
<td><input type="text" name="person_id"></td>
<td><input type="text" name="name"></td>
<td><input type="text" name="unit_id"></td>
<td><input type="text" name="email"></td>
<td><input type="text" name="phone"></td>
<td><input type="text" name="pw"></td>
<td><input type="text" name="role"></td>
<td><input type="submit" value="新增"></td>
</form>
</tr>

</table>

</body>
</html>




