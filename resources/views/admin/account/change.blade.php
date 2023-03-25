@extends('admin.layouts.master')

@section('title', 'Password Change Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div> --}}
                <div class="col-lg-6 offset-3 mt-5">
                    <div class="card rounded border border-dark">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change your Password</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Old Password</label>
                                    <input id="" name="oldPassword" value="" type="password"
                                        class="form-control @if (session('notMatch')) is-invalid @endif rounded-pill shadow border border-dark
                                    @error('oldPassword')
                                        is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Old Password...">
                                    @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @if (session('notMatch'))
                                        <div class="invalid-feedback">
                                            {{ session('notMatch') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label mb-1">New Password</label>
                                    <input id="" name="newPassword" value="" type="password"
                                        class="form-control rounded-pill shadow border border-dark @error('newPassword')
                                        is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="New Password...">
                                    @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Confirm New Password</label>
                                    <input id="" name="confirmPassword" value="" type="password"
                                        class="form-control rounded-pill shadow border border-dark @error('confirmPassword')
                                        is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Confirm New Password...">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit"
                                        class="btn btn-lg btn-info btn-block rounded-pill shadow border border-dark my-3">
                                        <span id="payment-button-amount">Change Password</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-check"></i>
                                    </button>
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
