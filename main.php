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
      echo '<td></td>';
      foreach($pdo->query('select croom_id from classroom order by croom_id') as $row)
      {
          echo '<td>'.$row['croom_id'].'</td>';
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

