#!/bin/bash

# Database credentials
user="kscombr_ks"
password="m@tsu1001"
host="localhost"
db_name="kscombr_dbks"
dbbackup="dbks.sql"
backup_path="../sql"

mysqldump --no-create-db --extended-insert=FALSE --user=$user --password=$password --host=$host $db_name > $backup_path/$dbbackup
