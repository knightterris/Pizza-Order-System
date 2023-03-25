@extends('admin.layouts.master')

@section('title', 'User List Page')
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
                                <h2 class="title-1">User List Page</h2>

                            </div>
                        </div>
                    </div>
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row my-3">
                        <div class="col">
                            <h3 class="text-dark d-flex">Search Key : <p class="text-danger mx-3"> {{ request('key') }} </p>
                            </h3>

                        </div>

                        <div class="col-4 offset-6">
                            <form action="{{ route('admin#userList') }}" method="get">
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

                    <div class="row">
                        <div class="col-2 text-center">

                            <button class="btn btn-dark text-light w-75" disabled> <i class="fa-solid fa-users me-2"></i>
                                {{ $users->total() }} </button>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2">
                            <thead>
                                <tr class="">

                                    <th class="text-center" style="font-size: 20px;">Image</th>
                                    <th class="text-center" style="font-size: 20px;">User Name</th>
                                    <th class="text-center" style="font-size: 20px;">Email</th>
                                    <th class="text-center" style="font-size: 20px;">Gender</th>
                                    <th class="text-center" style="font-size: 20px;">Phone</th>
                                    <th class="text-center" style="font-size: 20px;">Address</th>
                                    <th class="text-center" style="font-size: 20px;">Role</th>

                                    <th></th>
                                </tr>
                            </thead>

                            <tbody id="dataList">

                                @foreach ($users as $u)
                                    <tr>
                                        <td>
                                            @if ($u->image == null)
                                                @if ($u->gender == 'Male')
                                                    <img src="{{ asset('images/defaultUser.png') }}" class="rounded shadow"
                                                        style="width:200px; height:200px;">
                                                @else
                                                    <img src="{{ asset('images/defaultFemale.png') }}"
                                                        class="rounded shadow" style="width:200px; height:200px;">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $u->image) }}" class="rounded shadow"
                                                    style="width:200px; height:200px;">
                                            @endif
                                        </td>
                                        <input type="hidden" id="userId" value="{{ $u->id }}">
                                        <td class="text-center">{{ $u->name }}</td>
                                        <td class="text-center">{{ $u->email }}</td>
                                        <td class="text-center">{{ $u->gender }}</td>
                                        <td class="text-center">{{ $u->phone }}</td>
                                        <td class="text-center">{{ $u->address }}</td>
                                        <td class="text-center">
                                            <select class="form-control statusChange text-center">
                                                <option value="user" @if ($u->role == 'user') selected @endif>
                                                    User</option>
                                                <option value="admin" @if ($u->role == 'admin') selected @endif>
                                                    Admin</option>
                                            </select>
                                        </td>
                                        <td class="">
                                            <a href="{{ route('admin#delete', $u->id) }}">
                                                <button class="btn btn-outline-dark" title="Delete"><i
                                                        class="fa-solid fa-trash-can"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $users->links() }}
                            {{-- {{ $pizzas->appends(request()->query())->links() }} --}}
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
            //change status
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                // console.log($currentStatus);
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find('#userId').val();
                // console.log($userId);
                $data = {
                    'userId': $userId,
                    'role': $currentStatus
                };


                $.ajax({
                    type: 'get',
                    url: '/user/change/role',
                    data: $data,
                    dataType: 'json',
                })
                location.reload();

            })
        })
    </script>

@endsection
