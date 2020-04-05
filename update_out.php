<?php require "connect.php" ?>
<?php
session_start();
//echo $_REQUEST['pw'];
$sql = $pdo->prepare('update user set pw=? where person_id=?');
if($sql->execute([$_REQUEST['pw'],$_SESSION['staff']['id']]))
{    
    echo "更改成功!";
}
else
{
    echo "更改失敗~";
}    
?>