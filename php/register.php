<?php

require_once("common.php");
require_once("connect.php");
require_once('recaptchalib.php');
require_once('includes/class.phpmailer.php');

$error_message = array("0"=>"","1"=>"Name can not be left blank<br />","2"=>"E-mail can not be left blank<br />","3"=>"Profession field can not be left blank<br />","4"=>"Password field is empty<br />","5"=>"Confirm-password filed is empty<br />","6"=>"Passwords not in confirmation<br />","7"=>"Invalid CAPTCHA! Please try again<br />","8"=>"Invalid e-mail!<br />");

$publickey = "6Lc6KPMSAAAAAJ-yzoW7_KCxyv2bNEZcLImzc7I8";
$privatekey = "6Lc6KPMSAAAAANrIJ99zGx8wxzdUJ6SwQzk1BgXX";

$error_val = 0;

if(isset($_POST['message'])){$message = $_POST['message'];if($message == ''){$error_val = 5;}}else{$message = '';}
if(isset($_POST['subject'])){$subject = $_POST['subject'];if($subject == ''){$error_val = 4;}}else{$subject = '';}
if(isset($_POST['type'])){$type = $_POST['type'];if($type == ''){$error_val = 3;}}else{$type = '';}
if(isset($_POST['email'])){$email = $_POST['email'];if($email == ''){$error_val = 2;}else{if(!(preg_match("/.*\@[a-zA-Z0-9\.]+\.[a-zA-Z0-9\.]+/", $email))){$error_val = 7;}}}else{$email = '';}
if(isset($_POST['name'])){$name = $_POST['name'];if($name == ''){$error_val = 1;}}else{$name = '';}
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
                    $error_val = 6;
            }
    }
}

include("includes/header.php");
echo "<div class=\"mainpage\">";
echo "<div id=\"row4\" class=\"container\">";

if(($error_val == 0) && ($isfirst == 0))
{
    $to = $supportEmail;
    
    $mail = new PHPMailer();
    $mail->isSendmail();
    $mail->WordWrap = 50;
    $mail->setFrom($email, $name);
    $mail->addReplyTo($email, $name);
    $mail->addAddress($to, 'Advaita Sharada');
    $mail->Subject = '[' . $type . '] ' . $subject;
    $mail->Body = $message;

    if($mail->send())
    {
        echo "<p class=\"fgentium small clr\">Thank you for giving your feedback. You wil hear from us shortly.<br />Now you will be redirected to the home page.</p>";
    }
    else
    {
        echo "<p class=\"fgentium small clr\">".$mail->ErrorInfo."<br />Error encountered while submitting your feedback. Please try again after some time. Sorry for the inconvenience.</p>";
    }

    echo "  </div>";
    echo "</div>";
    include("includes/footer.php");
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
                            <p class="clr1 required_notification"><?php echo $err_str; ?></p>
                        </li>
                        <li>
                            <label for="name">Name&nbsp;<span class="clr2">*</span></label><br />
                            <input class="rinput" type="text" name="name" />
                        </li>
                        <li>
                            <label for="email">Email&nbsp;<span class="clr2">*</span></label><br />
                            <input class="rinput" type="text" name="email" />
                        </li>
                        <li>
                            <label for="email">Profession&nbsp;<span class="clr2">*</span></label><br />
                            <input class="rinput" type="text" name="profession" />
                        </li>
                        <li>
                            <label for="info">Affiliation</label><br />
                            <textarea class="rinput tinput" name="info" placeholder="Please tell us about your affiliation and interest in KSCST Student Project Program."></textarea>
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
    </div>
</div>

<?php

include("includes/footer.php");
}
?>
