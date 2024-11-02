@extends('vendor_dashboard.layouts.master')
@section('content')
    <style>
        td.editDelete {
            display: flex;
            gap: 10px;
        }

        .productsetting {
            margin-left: 63%;
        }

        .productsetting a {
            padding: 10px;
        }

        .power_icon {
            padding: 5px 10px 5px 12px;
            background: #343A40;
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
        }

        .power_icon_red {
            padding: 10px 10px 10px 12px;
            background: red;
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
        }

        a.power_icon_red:hover,
        a.power_icon:hover {
            color: #fff;
        }

        .bg_orange {
            background-color: #FF581B !important;
        }

        .reload_icon {
            padding: 1px 3px;
            border-radius: 5px;
            font-size: 16px;
            background-color: #FF581B !important;

        }
        /* .power_icon_data{
                text-align: center;

            } */
    </style>

    @if (Session::has('listing'))
    <script type="text/javascript">
        swal("Listing!", "{{ Session::get('listing') }}", "success");
    </script>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Car Listing </h5>
                        <h5>Total Listing: {{$total_cars}}</h5>
                        <h5>Active Listing: {{$active_cars}}</h5>
                        {{-- <div class="productsetting"><a class="btn btn-gradient" data-bs-original-title="" title=""
                            href="{{ route('product-setting') }}">Product Setting</a></div> --}}
                        <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                                href="{{ route('rent-car.create') }}">Add</a></div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table data-order='[[ 0, "desc" ]]' class="display dataTable no-footer" id="basic-1"
                                    role="grid" aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                S.NO</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Car Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Price Set</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-label="Action: activate to sort column ascending"
                                                style="width: 120.016px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $value)
                                            <tr role="row" class="odd">
                                                <td>
                                                    {{ $loop->iteration ?? null }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('car-details', ['slug' => $value->slug]) }}" target="_blank" > {{ $value->get_brand_name->brand_name . ' ' . $value->model_name . ' ' . $value->make_year ?? null }} </a>
                                                </td>
                                                <td>
                                                    {!! $value->price_per_day ? $value->price_per_day . ' / Day' . '<br>' : '' !!}
                                                    @php
                                                        $minMileage = null;
                                                    @endphp

                                                    @foreach ($value->get_mileage as $mileage)
                                                        @php
                                                            $mileageValues = [$mileage->one_month, $mileage->three_months, $mileage->six_months, $mileage->nine_months, $mileage->twelve_months];
                                                            $nonNullMileageValues = array_filter($mileageValues, fn($v) => !is_null($v));

                                                            if (!empty($nonNullMileageValues)) {
                                                                $currentMinMileage = min($nonNullMileageValues);
                                                                if ($minMileage === null || $currentMinMileage < $minMileage) {
                                                                    $minMileage = $currentMinMileage;
                                                                }
                                                            }
                                                        @endphp
                                                    @endforeach

                                                    @if ($minMileage !== null)
                                                        {{ $minMileage }} / Month
                                                    @else
                                                        {{ $value->weekly_rent }} / Week
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($value->status == 1)
                                                        Active
                                                    @else
                                                        In Active
                                                    @endif
                                                </td>

                                                <td class="power_icon_data editDelete">

                                                    @if ($value->status == 1)
                                                        <a href="{{ route('product-status', $value->id) }}"
                                                            class="power_icon">
                                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('product-status', $value->id) }}"
                                                            class="power_icon_red">
                                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('refresh-car', $value->id) }}" class="reload_icon">
                                                        <i class="fa fa-refresh p-2 rounded bg_orange text-light"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                    {{-- </td>
                                                <td class="editDelete"> --}}
                                                    <form action="{{ route('rent-car.destroy', $value->id) }}"
                                                        method="post">

                                                        @method('DELETE')

                                                        @csrf
                                                        <a href="#">
                                                            <button class="btn btn-danger btn-xs" type="submit"
                                                                data-original-title="btn btn-danger btn-xs"
                                                                onclick="return confirm('Are you sure you want to delete product ?');">Delete</button></a>
                                                    </form>

                                                    <a href="{{ route('rent-car.edit', $value->id) }}"> <button
                                                            class="btn btn-success btn-xs" type="button"
                                                            data-original-title="btn btn-danger btn-xs" title=""
                                                            data-bs-original-title="">Edit</button></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>.
@endsection
