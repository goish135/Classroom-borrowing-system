<?php
$pdo = new PDO('mysql:host=localhost;dbname=borrow;charset=utf8','root','wisdom5678');
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
?>