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
                                <h5 class="font-weight-bold">Breast Cancer Detection System</h5>
                            </div>
                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">About Breast Cancer Detection System</h5>
                            <p class="text-justify">The Breast Cancer Detection System (BCDS) supports doctors diagnosing
                                with an ultrasound breast image input. The system can diagnose and classify whether it is
                                normal, or having a malignant or benign tumor. The system allows the doctors to create a
                                request for patients to take an ultrasound scan to the sonographer. After finishing the
                                scanning process, the sonographer uploads the ultrasound breast image into the system, then
                                the machine learning model in BCDS diagnoses the result based on the given ultrasound image.
                                Moreover, the BCDS identifies the cancer area on the inputted ultrasound image when
                                returning the result to the doctor.</p>

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
                        </div> {{-- <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Credits</h5>
                            <p>Laravel SB Admin 2 uses some open-source third-party libraries/packages, many thanks to the web community.</p>
                            <ul>
                                <li><a href="https://laravel.com" target="_blank">Laravel</a> - Open source framework.</li>
                                <li><a href="https://github.com/DevMarketer/LaravelEasyNav" target="_blank">LaravelEasyNav</a> - Making managing navigation in Laravel easy.</li>
                                <li><a href="https://startbootstrap.com/themes/sb-admin-2" target="_blank">SB Admin 2</a> - Thanks to Start Bootstrap.</li>
                            </ul>
                        </div>
                    </div> --}}
                    </div>
                    <hr>
                    <h2 style="text-align:center">Our Team</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{url('img/about/Luong_Hoang_Huong.png')}}" alt="Jane" style="width:100%">
                                <div class="container">
                                    <h5>Luong Hoang Huong</h5>
                                    <p class="title">Supervisor</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{url('img/about/Phan_Le_Trong_Nghia.png')}}" alt="Mike" style="width:100%">
                                <div class="container">
                                    <h5>Phan Le Trong Nghia</h5>
                                    <p class="title">Leader</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{url('img/about/Dang_Minh_Thuan.png')}}" alt="John" style="width:100%">
                                <div class="container">
                                    <h5>Dang Minh Thuan</h5>
                                    <p class="title">Member</p>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{url('img/about/Nguyen_Duc_Tong.png')}}" alt="Jane" style="width:100%">
                                <div class="container">
                                    <h5>Nguyen Duc Tong</h5>
                                    <p class="title">Member</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{url('img/about/Duong_Tri_Tin.png')}}" alt="Mike" style="width:100%">
                                <div class="container">
                                    <h5>Duong Tri Tin</h5>
                                    <p class="title">Member</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{url('img/about/Dinh_Cong_Toai.png')}}" alt="John" style="width:100%">
                                <div class="container">
                                    <h5>Dinh Cong Toai</h5>
                                    <p class="title">Member</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endsection
