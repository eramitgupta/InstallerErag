<?php

namespace InstallerErag\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use InstallerErag\Main\EnvironmentManager;


class DatabaseConyroller extends Controller
{
    public $entries;
     /**
      * @var EnvironmentManager
      */
     protected $EnvironmentManager;


     public function __construct(EnvironmentManager $environmentManager)
     {
          $this->EnvironmentManager = $environmentManager;
     }


     public function database_import(Request $request)
     {
        try {
            DB::connection()->getPdo();
            return redirect(URL::to('/'));
        } catch (\Exception $e) {
            return view('InstallerEragViews::database-import');
        }
     }

     public function saveWizard(Request $request, Redirector $redirect)
     {

          $rules = config('install.environment.form.rules');

          $validator = Validator::make($request->all(), $rules);

          if ($validator->fails()) {
               return $redirect->route('database_import')->withInput()->withErrors($validator->errors());
          }

          if (!$this->checkDatabaseConnection($request)) {
               return $redirect->route('database_import')->withInput()->withErrors([
                    'database_hostname' => 'database connection failed',
               ]);
          }

        $this->readEnv();
        $input = $request->only(['app_name', 'app_url', 'database_hostname', 'database_connection', 'database_port', 'database_name', 'database_username', 'database_password']);

            $this->changeEntry('APP_NAME', $input['app_name']);
            $this->changeEntry('APP_URL', $input['app_url']);
            $this->changeEntry('DB_CONNECTION', $input['database_connection']);
            $this->changeEntry('DB_HOST', $input['database_hostname']);
            $this->changeEntry('DB_PORT', $input['database_port']);
            $this->changeEntry('DB_DATABASE', $input['database_name']);
            $this->changeEntry('DB_USERNAME', $input['database_username']);
            $this->changeEntry('DB_PASSWORD', $input['database_password']);

        //   $this->EnvironmentManager->saveFileWizard($request);

            return redirect()->route('account');
     }

     private function checkDatabaseConnection(Request $request)
     {
          $connection = 'mysql';

          $settings = config("database.connections.$connection");

          config([
               'database' => [
                    'default' => $connection,
                    'connections' => [
                         $connection => array_merge($settings, [
                              'driver' => $connection,
                              'host' => $request->input('database_hostname'),
                              'port' => $request->input('database_port'),
                              'database' => $request->input('database_name'),
                              'username' => $request->input('database_username'),
                              'password' => $request->input('database_password'),
                         ]),
                    ],
               ],
          ]);

          DB::purge();

          try {
               DB::connection()->getPdo();

               return true;
          } catch (Exception $e) {
               return false;
          }
     }

     public function readEnv()
    {
        $content = file_get_contents(base_path('.env'));

        $lines = explode(PHP_EOL, $content);

        foreach ($lines as $line) {
            if (str_contains($line, '=')) {
                $entry = explode('=', $line);
                $value = $entry[1];
                if (str_starts_with($value, '"') && str_ends_with($value, '"')) {
                    $value = substr($value, 1, -1);
                }
                $this->entries[$entry[0]] = $value;
            }
        }
    }

    public function getEntry($key, $default = null)
    {
        return $this->entries[$key] ?? $default;
    }

    public function changeEntry($key, $value, $write = true)
    {
        $this->entries[$key] = $value;

        if ($write) {
            $this->writeEnv();
        }
    }

    public function writeEnv()
    {
        $content = '';

        foreach ($this->entries as $key => $value) {
            if (str_contains($value, ' ')) {
                $value = '"'.$value.'"';
            }
            $content .= "{$key}={$value}".PHP_EOL;
        }

        file_put_contents(base_path('.env'), $content);
    }
}
