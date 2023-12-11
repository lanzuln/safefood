@extends('backend.layout.master')
@section('page-title')
    Edit About
@endsection

@push('style')
@endpush

@section('body')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">

            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Customers List Start -->
        <div class="row">

                {{-- update without image  --}}
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('updateFontendAbout') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $frontendAbout->id }}">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ $frontendAbout->title }}" id="">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Content</label>

                                        <textarea name="content"  cols="30" rows="10" id="summernote">
                                            {{ $frontendAbout->content }}
                                        </textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $frontendAbout->name }}" id="">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- designation  --}}
                                    <div class="mb-3">
                                        <label class="form-label">Designation</label>
                                        <input type="text" name="designation"
                                            class="form-control @error('designation') is-invalid @enderror"
                                            value="{{ $frontendAbout->designation }}" id="">
                                        @error('designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- Admin image  --}}
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label">Admin image</label>
                                            <input oninput="AImg.src=window.URL.createObjectURL(this.files[0])"
                                                class="form-control" name="avator" type="file">
                                        </div>

                                        @error('avator')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="mb-3">
                                            <img class="" id="AImg"
                                                src="{{ asset($frontendAbout->avator ?? 'no-image.jpg') }}" width="150">
                                        </div>


                                    </div>

                                    {{-- Admin signatire  --}}
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label">Admin Signature</label>
                                            <input oninput="sImg.src=window.URL.createObjectURL(this.files[0])"
                                                class="form-control" name="signature" type="file">
                                        </div>
                                        @error('signature')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                        <div class="mb-3">
                                            <img class="" id="sImg"
                                            src="{{ asset($frontendAbout->signature ?? 'no-image.jpg') }}" width="150">
                                        </div>

                                    </div>
                                         {{-- Banner  --}}
                                         <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Banner</label>
                                                <input oninput="bImg.src=window.URL.createObjectURL(this.files[0])"
                                                    class="form-control" name="banner" type="file">
                                            </div>
                                            @error('banner')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                            <div class="mb-3">
                                                <img class="" id="bImg"
                                                src="{{ asset($frontendAbout->banner ?? 'no-image.jpg') }}" width="150">
                                            </div>

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
