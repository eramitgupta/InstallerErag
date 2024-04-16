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
    public $entries;
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
        try {
            DB::connection()->getPdo();
            return redirect(URL::to('/'));
        } catch (\Exception $e) {
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
    }


    public function install_check()
    {
        return redirect(route('database_import'));
    }


    public function account()
    {
        //   DatabaseManager::MigrateAndSeed();
        return view('InstallerEragViews::account');
    }

    public function saveAccount(Request $request, Redirector $redirect)
    {
        $this->readEnv();
        $input = $request->only(['mail_driver', 'mail_host', 'mail_port', 'mail_encryption', 'mail_username', 'mail_password', 'mail_from_address', 'mail_from_name']);

        $this->changeEntry('MAIL_MAILER', $input['mail_driver'] ?? 'log');
        $this->changeEntry('MAIL_HOST', $input['mail_host'] ?? 'mailhog');
        $this->changeEntry('MAIL_PORT', $input['mail_port'] ?? 1025);
        $this->changeEntry('MAIL_ENCRYPTION', $input['mail_encryption'] ?? 'null');
        $this->changeEntry('MAIL_USERNAME', $input['mail_username'] ?? 'null');
        $this->changeEntry('MAIL_PASSWORD', $input['mail_password'] ?? 'null');
        $this->changeEntry('MAIL_FROM_ADDRESS', $input['mail_from_address'] ?? 'null');
        $this->changeEntry('MAIL_FROM_NAME', $input['mail_from_name'] ?? '${APP_NAME}');

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
                $value = '"' . $value . '"';
            }
            $content .= "{$key}={$value}" . PHP_EOL;
        }

        file_put_contents(base_path('.env'), $content);
    }
}
