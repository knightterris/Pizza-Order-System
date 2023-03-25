@extends('admin.layouts.master')

@section('title', 'Product List Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Pizza List Page</h2>

                            </div>
                        </div>

                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small rounded-pill">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small rounded-pill">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col">
                            <h3 class="text-dark d-flex">Search Key : <p class="text-danger mx-3">{{ request('key') }}</p>
                            </h3>

                        </div>

                        <div class="col-3 offset-6">
                            <form action="{{ route('product#list') }}" method="get">
                                @csrf
                                <div class=" d-flex">
                                    <input type="text" name="key" class="form-control rounded-pill"
                                        placeholder="Search Pizza...." value="{{ request('key') }}">
                                    <button type="submit" class="btn btn-outline-dark rounded-circle shadow-sm">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (session('createSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('createSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif


                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('updatePizzaSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('updatePizzaSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-2 p-2 my-3 shadow-sm bg-secondary rounded-pill">
                            <h2 class="text-center">
                                <i class="fa-solid fa-pizza-slice me-4" style="color:rgb(219,162,74)"></i>
                                <span style="color:rgb(255, 172, 40)">{{ $pizzas->total() }}</span>
                            </h2>
                        </div>
                    </div>


                    @if (session('deletePizzaSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('deletePizzaSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif


                    @if (count($pizzas) != 0)

                        <div class="table-responsive table-responsive-data2 ">
                            <table class="table table-data2">
                                <thead>
                                    <tr class="">

                                        <th class="text-center" style="font-size: 20px;">Pizza Image</th>
                                        <th class="text-center" style="font-size: 20px;">Pizza Name</th>
                                        <th class="text-center" style="font-size: 20px;">Category Name</th>
                                        <th class="text-center" style="font-size: 20px;">Price</th>
                                        <th class="text-center" style="font-size: 20px;">View Count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pizzas as $p)
                                        <tr class="tr-shadow text-center">

                                            <td><img src="{{ asset('storage/' . $p->image) }}"
                                                    class="rounded shadow"style="width:300px; height:200px;"></td>
                                            <td style="font-size: 20px;">{{ $p->name }}</td>
                                            <td style="font-size: 20px;">{{ $p->category_name }}</td>
                                            <td style="font-size: 20px;">{{ $p->price }}</td>
                                            <td style="font-size: 20px;">{{ $p->view_count }}</td>


                                            <td class=" ">
                                                <div class="table-data-feature ">

                                                    <a href="{{ route('product#edit', $p->id) }}">
                                                        <button class="item me-3" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#updatePage', $p->id) }}">
                                                        <button class="item me-3" data-toggle="tooltip" data-placement="top"
                                                            title="Update">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                            <td></td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{-- {{ $pizzas->links() }} --}}
                                {{ $pizzas->appends(request()->query())->links() }}
                            </div>

                        </div>
                    @else
                        <h2 class="text-center text-danger mt-5">There is no such kind of pizza here!!!<i
                                class="fa-solid fa-face-sad-tear ms-2"></i></h2>

                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
