@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{ route('portfolio.update', $portfolio->id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="portfolio_id" value="{{ $portfolio->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Service.*</label>
                                            <select name="type" for="exampleFormControlInput10"
                                                class="form-control btn-square type" id="service">
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}"
                                                        {{ $service->id == $portfolio->id ? 'selected' : '' }}
                                                        class="form-control btn-square" id="exampleFormControlInput10">
                                                        {{ $service->service_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if ($portfolio->image)
                                    <img src="{{ url('public/portfolio/' . $portfolio->image) }}" alt=""
                                        width="100px" height="100px">
                                @else
                                    <img src="{{ url('public/portfolio/no-image.jpg') }}" alt="" width="100px"
                                        height="100px">
                                @endif
                                <div class="row" id="image">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Image</label>
                                            <input type="file" class="form-control" data-bs-original-title=""
                                                title="" name="image">
                                        </div>
                                    </div>
                                </div>

                                @if ($portfolio->image_thumbnail)
                                    <img src="{{ url('public/portfolio/' . $portfolio->image_thumbnail) }}" alt=""
                                        width="100px" height="100px">
                                @else
                                    <img src="{{ url('public/portfolio/no-image.jpg') }}" alt="" width="100px"
                                        height="100px">
                                @endif
                                <div class="row" id="image_thumbnail">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="">Thumbnail Image</label>
                                            <input type="file" class="form-control" type="file"
                                                data-bs-original-title="" title="" name="image_thumbnail">
                                        </div>
                                    </div>
                                </div>
                                <video width="200" height="150" controls>
                                    <source src="{{ url('public/portfolio/' . $portfolio->video) }}" type="video/mp4">
                                </video>
                                <div class="row" style="" id="video">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="">Video</label>
                                            <input class="form-control" type="file" data-bs-original-title=""
                                                title="" name="video">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{ route('portfolio.index') }}"
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
