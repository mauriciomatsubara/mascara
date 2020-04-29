# Database credentials
user="kscombr_ks"
password="m@tsu1001"
host="localhost"
db_name="kscombr_dbks"

mysql --user=$user --password=$password --host=$host $db_name < "url-staging-prod.sql"
