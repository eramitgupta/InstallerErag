@section('title', 'Application Installation')
@extends('vendor.InstallerEragViews.app-layout')
@section('content')
    <section class="mt-4">
        <div class="container">
            <form action="{{ route('install_check') }}" method="post">
                @csrf
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Extension</th>
                                        <th>Status</th>
                                        <th>Current Version</th>
                                        <th>Required Version</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requirements['requirements'] as $type => $requirement)
                                        @foreach ($requirements['requirements'][$type] as $extension => $enabled)
                                            <tr>
                                                <td>{{ Str::upper($type) }}</td>
                                                <td>{{ $extension }}</td>
                                                <td>
                                                    <span class="badge text-bg-{{ $enabled ? 'success' : 'danger' }}">
                                                        {{ $enabled ? 'success' : 'error' }}
                                                        <i
                                                            class="bi bi-{{ $enabled ? 'bi bi-check-circle' : 'x-circle' }}"></i>
                                                    </span>
                                                </td>
                                                <td>version {{ $phpSupportInfo['current'] }}
                                                    <i
                                                        class="text-{{ $phpSupportInfo['supported'] ? 'success' : 'danger' }} bi bi-{{ $phpSupportInfo['supported'] ? 'check-circle-fill' : 'x-circle-fill' }}"></i>
                                                </td>
                                                <td>(version {{ $phpSupportInfo['minimum'] }} required)</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Folder</th>
                                        <th>Status</th>
                                        <th>Permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions['permissions'] as $permission)
                                        <tr>
                                            <td>{{ $permission['folder'] }}</td>
                                            <td>
                                                <span class="badge text-bg-{!! $permission['isSet'] ? 'success' : 'danger' !!}">
                                                    {!! $permission['isSet'] ? 'success' : 'error' !!}
                                                    <i
                                                        class="bi bi-{{ $permission['isSet'] ? 'bi bi-check-circle' : 'x-circle' }}"></i>
                                                </span>
                                            </td>
                                            <td>{{ $permission['permission'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (!isset($requirements['errors']) && $phpSupportInfo['supported'])
                    @if (!isset($permissions['errors']))
                        <div class="card-footer footerHome text-end">
                            <div class="d-flex">
                                <button type="submit" id="next_button" class="btn btn-primary ms-auto">Next</button>
                            </div>
                        </div>
                    @endif
                @endif
            </form>
        </div>
    </section>
@endsection
