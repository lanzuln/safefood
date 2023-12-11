@extends('backend.layout.master')
@section('page-title')
    Edit Service
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
                    <h1>Update Service</h1>
                    <div class="d-flex">
                        <a href="{{ route('service.index') }}" class="btn btn-primary"><i class="fa-solid fa-angles-left"></i>
                            Service list</a>
                    </div>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Customers List Start -->
        <div class="row">
            {{-- update without image  --}}
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('service.update', $service->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-12">

                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])"
                                        class="form-control" name="image" type="file">
                                </div>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="mb-3">
                                    <img class="" id="newImg" src="{{ asset($service->image ?? 'no-image.jpg') }}"
                                        width="150">
                                </div>


                                <!-- name  -->
                                <div class="mb-3">
                                    <label class="form-label">Service title</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ $service->title }}" id="">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <label class="form-label">Text</label>

                                <textarea name="text" id=""class="form-control @error('text') is-invalid @enderror" cols="30"
                                    rows="10">  {{ $service->text }} </textarea>
                                @error('text')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @push('script')
    @endpush
@endsection
