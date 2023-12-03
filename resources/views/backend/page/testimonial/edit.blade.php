@extends('backend.layout.master')
@section('page-title')
    Edit caetegory
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
                        <form action="{{route('category.update', $category->slug)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Category title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$category->title?? old('title')}}" id="">
                                @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-0">
                                <div class="form-check form-switch mb-1">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="quantitySwitch2"
                                    @if ($category->is_active)
                                        checked
                                    @endif>
                                    <label class="form-check-label" for="quantitySwitch2">Active or Inactive</label>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-warning">Update</button>
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
