<?php require 'connect.php';?>
<?php

if(isset($_REQUEST['Name']))
echo '<p>',$_REQUEST['Name'],'</p>';

if(isset($_REQUEST['date']))
echo '<p>',$_REQUEST['date'],'</p>';

if(isset($_REQUEST['section']))
{    
    foreach($_REQUEST['section'] as $item)
    {
        echo '<p>',$item,'</p>';
    }
    $count = count($_REQUEST['section']);
    $section = json_encode($_REQUEST['section']);
}
else
{
    $count = 0;
    echo "節次不得為空";
}    

if(isset($_REQUEST['device'])){
    $device  = json_encode($_REQUEST['device'], JSON_UNESCAPED_UNICODE);
    foreach($_REQUEST['device'] as $item)
    {
        echo '<p>',$item,'</p>';
    }
}
else
{
    $device = json_encode([]);
}    
if(isset($_REQUEST['purpose']))
echo '<p>',$_REQUEST['purpose'],'</p>';

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
// ,$_REQUEST['date'],$section,$_REQUEST['purpose'],$device



//echo 'device: ',$device;
/*
if(is_array($section))
{
    $section = json_encode($_REQUEST['section']);
    $count = count($section);
}
else
{
    $count = 0;
}
*/
// 
// (教室,日期),節次

/*$results = $pdo->query("SELECT * FROM apply")->fetchAll(PDO::FETCH_ASSOC);
if(count($results)) 
{
    // You have records.
}*/
$cf = 0;
$sql2 = $pdo->prepare('select * from apply where class=? and date=?');

$sql2->execute([$_REQUEST['classID'],$_REQUEST['date']]);
foreach($sql2->fetchAll() as $row)
{
    // echo $row['name'].' '.$row['section'].' '.$row['class'].' '.$_REQUEST['date'].'<br>';
    $ar = json_decode($row['section']);
    $ar2 = $_REQUEST['section'];
    foreach($ar as $item)
    {
        if(in_array($item,$ar2))
        {
            $cf = 1;
            echo $row['name'];
            echo $item.' conflict<br>';
        }
    }
}    
//
/*
foreach($pdo->query('select * from apply') as $row) 
{
    echo '<p>';
    echo $row['name'],":";
    echo $row['class'],":";
    echo $row['date'],":";
    echo $row['section'],":";
    echo $row['purpose'],":";
    echo $row['device'],":";
    echo '</p>';
}
*/
$sql = $pdo->prepare('insert into apply (name,class,date,section,purpose,device) value(?,?,?,?,?,?)');
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
    [$_REQUEST['Name'],$_REQUEST['classID'],$_REQUEST['date'],$section,$_REQUEST['purpose'],$device]))
    {
        echo '新增成功';
    }
    else
    {
        echo '新增失敗';
        $error = $sql->errorInfo();
        echo 'check'.$error.'check';
        echo $error[2];
    }
}    
?>