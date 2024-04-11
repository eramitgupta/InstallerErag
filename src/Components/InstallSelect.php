<?php

namespace InstallerErag\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InstallSelect extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('vendor.InstallerEragViews.components.install-select');
    }
}