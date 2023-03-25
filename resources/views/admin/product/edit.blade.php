@extends('admin.layouts.master')

@section('title', 'Pizza View Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 offset-10">
                        <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>


                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body rounded border border-dark">
                            <div class="card-title">
                                <i class="fa-solid fa-backward d-flex ms-3 mt-3 fs-5" onclick="history.back()"></i>
                                <h3 class="text-center title-2">View your Pizza</h3>
                            </div>
                            <hr>

                            <div class="row p-2 mt-5">
                                <div class="col-5 text-center">

                                    <img src="{{ asset('storage/' . $pizza->image) }}" class="shadow rounded"
                                        style="width: 600px; height:500px; ">
                                </div>
                                <div class="col offset-1">

                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-success"><i
                                            class="fa-solid fa-pizza-slice ms-3 me-3"></i>{{ $pizza->name }}
                                    </h3>
                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-success"><i
                                            class="fa-solid fa-table-list ms-3 me-3"></i>{{ $pizza->category_name }}
                                    </h3>
                                    <h3 class="mb-3 shadow-sm p-2 rounded border border-success"><i
                                            class="fa-solid fa-circle-info ms-3 me-3"></i>{{ $pizza->description }}</h3>
                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-success"><i
                                            class="ms-3 me-3 fa-solid fa-eye"></i>{{ $pizza->view_count }}</h3>
                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-success"><i
                                            class="fa-solid fa-clock ms-3 me-3"></i>{{ $pizza->waiting_time }}Mins
                                    </h3>
                                    <h3 class="mb-3 shadow-sm p-2 rounded-pill border border-success"><i
                                            class="fa-solid fa-money-bill-wave ms-3 me-3"></i>{{ $pizza->price }}Ks
                                    </h3>
                                    <h3 class="mb-2 shadow-sm p-2 rounded-pill border border-success"><i
                                            class="ms-3 fa-solid fa-calendar-days me-4"></i>{{ $pizza->created_at->format('j / F / Y') }}
                                    </h3>
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
