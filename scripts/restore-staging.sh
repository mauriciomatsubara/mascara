#!/bin/bash

# Database credentials
user="tprobr_ks"
password="m@tsu1001"
host="localhost"
db_name="tprobr_dbks"
dbbackup="dbks.sql"
backup_path="../sql"

mysql --user=$user --password=$password --host=$host $db_name < $backup_path/$dbbackup

