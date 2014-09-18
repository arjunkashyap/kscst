<?php

require_once("common.php");
require_once("connect.php");
require_once('recaptchalib.php');
require_once('includes/class.phpmailer.php');

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
mysql_query("set names utf8");
    
$error_message = array("0"=>"","1"=>"Name can not be left blank<br />","2"=>"E-mail can not be left blank<br />","3"=>"Profession field can not be left blank<br />","4"=>"Password field is empty<br />","5"=>"Confirm-password field is empty<br />","6"=>"Passwords not in confirmation<br />","7"=>"Invalid CAPTCHA! Please try again<br />","8"=>"Invalid e-mail!<br />");

$publickey = "6Lc6KPMSAAAAAJ-yzoW7_KCxyv2bNEZcLImzc7I8";
$privatekey = "6Lc6KPMSAAAAANrIJ99zGx8wxzdUJ6SwQzk1BgXX";

$error_val = 0;

if(isset($_POST['affiliation'])){$affiliation = $_POST['affiliation'];if($affiliation == ''){$error_val = 4;}}else{$affiliation = '';}
if(isset($_POST['profession'])){$profession = $_POST['profession'];if($profession == ''){$error_val = 3;}}else{$profession = '';}
if(isset($_POST['email'])){$email = $_POST['email'];if($email == ''){$error_val = 2;}else{if(!(preg_match("/.*\@[a-zA-Z0-9\.]+\.[a-zA-Z0-9\.]+/", $email))){$error_val = 8;}}}else{$email = '';}
if(isset($_POST['name'])){$name = $_POST['name'];if($name == ''){$error_val = 1;}}else{$name = '';}

if($error_val == 0) {
    if(isset($_POST['cpassword'])){$cpassword = $_POST['cpassword'];if($cpassword == ''){$error_val = 5;}}else{$cpassword = '';}
    if(isset($_POST['password'])){$pwd = $_POST['password'];if($pwd == ''){$error_val = 4;}}else{$pwd = '';}
}
if($error_val == 0) {
    if($pwd != $cpassword){$error_val = 6;}
}

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
                    $error_val = 7;
            }
    }
}

include("includes/header.php");
echo "<div class=\"mainpage\">";
echo "<div id=\"row4\" class=\"container\">";

if(($error_val == 0) && ($isfirst == 0))
{
    $query_reg = "select count(*) from userdetails where email='$email'";
    $result_reg = mysql_query($query_reg);
    $row_reg=mysql_fetch_assoc($result_reg);
    $num=$row_reg['count(*)'];

    if($num == 0)
    {
        $salt = "kscst";
        $pwd = sha1($salt.$pwd);
        
        $tstamp = time();
        $hash = sha1($pwd.$name.$email.$tstamp);
        
        $query = "INSERT INTO userdetails values('$name','$email','$profession','$pwd','$affiliation','','0','1','$hash','$tstamp','')";
        $result = mysql_query($query);

        if($result)
        {
            $_SESSION['email'] = $email;
            $_SESSION['valid'] = 1;
            
            echo "<p>Registration Successful!<br /><br /></p>";
            
            $to = $email;

            $message = "Dear $name,<br /><br />Use the following link within the next 24 hours to confirm your registration:<br /><a href=\"http://spp.kscst.iisc.ernet.in/php/verifyRegistration.php?verify=$hash\">http://spp.kscst.iisc.ernet.in/php/verifyRegistration.php?verify=$hash</a><br /><br />Thanks,<br />Team SPP<br />Karnataka State Council for Science and Technology";

                $mail = new PHPMailer();
                $mail->isSendmail();
                $mail->isHTML(true);
                $mail->WordWrap = 50;
                $mail->setFrom($supportEmail, $supportName);
                $mail->addReplyTo($supportEmail, $supportName);
                $mail->addAddress($to, $name);
                $mail->Subject = '[KSCST SPP] Please verify your email';
                $mail->Body = $message;

            if($mail->send())
            {
                echo "<p>An email has been sent to your address. Use the link given there within the next 24 hours to confirm your registration.<br />If you have not received the email yet, check in your spam folder</p>";
            }
            else
            {
                echo "<p>".$mail->ErrorInfo."<br />Error encountered while registering. Please try again after some time. Sorry for the inconvenience.</p>";
            }
        }
        else
        {
            echo "<p>Error encountered while registering. Please try again after some time. Sorry for the inconvenience.</p>";
        }
    }
    else
    {
        echo "<p>This e-mail id seems to be already registered with us. Try logging in or use another id.</p>";
    }
}
elseif(($error_val > 0) || ($isfirst == 1))
{
    $err_str = $error_message{$error_val};
?>
        <div class="pDesc">
            <p class="largest-text clr3"><span class="b-right">Registration</span></p>
        </div>
        <form method="post" action="register.php">
            <div class="search w-500">
                <div class="otherp">
                    <ul>
                         <li>
                            <p class="clr5 required_notification"><?php echo $err_str; ?></p>
                        </li>
                        <li>
                            <label for="name">Name&nbsp;<span class="clr2">*</span></label><br />
                            <input class="rinput" type="text" name="name" value="<?php echo $name;?>"/>
                        </li>
                        <li>
                            <label for="email">Email&nbsp;<span class="clr2">*</span></label><br />
                            <input class="rinput" type="text" name="email" value="<?php echo $email;?>"/>
                        </li>
                        <li>
                            <label for="email">Profession&nbsp;<span class="clr2">*</span></label><br />
                            <input class="rinput" type="text" name="profession" value="<?php echo $profession;?>"/>
                        </li>
                        <li>
                            <label for="info">Affiliation</label><br />
                            <textarea class="rinput tinput" name="affiliation" placeholder="Please tell us about your affiliation and interest in KSCST Student Project Program."><?php echo $affiliation;?></textarea>
                        </li>
                        <li>
                            <label for="password">Password&nbsp;<span class="clr2">*</span></label><br />
                            <input class="rinput" type="password" name="password" />
                        </li>
                        <li>
                            <label for="cpassword">Confirm Password&nbsp;<span class="clr2">*</span></label><br />
                            <input class="rinput" type="password" name="cpassword" />
                        </li>
                        <li>
<?php
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

echo "  </div>";
echo "</div>";
include("includes/footer.php");

?>
