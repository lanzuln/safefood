@extends('backend.layout.master')
@section('page-title')
    create product
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('body')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-6">
                    <h1>Create product</h1>
                    <div class="d-flex">
                        <a href="{{ route('product.index') }}" class="btn btn-primary"><i
                                class="fa-solid fa-angles-left"></i>
                            product list</a>
                    </div>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Customers List Start -->
        <div class="row">
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">select category</label>
                                <select class="form-select" aria-label="Default select example" name="category_id">
                                    <option>Select</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Product title</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="" id="">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- Product price  --}}
                                    <div class="mb-3">
                                        <label class="form-label">Product price</label>
                                        <input type="number" name="product_price"
                                            class="form-control @error('product_price') is-invalid @enderror" value=""
                                            id="">
                                        @error('product_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- Product code --}}
                                    <div class="mb-3">
                                        <label class="form-label">Product code</label>
                                        <input type="text" name="product_code"
                                            class="form-control @error('product_code') is-invalid @enderror" value=""
                                            id="">
                                        @error('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- Product price  --}}
                                    <div class="mb-3">
                                        <label class="form-label">Product stock</label>
                                        <input type="number" name="product_stock"
                                            class="form-control @error('product_stock') is-invalid @enderror" value=""
                                            id="">
                                        @error('product_stock')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- Product code --}}
                                    <div class="mb-3">
                                        <label class="form-label">Alert quantity</label>
                                        <input type="number" name="alert_quantity"
                                            class="form-control @error('alert_quantity') is-invalid @enderror"
                                            value="" id="" min="1">
                                        @error('alert_quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Product Short description --}}
                            <div class="mb-3">
                                <label class="form-label">Product Short description</label>
                                <textarea name="short_desc" class="form-control" id="" cols="20" rows="5"></textarea>

                            </div>
                            {{-- Product long description --}}
                            <div class="mb-3">
                                <label class="form-label">Product long description</label>
                                <textarea name="long_desc" class="form-control" id="" cols="20" rows="5"></textarea>

                            </div>
                            {{-- Product Additional info --}}
                            <div class="mb-3">
                                <label class="form-label">Product Additional info</label>
                                <textarea name="addtional_info" class="form-control" id="" cols="20" rows="5"></textarea>

                            </div>
                            {{-- product image	 --}}
                            <div class="mb-3">
                                <label class="form-label">Product image</label>
                                <input type="file" name="product_image" class="form-control dropify" id="">
                            </div>
                            {{-- multi image	 --}}
                            <div class="mb-3">
                                <label class="form-label">Product multi image</label>
                                <input type="file" name="multi_images[]" multiple class="form-control"
                                    id="multiImg">
                            </div>

                            {{-- <div class="mb-3" id="preview_img">

                            </div> --}}

                            <div class="mb-0">
                                <div class="form-check form-switch mb-1">
                                    <input type="checkbox" class="form-check-input" id="quantitySwitch2" checked="">
                                    <label class="form-check-label" for="quantitySwitch2">Active or Inactive</label>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Customers List End -->
    </div>

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
            integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                $('.dropify').dropify();
            });


        </script>
    @endpush
@endsection
