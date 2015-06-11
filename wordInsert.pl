#!/usr/bin/perl
use POSIX;
$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

print "Word Insertion\n";

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth11=$dbh->prepare("drop table if exists word");
$sth11->execute();
$sth11->finish(); 

$sth11=$dbh->prepare("CREATE TABLE word(snum varchar(5),
projectid varchar(10),
height varchar(10),
width varchar(10),
pagenum varchar(10),
l int(10),
b int(10),
t int(10),
r int(10),
word varchar(50),
wordid int(10) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (wordid))AUTO_INCREMENT=1001  ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish(); 
@series = `ls Volumes_xml`;

for($i1=0;$i1<@series;$i1++)
{
	print $series[$i1];
	chop($series[$i1]);
	$snum = $series[$i1];
	
	@projectid = `ls Volumes_xml/$snum`;
	for($i2 = 0; $i2 < @projectid; $i2++)
	{
		chop($projectid[$i2]);
		$pid = $projectid[$i2];
		@files = `ls Volumes_xml/$snum/$pid`;
		for($i3 = 0; $i3 < @files; $i3++)
		{
			chop($files[$i3]);
			$file = $files[$i3];
			open(IN,"Volumes_xml/$snum/$pid/$file")or die ("cannot open Volumes_xml/$snum/$pid/$file");
			$line = <IN>;
			while($line)
			{
				if($line =~ /<OBJECT data="(.*)" type="(.*)" height="(.*)" width="(.*)" usemap="(.*).djvu" >/)
				{
					$height = $3;
					$width = $4;
					$page = $5;
				}
				elsif($line =~ /<WORD coords="(.*)">(.*)<\/WORD>/)
				{
					$cords = $1;
					$word = $2;
					if(length($word) > 3)
					{
						insert_word($snum,$pid,$height,$width,$page,$cords,$word);
					}
				}
				$line = <IN>;
			}
			close(IN);
		}
	}
}
$dbh->disconnect();

sub insert_word()
{
	my($snum,$pid,$height,$width,$page,$cords,$word) = @_;

	$word =~ s/\\/\//g;
	$word =~ s/'/\\'/g;
	$word =~ s/\"/\\"/g;
	$word =~ s/\n/ /g;
	$word =~ s///g;
	$word =~ s///g;
	$word =~ s///g;
	$word =~ s/^\s+|\s+$//g;
	#~ Base image size is 800X1200
	#~ Also note that coordinate has already been shifted to top left from bottom left (DjVu)
	@sumne = split(/,/, $cords);
	$left = floor($sumne[0] * 800 / $width);
	$top = floor($sumne[2] * 800 / $width);
	$bottom = floor($sumne[1] * 1200 / $height);
	$right = floor($sumne[3] * 1200 / $height);
	
	my($sth1,$sth);

	$sth = $dbh->prepare("insert into word values('$snum','$pid','$height','$width','$page','$left','$bottom','$right','$top','$word','')");
	$sth->execute();
	$sth->finish();
}

