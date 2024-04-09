<?php

namespace InstallerErag\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InstallerErag\Main\EnvironmentManager;


class DatabaseConyroller extends Controller
{
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
          return view('InstallerEragViews::database-import');
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
                    'database_connection' => 'db connection failed',
               ]);
          }

          $this->EnvironmentManager->saveFileWizard($request);

          return redirect(route('finish'));
     }

     private function checkDatabaseConnection(Request $request)
     {
          $connection = $request->input('database_connection');

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
}
