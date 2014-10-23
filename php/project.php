<?php include("includes/header.php");?>
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
	echo "</div></div>";
    include("includes/footer.php");
	exit(1);
}

$db = @new mysqli('localhost', "$user", "$password", "$database");
if($db->connect_errno > 0)
{
	echo 'Not connected to the database [' . $db->connect_errno . ']';
	echo "</div></div>";
    include("includes/footer.php");
	exit(1);
}

$query = "select * from project where snum='$snum' and projectid='$projectid'";

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
    echo "  <p class=\"largest-text clr3\"><span class=\"b-right\">".str_pad(intval($snum), 2, "0", STR_PAD_LEFT)."</span></p>";
    echo (file_exists("images/cover/".$snum."/".$projectid.".jpg")) ? "<p class=\"dText\"><img src=\"images/cover/".$snum."/".$projectid.".jpg\" alt=\"Cover ".$snum." ".$projectid."\"/></p>" : "<p class=\"dText\"><span class=\"clr2 yes-ul\">".$year."</span></p>";
    
    if(intval($snum) >= DIGITIZEDFROM)
    {
        echo "  <p class=\"dText clr4\" style=\"line-height: 2em;\">";
        echo "      <span class=\"yes-ul\"><i class=\"fa fa-file-text-o\" title=\"Project of the year\"></i>&nbsp;&nbsp;<a href=\"../Abstract/".$snum."/".$projectid."/index.djvu?djvuopts&amp;page=1&amp;zoom=page\">Abstract</a></span><br />";
        echo "      <span class=\"yes-ul\"><i class=\"fa fa-book\" title=\"Project of the year\"></i>&nbsp;&nbsp;<a href=\"viewReport.php?snum=".$snum."&amp;projectid=".$projectid."\">Report</a></span>";
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
<?php include("includes/footer.php");?>
