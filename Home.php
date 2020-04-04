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
</style>
</head>
<?php require 'connect.php';?>

<?php
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
  <li><a class="active" href="#home">Home</a></li>
   <div class="dropdown">
    <button class="dropbtn">Classroom 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
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
    </div>
  </div> 
  <li><a href="Request.php">Request</a></li>
  <li><a href="Contact.html">Contact</a></li>
  <li><a href="About.html">About</a></li>
</ul>

<br>
<?php
    if(isset($_GET['id']))
    {    
        $a = date('Y/m/d',(strtotime("$tmp")+(86400*6)));
        
        $next_week = date('Y-m-d',strtotime("$a +1 days"));
        $last_week = date('Y/m/d',(strtotime("$tmp")-(86400*7)));
    }    
?>
<a href="Home.php?id=<?php echo $last_week; ?>" class="previous">&laquo; Previous</a>
<a href="Home.php?id=<?php echo $next_week; ?>" class="next">Next &raquo;</a>

<br><br>


<table id="customers">
  <tr>
    <th>Section</th>
    <th>Time</th>
    <!--
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wedesday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>
    <th>Sunday</th>
    -->
    <?php
    
        $Arr=array('Monday','Tuesday','Wedesday','Thursday','Friday','Saturday','Sunday');
        if(isset($_GET['id']))
        {
            //echo "get<br>";
            for($i=0;$i<7;$i++)
            {
                //echo $_GET['id'].'<br>';
                $a = date('m/d',(strtotime("$tmp")+(86400*$i)));
                //$b = date('Y-m-d',(strtotime("$tmp")+(86400*$i)));
                //if($sdefaultDate==$b)
                {    
                    //echo "today";
                    //echo "<th style='border-color:red;border-style:solid;border-width:3px;padding:5px;'>".$Arr[$i]." ".$a."</th>";
                    
                }
                $b = date('Y-m-d',(strtotime("$tmp")+(86400*$i)));
                //echo $b;
                if($sdefaultDate==$b)
                {    
                    // echo $b;
                    //echo "today";
                    echo "<th style='border-color:red;border-style:solid;border-width:3px;padding:5px;'>".$Arr[$i]." ".$a."</th>";
                    
                }
                else
                {
                    echo "<th>".$Arr[$i]." ".$a."</th>";
                }
                $a = date('Y/m/d',(strtotime("$tmp")+(86400*$i)));
                /*
                if($i==6)
                {
                    echo $a;
                    $next_week = date('Y-m-d',strtotime("$a +1 days"));
                    echo $next_week;
                    
                }
                */
                //echo $week_end;
            }
        }
        else
        {
            //echo "no<br>";
            for($i=0;$i<7;$i++)
            {
                //if($i==0)
                {
                   // $next_week = date('Y-m-d',strtotime("$week_end +1 days")); 
                }
                  
                $a = date('m/d',(strtotime("$week_start")+(86400*$i)));
                $b = date('Y-m-d',(strtotime("$week_start")+(86400*$i)));
                //echo $b;
                if($sdefaultDate==$b)
                {    
                    // echo $b;
                    //echo "today";
                    echo "<th style='border-color:red;border-style:solid;border-width:3px;padding:5px;'>".$Arr[$i]." ".$a."</th>";
                    
                }
                else
                {    
                    echo "<th>".$Arr[$i]." ".$a."</th>";
                }        
            }
        }    
    ?>
  </tr>
  <tr>
    <td>A</td>
    <td>7:00-7:50 </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>1</td>
    <td>8:10-9:00 </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>2</td>
    <td>9:10-10:00 </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>3</td>
    <td>10:10-11:00</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>4</td>
    <td>11:10-12:00</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>B</td>
    <td>12:10-13:00</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>5</td>
    <td>13:10-14:00</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>6</td>
    <td>14:10-15:00 </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>7</td>
    <td>15:10-16:00</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>8</td>
    <td>16:10-17:00</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
        
  </tr>
  <tr>
    <td>9</td>
    <td>17:10-18:00</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
        
  </tr>
  <tr>
    <td>C</td>
    <td>18:20-19:10</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
        
  </tr>
  <tr>
    <td>D</td>
    <td>19:15-20:05</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
        
  </tr>  
  <tr>
    <td>E</td>
    <td>20:10-21:00</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
        
  </tr>  
    <tr>
    <td>F</td>
    <td>21:05-21:55</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
        
    </tr>
</table>


</body>
</html>
