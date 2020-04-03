<?php require 'connect.php';?>
<style>
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
echo $_REQUEST['date'],' ',$_REQUEST['class'].'<br>';
//$year = date("Y");
$sql = $pdo->prepare('select * from apply where date between ? and ? and class=?');
$tmp = $_REQUEST['date'];
$end=date('Y-m-d',strtotime("$tmp +6 days"));
$sql->execute([$_REQUEST['date'],$end,$_REQUEST['class']]);
$d = array();
for($i=0;$i<7;$i++)
{
    $d[$i] = $tmp;
    $tmp = date('Y-m-d',strtotime("$tmp +1 days"));
}
echo implode($d);
$pair = array();
$cnt = 0;
foreach($sql->fetchAll() as $row)
{
    echo $row['date'].' '.$row['section'].'<br>';
    $w=date('w',strtotime($row['date']));
    if($w==0)
    {
        $w = 7; 
    }
    
    //$sc = $json_decode($row['section']);
    $sc=json_decode($row['section']);
    //echo $sc;
    $rp = array(
        "A" => "0",
        
        "B" => "5",
        
        "C" => "11",
        "D" => "12",
        "E" => "13"
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
            $sc[$i] = $rp[$sc[$i]];
        }    
        $pair[$cnt] = array($sc[$i],$w);
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

// 輸出
echo '<table id="customers">';
for($i=0;$i<15;$i++) //時段
{
    echo '<tr>';
    for($j=1;$j<=7;$j++)
    {
        echo '<td>';
         $cp = array($i,$j);
         //echo implode($cp); 
         if(in_array($cp,$pair))
         {
             echo implode($cp);
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

?>