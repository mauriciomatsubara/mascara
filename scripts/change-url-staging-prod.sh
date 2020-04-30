# Database credentials
user="mlcombr_ml"
password="m@tsu1001"
host="localhost"
db_name="mlcombr_dbml"

mysql --user=$user --password=$password --host=$host $db_name < "url-staging-prod.sql"
