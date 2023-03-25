@extends('admin.layouts.master')

@section('title', 'Your Account')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @if (session('updateSuccess'))
                    <div class="col-6 offset-5">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong class="fs-5">{{ session('updateSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="col-lg-10 offset-1 mt-3">
                    <div class="card rounded border border-dark">
                        <div class="card-body">
                            <div class="card-title">
                                <i class="fa-solid fa-backward d-flex ms-3 mt-3 fs-5" onclick="history.back()"></i>
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>

                            <div class="row p-2 mt-5">
                                <div class="col-3 offset-1">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'Male')
                                            <img src="{{ asset('images/defaultUser.png') }}" class="rounded shadow">
                                        @else
                                            <img src="{{ asset('images/defaultFemale.png') }}" class="rounded shadow">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded">
                                    @endif
                                </div>
                                <div class="col offset-2">

                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-primary"><i
                                            class="ms-3 fa-solid fa-user me-3"></i>{{ Auth::user()->name }}
                                    </h3>
                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-primary"><i
                                            class="ms-3 fa-solid fa-envelope me-3"></i>{{ Auth::user()->email }}
                                    </h3>
                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-primary"><i
                                            class="ms-3 fa-solid fa-phone me-3"></i>{{ Auth::user()->phone }}</h3>
                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-primary"><i
                                            class="ms-3 me-3 fa-solid fa-venus-mars"></i>{{ Auth::user()->gender }}</h3>
                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-primary"><i
                                            class="ms-3 fa-solid fa-map-location me-3"></i>{{ Auth::user()->address }}</h3>
                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-primary"><i
                                            class="ms-3 fa-solid fa-person-circle-check me-3"></i>{{ Auth::user()->role }}
                                    </h3>
                                    <h3 class="mb-2 shadow-sm p-2 rounded-pill border border-primary"><i
                                            class="ms-3 fa-solid fa-calendar-days me-4"></i>{{ Auth::user()->created_at->format('j / F / Y') }}
                                    </h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 offset-7 text-center">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-outline-dark rounded-pill  shadow my-3">Edit Your
                                            Profile</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
