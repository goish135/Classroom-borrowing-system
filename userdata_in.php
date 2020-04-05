<?php require "connect.php"?>
<?php
$sql2 = $pdo->prepare('select person_id from user where person_id=?');
$sql2->execute([$_REQUEST['id']]);
if(empty($sql2->fetchAll()))
{
     $sql = $pdo->prepare('insert into user (person_id,name,email,phone,unit_id,pw) values(?,?,?,?,?,?)');
     if($sql->execute([$_REQUEST['id'],$_REQUEST['name'],$_REQUEST['email'],$_REQUEST['phone'],$_REQUEST['unit'],$_REQUEST['pw']]))
     {
        echo '註冊成功';
     }
     else
     {
       echo '註冊失敗';
     }
}
else
{
    echo '此學號已註冊!';
}    


// echo $_REQUEST['id'];
// echo $_REQUEST['name'];
// echo $_REQUEST['email'];
// echo $_REQUEST['phone'];
// echo $_REQUEST['unit'];

?>