@extends('backend.layout.master')
@section('page-title')
    Create service
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
                    <h1>Create service</h1>
                    <div class="d-flex">
                        <a href="{{ route('service.index') }}" class="btn btn-primary"><i class="fa-solid fa-angles-left"></i>
                            service list</a>
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
                        <form action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">




                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Service image</label>
                                        <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])"
                                             class="form-control" name="image" type="file" accept="image/jpeg, image/png, image/gif, image/webp">

                                    </div>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="mb-3">
                                        <img class="" id="newImg" width="150">
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <!-- name  -->
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}" id="">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <!-- name  -->
                                    <div class="mb-3">
                                        <label class="form-label">Text</label>
                                        <input type="text" name="text"
                                            class="form-control @error('text') is-invalid @enderror"
                                            value="{{ old('text') }}" id="">
                                        @error('text')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

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

    </div>


@endsection
