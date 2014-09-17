<?php

include("includes/header.php");
echo "<div class=\"mainpage\">";
echo "<div id=\"row4\" class=\"container\">";

require_once("common.php");
require_once("connect.php");
require_once('recaptchalib.php');
require_once('includes/class.phpmailer.php');

$error_message = array("0"=>"","1"=>"E-mail field is empty<br />","2"=>"Password field is empty<br />","3"=>"Invalid email or password.<br />");

$error_val = 0;
$isfirst = 1;

if(isset($_POST['lpassword'])){$lpassword = $_POST['lpassword'];if($lpassword == ''){$error_val = 2;}}else{$lpassword = '';}
if(isset($_POST['lemail'])){$lemail = $_POST['lemail'];if($lemail == ''){$error_val = 1;}}else{$lemail = '';}

if(($lemail != '') && ($lpassword != '') && ($error_val == 0)) {
    if(VerifyCredentials($lemail, $lpassword)) {
        $isfirst = 0;
    }
    else {
        $error_val = 3;
    }
}

if(($error_val == 0) && ($isfirst == 0))
{
    if(isset($_SESSION['refererUrl'])){
        @header("Location: " . $_SESSION['refererUrl']);
    }
    else{
        @header("Location: ../index.php");
    }
    exit;
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

<?php
}
echo "  </div>";
echo "</div>";
include("includes/footer.php");

?>
