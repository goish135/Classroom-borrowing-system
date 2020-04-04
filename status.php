<?php require 'connect.php';?>
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
<ul>
  <li><a class="active" href="#home">Home</a></li>
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
<!--    
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
-->      
    </div>
  </div> 
  <li><a href="Request.php">Request</a></li>
  <li><a href="Contact.html">Contact</a></li>
  <li><a href="About.html">About</a></li>
</ul>
<br>
<?php
$sdd = date("m-d");
if(isset($_REQUEST['date']))
{
    //echo $_REQUEST['date'];
    $week_start = $_REQUEST['date'];
    //echo 'test';
    $week_end=date('Y-m-d',strtotime("$week_start +6 days"));
    $next_week = date('Y-m-d',strtotime("$week_end +1 days"));
    $last_week = date('Y-m-d',strtotime("$week_start -7 days"));
}
else
{
    $cs = $_REQUEST['class'];
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
    $week_end=date('Y-m-d',strtotime("$week_start +6 days"));
    $next_week = date('Y-m-d',strtotime("$week_end +1 days"));
    $last_week = date('Y-m-d',strtotime("$week_start -7 days"));    
}
?>
<a href="status.php?date=<?php echo $last_week; ?>&class=<?php echo $_REQUEST['class']; ?>" class='previous'>&laquo; Previous</a>
<a href="status.php?date=<?php echo $next_week; ?>&class=<?php echo $_REQUEST['class']; ?>" class='next'>Next &raquo;</a>
<br> <br>
<?php
$w1 = $week_start;
$w2 = date('m-d',strtotime("$w1"));

$wk = array();
for($i=0;$i<7;$i++)
{
    $wk[$i] = $w2;
    $w1 = date('Y-m-d',strtotime("$w1 +1 days"));
    $w2 = date('m-d',strtotime("$w1"));
}

//if(isset($_REQUEST['date']))
{
  //  echo 'test';
    
}
//else
{   

    date_default_timezone_set('Asia/Taipei');
    //當前日期
    //$sdefaultDate = date("Y-m-d");
    // echo $sdefaultDate;
    // echo $sdefaultDate.'<br>';
     
    //$first =1 表示每週星期一为開始日期 0表示每週日为開始日期
    $first=1;
     
    //获取当前周的第几天 周日是 0 周一到周六是 1 - 6
    //$w=date('w',strtotime($sdefaultDate));

     
    //取本周开始日期，如果$w是0，則表示周日，減去 6 天
    /*$week_start=date('Y-m-d',strtotime("$sdefaultDate -".($w ? $w - $first : 6).' days')); 
    $week_end=date('Y-m-d',strtotime("$week_start +6 days"));
    $next_week = date('Y-m-d',strtotime("$week_end +1 days"));
    $last_week = date('Y-m-d',strtotime("$week_start -7 days"));
    */
    //echo $_REQUEST['date'],' ',$_REQUEST['class'].'<br>';
    //$year = date("Y");
    $sql = $pdo->prepare('select * from apply where date between ? and ? and class=?');
    $tmp = $week_start;
    $end=date('Y-m-d',strtotime("$tmp +6 days"));
    $sql->execute([$week_start,$end,$_REQUEST['class']]);
    
    $d = array();
    for($i=0;$i<7;$i++)
    {
        $d[$i] = $tmp;
        $tmp = date('Y-m-d',strtotime("$tmp +1 days"));
    }
    // echo implode($d);
    $pair = array();
    $pname = array();
    $cnt = 0;
    foreach($sql->fetchAll() as $row)
    {
        //echo $row['date'].' '.$row['section'].'<br>';
        $w=date('w',strtotime($row['date']));
        if($w==0)
        {
            $w = 7; 
        }
        
        //$sc = $json_decode($row['section']);
        //$sc=json_decode($row['section']);
        //echo 'Y'.$row['section'].'$<br>';
        //echo gettype($row['section']).'<br>';
        
        $sc = json_decode($row['section'],true);
        //$sc=explode(",",$sc);
        //echo print_r($sc);
        //echo gettype($sc);
        //echo '^'.$sc.'$';
        $rp = array(
            "A" => "0",
            
            "B" => "5",
            
            "C" => "11",
            "D" => "12",
            "E" => "13",
            "F" => "14"
        );
        for($i=0;$i<count($sc);$i++)
        {
            //echo $sc[$i].'<br>';
            /*
            if($sc[$i]=='A')
            {
                $sc[$i] = '0';
            }
            if($sc[$i]=='B')
            {
                $sc[$i] = '5';
            }
            if($sc[$i]=='C')
            {
               $sc[$i] = '11'; 
            }*/
            if($sc[$i]>='5'and $sc[$i]<='9')
            {
                $sc[$i] = $sc[$i] + '1';
            }
            else if(!($sc[$i]>='1'and $sc[$i]<='4'))
            {    
                //echo $sc[$i];
                $sc[$i] = $rp[$sc[$i]];
            }    
            $pair[$cnt] = array($sc[$i],$w);
            $pname[$cnt] = $row['name'];
            $cnt++;
        }
    }
    //echo implode($pair);
    //echo count($pair);

    /*
    for($i=0;$i<count($pair);$i++)
    {
        echo implode($pair[$i]);
        echo $pair[$i][1].'<br>';
    }
    */

    //$ans = $sql->fetchAll();
    //echo count($ans);
    //echo $ans[0]['section'];
    //echo json_encode($sql->fetchAll(), JSON_UNESCAPED_UNICODE);
    $Arr=array('Section','Time','Monday','Tuesday','Wedesday','Thursday','Friday','Saturday','Sunday');

    // 輸出
    echo '<table id="customers">';
    echo '<th>'.$Arr[0].'</th>';
    echo '<th>'.$Arr[1].'</th>';
    //$b = date('Y-m-d',(strtotime("$tmp")+(86400*$i)));
    //echo $b;
    //if($sdefaultDate==$b)
    {    
                    // echo $b;
                    //echo "today";
                    //echo "<th style='border-color:red;border-style:solid;border-width:3px;padding:5px;'>".$Arr[$i]." ".$a."</th>";
                    
    }
    
    //else
        
    for($i=2;$i<9;$i++)
    {
        if($sdd==$wk[$i-2])
        {
            echo "<th style='border-color:red;border-style:solid;border-width:3px;padding:5px;'>".$Arr[$i].' '.$wk[$i-2]."</th>";
        }
        else
            echo '<th>'.$Arr[$i].' '.$wk[$i-2].'</th>';
    }
    $s = ['A','1','2','3','4','B','5','6','7','8','9','C','D','E','F'];
    $t = ['7:00-7:50','8:10-9:00','9:10-10:00','10:10-11:00','11:10-12:00','12:10-13:00','13:10-14:00','14:10-15:00','15:10-16:00','16:10-17:00','17:10-18:00','18:20-19:10','19:15-20:05','20:10-21:00','21:05-21:55'];
    for($i=0;$i<15;$i++) //時段
    {
        
        echo '<tr>';
        echo '<td>'.$s[$i].'</td>';
        echo '<td>'.$t[$i].'</td>';
        for($j=1;$j<=7;$j++)
        {
            echo '<td>';
             $cp = array($i,$j);
             //echo implode($cp); 
             if(in_array($cp,$pair))
             {
                 //echo implode($cp);
                 $key = array_search($cp,$pair);
                 echo $pname[$key];
                 //echo 'find it!';
             }
             /*
             else
             {
                 echo '<>';
             }
             */
             echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}
?>