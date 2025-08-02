<?php

return [

    'pdf' => [
        'enabled' => true,
        'binary' => PHP_OS_FAMILY === 'Windows'
            ? env('WKHTML_PDF_BINARY', '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe"')
            : env('WKHTML_PDF_BINARY', base_path('storage/app/bin/wkhtmltopdf')),
        'timeout' => false,
        'options' => ['enable-local-file-access' => true],
        'env' => [],
    ],

    'image' => [
        'enabled' => true,
        'binary' => PHP_OS_FAMILY === 'Windows'
            ? env('WKHTML_IMG_BINARY', '"C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage.exe"')
            : env('WKHTML_IMG_BINARY', base_path('storage/app/bin/wkhtmltoimage')),
        'timeout' => false,
        'options' => ['enable-local-file-access' => true],
        'env' => [],
    ],

];
