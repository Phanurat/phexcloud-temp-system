#!/bin/bash
# สร้าง TempUser ใหม่
USERNAME="tempuser_$(date +%s)"
QUOTA="5GB"
docker exec -u www-data nextcloud-app php occ user:add "$USERNAME" --password-from-env
docker exec -u www-data nextcloud-app php occ user:setting "$USERNAME" files quota $QUOTA

# บันทึก expire
EXPIRE=$(date -d "+1 day" +%Y-%m-%d)
echo "$USERNAME,$EXPIRE" >> /var/www/html/data/tempusers.csv
