@extends('backend.layout.master')
@section('page-title')
    Edit slider
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
                    <h1>Update slider</h1>
                    <div class="d-flex">
                        <a href="{{ route('slider.index') }}" class="btn btn-primary"><i class="fa-solid fa-angles-left"></i>
                            slider list</a>
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
                        <form action="{{ route('slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-8">
                                    <!-- name  -->
                                    <div class="mb-3">
                                        <label class="form-label">Slider title</label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ $slider->title}}" id="">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Content</label>

                                                <textarea name="content" id=""class="form-control @error('content') is-invalid @enderror" cols="30" rows="10">
                                                    {{ $slider->content}}
                                                </textarea>
                                                @error('content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Video url</label>
                                                <input type="url" name="v_url"
                                                    class="form-control @error('v_url') is-invalid @enderror"
                                                    value="{{ $slider->v_url}}" id="">
                                                @error('v_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Product image</label>
                                        <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])"
                                            class="form-control" name="image" type="file">
                                    </div>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <div class="mb-3">
                                        <img class="" id="newImg" src="{{asset($slider->image ?? "no-image.jpg")}}" width="150">
                                    </div>

                                </div>
                            </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        <!-- Customers List End -->
    </div>

    @push('script')

    @endpush
@endsection
