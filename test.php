<?php require 'connect.php'?>

<?php
$sec = array("A"=>"07:50","1"=>"09:00","2"=>"10:00","3"=>"11:00","4"=>"12:00","B"=>"13:00",
"5"=>"14:00","6"=>"15:00","7"=>"16:00","8"=>"17:00","9"=>"18:00","C"=>"19:10","D"=>"20:05","E"=>"21:00","F"=>"21:55");

date_default_timezone_set("Asia/Taipei");
//echo date("Y-m-d H:i:s");

$y = date("Y");
$m = date("m");
$d = date("d");

$h = date("H");
$mm = date("i");
$s = date("s");

echo $y." ".$m." ".$d." ".$h.":".$mm.":".$s;
$flag = 0;
foreach($pdo->query("select * from apply where return_ok =(-1)") as $row)
{
    //echo $row['date'];
    
    // 2020 / 4 / 24 //
    $ar = explode("-",$row['date']);
    //echo $ar[0]." ".$ar[1]." ".$ar[2]."<br>";
    if($ar[0]==$y && $ar[1]==$m && $ar[2]==$d)
    {
        echo "the same";
        echo $row['name'];
    
        //$yy = substr($row['date'],0,4);
        //$mm = substr($row['date'],5,7);
        //$dd = substr($row['date'],8,10);
    
        // echo "<b>".$yy." ".$mm." ".$dd."</b><br>";
        //echo $yy."<br>";
        // echo $mm."<br>";
        // echo $dd."<br>";
    
    
    
        //echo $row['section'];
        $tmp = gettype($row['section']); // string //
        
        $r = json_decode($row['section']);
        //echo gettype($r);
    
        $last = end($r);
        
        echo $h." ".$mm." ".$s;
        echo $sec[$last];
        $b = explode(":",$sec[$last]);
        echo $b[0]."    ".$b[1];
        
        if((int)$h>(int)$b[0])
        {
            echo '超時';
            $flag = 1;
            $to_email = $row['email'];
            $subject = "討債信件";
            $body = "該還教室囉~~~headers?";
            $headers = "From: nsysu cs borrowing sytem";
     
            if (mail($to_email, $subject, $body, $headers)) {
                echo "Email successfully sent to $to_email...";
            } else {
                echo "Email sending failed...";    
            }
        }
        else if((int)$h==(int)$b[0])
        {
            if((int)$mm>(int)$b[0])
            {
                echo '寄信啦';
                $flag = 1;
                $to_email = $row['email'];
                $subject = "提醒";
                $body = "該還教室囉~~~";
                $headers = "From: 中山教室借用系統";
     
                if (mail($to_email, $subject, $body, $headers)) {
                 echo "Email successfully sent to $to_email...";
                } else {
                 echo "Email sending failed...";    
                }                
            }
            else
            {
                echo '剩幾分鐘';
            }
        }
        else
        {
            echo 'safe';
        }
        // echo end($r);
    
        //echo '<br>';
    }
}
 
//echo $now;
//echo year($now);
/*
echo $now['month'];
echo $now['mday'];
echo $now['h'];
echo $now['i'];
echo $now['sa'];
*/


/*
if($flag)
{    
    $to_email = "sundar1125@g-mail.nsysu.edu.tw";
    $subject = "Simple Email Test via PHP";
    $body = "Hi,nn This is test email send by PHP Script";
    $headers = "From: sender\'s email";
     
    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";    
    }
}*/


?>