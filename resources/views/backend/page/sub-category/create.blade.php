@extends('backend.layout.master')
@section('page-title')
    create caetegory
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
                    <h1>Create Category</h1>
                    <div class="d-flex">
                        <a href="{{ route('category.index') }}" class="btn btn-primary"><i
                                class="fa-solid fa-angles-left"></i>
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
                        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Category name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="" id="">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- category image	 --}}

                            <div class="mb-3">
                                <label class="form-label">Category image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" class="form-control"
                                name="image" type="file" id="image">
                            </div>
                            @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="mb-3">
                                <img class="" id="newImg" width="150">
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

    @endpush
@endsection
