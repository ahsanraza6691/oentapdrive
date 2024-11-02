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
                            <form id="" action="{{route('shipping.update',$shipping->id) }}" method="POST">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="city_id" value="{{ $shipping->id }}">
                                <input type="hidden" id="shipping_method_id" name="shipping_method_id" value="{{$shipping->shipping_method_id}}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Zone Name.*</label>
                                            <input class="form-control" type="text" placeholder="Enter Zone Name" data-bs-original-title="" title="" name="zone_name" value="{{$shipping->zone_name}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select City.*</label>
                                            {{-- {{dd($mul_citiest)}} --}}
                                            <select class="form-control js-example-tokenizer" name="city[]" id="city_id" multiple="multiple">
                                            @foreach ($cities as $city )
                                                <option value="{{$city->id}}"
                                                @if (count($shipping->cities) > 0)

                                                @foreach ($shipping->cities as $m_city)
                                                {{$city->city == $m_city->city_name ? 'selected' : ''}}
                                                @endforeach
                                                @endif
                                                class="form-control btn-square" >{{$city->city}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Shipping Method.*</label>
                                            <input class="form-control" type="text" placeholder="Enter Shipping Title" data-bs-original-title="" title="" name="shipping_title" value="{{$shipping->shipping_title}}" >
                                        </div>
                                    </div>
                                </div>
                                @if($shipping->shipping_method_id == 1)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label>Shipping Fee</label>
                                                <input class="form-control" type="number" placeholder="Enter Shipping Fee" data-bs-original-title="" title="" name="shipping_fee" value="{{$shipping->shipping_fee}}" >
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" id="" class="btn btn-success me-3">Add</button>
                                            <a class="btn btn-danger" href="{{route('shipping.index')}}" data-bs-original-title="" title="">Cancel</a>
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
