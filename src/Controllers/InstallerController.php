<?php

namespace InstallerErag\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use InstallerErag\Main\DatabaseManager;
use InstallerErag\Main\InstalledManager;
use InstallerErag\Main\PermissionsChecker;
use InstallerErag\Main\RequirementsChecker;

class InstallerController extends Controller
{
     /**
      * @var RequirementsChecker
      */
     protected $requirements;

     /**
      * @var PermissionsChecker
      */
     protected $permissions;


     public function __construct(PermissionsChecker $permissions, RequirementsChecker  $requirements)
     {
          $this->permissions = $permissions;
          $this->requirements = $requirements;
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


     public function install_check()
     {
          return redirect(route('database_import'));
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

     public function finishSave()
     {
          InstalledManager::create();
          return redirect(URL::to('/'));
     }

}
