#!/bin/bash
NOW=$(date +%s)
FILE_CSV="/var/www/html/data/tempfiles.csv"
TMP_CSV="/var/www/html/data/tempfiles.tmp"

while IFS=, read -r user filepath expire_ts; do
    if [[ "$NOW" -ge "$expire_ts" ]]; then
        rm -f "$filepath"
        echo "Deleted expired file: $filepath" >> /var/www/html/data/logs/cron.log
    else
        echo "$user,$filepath,$expire_ts" >> $TMP_CSV
    fi
done < "$FILE_CSV"

mv $TMP_CSV $FILE_CSV
