@section('title', 'Finish')
@extends('vendor.InstallerEragViews.app-layout')
@section('content')
    <section class="mt-4">
        <div class="container">
            <div class="row justify-content-center">
                <i class="bi bi-check2-circle text-center"></i>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h5 class="purple-text text-center finish">Application has been successfully installed
                        <a href="{{ route('finishSave')}}">Click here to exit</a></h5>
                </div>
            </div>
        </div>
    </section>
@endsection
