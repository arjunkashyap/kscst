<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Home | KSCST | Student Project Program</title>
    <meta name="description" content="Student Project Programme, KSCST">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="style/normalize.css" media="all" rel="stylesheet" type="text/css" />
    <link href="style/indexstyle.css" media="all" rel="stylesheet" type="text/css" />
    <link href="style/font-awesome-4.1.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
</head>

<body>
    <header class="app-bar">
        <div class="htitle short"><img src="images/logo.png" alt="KSCST Logo"/> <p>KSCST</p></div>
        <div class="htitle long"><img src="images/logo.png" alt="KSCST Logo"/> <p>Karnataka State Council for Science and Technology</p></div>
        <nav class="navdrawer-container">
            <ul>
                <li><span class="typ-a"><a href="../index.php">Home</a></span></li>
                <li><span class="typ-a"><a href="about.php">About SPP</a></span></li>
                <li><span class="typ-a"><a href="search.php">Search</a></span></li>
                <?php session_start(); echo ($_SESSION['login'] == 'yes') ? "<li><span class=\"typ-a\"><a href=\"logout.php\">Logout</a></span></li>" : "<li><span class=\"typ-a\"><a href=\"login.php\">Login</a></span></li>"?>
            </ul>
        </nav>
        <button class="menu">☰</button>        
    </header>    
    <div class="mainpage">
        <div id="row4" class="container">
            <div class="pDesc">
                <p class="largest-text clr3"><span class="b-right">Login</span></p>
            </div>
<?php
include("connect.php");
require_once("common.php");

$db = @new mysqli('localhost', "$user", "$password", "$database");
if($db->connect_errno > 0)
{
	echo 'Not connected to the database [' . $db->connect_errno . ']';
	echo "</div></div>
        <footer>
            <p>&copy;2014 All rights reserved</p>
            <p>
                            ಕರ್ನಾಟಕ ರಾಜ್ಯ ವಿಜ್ಞಾನ ಮತ್ತು ತಂತ್ರವಿದ್ಯಾ ಮಂಡಳಿ<br />            
                Karnataka State Council for<br />Science and Technology<br />
                Indian Institute of Science Campus<br />
                Bangalore - 560 012            
            </p>
            <p>
                <i class=\"fa fa-phone\" title=\"Phone\"></i> +91 80 2334 1652/8848/8849<br />
                <i class=\"fa fa-phone\" title=\"Fax\"></i> +91 80 2334 8840<br />
                <i class=\"fa fa-envelope-o\" title=\"Email\"></i> office@kscst.org.in<br />
                <i class=\"fa fa-envelope-o\" title=\"Email\"></i> office@kscst.iisc.ernet.in
            </p>
        </footer>
    </body>
    </html>";
	exit(1);
}

unset($_POST['lemail']);
unset($_POST['lpassword']);

$error_message = array("1"=>"E-mail field is empty<br />","2"=>"Password field is empty<br />","3"=>"Invalid email or password.<br />");
$error_message_registration = array("4"=>"Name field is empty<br />","5"=>"E-mail field is empty<br />","6"=>"Please fill in information about yourself<br />","7"=>"Password field is empty<br />","8"=>"Confirm-password filed is empty<br />","9"=>"Passwords not in confirmation<br />","10"=>"E-mail address invalid<br />","11"=>"Invalid CAPTCHA! Please try again<br />");

$err_str = "&nbsp;";
$err_str_registration = "&nbsp;";
if(isset($_GET['error']))
{
	if($_GET['error'] < 4)
	{
		$err_str = $error_message{$_GET['error']};
	}
	else
	{
		$err_str_registration = $error_message_registration{$_GET['error']};
	}
}
else
{
	$err_str = "&nbsp;";
	$err_str_registration = "&nbsp;";
}

?>
           <form method="post" action="login_confirm.php">
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
                                <h4 class="clr2" style="margin-top: 1em;">If you are a first time user, then we request you to register.</h2>
                            </li>
                        </ul>
                    </div>
                </div>
                </form>
                <form method="post" action="register.php">
                <div class="search w-500">
                    <div class="otherp">
                        <ul>
                             <li>
                                <p class="clr1 required_notification"><?php echo $err_str_registration; ?></p>
                                <p class="big clr1">Registration</p>
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
        </div>
    </div>
    <footer>
        <p>&copy;2014 All rights reserved</p>
        <p>
                        ಕರ್ನಾಟಕ ರಾಜ್ಯ ವಿಜ್ಞಾನ ಮತ್ತು ತಂತ್ರವಿದ್ಯಾ ಮಂಡಳಿ<br />            
            Karnataka State Council for<br />Science and Technology<br />
            Indian Institute of Science Campus<br />
            Bangalore - 560 012            
        </p>
        <p>
            <i class="fa fa-phone" title="Phone"></i> +91 80 2334 1652/8848/8849<br />
            <i class="fa fa-phone" title="Fax"></i> +91 80 2334 8840<br />
            <i class="fa fa-envelope-o" title="Email"></i> office@kscst.org.in<br />
            <i class="fa fa-envelope-o" title="Email"></i> office@kscst.iisc.ernet.in
        </p>
    </footer>
</body>
</html>
