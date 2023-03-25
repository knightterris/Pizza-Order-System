@extends('user.layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by Category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="bg-dark p-3  d-flex align-items-center justify-content-between mb-3">
                            {{-- <input type="checkbox" class="custom-control-input" checked id="price-all"> --}}
                            <label class="mt-2 fs-4" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal fs-3">{{ count($category) }}</span>
                        </div>
                        <div class="  d-flex align-items-center justify-content-between mb-3">

                            <a href="{{ route('user#home') }} "><label class="text-dark" for="price-1">
                                    All</label></a>

                        </div>

                        @foreach ($category as $c)
                            <div class="  d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('user#filter', $c->id) }} "><label class="text-dark" for="price-1">
                                        {{ $c->name }}</label></a>
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                {{-- <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button> --}}

                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-outline-dark position-relative me-3">
                                        <i class="fa-solid fa-cart-shopping me-2"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}

                                        </span>

                                    </button>
                                </a>


                                <a href="{{ route('user#history') }}">
                                    <button type="button" class="btn btn-outline-dark position-relative me-3">
                                        <i class="fa-solid fa-clock-rotate-left me-2"></i>
                                        Check Your Order Status
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($history) }}

                                        </span>

                                    </button>
                                </a>

                                <a href="{{ route('user#contactPage') }}">
                                    <button class="btn btn-outline-dark">
                                        <i class="fa-solid fa-file-signature me-2"></i>Contact</button>
                                </a>

                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" class="form-control" id="sortingOption">
                                        <option value="">Choose Option</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Shop Start -->
                    @if (session('messageSent'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('messageSent') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <span class="row" id="dataList">
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="myForm">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}"
                                                style="height:400px;">
                                            <div class="product-action">
                                                {{-- <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a> --}}


                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetails', $p->id) }}"><i
                                                        class="fa-solid fa-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} kyats</h5>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center fs-4 col-6 offset-3 mt-5 text-dark">There is no such kind of Pizza. <i
                                    class="fa-solid fa-face-sad-tear ms-3"></i></p>
                        @endif

                    </span>
                    <div class="">
                        {{-- {{ $pizza->links() }} --}}
                        {{-- {{ $pizza->appends(request()->query())->links() }} --}}
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                // console.log('changing');
                $eventOption = $('#sortingOption').val();
                // console.log($eventOption);

                if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response)
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`)
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="myForm">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                                    style="height:400px;">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                            class="fa fa-shopping-cart"></i></a>


                                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                            class="fa-solid fa-info"></i></a>
                                                </div>
                                            </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i] . price} kyats</h5>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            // console.log($list);
                            $('#dataList').html($list);
                        }
                    })
                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response)
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`)
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="myForm">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                                    style="height:400px;">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                            class="fa fa-shopping-cart"></i></a>


                                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                            class="fa-solid fa-info"></i></a>
                                                </div>
                                            </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5> ${response[$i].price} kyats</h5>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            // console.log($list);
                            $('#dataList').html($list);
                        }
                    })
                }
            })
        });
    </script>
@endsection
