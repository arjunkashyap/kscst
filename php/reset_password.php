<?php

include("includes/header.php");
echo "<div class=\"mainpage\">";
echo "<div id=\"row4\" class=\"container\">";

require_once("common.php");
require_once("connect.php");
require_once('recaptchalib.php');
require_once('includes/class.phpmailer.php');
$publickey = "6Lc6KPMSAAAAAJ-yzoW7_KCxyv2bNEZcLImzc7I8";
$privatekey = "6Lc6KPMSAAAAANrIJ99zGx8wxzdUJ6SwQzk1BgXX";

if(isset($_GET['status']))
{
    $status_message = array("1"=>"An email has been sent to your address. Use the link given there within the next 24 hours to reset your password.<br />If you have not received the email yet, check in your spam folder.","2"=>"Error encountered in resetting the password.<br /><br /><a href=\"login.php\">Click here to try again.</a>","3"=>"It seems the email entered is not registered with us!<br /><br /><a href=\"register.php\">Click here to register yourself.</a>","4"=>"Invalid email!<br /><br /><a href=\"login.php\">Click here to try again.</a>");
    $status_str = "&nbsp;";
    $status_str = $status_message{$_GET['status']};
    echo "<p>$status_str</p>";
}
elseif(isset($_GET['reset']))
{
    $reset = $_GET['reset'];
    
    $error_val = 0;
    $error_message = array("0"=>"","1"=>"New Password field empty<br />","2"=>"Confirm new password field empty<br />","3"=>"Passwords not in confirmation<br />","4"=>"Invalid CAPTCHA! Please try again<br />","5"=>"New Password field empty<br />");
    if(isset($_POST['cpassword'])){$cpwd = $_POST['cpassword'];if($cpwd == ''){$error_val = 4;}}else{$cpwd = '';}
    if(isset($_POST['password'])){$pwd = $_POST['password'];if($pwd == ''){$error_val = 5;}}else{$pwd = '';}
    if($pwd != $cpwd){$error_val = 3;}
    
    $resp = null;
    $error = null;
    
    $isfirst = 1;
    if($error_val == 0)
    {
    
        if (isset($_POST["recaptcha_response_field"])) {
                $isfirst = 0;
                $resp = recaptcha_check_answer ($privatekey,
                                                $_SERVER["REMOTE_ADDR"],
                                                $_POST["recaptcha_challenge_field"],
                                                $_POST["recaptcha_response_field"]);
                if ($resp->is_valid) {
                        
                } else {
                        $error_val = 4;
                }
        }
    }
    
    if(hasResetExpired($reset))
    {
       echo "<p class=\"fgentium small clr\">Password reset link has expired.<br /><br /><a href=\"login.php\">Click here try to again.</a></p>";
    }
    elseif(($error_val == 0) && ($isfirst == 0))
    {
        $salt = "kscst";
        $npwd = sha1($salt.$pwd);
        
        $query_aux = "select * from reset where hash='$reset'";
        $result_aux = mysql_query($query_aux);        
        $num_rows_aux = mysql_num_rows($result_aux);
        
        if($num_rows_aux > 0)
        {
            $row_aux=mysql_fetch_assoc($result_aux);

            $email=$row_aux['email'];
            $name=$row_aux['name'];        
            $pwd=$row_aux['password'];        
        
            $query = "UPDATE userdetails set password='$npwd' where email='$email' and name='$name'";
            $result = mysql_query($query);
            
            if((mysql_affected_rows() == 1) || ($npwd == $pwd))
            {
                $query = "DELETE from reset where hash='$reset' and email='$email' and name='$name'";
                $result = mysql_query($query);
            
                echo "<p class=\"fgentium small clr\">Password sucessfully reset.<br /><br /><a href=\"login.php\">Click here to login.</a></p>";
                $from = $supportEmail;
                
                $message = "Dear $name,<br /><br />Your password has been sucessfully reset.<br /><br />Thanks,<br />Team SPP<br />Karnataka State Council for Science and Technology";
                $mail = new PHPMailer();
                $mail->isSendmail();
                $mail->isHTML(true);
                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->setFrom($from, $supportName);
                $mail->addReplyTo($from, $supportName);
                $mail->addAddress($email, $name);
                $mail->addBCC($from);
                $mail->Subject = '[KSCST SPP] Password reset';
                $mail->Body = $message;

                $mail->send();
            }
            else
            {
                echo "<p class=\"fgentium small clr\">Error encountered in resetting the password.<br /><br /><a href=\"login.php\">Click here try to again.</a></p>";
            }
        }
        else
        {
            echo "<p class=\"fgentium small clr\">Password reset link has expired.<br /><br /><a href=\"login.php\">Click here try to again.</a></p>";
        }
    }
    else
    {
        $err_str = $error_message{$error_val};
?>

    <div class="pDesc">
        <p class="largest-text clr3"><span class="b-right">Password Reset</span></p>
    </div>
<?php
    echo "<form method=\"post\" action=\"reset_password.php?reset=$reset\">";
?>
        <div class="search w-500">
            <div class="otherp">
                <ul>
                    <li>
                        <p class="clr5 required_notification"><?php echo $err_str;?></p>
                    </li>
                   <li>
						<label for="password">New password&nbsp;<span class="clr2">*</span></label><br />
						<input class="rinput" type="password" name="password" />
					</li>
					<li>
						<label for="cpassword">Confirm new password&nbsp;<span class="clr2">*</span></label><br />
						<input class="rinput" type="password" name="cpassword" />
					</li>
					<li>
<?php
require_once('recaptchalib.php');
$publickey = "6Lc6KPMSAAAAAJ-yzoW7_KCxyv2bNEZcLImzc7I8";
$privatekey = "6Lc6KPMSAAAAANrIJ99zGx8wxzdUJ6SwQzk1BgXX";
echo recaptcha_get_html($publickey);
?>
					</li>
                    <li>
						<input class="rsubmit" type="submit" name="submit" value="submit"/>
					</li>
                </ul>
            </div>
        </div>
    </form>

<?php
    }
}

echo "  </div>";
echo "</div>";
include("includes/footer.php");

?>
