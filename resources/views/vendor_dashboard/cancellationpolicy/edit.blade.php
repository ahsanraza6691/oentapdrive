@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('cancellation-policy.update',$edit_policy->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Cancellation Reason</label>
                                            <input class="form-control" type="text" placeholder="Enter Title name" data-bs-original-title="" title="" name="reason" value="{{$edit_policy->reason ?? ''}}" required>
                                        </div>
                                    </div>
                                </div>
                                @if($edit_policy->id == 1)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="">Cancellation Policy</label>
                                            <textarea class="form-control editor" name="cancellation_policy" id="" cols="30" rows="10" required>{{ $edit_policy->cancellation_policy ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{ route('cancellation-policy.index') }}"
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
    @push('scripts')
<script>
    $("input[type='file']").on("change", function () {
        if(this.files[0].size > 3000000) {
            toastr.error("Please Upload file less than 3 Mb")
            $(this).val('');
        }
    });
    </script>
@endpush
@endsection
