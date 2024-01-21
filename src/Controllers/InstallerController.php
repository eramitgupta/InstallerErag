<?php

namespace InstallerErag\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use InstallerErag\Main\DatabaseManager;
use InstallerErag\Main\InstalledManager;
use InstallerErag\Main\PermissionsChecker;
use InstallerErag\Main\RequirementsChecker;
use InstallerErag\Main\EnvironmentManager;

class InstallerController extends Controller
{
     /**
      * @var EnvironmentManager
      */
     protected $EnvironmentManager;

     /**
      * @var RequirementsChecker
      */
     protected $requirements;


     /**
      * @var PermissionsChecker
      */
     protected $permissions;


     /**
      * @param  RequirementsChecker  $checker
      */
     /**
      * @param  PermissionsChecker  $checker
      */
     public function __construct(PermissionsChecker $permissions, RequirementsChecker  $requirements, EnvironmentManager $environmentManager)
     {
          $this->permissions = $permissions;
          $this->requirements = $requirements;
          $this->EnvironmentManager = $environmentManager;
     }

     public function index()
     {

          $permissions = $this->permissions->check(
               config('install.permissions')
          );

          $phpSupportInfo = $this->requirements->checkPHPversion(
               config('install.core.minPhpVersion')
          );
          $requirements = $this->requirements->check(
               config('install.requirements')
          );


          return view('InstallerEragViews::index', compact('permissions', 'requirements', 'phpSupportInfo'));
     }


     public function finishSave()
     {
          InstalledManager::create();
          return redirect(URL::to('/'));
     }

     public function install_check()
     {
          return redirect(route('database_import'));
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

          return redirect(route('account'));
     }

     public function account()
     {
          DatabaseManager::MigrateAndSeed();
          return view('InstallerEragViews::account');
     }

     public function saveAccount(Request $request, Redirector $redirect)
     {
          $rules = config('install.account');

          $validator = Validator::make($request->all(), $rules);

          if ($validator->fails()) {
               return $redirect->route('account')->withInput()->withErrors($validator->errors());
          }

          unset($request['_token']);

          $request['password'] = Hash::make($request->password);

          DB::table('users')->insert($request->all());

          return redirect(route('finish'));
     }

     public function finish()
     {
          return view('InstallerEragViews::finish');

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
