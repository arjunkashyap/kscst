<?php
	// If nothing is GETed, redirect to search page
	if(empty($_GET['snum']) && empty($_GET['title']) && empty($_GET['department']) && empty($_GET['college']) && empty($_GET['members']) && empty($_GET['advisor']) && empty($_GET['text'])) {
		header('Location: search.php');
		exit(1);
	}
?>
<?php include("includes/header.php");?>
    <div class="mainpage">
        <div id="row4" class="container">

<?php
include("connect.php");
require_once("common.php");

$db = @new mysqli('localhost', "$user", "$password", "$database");
if($db->connect_errno > 0)
{
	echo 'Not connected to the database [' . $db->connect_errno . ']';
	echo "</div></div>";
    include("includes/footer.php");
	exit(1);
}

if(isset($_GET['snum'])){$snum = $_GET['snum'];}else{$snum = '';}
if(isset($_GET['title'])){$title = $_GET['title'];}else{$title = '';}
if(isset($_GET['department'])){$department = $_GET['department'];}else{$department = '';}
if(isset($_GET['college'])){$college = $_GET['college'];}else{$college = '';}
if(isset($_GET['advisor'])){$advisor = $_GET['advisor'];}else{$advisor = '';}
if(isset($_GET['members'])){$members = $_GET['members'];}else{$members = '';}
if(isset($_GET['text'])){$text = $_GET['text'];}else{$text = '';}

$snum = entityReferenceReplace($snum);
$title = entityReferenceReplace($title);
$department = entityReferenceReplace($department);
$college = entityReferenceReplace($college);
$advisor = entityReferenceReplace($advisor);
$members = entityReferenceReplace($members);
$text = entityReferenceReplace($text);


$text2 = $text;
if($snum==''){$snum='.*';}
if($title==''){$title='.*';}
if($department==''){$department='.*';}
if($college==''){$college='.*';}
if($advisor==''){$advisor='.*';}
if($members==''){$members='.*';}

$snum = inputPreprocess($snum);
$title = inputPreprocess($title);
$department = inputPreprocess($department);
$college = inputPreprocess($college);
$advisor = inputPreprocess($advisor);
$members = inputPreprocess($members);
$text = inputPreprocess($text);

$snumFilter = createFilter($snum, "snum");
$titleFilter = createFilter($title, "title");
$departmentFilter = createFilter($department, "department");
$collegeFilter = createFilter($college, "college");
$advisorFilter = createFilter($advisor, "advisor");
$membersFilter = createFilter($members, "members");

if($text=='')
{
	$query="SELECT * FROM
                (SELECT * FROM
                    (SELECT * FROM
                        (SELECT * FROM
                            (SELECT * FROM
                                (SELECT * FROM project WHERE $snumFilter) AS tb1
                            WHERE $titleFilter) AS tb2
                        WHERE $departmentFilter) AS tb3
                    WHERE $collegeFilter) AS tb4
                WHERE $advisorFilter) AS tb5
            WHERE $membersFilter ORDER BY projectid DESC";
}
elseif($text!='')
{
	$text = rtrim($text);
    $textFilter = '';
    $textSearchBox = '';
    $texts = preg_split("/ /", $text);
    for($ic=0;$ic<sizeof($texts);$ic++)
    {
        $textFilter .= "+" . $texts[$ic] . " ";
        $textSearchBox .= "|" . $texts[$ic];
    }
    $textSearchBox = preg_replace("/^\|/", "", $textSearchBox);
	
    $query="SELECT * FROM
                (SELECT * FROM
                    (SELECT * FROM
                        (SELECT * FROM
                            (SELECT * FROM
                                (SELECT * FROM
                                    (SELECT * FROM searchtable WHERE MATCH (text) AGAINST ('$textFilter' IN BOOLEAN MODE)) AS tb1
                                WHERE $snumFilter) AS tb2
                            WHERE $titleFilter) AS tb3
                        WHERE $departmentFilter) AS tb4
                    WHERE $collegeFilter) AS tb5
                WHERE $advisorFilter) AS tb6
            WHERE $membersFilter ORDER BY projectid DESC";
}

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

echo "<div class=\"pDesc\">";
echo "  <p class=\"largest clr3\"><span class=\"b-right\">Results</span></p>";
echo "  <p class=\"dText clr4\" style=\"line-height: 2em;\">";
echo ($num_rows > 0) ? "<span class=\"clr2 yes-ul big\">".$num_rows."</span><br />" : "No Results";
echo "  </p>";
echo "</div>";
    
$id = 0;
$end = 0;

if($num_rows > 0)
{
	echo "<div class=\"box card-holder\">";
	for($i=1;$i<=$num_rows;$i++)
	{
		$row = $result->fetch_assoc();
		
		$snum = $row['snum'];
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
        $projectid = $row['projectid'];

		if($text != '')
        {
            $cur_page = $row['cur_page'];
        }

        $isFirst = 1;
        if ((strcmp($id, $projectid)) != 0)
		{
            if($end == 1)
            {
                echo "</p></div>";
                $end = 0;
            }
            echo "<div class=\"card\" id=\"".$projectid."\">";
            echo (file_exists("images/cover/".$snum."/".$projectid.".jpg")) ? "<img src=\"images/cover/".$snum."/".$projectid.".jpg\" alt=\"Cover ".$snum." ".$projectid."\"/>" : "";
            echo "  <p class=\"title\">".$title."</p>";
            echo "  <div class=\"seriesPop\"><p class=\"series\"><a href=\"series.php?snum=" . $snum . "\" title=\"Series " . intval($snum) . " (" . $year . ")\">".intval($snum)."</a></p></div>";
            echo "  <p class=\"others\">";
            echo "      <span class=\"dept-span clr2\">".$department.",</span><br />";
            echo "      <span class=\"college-span clr2\">".$college."</span><br />";
            echo "  </p>";
            echo "  <div class=\"link\">";
            echo "      <p><span class=\"link-span clr5 yes-ul\"><a href=\"project.php?snum=".$snum."&amp;projectid=".$projectid."\">More</a></span>";
            echo (intval($snum) >= 32) ? " | <span class=\"link-span clr5 yes-ul\"><a href=\"../Abstract/".$snum."/".$projectid."/index.djvu?djvuopts&amp;page=1&amp;zoom=page\">Abstract</a></span> | <span class=\"link-span clr5 yes-ul\"><a href=\"viewReport.php?snum=".$snum."&amp;projectid=".$projectid."\">Report</a></span>" : "";
            echo "      </p>";
            echo "      <p>";
            echo ($poy == '1') ? "<i class=\"fa fa-trophy clr2\" title=\"Project of the year\"></i>" : "";
            echo ($award != '') ? "<i class=\"fa fa-star-o clr5 gapLeft\" title=\"Selected for Seminar / Exhibition\"></i>" : "";
            echo "      </p>";
            echo "  </div>";
            if($text != '')
            {
                $cur_page = $row['cur_page'];
                
                if($isFirst == 1)
                {
                    echo "<p class=\"others\" style=\"max-height: 4em;overflow: hidden;\">";
                    $end = 1;   
                }
                echo (intval($cur_page) != 0) ? "<span class=\"dept-span tiny\"><a href=\"viewReport.php?snum=".$snum."&amp;projectid=".$projectid."&amp;page=".$cur_page."&find=".$textSearchBox."\">".intval($cur_page)."</a> </span> " : "";
            }
            else
            {
                echo "</div>";
            }
            $isFirst = 0;
			$id = $projectid;
        }
        else
        {
            $cur_page = $row['cur_page'];
            echo (intval($cur_page) != 0) ? "<span class=\"dept-span tiny\"><a href=\"viewReport.php?snum=".$snum."&amp;projectid=".$projectid."&amp;page=".$cur_page."&find=".$textSearchBox."\">".intval($cur_page)."</a> </span> " : "";
            $id = $projectid;
        }
	}
    if($end == 1)
    {
        echo "</p></div>";
    }
	echo "</div>";
}

if($result){$result->free();}
$db->close();

?>
        </div>
    </div>
<?php include("includes/footer.php");?>
