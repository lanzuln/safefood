@extends('backend.layout.master')
@section('page-title')
    Edit product
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
                    <h1>Update product</h1>
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
            <div class="col-6 mb-5">
                {{-- update without image  --}}
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('product.update', $product->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="{{ $product->id }}">

                            <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Select category</label>
                                        <select name="category_id" id="category_id_select" class="form-select"
                                            value="{{ old('category_id') }}">

                                            <option>Select</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}"
                                                    @if ($item->id == $product->category_id) selected @endif>{{ $item->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Select sub category</label>
                                        <select name="sub_category_id" id="sub_category_id_select" class="form-select"
                                            value="{{ old('sub_category_id') }}">
                                            <option>Select Category first</option>

                                            @foreach ($sub_category as $item)
                                                <option value="{{ $item->id }}"
                                                    @if ($item->id == $product->sub_category_id) selected @endif>{{ $item->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <!-- name  -->
                                    <div class="mb-3">
                                        <label class="form-label">Product name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $product->name }}" id="">
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
                                                    value="{{ $product->real_price }}" id="">
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
                                                    value="{{ $product->sale_price }}" id="">
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
                                                    value="{{ $product->qty }}" id="">
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
                                                    value="{{ $product->weight }}" id="">
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
                                                    value="{{ $product->u_code }}" id="">
                                                @error('u_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Product short description</label>
                                        <textarea name="short_desc" class="form-control" id="" cols="20" rows="5">{{ $product->short_desc }}</textarea>

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Product long description</label>
                                        <textarea name="long_desc" class="form-control" id="summernote" cols="20" rows="5">{{ $product->long_desc }}</textarea>

                                    </div>


                            </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                {{-- thumbnail image update  --}}
                <div class="card mb-5">
                    <div class="card-body">
                        <form action="{{ route('update.thambnail') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="old_img" value="{{ $product->image }}">

                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Product image</label>
                                    <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])"
                                        class="form-control" name="image" type="file">
                                </div>

                                <div class="mb-3">
                                    <img class="" id="newImg" src="{{asset($product->image ?? 'no-image.jpg')}}" width="150">
                                </div>

                            </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-success">Update Thumbnail</button>
                            </div>
                        </form>
                    </div>
                </div>


                {{-- multi image update  --}}
                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Change Image </th>
                                    <th scope="col">Delete </th>
                                </tr>
                            </thead>
                            <tbody>

                                <form method="post" action="{{ route('update.multiimage') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    @foreach ($multiImgs as $key => $img)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td> <img src="{{ asset($img->multi_image ?? 'no-image.jpg') }}" class="img-fluid" style="width:70px; height: auto; object-ft:cover"> </td>
                                            <td><input
                                                    oninput="newImg_{{ $img->id }}.src=window.URL.createObjectURL(this.files[0])"
                                                    class="form-control" name="multi_img[{{ $img->id }}]" type="file"
                                                    id="">
                                                <img class="" id="newImg_{{ $img->id }}" width="100">

                                            <td>
                                                <span style="display: inline-block"> <input type="submit" class="btn btn-primary px-4" value="Update" /></span>
                                                <span style="display: inline-block"><a href="{{ route('multiimg.delete', $img->id) }}" class="btn btn-danger"
                                                    id="delete"> Delete </a></span>


                                            </td>
                                        </tr>
                                    @endforeach

                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Customers List End -->
    </div>

    @push('script')
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
                                console.log(data)
                                var d = $('#sub_category_id_select').empty();
                                $.each(data, function(key, value) {
                                    d.append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                });
                            },
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
