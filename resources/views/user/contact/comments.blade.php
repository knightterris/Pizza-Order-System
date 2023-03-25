@extends('user.layouts.master')

@section('content')
    <div class="alert alert-warning alert-dismissible fade show col-6 offset-3" role="alert">
        <strong>Hello! We are "My Shop" Admin Team.</strong> You can write comments(complaints, advice messages and
        reviews...etc.)here. Also you can rate our service with your comments. Thank you for your interest in our shop and
        products. <br>
        <strong>Yours Lovingly, <br> "My Shop" Admin Team.</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <div class="row">
        <div class="col-6 offset-3 mt-5">
            <div class="card rounded border border-dark">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Write your Comment</h3>
                    </div>
                    <hr>
                    <form action="{{ route('user#contact') }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label for="" class="control-label mb-1">User Name</label>
                            <input id="" name="name" value="" type="text"
                                class="form-control @if (session('notMatch')) is-invalid @endif rounded-pill shadow border border-dark
                                    @error('name')
                                        is-invalid
                                    @enderror"
                                aria-required="true" aria-invalid="false" placeholder="Your Name...">
                            @error('name')
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
                            <label for="" class="control-label mb-1">Email</label>
                            <input id="" name="email" value="" type="text"
                                class="form-control rounded-pill shadow border border-dark @error('email')
                                        is-invalid
                                    @enderror"
                                aria-required="true" aria-invalid="false" placeholder="Your Email...">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label mb-1">Phone</label>
                            <input id="" name="phone" value="" type="number"
                                class="form-control rounded-pill shadow border border-dark @error('phone')
                                        is-invalid
                                    @enderror"
                                aria-required="true" aria-invalid="false" placeholder="Your phone...">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label mb-2 fs-5">Message</label>
                            <textarea name="message" cols="30" rows="10"
                                class="form-control @error('message')
                                        is-invalid
                                    @enderror mb-2 rounded border border-dark"
                                placeholder="Your Pizza Description Goes Here....">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button id="payment-button" type="submit"
                                class="btn btn-lg btn-secondary btn-block rounded-pill shadow border border-dark my-3">
                                <span id="payment-button-amount">Submit Your Message</span>
                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                <i class="fa-regular fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
