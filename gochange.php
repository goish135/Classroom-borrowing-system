<?php require 'connect.php';?>
<?php
session_start();
date_default_timezone_set('Asia/Taipei');
// get the q parameter from URL
$q = $_REQUEST["q"];
$q2 = $_REQUEST["q2"];

$hint = "";
$sql = $pdo->prepare('update apply set return_ok=return_ok*(-1) where ID=?');
$sql->execute([$q]);


//echo $_SESSION['staff']['unit_id'],$_SESSION['staff']['name'];
//echo $q2;
// echo $_SESSION['staff']['name'];

if($q2==1) // -> -1 : 按錯情況
{
    //echo "未還";
    $sql3 = $pdo->prepare('update apply set return_time=?  where ID=?');
    $date  = date("0000/00/00 00:00:00");
    $sql3->execute([$date,$q]);
    
    $sql4 = $pdo->prepare('update apply set unit=? , uperson=? where ID=?');
    $sql4->execute(["","",$q]);    
    //$error = $sql4->errorInfo();
    //print_r($error[2]); 
}
else
{
    
    $sql2 =  $pdo->prepare('update apply set return_time=? where ID=?');

    $date  = date("Y/m/d h:i:sa");

    $sql2->execute([$date,$q]);
    
    $sql4 = $pdo->prepare('update apply set unit=? , uperson=? where ID=?');
    $sql4->execute([$_SESSION['staff']['unit_id'],$_SESSION['staff']['name'],$q]);
    
    //$error = $sql4->errorInfo();
    //print_r($error);
    //print_r($error[2]);     
}

    
//echo $q2;
/*
// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
*/
$hint=$hint.'<table id="status">';
$hint=$hint.'<tr><th>歸還狀態</th><th>借用人</th><th>班級</th><th>節次</th><th>目的</th><th>設備</th><th>借用日期</th><th>歸還時間</th><th>負責單位</th><th>負責人</th></tr>';
foreach($pdo->query('select * from apply order by return_ok') as $row)
{
    if($row['return_ok']==-1)
    {    
        $hint =$hint.'<tr bgcolor="#eee">';
        $hint =$hint.'<td><input type="checkbox" value="'.$row['ID'].'" onclick="myFunction(this.value,-1)"></td>';
        $hint =$hint.'<td>'.$row['name'].'</td>';
        $hint =$hint.'<td>'.$row['class'].'</td>';
        $hint =$hint.'<td>'.$row['section'].'</td>';
        $hint =$hint.'<td>'.$row['purpose'].'</td>';
        $hint =$hint.'<td>'.$row['device'].'</td>';
        $hint =$hint.'<td>'.$row['date'].'</td>';
        $hint =$hint.'<td>'.$row['return_time'].'</td>';
        $hint =$hint.'<td>'.$row['unit'].'</td>';
        $hint =$hint.'<td>'.$row['uperson'].'</td>';
        
        $hint =$hint.'<tr>';
    }
    else
    {
        $hint = $hint.'<tr bgcolor="#ddd">';
        $hint = $hint.'<td><input type="checkbox" value="'.$row['ID'].'" onclick="myFunction(this.value,1)" checked></td>';
        $hint =$hint.'<td>'.$row['name'].'</td>';
        $hint =$hint.'<td>'.$row['class'].'</td>';
        $hint =$hint.'<td>'.$row['section'].'</td>';
        $hint =$hint.'<td>'.$row['purpose'].'</td>';
        $hint =$hint.'<td>'.$row['device'].'</td>';
        $hint =$hint.'<td>'.$row['date'].'</td>';
        $hint =$hint.'<td>'.$row['return_time'].'</td>';
        $hint =$hint.'<td>'.$row['unit'].'</td>';
        $hint =$hint.'<td>'.$row['uperson'].'</td>';        
        $hint =$hint.'</tr>';
    }        
}
$hint=$hint.'</table>';
echo $hint;
?>