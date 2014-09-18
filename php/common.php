<?php

function isValidSnum($snum)
{
	if(is_array($snum)){return false;}
	return preg_match("/^[0-9][0-9][0-9]$/", $snum) ? true : false;
}

function isValidProjectid($projectid)
{
	if(is_array($projectid)){return false;}
	return preg_match("/^([0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9][A-Z])$/", $projectid) ? true : false;
}

function isValidId($book_id)
{
	if(is_array($book_id)){return false;}
	return preg_match("/^[0-9][0-9][0-9]$/", $book_id) ? true : false;
}

function isValidType($type)
{
	if(is_array($type)){return false;}
	return preg_match("/^(rec|mem|occ|fbi|fi|sfs|cas|ess|hpg|spb|sse|tcm|zlg|bul)$/", $type) ? true : false;
}

function isValidCheck($check)
{
	for($i=0;$i<sizeof($check);$i++)
	{
		if(is_array($check[$i])){return false;}
		if(!(preg_match("/^(rec|mem|occ|fbi|fi|sfs|cas|ess|hpg|spb|sse|tcm|zlg|bul)$/", $check[$i])))
		{
			return false;
		}
	}
	return true;
}

function isValidTitle($title)
{
	return is_array($title) ? false : true;
}

function isValidLetter($letter)
{
	if(is_array($letter)){return false;}
	return preg_match("/^([A-Z]|Special)$/", $letter) ? true : false;
}

function isValidVolume($vol)
{
	if(is_array($vol)){return false;}
	return preg_match("/^[0-9][0-9][0-9]$/", $vol) ? true : false;
}

function isValidPart($part)
{
	if(is_array($part)){return false;}
	return preg_match("/^([0-9][0-9]|[0-9][0-9]\-[0-9][0-9])$/", $part) ? true : false;
}

function isValidYear($year)
{
	if(is_array($year)){return false;}
	return preg_match("/^([0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9]\-[0-9][0-9])$/", $year) ? true : false;
}

function isValidFeature($feature)
{
	return is_array($feature) ? false : true;
}

function isValidFeatid($featid)
{
	if(is_array($featid)){return false;}
	return preg_match("/^[0-9][0-9][0-9][0-9][0-9]$/", $featid) ? true : false;
}

function isValidAuthid($authid)
{
	if(is_array($authid)){return false;}
	return preg_match("/^[0-9][0-9][0-9][0-9][0-9]$/", $authid) ? true : false;
}

function isValidAuthor($author)
{
	return is_array($author) ? false : true;
}

function isValidText($text)
{
	return is_array($text) ? false : true;
}

function entityReferenceReplace($term)
{
	if(is_array($term))
	{
		$term = "$term";
	}
	
	$term = preg_replace("/<i>/", "", $term);
	$term = preg_replace("/<\/i>/", "", $term);
	$term = preg_replace("/\;/", "&#59;", $term);
	$term = preg_replace("/</", "&#60;", $term);
	$term = preg_replace("/=/", "&#61;", $term);
	$term = preg_replace("/>/", "&#62;", $term);
	$term = preg_replace("/\(/", "&#40;", $term);
	$term = preg_replace("/\)/", "&#41;", $term);
	$term = preg_replace("/\:/", "&#58;", $term);
	$term = preg_replace("/Drop table|Create table|Alter table|Delete from|Desc table|Show databases|iframe/i", "", $term);
	
	return($term);
}
function inputPreprocess($term)
{
    $term = preg_replace("/[,\-]+/", " ", $term);
    $term = preg_replace("/[\t]+/", " ", $term);
    $term = preg_replace("/[ ]+/", " ", $term);
    $term = preg_replace("/^ +/", "", $term);
    $term = preg_replace("/ +$/", "", $term);
    $term = preg_replace("/  /", " ", $term);
    $term = preg_replace("/  /", " ", $term);
    
    return($term);
}
function createFilter($term, $field)
{
    $termFilter = '';
    $terms = preg_split("/ /", $term);
    for($ic=0;$ic<sizeof($terms);$ic++)
    {
        $termFilter .= "and ".$field." REGEXP '" . $terms[$ic] . "' ";
    }
    $termFilter = preg_replace("/^and /", "", $termFilter);
    return($termFilter);
}
function VerifyCredentials($lemail, $lpassword)
{
	include("connect.php");
	
    $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
    $rs = mysql_select_db($database,$db) or die("No Database");
    mysql_query("set names utf8");

	$salt = "kscst";
	$lpassword = sha1($salt.$lpassword);

	$query_l2 = "select count(*) from userdetails where email='$lemail' and password='$lpassword'";
    
	$result_l2 = mysql_query($query_l2);
	$row_l2=mysql_fetch_assoc($result_l2);
	$num=$row_l2['count(*)'];
	if($num > 0)
	{
		$query_l3 = "update userdetails set visitcount=visitcount+1 where email='$lemail'";
		$result_l3 = mysql_query($query_l3);
		
		$_SESSION['email'] = $lemail;
        $_SESSION['login'] = 1;
        return True;
	}
	else
	{
		return False;
	}
}
/*
isValidTitle, isValidFeature, isValidAuthor, isValidText
*/
?>
