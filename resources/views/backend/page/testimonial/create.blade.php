@extends('backend.layout.master')
@section('page-title')
    create Testimonial
@endsection

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <a href="{{ route('testimonial.index') }}" class="btn btn-primary"><i class="fa-solid fa-angles-left"></i>
                            Testimonial list</a>
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
                        <form action="{{route('testimonial.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Client name</label>
                                <input type="text" name="client_name" class="form-control @error('client_name') is-invalid @enderror" value="{{old('client_name')}}" id="">
                                @error('client_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            {{-- client_designation	 --}}
                            <div class="mb-3">
                                <label class="form-label">Client designation</label>
                                <input type="text" name="client_designation" class="form-control @error('client_designation') is-invalid @enderror" value="{{old('client_designation')}}" id="">
                                @error('client_designation')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            {{-- Client Message  --}}
                            <div class="mb-3">
                                <label class="form-label">Client Message</label>
                                <textarea class="form-control @error('client_name') is-invalid @enderror" name="client_message" id="" cols="30" rows="10"></textarea>
                                @error('client_message')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- client_image	 --}}
                            <div class="mb-3">
                                <label class="form-label">Client designation</label>
                                <input type="file" name="client_image" class="form-control dropify" id="">
                            </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
        </script>
    @endpush
@endsection
