#!/bin/sh

host="localhost"
db="kscst"
usr="root"
pwd="mysql"

echo "drop database if EXISTS kscst; create database kscst;" | /usr/bin/mysql -uroot -pmysql
perl insert_projects.pl $host $db $usr $pwd
perl ocr.pl $host $db $usr $pwd
perl searchtable.pl $host $db $usr $pwd
echo "create fulltext index text_index_records on searchtable (text);" | /usr/bin/mysql -uroot -pmysql kscst
