#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth11_aux=$dbh->prepare("DROP TABLE IF EXISTS ocr");
$sth11_aux->execute();
$sth11_aux->finish(); 

$sth11=$dbh->prepare("CREATE TABLE ocr(snum varchar(10),
projectid varchar(10),
cur_page varchar(10),
text varchar(5000)) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci");

$sth11->execute();
$sth11->finish(); 
@snums = `ls Text`;

for($i1=0;$i1<@snums;$i1++)
{
	print $snums[$i1];
	chop($snums[$i1]);
	
	@projectids = `ls Text/$snums[$i1]/`;

	for($i2=0;$i2<@projectids;$i2++)
	{
		chop($projectids[$i2]);

		@files = `ls Text/$snums[$i1]/$projectids[$i2]/`;
		
		for($i3=0;$i3<@files;$i3++)
		{
			chop($files[$i3]);
			if($files[$i3] =~ /\.txt/)
			{
				$vol = $snums[$i1];
				$iss = $projectids[$i2];
				$cur_page = $files[$i3];
				
				open(DATA,"Text/$vol/$iss/$cur_page")or die ("cannot open Text/$vol/$iss/$cur_page");
				
				$cur_page =~ s/\.txt//g;
				
				$line=<DATA>;
				$line =~ s/'/\\'/g;
				
				$sth1=$dbh->prepare("insert into ocr values ('$vol','$iss','$cur_page','$line')");
				$sth1->execute();
				$sth1->finish();
				
				close(DATA);
			}
		}
	}
}
