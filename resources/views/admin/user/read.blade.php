@extends('admin.layouts.master')

@section('title', 'Read Messages')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1 mt-3">
                    <div class="card rounded border border-dark">
                        <div class="card-body">
                            <div class="card-title">
                                <i class="fa-solid fa-backward d-flex ms-3 mt-3 fs-5" onclick="history.back()"></i>
                                <h3 class="text-center title-2">Read Message</h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="">
                                    @foreach ($showMessage as $sM)
                                        <label for="" class="fs-5">
                                            <h2>From</h2>
                                        </label>
                                        <h3 class="text-muted"> <span class="mx-2"> &rarr; </span> {{ $sM->name }}
                                        </h3> <br>

                                        <label for="" class="fs-5">
                                            <h2>Email</h2>
                                        </label>
                                        <h3 class="text-muted"> <span class="mx-2"> &rarr; </span> {{ $sM->email }}
                                        </h3> <br>

                                        <label for="" class="fs-5">
                                            <h2>Phone</h2>
                                        </label>
                                        <h3 class="text-muted"> <span class="mx-2"> &rarr; </span> {{ $sM->phone }}
                                        </h3> <br>

                                        <label for="" class="fs-5">
                                            <h2>Message</h2>
                                        </label>
                                        <h3 class="text-muted"> <span class="mx-2"> &rarr; </span> {{ $sM->message }}
                                        </h3>
                                    @endforeach
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
