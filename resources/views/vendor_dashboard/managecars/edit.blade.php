@extends('admin_dashboard.layouts.master')
@section('content')
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {

position: unset !important;
border-right: unset !important
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover,
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus {
background-color: #7366ff;
color: #fff;
}

/* update work 8 */
.select-dropdown,
.select-dropdown * {
position: relative;
}

.select-dropdown {
position: relative;
color: grey;

}

.select-dropdown select {
background-color: transparent;
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
color: grey;
}

.select-dropdown select:active,
.select-dropdown select:focus {
outline: none;
box-shadow: none;
color: grey;
}

.select-dropdown:after {
content: "";
position: absolute;
top: 50%;
right: 8px;
width: 0;
height: 0;
margin-top: -2px;
border-top: 5px solid #aaa;
border-right: 5px solid transparent;
border-left: 5px solid transparent;

}
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('variants.update',$variants->id) }}" method="POST">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="city_id" value="{{ $variants->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Attribute Name</label>
                                            <input class="form-control" type="text" placeholder="Enter Variant Name" data-bs-original-title="" title="" name="attribute_name" value="{{$variants->variant}}" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Attribute Value.*</label>
                                            <select class="form-control js-example-tokenizer" name="attribute_value[]"
                                            id="attribute_value" multiple="multiple" required>
                                            <option selected="selected" value="{{$variants->attribute_value}}">{{$variants->attribute_value}}</option>

                                        </select>
                                            <input class="form-control" type="text" placeholder="Enter Attribute Value" data-bs-original-title="" title="" name="variation_value" value="{{old('variation_value')}}" >
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" id="" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{route('variants.index')}}" data-bs-original-title="" title="">Cancel</a>
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
    @push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    $(".js-example-tokenizer").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
</script>
@endpush
@endsection



