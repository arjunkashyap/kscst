<?php

session_start();

$_SESSION['login'] = 'no';
@header("Location: ../index.php");
/*

include("common.php");
require_once("connect.php");
require_once('includes/class.phpmailer.php');

if(isset($_POST['pr_email']))
{
    if($_POST['pr_email'] != '')
    {
        $pr_email = $_POST['pr_email'];

        if(!(preg_match("/.*\@[a-zA-Z0-9\.]+\.[a-zA-Z0-9\.]+/", $pr_email)))
		{
			 @header("Location: reset_password.php?status=4");
            exit;
		}
        
        $to = $pr_email;
        
        $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
        $rs = mysql_select_db($database,$db) or die("No Database");
        
        $query_l2 = "select password,name,email from details where email='$pr_email'";
        $result_l2 = mysql_query($query_l2);
        $num_rows_l2 = mysql_num_rows($result_l2);
        if($num_rows_l2 > 0)
        {
            $row_l2=mysql_fetch_assoc($result_l2);

            $pwd=$row_l2['password'];
            $name=$row_l2['name'];
            $email=$row_l2['email'];
            $tstamp = time();

            $hash = sha1($pwd.$name.$email.$tstamp);
            
            $query_l3 = "INSERT INTO reset values('$hash','$email','$name','$pwd','$tstamp','')";
            $result_l3 = mysql_query($query_l3);
            
            $from = $supportEmail;
            
            $message = "Dear $name,<br /><br />Use the following link within the next 24 hours to reset your password:<br /><a href=\"http://advaitasharada.sringeri.net/php/reset_password.php?reset=$hash\">http://advaitasharada.sringeri.net/php/reset_password.php?reset=$hash</a><br /><br />Thanks,<br />Team Advaita Sharada";
            $mail = new PHPMailer();
            $mail->isSendmail();
            $mail->isHTML(true);
            $mail->WordWrap = 50;                           
            $mail->IsHTML(true);
            $mail->setFrom($from, 'Advaita Sharada');
            $mail->addReplyTo($from, 'Advaita Sharada');
            $mail->addAddress($to, $name);
            $mail->addBCC($from);
            $mail->Subject = '[Advaita Sharada] Password reset';
            $mail->Body = $message;

            if($mail->send())
            {
                @header("Location: reset_password.php?status=1");
                exit;
            }
            else
            {
                @header("Location: reset_password.php?status=2");
                exit;
            }
        }
        else
        {
            @header("Location: reset_password.php?status=3");
            exit;
        }
    }
}

if(isset($_POST['lemail']))
{
	$lemail = $_POST['lemail'];
	if($lemail == '')
	{
		@header("Location: login.php?error=1");
		exit;
	}
}
else
{
	@header("Location: login.php?error=1");
	exit;
}

if(isset($_POST['lpassword']))
{
	$lpassword = $_POST['lpassword'];
	if($lpassword == '')
	{
		@header("Location: login.php?error=2");
		exit;
	}
}
else
{
	@header("Location: login.php?error=2");
	exit;
}

VerifyCredentials($lemail, $lpassword);
*/

?>
