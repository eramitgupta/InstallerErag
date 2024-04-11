<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="cardstep px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">Laravel Application Install</h2>
                <form id="msform">
                    <ul id="progressbar">
                        <li class="{{ Route::currentRouteName() == 'installs' ? 'active' : '' }} {{ Route::currentRouteName() == 'database_import' ? 'active' : '' }} {{ Route::currentRouteName() == 'account' ? 'active' : '' }} {{ Route::currentRouteName() == 'finish' ? 'active' : '' }}"
                            id="RequirementsPermissions"><strong>Requirements & Permissions</strong>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'database_import' ? 'active' : '' }} {{ Route::currentRouteName() == 'account' ? 'active' : '' }} {{ Route::currentRouteName() == 'finish' ? 'active' : '' }}"
                            id="DatabaseImport"><strong>Database Import</strong></li>
                        <li class="{{ Route::currentRouteName() == 'account' ? 'active' : '' }} {{ Route::currentRouteName() == 'finish' ? 'active' : '' }}"
                            id="account">
                            <strong>Mail Setup</strong>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'finish' ? 'active' : '' }}" id="confirm">
                            <strong>Finish</strong>
                        </li>
                    </ul>
                    @php
                        $totalSteps = 4;
                        $currentStep = array_search(Route::currentRouteName(), ['installs', 'database_import', 'account', 'finish']) + 1;
                        $progressPercentage = ($currentStep / $totalSteps) * 100;
                    @endphp
                    <div class="progress" role="progressbar" aria-label="Default striped example"
                        aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped" style="width: {{ $progressPercentage }}%"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
