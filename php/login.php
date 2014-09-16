<?php

require_once("common.php");
require_once("connect.php");
require_once('recaptchalib.php');
require_once('includes/class.phpmailer.php');

$error_message = array("0"=>"","1"=>"E-mail field is empty<br />","2"=>"Password field is empty<br />","3"=>"Invalid email or password.<br />");

$publickey = "6Lc6KPMSAAAAAJ-yzoW7_KCxyv2bNEZcLImzc7I8";
$privatekey = "6Lc6KPMSAAAAANrIJ99zGx8wxzdUJ6SwQzk1BgXX";

$error_val = 0;

if(isset($_POST['lpassword'])){$lpassword = $_POST['lpassword'];if($lpassword == ''){$error_val = 2;}}else{$lpassword = '';}
if(isset($_POST['lemail'])){$lemail = $_POST['lemail'];if($lemail == ''){$error_val = 1;}}else{$lemail = '';}

$resp = null;
$error = null;

$isfirst = 1;

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
            <p class="largest-text clr3"><span class="b-right">Login</span></p>
        </div>
        <form method="post" action="login.php">
            <div class="search w-500">
                <div class="otherp">
                    <ul>
                        <li>
                            <h2 class="clr2 required_notification"><?php echo $err_str;?></h2>
                        </li>
                        <li>
                            <label for="lemail">Email&nbsp;<span class="clr2">*</span></label><br />
                            <input class="rinput" type="text" name="lemail" id="lemail" />
                        </li>
                        <li>
                            <label for="lpassword">Password&nbsp;<span class="clr2">*</span></label><br />
                            <input class="rinput" type="password" name="lpassword" id="lpassword" />
                        </li>
                        <li id="pr_email_show">
                            <label for="pr_email" class="clr2">Enter your email address</label><br />
                            <input class="rinput" type="text" name="pr_email" id="pr_email" />
                        </li>
                        <li id="regForm">
                            <input class="rsubmit" type="submit" name="submit" value="submit"/>
                            <p class="forgotPassword fright clr2"><a href="javascript:void(0);" onclick="$('#lemail').prop('disabled', true);$('#lpassword').prop('disabled', true);$('#regForm h2').hide();$('#pr_email_show').show();">Forgot your password?</a></p>
                            <h4 class="clr2" style="margin-top: 3em;"><a href="register.php">Click here to register, if you are a first time user</a></h2>
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
