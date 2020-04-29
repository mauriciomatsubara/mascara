#!/bin/bash

# Database credentials
user="tprobr_msk"
password="m@tsu1001"
host="localhost"
db_name="tprobr_dbmsk"
dbbackup="dbmsk.sql"
backup_path="../sql"

mysqldump --no-create-db --extended-insert=FALSE --user=$user --password=$password --host=$host $db_name > $backup_path/$dbbackup
