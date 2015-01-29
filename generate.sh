#!/bin/sh

host="localhost"
db="kscst"
usr="root"
pwd="mysql"

# echo "drop database if EXISTS kscst; create database kscst;" | /usr/bin/mysql -uroot -pmysql
echo "CREATE TABLE IF NOT EXISTS userdetails(name varchar(1000), email varchar(100), profession varchar(500), password varchar(100), affiliation varchar(2000), misc varchar(1000), isverified varchar(1), visitcount int(5), hash varchar(64), timestamp varchar(20), userid int(6) auto_increment, primary key(userid)) ENGINE=MyISAM;" | /usr/bin/mysql -uroot -p kscst
echo "CREATE TABLE IF NOT EXISTS reset (hash varchar(100), email varchar(100), name varchar(1000), password varchar(100), timestamp varchar(100), resetid int(6) AUTO_INCREMENT, PRIMARY KEY (resetid)) ENGINE=MyISAM;" | /usr/bin/mysql -uroot -p kscst

perl insert_projects.pl $host $db $usr $pwd
perl ocr.pl $host $db $usr $pwd
perl searchtable.pl $host $db $usr $pwd
echo "create fulltext index text_index_records on searchtable (text);" | /usr/bin/mysql -uroot -pmysql kscst
