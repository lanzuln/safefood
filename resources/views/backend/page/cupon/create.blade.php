@extends('backend.layout.master')
@section('page-title')
    create cupon
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
                    <h1>Create cupon</h1>
                    <div class="d-flex">
                        <a href="{{ route('coupne.index') }}" class="btn btn-primary"><i class="fa-solid fa-angles-left"></i>
                            cupon list</a>
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
                        <form action="{{route('coupne.store')}}" method="post">
                            @csrf
                            {{-- coupon name --}}
                            <div class="mb-3">
                                <label class="form-label">Coupon name</label>
                                <input type="text" name="coupne_name" class="form-control" value="" id="">
                                @error('coupne_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            {{-- Discount percentage --}}
                            <div class="mb-3">
                                <label class="form-label">Discount percentage</label>
                                <input type="number" name="discount_amount" class="form-control" value="" id="">
                                @error('discount_amount')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            {{-- Minimum purchase --}}
                            <div class="mb-3">
                                <label class="form-label">Minimum purchase</label>
                                <input type="number" name="minimum_purchase" class="form-control" value="0" id="" min="0">
                                @error('minimum_purchase')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                             {{-- expire date] --}}
                             <div class="mb-3">
                                <label class="form-label">Expire date</label>
                                <input type="date" name="expire" class="form-control" value="" id="">
                                @error('expire')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
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
