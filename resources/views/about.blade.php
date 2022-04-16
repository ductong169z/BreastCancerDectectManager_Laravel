@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('About') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4">
                    <img src="{{ asset('img/favicon.png') }}" class="rounded-circle" alt="user-image">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 mb-1">
                            <div class="text-center">
                                <h5 class="font-weight-bold">Breast Cancer Detection</h5>
                            </div>
                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">About Breast Cancer Detection System</h5>
                            <span>The Breast Cancer Detection System (BCDS) supports doctors diagnosing with an ultrasound breast image input. The system can diagnose and classify whether it is normal, or having a malignant or benign tumor. The system allows the doctors to create a request for patients to take an ultrasound scan to the sonographer. After finishing the scanning process, the sonographer uploads the ultrasound breast image into the system, then the machine learning model in BCDS diagnoses the result based on the given ultrasound image. Moreover, the BCDS identifies the cancer area on the inputted ultrasound image when returning the result to the doctor.</span>

                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Main features of BCDS:</h5>
                            <p>Breast cancer classification based on ultrasound images</p>
                            <p>Grad-CAM explanation on predicting images</p>
                            <p>Users, patients, predictions, and models management</p>
                            <p>Roles and permissions dynamic management</p>
                            <p>Data visualization</p>
                        </div {{-- <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Credits</h5>
                            <p>Laravel SB Admin 2 uses some open-source third-party libraries/packages, many thanks to the web community.</p>
                            <ul>
                                <li><a href="https://laravel.com" target="_blank">Laravel</a> - Open source framework.</li>
                                <li><a href="https://github.com/DevMarketer/LaravelEasyNav" target="_blank">LaravelEasyNav</a> - Making managing navigation in Laravel easy.</li>
                                <li><a href="https://startbootstrap.com/themes/sb-admin-2" target="_blank">SB Admin 2</a> - Thanks to Start Bootstrap.</li>
                            </ul>
                        </div>
                    </div> --}} </div>
                    </div>

                </div>

            </div>
        @endsection
