#!/bin/bash

# Database credentials
user="tprobr_msk"
password="m@tsu1001"
host="localhost"
db_name="tprobr_dbmsk"
dbbackup="dbmsk.sql"
backup_path="../sql"

mysql --user=$user --password=$password --host=$host $db_name < "url-prod-staging.sql"