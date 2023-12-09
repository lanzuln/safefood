@extends('backend.layout.master')
@section('page-title')
    Create Slider
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
                    <h1>Create Slider</h1>
                    <div class="d-flex">
                        <a href="{{ route('slider.index') }}" class="btn btn-primary"><i class="fa-solid fa-angles-left"></i>
                            Slider list</a>
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
                        <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-8">
                                    <!-- name  -->
                                    <div class="mb-3">
                                        <label class="form-label">Slider title</label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}" id="">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Content</label>

                                                <textarea name="content" id=""class="form-control @error('content') is-invalid @enderror" cols="30" rows="10"></textarea>
                                                @error('content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Video url</label>
                                                <input type="url" name="v_url"
                                                    class="form-control @error('v_url') is-invalid @enderror"
                                                    value="{{ old('v_url') }}" id="">
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
                                        <img class="" id="newImg" width="150">
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
