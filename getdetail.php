<?php require 'connect.php';?>
<?php
$q = $_REQUEST['q'];
echo $q.'<br>';
$sql = $pdo->prepare("select date,section from apply where return_ok=(-1) and class=? order by date");
$sql->execute([$q]);

foreach($sql->fetchAll() as $row)
{
    echo $row['date']." ".$row['section']."<br>";
}
?>