<?php require 'connect.php';?>
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

<br>

<?php
      date_default_timezone_set('Asia/Taipei');
      if(isset($_GET['id']))
      {
          
          $today = $_GET['id'];          
      }
      else
      {
          $today = date("Y-m-d");
      }          
      
      $tomorrow = date('Y-m-d',strtotime("$today +1 days"));
      $yesterday = date('Y-m-d',strtotime("$today -1 days"));
?>      
<a href="main.php?id=<?php echo $yesterday; ?>" class="previous">&laquo; Previous</a>
<a href="main.php?id=<?php echo $tomorrow; ?>" class="next">Next &raquo;</a> 
<br><br>    
<?php      

      echo '<table id="customers">';
      echo '<tr>';
      // echo '<td></td>';
        echo '<th>';
        echo '節次/教室';
        echo '</th>';
      
      foreach($pdo->query('select croom_id from classroom order by croom_id') as $row)
      {
          echo '<th>'.$row['croom_id'].'</th>';
      }
      echo '</tr>';
      $stion = ['A','1','2','3','4','B','5','6','7','8','9','C','D','E','F'];
      for($i=0;$i<15;$i++)
      {
          echo '<tr>';
          echo '<td>'.$stion[$i].'</td>';
          
          
          
          foreach($pdo->query('select croom_id from classroom order by croom_id') as $row)
          {
                
                $sql = $pdo->prepare("select * from apply where return_ok=(-1) and date=? and class=?");
                $sql->execute([$today,$row['croom_id']]);
                $tmp = $sql->fetchAll();
                //echo count($tmp);
                if(count($tmp)==0)
                {
                    
                    echo '<td></td>';
                }
                else
                {
                    $flag = 0;                    
                    foreach($tmp as $item)
                    {
                        
                        //echo $item['name'];
                        $arr = json_decode($item['section'], true);
                        if(in_array($stion[$i],$arr))
                        {
                            echo '<td>'.$item['name'].'</td>';
                            $flag = 1;
                            break;
                        }

                    }
                    if($flag==0)
                    {
                            echo '<td></td>';
                                                    
                    }
                }   
             
          } 
          echo '</tr>';
      } 
      echo '</table>';      
?>

