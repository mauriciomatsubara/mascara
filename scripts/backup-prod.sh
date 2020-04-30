#!/bin/bash

# Database credentials
user="mlcombr_ml"
password="m@tsu1001"
host="localhost"
db_name="mlcombr_dbml"
dbbackup="dbmsk.sql"
backup_path="../sql"

mysqldump --no-create-db --extended-insert=FALSE --user=$user --password=$password --host=$host $db_name > $backup_path/$dbbackup
