@extends('admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form id="" action="{{route('service.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Service Name</label>
                                        <input class="form-control" type="text" placeholder="Enter Your Facebook" data-bs-original-title="" title="" name="service_name">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Twitter</label>
                                        <input class="form-control" type="text" placeholder="Enter Your Twitter" data-bs-original-title="" title="" name="twitter">
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Instagram</label>
                                        <input class="form-control" type="text" placeholder="Enter Your Instagram" data-bs-original-title="" title="" name="instagram">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Linkedin</label>
                                        <input class="form-control" type="text" placeholder="Enter Your Linkedin" data-bs-original-title="" title="" name="linkedin">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <button type="submit" id="" class="btn btn-success me-3">Add</button>
                                        <a class="btn btn-danger" href="{{route('social.index')}}" data-bs-original-title="" title="">Cancel</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- {{-- script start --}} -->


@push('scripts')
@if($errors->any())
    @foreach($errors->all() as $error)
    <script>
        toastr.error('{{$error}}');
    </script>
    @endforeach
    @endif

    @endpush

@endsection

