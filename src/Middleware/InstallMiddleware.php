<?php

namespace InstallerErag\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class InstallMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->alreadyInstalled()) {
            return redirect(URL::to('/'));
        }

        return $next($request);
    }

    public function alreadyInstalled(): bool
    {
        return file_exists(storage_path('installed'));
    }
}
