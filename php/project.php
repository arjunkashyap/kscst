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

<?php
include("connect.php");
require_once("common.php");

if(isset($_GET['snum'])){$snum = $_GET['snum'];}else{$snum = '';}
if(isset($_GET['projectid'])){$projectid = $_GET['projectid'];}else{$projectid = '';}

if(!(isValidSnum($snum) && isValidProjectid($projectid)))
{
	echo "Invalid URL";
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

$query = "select * from project where snum='$snum' and projectid='$projectid' order by poy DESC";

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	$row = $result->fetch_assoc();
    
    $year = $row['year'];
    $title = $row['title'];
    $abstract = $row['abstract'];
    $college = $row['college'];
    $department = $row['department'];
    $members = $row['members'];
    $advisor = $row['advisor'];
    $date = $row['date'];
    $award = $row['award'];
    $poy = $row['poy'];
        
    echo "<div class=\"pDesc\">";
    echo "  <p class=\"largest clr3\"><span class=\"b-right\">".str_pad(intval($snum), 2, "0", STR_PAD_LEFT)."</span></p>";
    echo (file_exists("images/cover/".$snum."/".$projectid.".jpg")) ? "<p class=\"dText\"><img src=\"images/cover/".$snum."/".$projectid.".jpg\" alt=\"Cover ".$snum." ".$projectid."\"/></p>" : "<p class=\"dText\"><span class=\"clr2 yes-ul\">".$year."</span></p>";
    
    if(intval($snum) >= 32)
    {
        echo "  <p class=\"dText clr4\" style=\"line-height: 2em;\">";
        echo "      <span class=\"yes-ul\"><i class=\"fa fa-file-text-o\" title=\"Project of the year\"></i>&nbsp;&nbsp;<a href=\"../Abstract/".$snum."/".$projectid."/index.djvu?djvuopts&amp;page=1&amp;zoom=page\">Abstract</a></span><br />";
        echo "      <span class=\"yes-ul\"><i class=\"fa fa-book\" title=\"Project of the year\"></i>&nbsp;&nbsp;<a href=\"../Volumes/".$snum."/".$projectid."/index.djvu?djvuopts&amp;page=1&amp;zoom=page\">Report</a></span>";
        echo "  </p>";
    }
    
    echo "  <p class=\"dText awards\">";
    echo ($poy == '1') ? "Project of the year<i class=\"fa fa-trophy clr2\" title=\"Project of the year\"></i><br />" : "";
    echo ($award != '') ? "Selected for Seminar<i class=\"fa fa-star-o clr5\" title=\"Selected for Seminar / Exhibition\"></i>" : "";
    echo "  </p>";
    echo "</div>";

    echo "<p class=\"title-bar\">".$title."</p>";
    echo "<div class=\"box card-holder-desc\">";
    echo "  <div class=\"card l-edge-hl1\">";
    echo "      <p class=\"others\">";
    echo "          <span class=\"heading\">Team</span><br /><br />";
    
    $team = preg_split("/;/", $members);
    foreach($team as $tmember)
    {
        $tmdetails = preg_split("/:/", $tmember);
        echo "<span class=\"student-span\">".$tmdetails[1]."</span><br />";
    }

    echo "      </p>";
    echo "  </div>";
    echo "  <div class=\"card  l-edge-hl3\">";
    echo "      <p class=\"others\">";
    echo "          <span class=\"heading\">Advisor</span><br /><br />";

    $advisors = preg_split("/;/", $advisor);
    $isFirst = 1;
    foreach($advisors as $guide)
    {
        echo ($isFirst == 0) ? "<br />" : "";
        $guideDetails = preg_split("/:/", $guide);
        echo "<span class=\"guide-span\">".$guideDetails[2]."</span>";
        echo ($guideDetails[1] != '') ? "<span class=\"guide-span tinier gapLeft\">".$guideDetails[1]."</span>" : "";
        echo ($guideDetails[0] != '') ? "<br /><span class=\"guide-span tiny\">(".$guideDetails[0].")</span><br />" : "";
        $isFirst = 0;
    }
    
    echo "      </p>";
    echo "  </div>";
    echo "  <div class=\"card l-edge-hl1\">";
    echo "      <p class=\"others\">";
    echo "          <span class=\"heading\">Dept. / College</span><br /><br />";
    echo "          <span class=\"dept-span\">Dept. of ".$department.",</span><br />";
    echo "          <span class=\"college-span\">".$college."</span><br />";
    echo "      </p>";
    echo "  </div>";
    echo "</div>";
}
else
{
	echo "No data in the database";
}

if($result){$result->free();}
$db->close();

?>
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
