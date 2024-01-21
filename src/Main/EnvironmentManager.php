<?php

namespace InstallerErag\Main;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnvironmentManager
{
     /**
      * @var string
      */
     private $envPath;
     /**
      * Set the .env and .env.example paths.
      */
     public function __construct()
     {
          $this->envPath = base_path('.env');
     }

     public function saveFileWizard(Request $request)
     {
          $results = 'Installer Successfully';

          $env = config('install.env');

          $envFileData =
               'APP_NAME=\'' . $request->app_name . "'\n" .
               'APP_ENV=' . $request->environment . "\n" .
               'APP_KEY=' . 'base64:' . base64_encode(Str::random(32)) . "\n" .
               'APP_DEBUG=' . $request->app_debug . "\n" .
               'APP_LOG_LEVEL=' . $request->app_log_level . "\n" .
               'APP_URL=' . $request->app_url . "\n\n" .
               'DB_CONNECTION=' . $request->database_connection . "\n" .
               'DB_HOST=' . $request->database_hostname . "\n" .
               'DB_PORT=' . $request->database_port . "\n" .
               'DB_DATABASE=' . $request->database_name . "\n" .
               'DB_USERNAME=' . $request->database_username . "\n" .
               'DB_PASSWORD=' . $request->database_password . "\n\n" .
               $env;
          try {
               file_put_contents($this->envPath, $envFileData);
          } catch (Exception $e) {
               $results = 'installer Errors';
          }

          return $results;
     }
}
