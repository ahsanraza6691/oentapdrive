@extends('admin_dashboard.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="form theme-form">
           
              <div class="row">
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label>Page Name</label>
                    <input class="form-control" type="text" placeholder="Page Name" data-bs-original-title="" title="">
                  </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label>Page Name</label>
                        <input class="form-control" type="text" placeholder="Page Name" data-bs-original-title="" title="">
                      </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label>Page Name</label>
                        <input class="form-control" type="text" placeholder="Page Name" data-bs-original-title="" title="">
                      </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label>Enter some Details</label>
                    <textarea class="form-control" id="exampleFormControlTextarea4" rows="3"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label>Upload project file</label>
                    <form class="dropzone dz-clickable" id="singleFileUpload" action="{{route('homecontent.store')}}">
                      <div class="dz-message needsclick">
                        <i class="icon-cloud-up"></i>
                        <h6>Drop files here or click to upload.</h6>
                        <span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div><a class="btn btn-success me-3" href="#" data-bs-original-title="" title="">Add</a><a class="btn btn-danger" href="#" data-bs-original-title="" title="">Cancel</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- <script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script> --}}
  {{-- <script src="{{asset('assets/js/dropzone/dropzone-script.js')}}"></script> --}}
@endsection
