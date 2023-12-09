@extends('backend.layout.master')
@section('page-title')
    create product
@endsection

@push('style')
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
                        <a href="{{ route('product.index') }}" class="btn btn-primary"><i class="fa-solid fa-angles-left"></i>
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

                            <div class="row">
                                <div class="col-md-8">
                                    <!-- name  -->
                                    <div class="mb-3">
                                        <label class="form-label">Product name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" id="">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Real price</label>
                                                <input type="number" name="real_price"
                                                    class="form-control @error('real_price') is-invalid @enderror"
                                                    value="{{ old('real_price') }}" id="">
                                                @error('real_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Sale price</label>
                                                <input type="number" name="sale_price"
                                                    class="form-control @error('sale_price') is-invalid @enderror"
                                                    value="{{ old('sale_price') }}" id="">
                                                @error('sale_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" name="qty"
                                                    class="form-control @error('qty') is-invalid @enderror"
                                                    value="{{ old('qty') }}" id="">
                                                @error('qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Weight</label>
                                                <input type="number" name="weight"
                                                    class="form-control @error('weight') is-invalid @enderror"
                                                    value="{{ old('weight') }}" id="">
                                                @error('weight')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Unique code</label>
                                                <input type="text" name="u_code"
                                                    class="form-control @error('u_code') is-invalid @enderror"
                                                    value="{{ old('u_code') }}" id="">
                                                @error('u_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Product short description</label>
                                        <textarea name="short_desc" class="form-control" id="" cols="20" rows="5">{{ old('short_desc') }}</textarea>

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Product long description</label>
                                        <textarea name="long_desc" class="form-control" id="summernote" cols="20" rows="5">{{ old('long_desc') }}</textarea>

                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Select category</label>
                                        <select name="category_id" id="category_id_select"
                                            class="form-select @error('category_id') is-invalid @enderror"
                                            value="{{ old('category_id') }}">

                                            <option>Select</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Select sub category</label>
                                        <select name="sub_category_id" id="sub_category_id_select" class="form-select"
                                            value="{{ old('sub_category_id') }}">
                                            <option>Select Category first</option>



                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Product image</label>
                                        <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])"
                                            class="form-control" name="image" type="file">
                                    </div>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <div class="mb-3">
                                        <img class="" id="newImg" width="150">
                                    </div>

                                    {{-- multi image --}}
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Main Thumbnail</label>
                                        <input oninput="displayThumbnails(this)" class="form-control"
                                            name="multi_image[]" multiple="" type="file">
                                    </div>

                                    <div class="mb-3">
                                        <div id="thumbnailContainer"></div>
                                    </div>

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
        <script>
            function displayThumbnails(input) {
                var thumbnailContainer = document.getElementById('thumbnailContainer');
                thumbnailContainer.innerHTML = ''; // Clear previous thumbnails

                for (var i = 0; i < input.files.length; i++) {
                    var newImg = document.createElement('img');
                    newImg.src = window.URL.createObjectURL(input.files[i]);
                    newImg.width = 120;
                    thumbnailContainer.appendChild(newImg);
                }
            }
        </script>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 300,
                });

                // sub category ajax call


                $('#category_id_select').on('change', function() {
                    var category_id_select = $(this).val();
                    if (category_id_select) {
                        $.ajax({
                            url: "{{ url('admin/subcategory/ajax') }}/" + category_id_select,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {

                                var d = $('#sub_category_id_select').empty();
                                $.each(data, function(key, value) {
                                    d.append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            },
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
