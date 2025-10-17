<?php
return [
    // Default quota per TempUser
    'default_quota' => '5GB',

    // Default file expiration in minutes
    'default_file_expire' => 60,

    // Max file upload size in bytes (1GB)
    'max_file_size' => 1073741824,

    // TempUser lifetime in days
    'tempuser_lifetime_days' => 1,

    // Paths
    'data_dir' => '/var/www/html/data',
    'scripts_dir' => '/var/www/html/scripts',
    'log_dir' => '/var/www/html/data/logs'
];
