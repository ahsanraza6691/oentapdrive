@extends('vendor_dashboard.layouts.master')
@section('content')
<style>
    td.editDelete {
    display: flex;
    gap: 10px;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 card p-4">
                <h3>Manage Car Discount </h3>
                <span style="color: #ED8413"><strong> To Clear discount price select car and empty discounted fields</strong></span>
                <form action="{{route('add-discount')}}" method="POST">
                    @csrf
                <div class="mt-3">
                    <div class="col-md-4 col-12">
                        <label for="Car">Select Car</label>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="select-dropdown">
                            <select class="form-control" id="select_car" name="select_car">
                                <option value="">Select Car</option>
                                @foreach ( $my_cars as  $car)
                                 <option value="{{$car->id}}">{{$car->get_brand_name->brand_name ?? ''}} {{$car->model_name}} {{$car->make_year}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-12 mt-3">
                        <label for="current_price">Current Per Day Price </label>
                    </div>
                    <div class="col-md-8 col-12">
                        <input class="form-control" type="number"  id="daily_current_price" name="daily_current_price"
                         disabled>
                    </div>

                    <div class="col-md-4 col-12 mt-3">
                        <label for="discount_price">Enter Discounted Per Day Price</label>
                    </div>
                    <div class="col-md-8 col-12">
                        <input class="form-control" type="number"  id="daily_discount_price" name="daily_discount_price">

                    </div>
                    <div class="col-md-4 col-12 mt-3">
                        <label for="current_week_price">Current Weekly Price </label>
                    </div>
                    <div class="col-md-8 col-12">
                        <input class="form-control" type="number"  id="current_weekly_price" name="current_weekly_price"
                         disabled>
                    </div>

                    <div class="col-md-4 col-12 mt-3">
                        <label for="discount_price">Enter Weekly Discount Price</label>
                    </div>
                    <div class="col-md-8 col-12">
                        <input class="form-control" type="number"  id="weekly_discount_price" name="weekly_discount_price">

                    </div>

                    <div class="col-md-4 col-12 mt-3">
                        <label for="current_monthly_price">Current Monthly Price </label>
                    </div>
                    <div class="col-md-8 col-12">
                        <input class="form-control" type="number"  id="current_monthly_price" name="current_monthly_price"
                         disabled>
                    </div>

                    <div class="col-md-4 col-12 mt-3">
                        <label for="monthly_discount_price">Enter Monthly Discount Price</label>
                    </div>
                    <div class="col-md-8 col-12">
                        <input class="form-control" type="number"  id="monthly_discount_price" name="monthly_discount_price">

                    </div>

                    <button type="submit" class="btn btn-gradient mt-3">Save</button>
                </div>
                </form>
            </div>
            <div class="col-sm-6 card p-4">
                <h3>Feature Car Listing </h3>
                <form action="{{route('feature-car')}}" method="POST">
                    @csrf
                <div class="mt-3">
                    <div class="col-md-4 col-12">
                        <label for="version">Select Car </label>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="select-dropdown">
                            <select class="form-control" id="featurelist" name="car">
                                @foreach ( $my_cars as  $car)
                                <option value="{{$car->id}}" @if ($car->is_featured == 1) selected @endif>{{$car->get_brand_name->brand_name ?? ''}} {{$car->model_name}} {{$car->make_year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- <div class="col-md-4 col-12 mt-3">
                        <label for="version">Version</label>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="select-dropdown">
                            <select class="form-control" id="version" name="version">
                                <option value="N/A">N/A</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-12 mt-3">
                        <label for="make_year">Make (Year)</label>
                    </div> --}}
                    {{-- <div class="col-md-8 col-12">
                        <div class="select-dropdown">
                            <select class="form-control" id="make_year" name="make_year" required>
                            </select>
                        </div>
                    </div> --}}
                    <button type="submit" class="btn btn-gradient mt-3">Save</button>
                </div>
                </form>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>.

    <script>
    $("#daily_discount_price").keyup(function(e){
        var num = this.value.match(/^\d+$/);
        if (num === null || num == 0) {
            this.value = "";
        }
    });
    $("#weekly_discount_price").keyup(function(e){
        var num = this.value.match(/^\d+$/);
        if (num === null || num == 0) {
            this.value = "";
        }
    });
    $("#monthly_discount_price").keyup(function(e){
        var num = this.value.match(/^\d+$/);
        if (num === null || num == 0) {
            this.value = "";
        }
    });

</script>
    <script>
        $(document).ready(function() {
            $('#select_car').on('change', function() {
                var id = $(this).val();
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: '{{ route('get_car_prices') }}',
                    "dataSrc": "",
                    data: {
                        'id': id
                    },
                    beforeSend: function() {
                        $(".loader-bg").removeClass('loader-active');
                    },
                    success: function(response) {
                        $(".loader-bg").addClass('loader-active');
                        $('#current_price').html('');
                        $('#current_weekly_price').html('');
                        $('#daily_discount_price').html('');
                        $('#weekly_discount_price').html('');
                        $('#monthly_discount_price').html('');
                        $('#daily_current_price').val(response.get_price.price_per_day);
                        $('#current_weekly_price').val(response.get_price.weekly_rent);
                        $('#daily_discount_price').val(response.get_price.daily_discount_price);
                        $('#weekly_discount_price').val(response.get_price.weekly_discount_price);
                        $('#monthly_discount_price').val(response.get_price.monthly_discount_price)
                    }
                });
            });
        });
    </script>


@endsection
