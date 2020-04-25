<?php require 'connect.php';?>
<?php


       $q = $_REQUEST['keyword'];
       //echo $q;
       if(strlen($q)==0)
       {
           //echo 'all';
           echo '<table id="customers">';
           //echo '<tr><td colspan="6" align="center">教室或設備的借用情形</td></tr>';
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
           //echo 'test';
           $sql = $pdo->prepare('select * from classroom where croom_id like ?');
           $sql->execute(['%'.$q.'%']);
           //echo $_REQUEST['keyword'];
           
           echo '<table id="customers">';
           //echo '<tr><td colspan="6" align="center">教室或設備的借用情形</td></tr>';
           echo '<tr><th>教室編號</th><th>教室名稱</th><th>教室位置</th><th>教室容量</th><th>借用情況</th><th>設備狀態</th></tr>';
         //echo print_r($sql->fetchAll());
        
        foreach($sql->fetchAll() as $row)
        {
            //echo $row['croom_id'];
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
 
?>       