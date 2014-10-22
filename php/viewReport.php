<?php

session_start();

if(isset($_SESSION['login']))
{
    if($_SESSION['login'] == 1)
    {
        require_once("common.php");

        if(isset($_GET['snum'])){$snum = $_GET['snum'];}else{$snum = '';}
        if(isset($_GET['projectid'])){$projectid = $_GET['projectid'];}else{$projectid = '';}
        if(isset($_GET['page'])){$page = $_GET['page'];}else{$page = '';}
        if(isset($_GET['find'])){$find = $_GET['find'];}else{$find = '';}

        if(!(isValidSnum($snum) && isValidProjectid($projectid)))
        {
            echo "Invalid URL";
            echo "</div></div>";
            include("includes/footer.php");
            exit(1);
        }
        else
        {
            if($page == '')
            {
                @header("Location: ../Volumes/".$snum."/".$projectid."/index.djvu?djvuopts&amp;page=".$page.".djvu&amp;zoom=page&amp;find=".$find."/r");
                exit;
            }
            else
            {
                @header("Location: ../Volumes/".$snum."/".$projectid."/index.djvu?djvuopts&amp;page=1&amp;zoom=page");
                exit;
            }
        }
    }
    else
    {
        @header("Location: login.php");
        exit;
    }
}
else
{
    @header("Location: login.php");
    exit;
}
?>
