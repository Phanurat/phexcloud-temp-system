<?php
return [
    // API สำหรับสร้าง TempUser
    'routes' => [
        [
            'name' => 'createTempUser',
            'url' => '/api/createTempUser',
            'verb' => 'POST',
            'class' => 'OCA\TempApp\Controller\TempUserController',
            'method' => 'createTempUser',
        ],
        // API สำหรับอัพโหลด TempFile
        [
            'name' => 'uploadTempFile',
            'url' => '/api/uploadTempFile',
            'verb' => 'POST',
            'class' => 'OCA\TempApp\Controller\TempUserController',
            'method' => 'uploadTempFile',
        ],
    ]
];
