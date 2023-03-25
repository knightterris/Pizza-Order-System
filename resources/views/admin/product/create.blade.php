@extends('admin.layouts.master')

@section('title', 'Pizza Create Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body border border-dark">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create your Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#create') }}" enctype="multipart/form-data" method="post"
                                novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="control-label mb-2 fs-5">Name</label>
                                    <input id="" name="pizzaName" value="{{ old('pizzaName') }}" type="text"
                                        class="form-control @error('pizzaName') is-invalid
                                    @enderror mb-2 rounded-pill border border-dark "
                                        aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                    @error('pizzaName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <label for="" class="control-label mb-2 fs-5">Image</label>
                                    <input type="file" name="pizzaImage"
                                        class="form-control @error('pizzaImage')
                                        is-invalid
                                    @enderror mb-2 rounded-pill border border-dark">
                                    @error('pizzaImage')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <label for="" class="control-label mb-2 fs-5">Category</label>
                                    <select name="pizzaCategory"
                                        class="form-control @error('pizzaCategory')
                                        is-invalid
                                    @enderror mb-2 rounded-pill border border-dark">
                                        <option value="">Choose A Category &darr;</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCategory')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <label for="" class="control-label mb-2 fs-5">Description</label>
                                    <textarea name="pizzaDescription" cols="30" rows="5"
                                        class="form-control @error('pizzaDescription')
                                        is-invalid
                                    @enderror mb-2 rounded border border-dark"
                                        placeholder="Your Pizza Description Goes Here....">{{ old('pizzaDescription') }}</textarea>
                                    @error('pizzaDescription')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <label for="" class="control-label mb-2 fs-5">Waiting Time</label>
                                    <input id="" name="pizzaWaitingTime" value="{{ old('pizzaWaitingTime') }}"
                                        type="number"
                                        class="form-control @error('pizzaWaitingTime') is-invalid
                                    @enderror mb-2 rounded-pill border border-dark "
                                        aria-required="true" aria-invalid="false" placeholder="Waiting time...">
                                    @error('pizzaWaitingTime')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <label for="" class="control-label mb-2 fs-5">Price</label>
                                    <input id="" name="pizzaPrice" value="{{ old('pizzaPrice') }}" type="number"
                                        class="form-control @error('pizzaPrice')
                                        is-invalid
                                    @enderror mb-2 rounded-pill border border-dark"
                                        aria-required="true" aria-invalid="false" placeholder="Eg. 10000...">
                                    @error('pizzaPrice')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit"
                                        class="btn btn-lg btn-info btn-block rounded-pill border border-dark">
                                        <span id="payment-button-amount">Create Pizza</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-cookie"></i>
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
