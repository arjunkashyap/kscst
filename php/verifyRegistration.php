<?php

require_once("common.php");
require_once("connect.php");
require_once('recaptchalib.php');
require_once('includes/class.phpmailer.php');

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
mysql_query("set names utf8");

include("includes/header.php");
echo "<div class=\"mainpage\">";
echo "<div id=\"row4\" class=\"container\">";

if(isset($_GET['verify']))
{
    $verify = $_GET['verify'];
    
    if(hasVerifyExpired($verify)) {
       echo "<p>Registration confirmation link has expired.<br /><br /><a href=\"registration.php\">Click here try to again.</a></p>";
    }
    else {
        $query_aux = "select * from userdetails where hash='$verify'";
        $result_aux = mysql_query($query_aux);        
        $num_rows_aux = mysql_num_rows($result_aux);
        
        if($num_rows_aux > 0)
        {
            $row_aux=mysql_fetch_assoc($result_aux);

            $email=$row_aux['email'];
            $name=$row_aux['name'];        
            $pwd=$row_aux['password'];        
        
            $query = "UPDATE userdetails set isverified='1' where email='$email' and name='$name' and hash='$verify'";
            $result = mysql_query($query);
            
            if(mysql_affected_rows() == 1)
            {
                echo "<p>Registration confirmed.<br /><br /><a href=\"login.php\">Click here to login.</a></p>";
                $from = $supportEmail;
                
                $message = "Dear $name,<br /><br />Your registration has been confirmed.<br /><br />Thanks,<br />Team SPP<br />Karnataka State Council for Science and Technology";
                $mail = new PHPMailer();
                $mail->isSendmail();
                $mail->isHTML(true);
                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->setFrom($from, $supportName);
                $mail->addReplyTo($from, $supportName);
                $mail->addAddress($email, $name);
                $mail->addBCC($from);
                $mail->Subject = '[KSCST] Registration confirmed';
                $mail->Body = $message;

                $mail->send();
            }
            else
            {
                echo "<p>Error encountered in confirming registration.<br /><br /><a href=\"registration.php\">Click here try to again.</a></p>";
            }
        }
        else
        {
            echo "<p>Registration confirmation link has expired.<br /><br /><a href=\"registration.php\">Click here try to again.</a></p>";
        }
    }
}

echo "  </div>";
echo "</div>";
include("includes/footer.php");

?>
