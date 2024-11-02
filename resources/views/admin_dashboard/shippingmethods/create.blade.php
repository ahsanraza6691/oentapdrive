@extends('admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form id="" action="{{route('shipping-method.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Shipping Title.*</label>
                                        <input class="form-control" type="text" placeholder="Enter Shipping Title" data-bs-original-title="" title="" name="shipping_title" value="{{old('shipping_title')}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Shipping Fee.*</label>
                                        <input class="form-control" type="number" placeholder="Enter Shipping Fee" data-bs-original-title="" title="" name="shipping_price" value="{{old('shipping_fee')}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <button type="submit" id="" class="btn btn-success me-3">Add</button>
                                        <a class="btn btn-danger" href="{{route('shipping-method.index')}}" data-bs-original-title="" title="">Cancel</a>
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
    $(document).ready(function(){
    $('#parent_category_id').on('change', function(){
        var id = $(this).val();
        $.ajax({
        type: "GET",
        url: '{{route('get_main_category')}}',
        "dataSrc": "",
        data:  {'id':id},
        // dataType: 'json',
        //  cache: false,
        success: function(response) {
            // console.log(response.clients);
            // $("#pageloader").hide();
            $('#main-category_id').html('');
            // $("#main-category_id").append(`<optgroup label="Please Select Parent Category">`);
            if(response!='') {
                $.each(response.maincategory, function(value,i) {
                    $('#main-category_id').append(`<option  value ="${i.id}" >${i.main_category_name}</option>`);
                });
                }else
                {
                    $('#main-category_id').append('<h3>No Category Found</h3>');
                }
             }
        });
    });
});
</script>
<script>
        var id = ($('select[name="parent_category_id"]').val());
        $.ajax({
        type: "GET",
        url: '{{route('get_main_category')}}',
        data:  {'id':id},
        success: function(response) {
            // console.log(response.clients);
            $('#main-category_id').html('');
            if(response!='') {
                $.each(response.maincategory, function(value,i) {
                    var select = (i.id == i.main_category_name ? 'selected="selected"' : '');
                    // console.log(test);
                    $('#main-category_id').append(`<option  value ="${i.id}" ${select}>${i.main_category_name}</option>`);

                });
                }else
                {
                    $('#main-category_id').append('<h3>No Category Found</h3>');
                }
            }
        });
    </script>
    @endpush
@endsection

