@extends('admin.layouts.master')

@section('title', 'Category List Page')
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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>

                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small rounded-pill">
                                    <i class="zmdi zmdi-plus"></i>add category
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

                        <div class="col-4 offset-6">
                            <form action="{{ route('category#list') }}" method="get">
                                @csrf
                                <div class=" d-flex">
                                    <input type="text" name="key" class="form-control rounded-pill"
                                        placeholder="Search category" value="{{ request('key') }}">
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

                    @if (session('updateSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('updateSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-2 p-2 my-3 shadow-sm bg-secondary rounded-pill">
                            <h2>
                                <i class="fa-solid fa-pizza-slice me-4" style="color:rgb(219,162,74)"></i>
                                <span style="color:#ffac28">{{ $categories->total() }}</span>
                            </h2>
                        </div>
                    </div>

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2 ">
                            <table class="table table-data2">
                                <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                        {{-- <th>date</th>
                                    <th>status</th>
                                    <th>price</th> --}}
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow text-center">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>

                                            <td>
                                                <div class="table-data-feature">

                                                    <a href="{{ route('category#edit', $category->id) }}">
                                                        <button class="item me-3" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{-- {{ $categories->links() }} --}}
                                {{ $categories->appends(request()->query())->links() }}
                            </div>

                        </div>
                    @else
                        <h1 class="text-center text-secondary mt-5">There is no category here!!!</h1>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
