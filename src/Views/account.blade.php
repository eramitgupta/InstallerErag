{{-- @section('title', 'Account')
@extends('vendor.InstallerEragViews.app-layout')
@section('content')
    <section class="mt-4">
        <div class="container">
            <div class="col-md-6 cs_center">
                <form action="{{ route('saveAccount') }}" method="post" class="card">
                    @csrf
                    <div class="card-body">
                        <div class="tab">

                            <div class="col-md-12 mb-3">
                                <x-input label="Name" required="ture" name="first_name" type="text"
                                    value="{{ old('first_name') }}" />
                                <x-error for="first_name" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <x-input label="Email" required="ture" name="email" type="email"
                                    value="{{ old('email') }}" />
                                <x-error for="email" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <x-input label="Password" required="ture" name="password" type="password"
                                    value="{{ old('password') }}" />
                                <x-error for="password" />
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <button type="submit" id="next_button" class="btn btn-primary ms-auto">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection --}}
