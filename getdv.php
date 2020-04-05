<?php require 'connect.php';?>
<?php
$q=$_GET["q"];
// echo $q.'的device列表';
// $id = substr($q,2);
// echo $id;
// $sql = $pdo->prepare('select device_name from facility where device_id=? and status=0');
$sql = $pdo->prepare('select device_name from facility where device_id=?');
$sql->execute([$q]);
$result = "";
foreach($sql->fetchAll() as $row)
{
        $result = $result.'<input type="checkbox" name="device[]" value="'.$row['device_name'].'">';
        $result = $result.$row['device_name']."\t";    
}
echo $result;    
?>