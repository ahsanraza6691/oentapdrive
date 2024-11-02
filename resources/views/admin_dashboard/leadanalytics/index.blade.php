@extends('admin_dashboard.layouts.master')
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
                        <h5>Lead Analytics </h5>
                        {{-- <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                                href="{{ route('main-category.create') }}">Add</a></div> --}}

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
                                            
                                                {{-- <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Car</th> --}}
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Vendor Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">User Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Product Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Contact</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Lead Type</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   

                                    {{-- @foreach ($lead as $value)
                                       
                                            <tr role="row" class="odd">
                                                <td>
                                                    {{ $loop->iteration ?? null }}
                                                </td>
                                                   
                                                <td>
                                                    @if(!empty($value->get_car->id))
                                                    <a href="{{ route('car-details', ['id' => $value->get_car->id, 'slug' => $value->get_car->slug]) }}" target="_blank" >{{$value->get_car->get_brand_name->brand_name ?? ''}} {{$value->get_car->model_name ?? ''}} {{$value->get_car->make_year ?? ''}}</a>
                                                    @endif
                                                 </td>
                                                
                                                <td>
                                                    {{ $value->get_vendor->company_name ?? ''}}
                                                </td>
                                                <td>
                                                    {{ $value->get_user->name ?? ''}}
                                                </td>
                                               
                                                <td>
                                                    {{ $value->get_user->email ?? ''}}
                                                </td>
                                               
                                                <td>
                                                    {{ $value->get_user->phone_number ?? ''}}
                                                </td>
                                                <td>
                                                    @if($value->whatsapp == 1 )
                                                    Whatsapp
                                                    @else
                                                    Call
                                                    @endif
                                                </td>

                                                <td>
                                                    {{$value->created_at->format('l, F j, Y h:i:s a');}}
                                                 </td>

                                              
                                            </tr>

                                          
                                    @endforeach --}}


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#basic-1').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("all-leads") }}',
            columns: [
                { data: 'iteration', name: 'iteration', className: 'text-center' },
                { data: 'vendor_name', name: 'vendor_name' },
                { data: 'user_name', name: 'user_name' },
                { data: 'user_email', name: 'user_email' },
               { 
                data: null,
                render: function(data) {
                    var productName = data.product_name ? data.product_name : '';
                    var brandName = data.brand_name ? data.brand_name : '';
                    return brandName + ' ' + productName;
                }
            },
                { data: 'user_contact', name: 'user_contact' },
                { data: 'lead_type', name: 'lead_type' },
                { 
                data: 'created_at', 
                name: 'created_at', 
                render: function(data) {
                    var date = moment(data);
                    var formattedDate = date.format('DD MMMM YYYY h:mm a');
                    var dayBefore = date.subtract(1, 'day').format('dddd');
                    return dayBefore + ', ' + formattedDate;
                }
            },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
    </script>
    
    {{-- <script type="text/javascript">
        $(function() {
            var table = $("#basic-1").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('lead-analytics') }}",
                    type: 'GET',
                },
                columns: [
                    { data: 'iteration', name: 'iteration', className: 'text-center' },
                    { data: 'seller_name', name: 'seller_name', className: 'text-center' },
                    { data: 'buyer_name', name: 'buyer_name', className: 'text-center' },
                    { data: 'buyer_city', name: 'buyer_city', className: 'text-center' },
                    { data: 'brand', name: 'brand', className: 'text-center' },
                    { data: 'model', name: 'model', className: 'text-center' },
                    { data: 'website', name: 'website', className: 'text-center' },
                    { data: 'whatsapp_call', name: 'whatsapp_call', className: 'text-center' },
                    { 
                        data: 'created_at', 
                        name: 'created_at',
                        className: 'text-center',
                        render: function(data) {
                            return moment(data).format('YYYY-MM-DD HH:mm:ss');
                        }
                    },
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return data;
                        }
                    }
                ],
                lengthMenu: [20, 50, 100, 200, 500],
                dom: 'Blfrtip',
                buttons: ['copyHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
            });
        });
      </script> --}}
      

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
                        url: "{{route('main-category.destroy',"id")}}",
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
