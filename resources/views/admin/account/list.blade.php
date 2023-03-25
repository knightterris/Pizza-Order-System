@extends('admin.layouts.master')

@section('title', 'Admin List Page')
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
                                <h2 class="title-1">Admin List</h2>

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
                            <h3 class="text-dark d-flex">Search Key : <p class="text-danger mx-3"> {{ request('key') }}</p>
                            </h3>

                        </div>

                        <div class="col-4 offset-6">
                            <form action="{{ route('admin#list') }}" method="get">
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
                            <h2 class="text-center">
                                <i class="zmdi zmdi-accounts me-4 fs-3 text-light"></i>

                                <span class="text-light"> {{ $admin->total() }} </span>
                            </h2>
                        </div>
                    </div>

                    {{-- @if (count($categories) != 0) --}}
                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2">
                            <thead>
                                <tr class="text-center">
                                    <th></th>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Role</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow text-center">
                                        <td></td>
                                        <td>{{ $a->id }}</td>
                                        <td>
                                            @if ($a->image == null)
                                                @if ($a->gender == 'Male')
                                                    <img src="{{ asset('images/defaultUser.png') }}" class="rounded shadow"
                                                        style="width:200px; height:200px;">
                                                @else
                                                    <img src="{{ asset('images/defaultFemale.png') }}"
                                                        class="rounded shadow" style="width:200px; height:200px;">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}" class="rounded shadow"
                                                    style="width:200px; height:200px;">
                                            @endif
                                        </td>
                                        <input type="hidden" id="adminId" value="{{ $a->id }}">
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>
                                            @if (Auth::user()->id == $a->id)
                                                <span>-</span>
                                            @else
                                                <select name="" id="" class="form-control changeRole">
                                                    <option value="admin"
                                                        @if ($a->role == 'admin') selected @endif>
                                                        Admin</option>
                                                    <option value="user"
                                                        @if ($a->role == 'user') selected @endif>
                                                        User</option>
                                                </select>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="table-data-feature">


                                                {{-- <a
                                                    href="@if (Auth::user()->id == $a->id) # @else
                                                    {{ route('admin#delete') }} @endif">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a> --}}

                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                    <a href="{{ route('admin#delete', $a->id) }}">
                                                        <button class="item me-3" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('admin#changeRole', $a->id) }}">
                                                        <button class="item me-3" data-toggle="tooltip" data-placement="top"
                                                            title="Change Admin Role or See Info">
                                                            <i class="fa-solid fa-user-tag"></i>
                                                        </button>
                                                    </a>
                                                @endif

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{-- {{ $categories->links() }} --}}
                            {{ $admin->appends(request()->query())->links() }}
                        </div>

                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')

    <script>
        $(document).ready(function() {
            $('.changeRole').change(function() {
                // console.log('this is changing');
                $currentRole = $(this).val();
                // console.log($currentRole);
                $parentNode = $(this).parents("tr");
                $adminId = $parentNode.find('#adminId').val();
                // console.log($adminId);
                $data = {
                    'adminId': $adminId,
                    'role': $currentRole
                };

                $.ajax({
                    type: 'get',
                    url: '/admin/changeUser/changeRole',
                    data: $data,
                    dataType: 'json',
                })
                location.reload();
            })

        })
    </script>
@endsection
