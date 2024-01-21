<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'core' => [
        'minPhpVersion' => '8.2.0',
    ],
    'final' => [
        'key' => true,
        'publish' => false,
    ],
    'requirements' => [
        'php' => [
            'openssl',
            'pdo',
            'mbstring',
            // 'gd2',
            'tokenizer',
            'JSON',
            'cURL',
        ],
        'apache' => [
            'mod_rewrite',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        'storage/framework/'     => '775',
        'storage/logs/'          => '775',
        'bootstrap/cache/'       => '775',
    ],



    'environment' => [
        'form' => [
            'rules' => [
                'app_name'              => 'required|string|max:50',
                'environment'           => 'required|string|max:50',
                'environment_custom'    => 'required_if:environment,other|max:50',
                'app_debug'             => 'required|string',
                'app_log_level'         => 'required|string|max:50',
                'app_url'               => 'required|url',
                'database_connection'   => 'required|string|max:50',
                'database_hostname'     => 'required|string|max:50',
                'database_port'         => 'required|numeric',
                'database_name'         => 'required|string|max:50',
                'database_username'     => 'required|string|max:50',
                'database_password'     => 'required|string|max:50',
            ],
        ],
    ],

    // env

    'env' => 'BROADCAST_DRIVER=log' . "\n" .
        'CACHE_DRIVER=file' . "\n" .
        'FILESYSTEM_DISK=local' . "\n" .
        'QUEUE_CONNECTION=sync' . "\n" .
        'SESSION_DRIVER=file' . "\n" .
        'SESSION_LIFETIME=120' . "\n\n" .
        'MEMCACHED_HOST=127.0.0.1' . "\n\n" .
        'REDIS_HOST=127.0.0.1' . "\n" .
        'REDIS_PASSWORD=null' . "\n" .
        'REDIS_PORT=6379' . "\n\n" .
        'MAIL_MAILER=smtp' . "\n" .
        'MAIL_HOST=mailpit' . "\n" .
        'MAIL_PORT=1025' . "\n" .
        'MAIL_USERNAME=null' . "\n" .
        'MAIL_PASSWORD=null' . "\n" .
        'MAIL_ENCRYPTION=null' . "\n" .
        'MAIL_FROM_ADDRESS="hello@example.com"' . "\n" .
        'MAIL_FROM_NAME="${APP_NAME}"' . "\n\n" .
        'AWS_ACCESS_KEY_ID=' . "\n" .
        'AWS_SECRET_ACCESS_KEY=' . "\n" .
        'AWS_DEFAULT_REGION=us-east-1' . "\n" .
        'AWS_BUCKET=' . "\n" .
        'AWS_USE_PATH_STYLE_ENDPOINT=false' . "\n\n" .
        'PUSHER_APP_ID=' . "\n" .
        'PUSHER_APP_KEY=' . "\n" .
        'PUSHER_APP_SECRET=' . "\n" .
        'PUSHER_HOST=' . "\n" .
        'PUSHER_PORT=443' . "\n" .
        'PUSHER_SCHEME=https' . "\n" .
        'PUSHER_APP_CLUSTER=mt1' . "\n\n" .
        'VITE_APP_NAME="${APP_NAME}"' . "\n" .
        'VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"' . "\n" .
        'VITE_PUSHER_HOST="${PUSHER_HOST}"' . "\n" .
        'VITE_PUSHER_PORT="${PUSHER_PORT}"' . "\n" .
        'VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"' . "\n" .
        'VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"',


    'account' =>    [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|string|min:6',
    ]
];
