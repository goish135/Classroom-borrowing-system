<?php require "connect.php" ?>
<?php
session_start();
unset($_SESSION['staff']);
$sql = $pdo->prepare('select * from user where person_id=? and pw=?');
$sql ->execute([$_REQUEST['login'],$_REQUEST['pw']]);
foreach($sql->fetchAll() as $row)
{
    $_SESSION['staff'] = [
        'id' => $row['person_id'],
        'name' => $row['name'],
        'pw' => $row['pw'],
        'unit_id'=>$row['unit_id'],
        'email'=>$row['email']
        ];
        
}
if(isset($_SESSION['staff']))
{
    echo "Hi,".$_SESSION['staff']['name'].'!<br>';
    echo "單位:".$_SESSION['staff']['unit_id'];
}
else
{
    echo '登入失敗';
}
?>