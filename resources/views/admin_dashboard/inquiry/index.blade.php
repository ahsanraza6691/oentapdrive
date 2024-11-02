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
                        <h5>Inquiry List </h5>
                        <div class=""></div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table data-order='[[ 0, "desc" ]]' class="display dataTable no-footer" id="basic-1" role="grid"
                                    aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                S.NO</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Vendor Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> User Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Contact</th>
                                               
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Car Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Date</th>
                                               
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-label="Action: activate to sort column ascending"
                                                style="width: 120.016px;">Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @foreach ($inquiries as $value)
                                            <tr role="row" class="odd">
                                                <td>
                                                    {{ $value->id ?? null }}
                                                </td>
                                                <td>
                                                    {{ $value->name ?? null }}
                                                </td>

                                                <td>
                                                    {!! $value->email ?? null !!}
                                                </td>
                                                <td>
                                                    {!! $value->contact ?? null !!}
                                                </td>
                                                <td>
                                                    {!! Str::limit($value->message,30) ?? null !!}
                                                </td>
                                                <td class="editDelete">
                                                    <form action="{{ route("delete-contact", $value->id) }}" method="post">
                                                        @csrf
                                                        <a href="#">
                                                        <button class="btn btn-danger btn-xs" type="submit"
                                                            data-original-title="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete inquiry ?');" >Delete</button></a>
                                                    </form>

                                                    <a href="{{ route('view-inquiry', $value->id) }}"> <button
                                                            class="btn btn-success btn-xs" type="button"
                                                            data-original-title="btn btn-danger btn-xs" title=""
                                                            data-bs-original-title="">View</button></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody> --}}
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
    $('#basic-1').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("all-inquiries") }}',
    columns: [
        { data: 'iteration', name: 'iteration', className: 'text-center' },
        { data: 'vendor_name', name: 'vendor_name' },
        { data: 'user_name', name: 'user_name' },
        { data: 'user_email', name: 'user_email' },
        { data: 'contact', name: 'contact' },
        { data: 'car_name', name: 'car_name' },
        { data: 'created_at', name: 'created_at' },
        { data: 'action', name: 'action' },
        
    ]
});
    });

</script>
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

                $(".deleteinquiry").on("click", function() {
                    var id = $(this).attr("data-id");
                    $.ajax({
                        url: "{{route('delete-contact',"id")}}",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}"
                        },
                        type: 'GET',
                        success: function(result) {
                            toastr.success('Inquiry Deleted Sucessfully');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                });
            })
        </script>



{{-- @if (Session::has('Update_Faqs'))
    <script>
        toastr.success('Faqs Updated', '{{ Session::get('Update_Faqs') }}', 'success')
    </script>
@endif --}}

    @endsection
