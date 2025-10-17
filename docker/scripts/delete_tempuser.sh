#!/bin/bash
NOW=$(date +%Y-%m-%d)
USER_CSV="/var/www/html/data/tempusers.csv"
TMP_CSV="/var/www/html/data/tempusers.tmp"

while IFS=, read -r user expire_date; do
    if [[ "$NOW" > "$expire_date" ]]; then
        docker exec -u www-data nextcloud-app php occ user:delete "$user"
        echo "Deleted expired user: $user" >> /var/www/html/data/logs/cron.log
    else
        echo "$user,$expire_date" >> $TMP_CSV
    fi
done < "$USER_CSV"

mv $TMP_CSV $USER_CSV
