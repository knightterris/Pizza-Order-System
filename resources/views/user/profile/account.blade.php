@extends('user.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1 mt-5">
                    <div class="card rounded border border-dark">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">User Account</h3>
                            </div>
                            <hr>
                            @if (session('updateSuccess'))
                                <div class="col-5 offset-6">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session('updateSuccess') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('user#accoutChange', Auth::user()->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row p-3">
                                    <div class="col-4 ">


                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'Male')
                                                <img src="{{ asset('images/defaultUser.png') }}" class="rounded shadow"
                                                    style="width:500px; height:500px;">
                                            @else
                                                <img src="{{ asset('images/defaultFemale.png') }}" class="rounded shadow"
                                                    style="width:500px; height:500px;">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded"
                                                style="width:500px; height:500px;">
                                        @endif
                                        <input type="file"
                                            class="form-control rounded-pill @error('image')
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
                                            <input id="" name="name"
                                                value="{{ old('name', Auth::user()->name) }}" type="text"
                                                class="form-control @error('name')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark"
                                                aria-required="true" aria-invalid="false" placeholder="New Name...">
                                        </div>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Email</label>
                                            <input id="" name="email"
                                                value="{{ old('email', Auth::user()->email) }}" type="text"
                                                class="form-control @error('email')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark"
                                                aria-required="true" aria-invalid="false" placeholder="New Email...">

                                        </div>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Address</label>
                                            <input id="" name="address"
                                                value="{{ old('address', Auth::user()->address) }}" type="text"
                                                class="form-control @error('address')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark"
                                                aria-required="true" aria-invalid="false" placeholder="New Address...">

                                        </div>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Gender</label>
                                            <select name="gender"
                                                class="form-control @error('gender')
                                                    is-invalid
                                                @enderror border border-dark rounded-pill shadow-sm">
                                                <option value="">Choose Gender</option>
                                                <option value="Male" @if (Auth::user()->gender == 'Male') selected @endif>
                                                    Male</option>
                                                <option value="Female" @if (Auth::user()->gender == 'Female') selected @endif>
                                                    Female</option>
                                            </select>

                                        </div>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Phone</label>
                                            <input id="" name="phone"
                                                value="{{ old('phone', Auth::user()->phone) }}" type="number"
                                                class="form-control @error('phone')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark "
                                                aria-required="true" aria-invalid="false" placeholder="New Phone Number...">

                                        </div>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Role</label>
                                            <input id="" name=""
                                                value="{{ old('role', Auth::user()->role) }}" type=""
                                                class="form-control rounded-pill shadow-sm border border-dark "
                                                aria-required="true" aria-invalid="false" disabled>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 offset-3 text-center">

                                        <button class="btn btn-outline-dark rounded-pill shadow-sm my-3"
                                            type="submit">Update
                                            Your
                                            Profile<i class="fa-solid fa-circle-check ms-3"></i></button>

                                    </div>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
