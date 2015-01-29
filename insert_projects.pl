#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"kscst.xml") or die "can't open kscst.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth11_aux=$dbh->prepare("DROP TABLE IF EXISTS project");
$sth11_aux->execute();
$sth11_aux->finish(); 

$sth11=$dbh->prepare("CREATE TABLE project(snum varchar(5),
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
projectid varchar(8), primary key(projectid)) ENGINE=MyISAM");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;
$abstract = "";
$poy = "";
while($line)
{
	if($line =~ /<series snum="(.*)" year="(.*)">/)
	{
		$snum = $1;
		$year = $2;
        print $snum . "\n";
	}
	elsif($line =~ /<project id="(.*)" date="(.*)" awards="(.*)" poy="(.*)">/)
	{
		$id = $1;
		$date = $2;
		$awards=$3;
		$poy = $4;
	}
	elsif($line =~ /<college>(.*)<\/college>/)
	{
		$college = $1;
	}
	elsif($line =~ /<dept>(.*)<\/dept>/)
	{
		$dept = $1;
	}
	elsif($line =~ /<title>(.*)<\/title>/)
	{
		$title = $1;
	}	
	elsif($line =~ /<abstract>(.*)<\/abstract>/)
	{
		$abstract = $1;
	}	
	elsif($line =~ /<member usn="(.*)">(.*)<\/member>/)
	{
		$usn = $1;
		$member_name = $2;
		$members = $members . ";".$usn.":".$member_name;
	}
	elsif($line =~ /<advisor details="(.*)" qual="(.*)">(.*)<\/advisor>/)
	{
		$details = $1;
		$qual = $2;
		$advisor_name = $3;
		$advisor = $advisor. ";".$details.":".$qual.":".$advisor_name;
	}
	elsif($line =~ /<\/project>/)
	{
		insert_project($id,$year,$date,$college,$dept,$title,$members,$advisor,$snum,$abstract,$awards,$poy);
		$members = "";
		$advisor = "";
		$id = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_project()
{
	my($id,$year,$date,$college,$dept,$title,$members,$advisor,$snum,$abstract,$awards,$poy) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	$college =~ s/'/\\'/g;
	$advisor =~ s/'/\\'/g;
	$members =~ s/'/\\'/g;
	$advisor =~ s/^;//;
	$members =~ s/^;//;
	$awards  =~ s/^;//;
	#~ $poy     =~ s/^;//;
	
	$sth1=$dbh->prepare("insert into project values('$snum','$year','$title','$abstract','$college','$dept','$members','$advisor','$date','$awards','$poy','$id')");
	$sth1->execute();
	$sth1->finish();
}
