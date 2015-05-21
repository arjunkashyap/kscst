#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth11_aux=$dbh->prepare("DROP TABLE IF EXISTS searchtable");
$sth11_aux->execute();
$sth11_aux->finish(); 

$sth11=$dbh->prepare("CREATE TABLE searchtable(snum varchar(5),
year varchar(20),
title varchar(500),
abstract varchar(100),
college varchar(300), 
department varchar(300), 
members varchar(500), 
advisor varchar(300), 	
date DATE, 
award varchar(10),
poy varchar(10),
type varchar(10),
projectid varchar(8),
cur_page varchar(5),
text varchar(5000)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci");

$sth11->execute();
$sth11->finish();

$sth1=$dbh->prepare("select * from project where snum >= '032' order by projectid");
$sth1->execute();

while($ref=$sth1->fetchrow_hashref())
{
	$snum = $ref->{'snum'};
	$year = $ref->{'year'};
	$title = $ref->{'title'};
	$abstract = $ref->{'abstract'};
	$college = $ref->{'college'};
	$department = $ref->{'department'};
	$members = $ref->{'members'};
	$advisor = $ref->{'advisor'};
	$date = $ref->{'date'};
	$award = $ref->{'award'};
	$poy = $ref->{'poy'};
	$type = $ref->{'type'};
	$projectid = $ref->{'projectid'};	
	
	$title =~ s/'/\\'/g;
	$members =~ s/'/\\'/g;
	$advisor =~ s/'/\\'/g;
	$college =~ s/'/\\'/g;
	
	print $projectid."\n";
	
	$sth2=$dbh->prepare("select * from ocr where snum='$snum' and projectid='$projectid'");
	$sth2->execute();
	
	while($ref2=$sth2->fetchrow_hashref())
	{
		$text = $ref2->{'text'};
		$cur_page = $ref2->{'cur_page'};
		
		$sth4=$dbh->prepare("insert into searchtable values('$snum','$year','$title','$abstract','$college','$department','$members','$advisor','$date','$award','$poy','$type','$projectid','$cur_page','$text')");
		$text = '';
		$sth4->execute();
		$sth4->finish();
	}
	$sth2->finish();
}

$sth1->finish();
$dbh->disconnect();
