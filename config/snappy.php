<?php

return [

    'pdf' => [
        'enabled' => true,
        'binary' => PHP_OS_FAMILY === 'Windows'
            ? env('WKHTML_PDF_BINARY', '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe"')
            : env('WKHTML_PDF_BINARY', base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64')),
        'timeout' => false,
        'options' => ['enable-local-file-access' => true],
        'env' => [],
    ],

    'image' => [
        'enabled' => true,
        'binary' => PHP_OS_FAMILY === 'Windows'
            ? env('WKHTML_IMG_BINARY', '"C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage.exe"')
            : env('WKHTML_IMG_BINARY', base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64')),
        'timeout' => false,
        'options' => ['enable-local-file-access' => true],
        'env' => [],
    ],

];
