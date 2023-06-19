# Load ENV
set -a; source .env; set +a

if [ ! -d "database/backup" ]; then
        mkdir "database/backup"
fi

mysqldump $DB_DATABASE -h $DB_HOST -u $DB_USERNAME --password=$DB_PASSWORD > database/backup/pion_backup_$(date +%d_%m_%Y).sql