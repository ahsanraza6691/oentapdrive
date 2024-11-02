@extends('admin_dashboard.layouts.master')
@section('content')
<style>
    .customer_records,
    .remove {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form id="" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Select Parent Category.*</label>
                                        <select id="parent_category_id"  name="parent_category_id" for="exampleFormControlInput10" class="form-control btn-square type">
                                         @foreach ($parent_categories as $parents )
                                             <option id="parent_category_id" value="{{$parents->id}}" class="form-control btn-square" >{{$parents->parent_category_name}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Select Main Category.*</label>
                                        <select id="main-category_id" for="exampleFormControlInput10" class="form-control btn-square type" name="main_category_id">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Select Sub Category.*</label>
                                        <select id="sub-category_id" for="exampleFormControlInput10" class="form-control btn-square type" name="sub_category_id">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Product Name</label>
                                        <input class="form-control" type="text" placeholder="Enter Product Title" data-bs-original-title="" title="" name="product_name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Product Images</label>
                                        <input class="form-control" type="file" data-bs-original-title="" title="" name="image[]"  multiple accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Product Price</label>
                                        <input class="form-control" type="number" id="price" placeholder="Enter Product Price" data-bs-original-title="" title="" name="price">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Enter Discount If any</label>
                                        <input class="form-control" type="number" id="discount" placeholder="Enter Product Discount Price" data-bs-original-title="" title="" name="discount">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Total Price</label>
                                        <input class="form-control" type="number" id="total_price" placeholder="Enter Product Price" data-bs-original-title="" title="" name="total_price">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Product Stock</label>
                                        <input class="form-control" type="number" placeholder="Enter Product Stock" data-bs-original-title="" title="" name="stock">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Add Attibutes(size,color)</label>
                                        <div class="customer_records">
                                            <input class="form-control" name="color" type="text" placeholder="Enter Labels">
                                            <input class="form-control" name="size" type="text" placeholder="Enter Labels">
                                            <span class="btn btn-success extra-fields-customer"> <i class="fa fa-plus-circle"></i></span>
                                        </div>

                                        <div class="customer_records_dynamic"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Product Description</label>
                                        <textarea class="form-control editor" name="description" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <button type="submit" id="" class="btn btn-success me-3">Add</button>
                                        <a class="btn btn-danger" href="{{route('product.index')}}" data-bs-original-title="" title="">Cancel</a>
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
            // $("#pageloader").hide();
            $('#main-category_id').html('');
            // $("#main-category_id").append(`<optgroup label="Please Select Parent Category">`);
            if(response!='') {
                $.each(response.maincategory, function(value,i) {
                    $('#main-category_id').append(`<option   value ="${i.id}" >${i.main_category_name}</option>`);
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

<script>
    $(document).ready(function(){
    $('#main-category_id').on('change', function(){
        var id = $(this).val();
        $.ajax({
        type: "GET",
        url: '{{route('get_sub_category')}}',
        "dataSrc": "",
        data:  {'id':id},
        // dataType: 'json',
        //  cache: false,
        success: function(response) {
            // console.log(response.clients);
            // $("#pageloader").hide();
            $('#sub-category_id').html('');
            // $("#main-category_id").append(`<optgroup label="Please Select Parent Category">`);
            if(response!='') {
                $.each(response.subcategory, function(value,i) {
                    $('#sub-category_id').append(`<option  value ="${i.id}" >${i.sub_category_name}</option>`);
                });
                }else
                {
                    $('#sub-category_id').append('<h3>No Category Found</h3>');
                }
             }
        });
    });
});
 </script>
<script>

    var id = ($('select[name="main_category_id"]').val());
    $.ajax({
    type: "GET",
    url: '{{route('get_sub_category')}}',
    data:  {'id':id},
    success: function(response) {
        // console.log(response.clients);
        $('#sub-category_id').html('');
        if(response!='') {
            $.each(response.subcategory, function(value,i) {
                var select = (i.id == i.sub_category_name ? 'selected="selected"' : '');
                // console.log(test);
                $('#sub-category_id').append(`<option  value ="${i.id}" ${select}>${i.sub_category_namee}</option>`);

            });
            }else
            {
                $('#sub-category_id').append('<h3>No Category Found</h3>');
            }
        }
    });
</script>
     <script type="text/javascript">

    $('.extra-fields-customer').click(function() {
    $('.customer_records').clone().appendTo('.customer_records_dynamic');
    $('.customer_records_dynamic .customer_records').addClass('single remove');
    $('.single .extra-fields-customer').remove();
    $('.single').append('<span  class="btn btn-danger remove-field btn-remove-customer"><i class="fa fa-minus-circle"></i></span>');
    $('.customer_records_dynamic > .single').attr("class", "remove");

        $('.customer_records_dynamic input').each(function() {
            var count = 0;
            var fieldname = $(this).attr("name");
            $(this).attr('name', fieldname + count );
            count++;
        });

    });

    $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.remove').remove();
        e.preventDefault();
    });
</script>
<script>
   $(":input").on("keyup change", function(e) {
        var price =   $("#price").val();
        var discount  = $("#discount").val();
        var total = price - discount;
        console.log(total);
        var final = $("#total_price").val(total);

    })
</script>
@endpush

@endsection

