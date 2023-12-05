@extends('backend.layout.master')
@section('page-title')
    Edit caetegory
@endsection

@section('body')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-6">
                    <h1>Edit Category</h1>
                    <div class="d-flex">
                        <a href="{{ route('category.index') }}" class="btn btn-primary"><i class="fa-solid fa-angles-left"></i>
                            Category list</a>
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
                        <form action="{{ route('sub-category.update', $sub_category->slug) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <select class="form-select mb-3" aria-label="Default select example" name="category_id">
                                    <option selected="">Select category</option>
                                    @foreach ($allCategory as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == $sub_category->category_id) selected  @endif >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sub Category name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{$sub_category->name}}" id="">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            {{-- category image	 --}}

                            <div class="mb-3">
                                <label class="form-label">Sub Category image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" class="form-control"
                                name="image" type="file" id="image">
                            </div>
                            @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="mb-3">
                                <img class="img-fluid" src="{{asset($sub_category->image ?? 'no-image.jpg')}}" id="newImg" width="150">
                            </div>


                            <div class="mt-5">
                                <button type="submit" class="btn btn-success">update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Customers List End -->
    </div>


@endsection
