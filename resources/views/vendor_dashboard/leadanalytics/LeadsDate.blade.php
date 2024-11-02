@php

    use App\Models\User;
    use App\Models\BackendModels\Product;

@endphp
@extends('vendor_dashboard.layouts.master')
@section('content')
    <style>
        td.editDelete {
            display: flex;
            gap: 10px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        @php

                            $createdAtDate = \Carbon\Carbon::parse($leadDate);
                            $leadDate = $createdAtDate->format('F j (D)');

                        @endphp

                        <h5>Lead Analytics


                            {{ $leadDate }}

                        </h5>
                        {{-- <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                                href="{{ route('main-category.create') }}">Add</a></div> --}}

                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table class="display dataTable no-footer" id="basic-1" role="grid"
                                    aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                S.NO</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                Name</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                Phone</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                Product</th>

                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">Lead Type</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (!empty($lead_analytics))
                                            @foreach ($lead_analytics as $key => $lead_analytic)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    @php
                                                        $User = User::where('id', $lead_analytic['user_id'])->first();

                                                    @endphp
                                                    @if (!empty($User))
                                                        <td>
                                                            {{ $User->name }}
                                                        </td>
                                                        <td>
                                                            {{ $User->phone_number }}
                                                        </td>
                                                    @endif
                                                    {{-- <td>{{ $lead_analytic['user_id'] }}</td> --}}

                                                    @php
                                                        $Product = Product::with(
                                                            'get_user',
                                                            'get_images',
                                                            'get_mileage',
                                                            'get_brand_name',
                                                        )
                                                            ->where('id', $lead_analytic['product_id'])
                                                            ->first();
                                                    @endphp
                                                    @if (!empty($Product))
                                                        {{-- <td>{{ $lead_analytic['product_id'] }}</td> --}}

                                                        <td>
                                                            <a target="_blank"
                                                                href="{{ route('car-details', ['id' => $Product->id, 'slug' => $Product->slug]) }}">

                                                                {{ $Product->get_brand_name->brand_name ?? '' }}
                                                                {{ $Product->model_name }}
                                                                {{ $Product->make_year }}

                                                            </a>
                                                        </td>
                                                    @endif

                                                    @if ($lead_analytic['whatsapp'] != null)
                                                        <td>WhatsApp</td>
                                                    @else
                                                        <td>Call</td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        @endif


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


    <script>
        $(document).ready(function() {

            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': false,
                'progressBar': false,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            }

            $(".deletemaincategory").on("click", function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "{{ route('main-category.destroy', 'id') }}",
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    type: 'DELETE',
                    success: function(result) {
                        toastr.success('Main Category Deleted Sucessfully');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                });
            });
        })

    </script>
@endsection
