@extends('admin.layouts.master')

@section('title', 'Update Pizza')
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
                                <h3 class="text-center title-2 mb-5">Update Pizza</h3>
                            </div>
                            <hr>

                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row p-3">
                                    <div class="col-4 ">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                        {{-- <input type="hidden" name="pizzaCategory" value="{{ $pizza->category_id }}"> --}}
                                        <img src="{{ asset('storage/' . $pizza->image) }}" class="shadow mt-3 rounded"
                                            style="width:600px; height:400px;">

                                        <input type="file"
                                            class="form-control rounded-pill @error('pizzaImage') is-invalid @enderror mt-3 shadow border border-dark"
                                            name="pizzaImage">
                                        @error('pizzaImage')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>

                                    <div class="col mt-3">
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Name</label>
                                            <input id="" name="pizzaName"
                                                value="{{ old('pizzaName', $pizza->name) }}" type="text"
                                                class="form-control @error('pizzaName')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark"
                                                aria-required="true" aria-invalid="false" placeholder="New Name...">
                                        </div>
                                        @error('pizzaName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror


                                        {{-- <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Category</label>
                                            <select name="pizzaCategory"
                                                class="form-control @error('pizzaCategory')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark">
                                                <option value="">Choose Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->category_id }}"
                                                        @if ($pizza->category_id == $c->id) selected @endif>
                                                        {{ $c->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        @error('pizzaCategory')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror --}}

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Category</label>
                                            <select name="pizzaCategory"
                                                class="form-control shadow-sm border border-dark rounded-pill @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose Pizza Category....</option>

                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}"
                                                        @if ($pizza->category_id == $c->id) selected @endif>
                                                        {{ $c->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        @error('pizzaCategory')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror


                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Description</label>

                                            <textarea name="pizzaDescription" id="" cols="30" rows="10" type="text"
                                                class="form-control @error('pizzaDescription')
                                                    is-invalid
                                                @enderror rounded shadow-sm border border-dark"
                                                aria-required="true" aria-invalid="false" placeholder="New pizzaDescription...">{{ $pizza->description }}</textarea>

                                        </div>
                                        @error('pizzaDescription')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Waiting Time</label>
                                            <input id="" name="pizzaWaitingTime"
                                                value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}" type="number"
                                                class="form-control @error('pizzaWaitingTime')
                                                    is-invalid
                                                @enderror rounded-pill shadow-sm border border-dark"
                                                aria-required="true" aria-invalid="false" placeholder="New waiting time...">

                                        </div>
                                        @error('pizzaWaitingTime')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">Price</label>
                                            <input id="" name="pizzaPrice"
                                                value="{{ old('role', $pizza->price) }}" type="number"
                                                class="form-control @error('pizzaPrice') is-invalid @enderror rounded-pill shadow-sm border border-dark "
                                                aria-required="true" aria-invalid="false">

                                        </div>
                                        @error('pizzaPrice')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1 fs-5">View Count</label>
                                            <input id="" name="viewCount"
                                                value="{{ old('viewCount', $pizza->view_count) }}" type="number"
                                                class="form-control rounded-pill shadow-sm border border-dark "
                                                aria-required="true" aria-invalid="false" placeholder="New view_count ..."
                                                disabled>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 offset-3 text-center">

                                        <button class="btn btn-outline-dark rounded-pill shadow-sm my-3"
                                            type="submit">Update
                                            Your
                                            Pizza<i class="fa-solid fa-circle-check ms-3"></i></button>

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
