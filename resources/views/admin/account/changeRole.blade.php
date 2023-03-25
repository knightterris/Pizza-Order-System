@extends('admin.layouts.master')

@section('title', 'Role Change Page')
@section('content')

    <!-- MAIN CONTENT-->

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1 mt-5">
                    <div class="card rounded border border-dark">
                        <div class="card-body">
                            <div class="card-title">
                                <i class="fa-solid fa-backward d-flex ms-3 mt-3 fs-5" onclick="history.back()"></i>
                                <h3 class="text-center title-2">Role Change </h3>
                            </div>
                            <hr>

                            <form action="{{ route('admin#change', $account->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row p-3">
                                    <div class="col-4 ">


                                        @if ($account->image == null)
                                            @if ($account->gender == 'Male')
                                                <img src="{{ asset('images/defaultUser.png') }}" class="rounded shadow">
                                            @else
                                                <img src="{{ asset('images/defaultFemale.png') }}" class="rounded shadow">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}" class="rounded">
                                        @endif
                                        <input type="file" disabled
                                            class="form-control @error('image')
                                                    is-invalid
                                                @enderror mt-3 shadow border border-dark"
                                            name="image">
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>

                                    <div class="col mt-3">
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Name</label>
                                            <input id="" name="name" value="{{ old('name', $account->name) }}"
                                                type="text"
                                                class="form-control @error('name')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark"
                                                aria-required="true" aria-invalid="false" disabled
                                                placeholder="New Name...">
                                        </div>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Email</label>
                                            <input id="" name="email" value="{{ old('email', $account->email) }}"
                                                type="text"
                                                class="form-control @error('email')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark"
                                                aria-required="true" aria-invalid="false" disabled
                                                placeholder="New Email...">

                                        </div>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Address</label>
                                            <input id="" name="address"
                                                value="{{ old('address', $account->address) }}" type="text"
                                                class="form-control @error('address')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark"
                                                aria-required="true" aria-invalid="false" disabled
                                                placeholder="New Address...">

                                        </div>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Gender</label>
                                            <select name="gender" disabled
                                                class="form-control @error('gender')
                                                    is-invalid
                                                @enderror border border-dark rounded-pill shadow-sm ">
                                                <option value="">Choose Gender</option>
                                                <option value="Male" @if ($account->gender == 'Male') selected @endif>
                                                    Male</option>
                                                <option value="Female" @if ($account->gender == 'Female') selected @endif>
                                                    Female</option>
                                            </select>

                                        </div>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Phone</label>
                                            <input id="" name="phone"
                                                value="{{ old('phone', $account->phone) }}" type="number"
                                                class="form-control @error('phone')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark "
                                                aria-required="true" aria-invalid="false" disabled
                                                placeholder="New Phone Number...">

                                        </div>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Role</label>
                                            {{-- <input id="" name="" value="{{ old('role', $account->role) }}"
                                                type=""
                                                class="form-control rounded-pill shadow-sm border border-dark "
                                                aria-required="true" aria-invalid="false"> --}}
                                            <select name="role"
                                                class="form-control rounded-pill shadow-sm border border-dark">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>
                                                    Admin</option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>
                                                    User</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 offset-3 text-center">

                                        <button class="btn btn-outline-dark rounded-pill shadow-sm my-3"
                                            type="submit">Change<i class="fa-solid fa-circle-check ms-3"></i></button>

                                    </div>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
