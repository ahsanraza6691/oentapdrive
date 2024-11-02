@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('social.update',$socials->id) }}" method="POST">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Facebook</label>
                                            <input class="form-control" type="text" placeholder="Enter Your Question"
                                                data-bs-original-title="" title="" name="facebook" value="{{$socials->facebook}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Twitter</label>
                                            <input class="form-control" type="text" placeholder="Enter Your Question"
                                                data-bs-original-title="" title="" name="twitter" value="{{$socials->twitter}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Instagram</label>
                                            <input class="form-control" type="text" placeholder="Enter Your Question"
                                                data-bs-original-title="" title="" name="instagram" value="{{$socials->instagram}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Linkedin</label>
                                            <input class="form-control" type="text" placeholder="Enter Your Question"
                                                data-bs-original-title="" title="" name="linkedin" value="{{$socials->linkedin}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{ route('social.index') }}"
                                                data-bs-original-title="" title="">Cancel</a>
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
@endsection
