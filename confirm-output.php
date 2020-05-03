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
</style>
</head>
<?php require 'connect.php';?>
<ul>
  <li><a class="active" href="Home.php">Home</a></li>
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
  <li><a href="admin.php">管理帳密</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="logout.php">Logout</a><li>
</ul>

<?php
session_start();

//if(isset($_REQUEST['Name']))
//echo '<p>',$_REQUEST['Name'],'</p>';

//if(isset($_REQUEST['date']))
//echo '<p>',$_REQUEST['date'],'</p>';
echo '<div class="center">';
if(isset($_REQUEST['section']))
{    
    //foreach($_REQUEST['section'] as $item)
    {
        //echo '<p>',$item,'</p>';
    }
    $count = count($_REQUEST['section']);
    $section = json_encode($_REQUEST['section']);
}
else
{
    $count = 0;
    echo "節次不得為空";
    echo "<br>";
}    


if(isset($_REQUEST['device']))
{
    $device  = json_encode($_REQUEST['device'], JSON_UNESCAPED_UNICODE);
    //foreach($_REQUEST['device'] as $item)
    {
        //echo '<p>',$item,'</p>';
    }
}
else
{
    $device = json_encode([]);
}
    
//if(isset($_REQUEST['purpose']))
//echo '<p>',$_REQUEST['purpose'],'</p>';

/*
switch($_REQUEST['classID'])
{
    case 'EC1005':
    echo 'EC1005';
    break;
    
    case 'EC1006':
    echo 'EC1006';
    break;
    
    case 'EC1014-2':
    echo 'EC1014-2';
    break;
    
    case 'EC2013-1':
    echo 'EC2013-1';
    break;
    
    case 'EC2013-2':
    echo 'EC2013-2';
    break;
    
    case 'EC2015':
    echo 'EC2015';
    break;

    case 'EC3015':
    echo 'EC3015';
    break;
    
    case 'EC3016':
    echo 'EC3016';
    break;
    
    case 'EC3016':
    echo 'EC3016';
    break;
    
    case 'EC5000':
    echo 'EC5000';
    break;
    
    case 'EC5007':
    echo 'EC5007';
    break;
    
    case 'EC5012':
    echo 'EC5012';
    break;
    
    case 'EC5025':
    echo 'EC5025';
    break;
    
    case 'EC5026':
    echo 'EC5026';
    break;
    
    case 'EC9014':
    echo 'EC9014';
    break;

    case 'EC9032-1':
    echo 'EC9032-1';
    break;
    
    case 'EC9032-2':
    echo 'EC9032-2';
    break;    
    
    case 'EC9013':
    echo 'EC9013';
    break;  
}
*/

$cf = 0;
$sql2 = $pdo->prepare('select * from apply where class=? and date=? and return_ok=(-1)');

$sql2->execute([$_REQUEST['classID'],$_REQUEST['date']]);
foreach($sql2->fetchAll() as $row)
{
    
    $ar = json_decode($row['section']);
    $ar2 = $_REQUEST['section'];
    foreach($ar as $item)
    {
        if(in_array($item,$ar2))
        {
            $cf = 1;
            echo '與'.$row['name'].'借的';
            echo '第'.$item.'節 conflict<br>';
        }
    }
}    

$sql = $pdo->prepare('insert into apply (name,class,date,section,purpose,device,return_ok,login_id,email) value(?,?,?,?,?,?,-1,?,?)');
if(empty($_REQUEST['Name']))
{
    echo "借用人欄位不得為空!";
}
else if(empty($_REQUEST['date']))
{
    echo "借用日期不得為空!";
}
else if($count==0)
{
    echo "需勾選節次!";
}
else if($cf==1)
{
    echo "時段衝突<br>";
}
else
{    
    if($sql->execute(
    [$_REQUEST['Name'],$_REQUEST['classID'],$_REQUEST['date'],$section,$_REQUEST['purpose'],$device,$_SESSION['staff']['id'],$_SESSION['staff']['email']]))
    {
        echo '新增成功';
    }
    else
    {
        echo '新增失敗';
        //$error = $sql->errorInfo();
        //echo 'check'.$error.'check';
        //echo $error[2];
    }
}
echo '</div>';    
?>