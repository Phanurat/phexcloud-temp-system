# Dockerfile
FROM nextcloud:26-apache

# Set environment variables (optional)
ENV NEXTCLOUD_ADMIN_USER=admin
ENV NEXTCLOUD_ADMIN_PASSWORD=supersecret

# Copy custom app
COPY app/ /var/www/html/custom_apps/tempapp/

# Copy scripts
COPY scripts/ /var/www/html/scripts/
RUN chmod +x /var/www/html/scripts/*.sh

# Copy config
COPY config/system.env /var/www/html/config/system.env

# Copy frontend
COPY frontend/ /var/www/html/frontend/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/custom_apps/tempapp \
    /var/www/html/scripts /var/www/html/frontend \
    /var/www/html/data

# Expose port
EXPOSE 8080

# Start apache in foreground
CMD ["apache2-foreground"]
