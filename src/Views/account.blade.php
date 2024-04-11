@section('title', 'Mail Setup')
@extends('vendor.InstallerEragViews.app-layout')
@section('content')
    <section class="mt-4">
        <div class="container">
            <form action="{{ route('saveAccount') }}" method="post" class="card">
                @csrf
                <div class="card-body">
                    <div class="tab">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <x-input label="Driver" name="mail_driver" type="text"
                                    value="{{ old('mail_driver') }}" placeholder="smtp" />
                                <x-error for="mail_driver" />
                            </div>

                            <div class="col-md-4 mb-3">
                                <x-input label="Host" name="mail_host" type="text"
                                    value="{{ old('mail_host') }}" placeholder="localhost" />
                                <x-error for="mail_host" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <x-input label="Port" name="mail_port" type="text"
                                    value="{{ old('mail_port') }}" placeholder="587 or 465 or 25" />
                                <x-error for="mail_port" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <x-input label="Mail Encryption" name="mail_encryption" type="text"
                                    value="{{ old('mail_encryption') }}" placeholder="TLS or SSL or null" />
                                <x-error for="mail_encryption" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <x-input label="Email Username" name="mail_username" type="email"
                                    value="{{ old('mail_username') }}" placeholder="admin@example.com" />
                                <x-error for="mail_username" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <x-input label="Email Password" name="mail_password" type="password"
                                    value="{{ old('mail_password') }}" />
                                <x-error for="mail_password" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <x-input label="Email From Address" name="mail_from_address" type="email"
                                    value="{{ old('mail_from_address') }}" />
                                <x-error for="mail_from_address" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <x-input label="Email From Name" name="mail_from_name" type="text"
                                    value="{{ old('mail_from_name') }}" />
                                <x-error for="mail_from_name" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <div class="d-flex">
                        <button type="submit" id="next_button" class="btn btn-primary ms-auto">Next</button>
                        {{-- <a href="{{ route('finish') }}" class="btn btn-warning ms-auto">Skip</a> --}}
                    </div>
                </div>
            </form>
        </div>
        </div>
    </section>
@endsection
