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

if(!(isValidSnum($snum)))
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

$query_aux = "select distinct year from project where snum='$snum'";
$result_aux = $db->query($query_aux);
$row_aux = $result_aux->fetch_assoc();
$year = $row_aux['year'];

echo "<div class=\"pDesc\">
        <p class=\"largest clr3\"><span class=\"b-right\">".str_pad(intval($snum), 2, "0", STR_PAD_LEFT)."</span></p>
        <p class=\"dText clr4\" style=\"line-height: 2em;\">
            <span class=\"clr5 yes-ul\">".$year."</span><br />
            <span class=\"clr2 yes-ul\">Projects</span>
        </p>
    </div>";

$query = "select * from project where snum='$snum' order by poy DESC";

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	echo "<div class=\"box card-holder\">";
	for($i=1;$i<=$num_rows;$i++)
	{
		$row = $result->fetch_assoc();
		
		$title = $row['title'];
        $abstract = $row['abstract'];
        $college = $row['college'];
        $department = $row['department'];
        $members = $row['members'];
        $advisor = $row['advisor'];
        $date = $row['date'];
        $award = $row['award'];
        $poy = $row['poy'];
        $projectid = $row['projectid'];
		
        echo "<div class=\"card\" id=\"".$projectid."\">";
        echo (file_exists("images/cover/".$snum."/".$projectid.".jpg")) ? "<img src=\"images/cover/".$snum."/".$projectid.".jpg\" alt=\"Cover ".$snum." ".$projectid."\"/>" : "";
        echo "  <p class=\"title\">".$title."</p>";
        echo "  <p class=\"others\">";
        echo "      <span class=\"dept-span clr2\">".$department.",</span><br />";
        echo "      <span class=\"college-span clr2\">".$college."</span><br />";
        echo "  </p>";
        echo "  <div class=\"link\">";
        echo "      <p><span class=\"link-span clr5 yes-ul\"><a href=\"project.php?snum=".$snum."&amp;projectid=".$projectid."\">More</a></span>";
        echo (intval($snum) >= 32) ? " | <span class=\"link-span clr5 yes-ul\"><a href=\"../Abstract/".$snum."/".$projectid."/index.djvu?djvuopts&amp;page=1&amp;zoom=page\">Abstract</a></span> | <span class=\"link-span clr5 yes-ul\"><a href=\"../Volumes/".$snum."/".$projectid."/index.djvu?djvuopts&amp;page=1&amp;zoom=page\">Report</a></span>" : "";
        echo "      </p>";
        echo "      <p>";
        echo ($poy == '1') ? "<i class=\"fa fa-trophy clr2\" title=\"Project of the year\"></i>" : "";
        echo ($award != '') ? "<i class=\"fa fa-star-o clr5 gapLeft\" title=\"Selected for Seminar / Exhibition\"></i>" : "";
        echo "      </p>";
        echo "  </div>";
        echo "</div>";
	}
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
