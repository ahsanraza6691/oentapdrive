@extends('admin_dashboard.layouts.master')
@section('content')
<style>
    td.editDelete {
    display: flex;
    gap: 10px;
}
.productsetting{
    margin-left: 63%;
}
.productsetting a {
    padding: 10px;
}
.power_icon {
            padding: 10px 10px 10px 12px;
            background: #51bb25;
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
        a.power_icon:hover{
            color: #fff;
        }
        .btn-green{
            background-color: var(--bs-success)!important;
        }
</style>




    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Packages Orders </h5>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table  class="display dataTable no-footer" id="basic-1" role="grid"
                                    aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc">S.NO</th>
                                            <th class="sorting">User</th>
                                            <th class="sorting">Package</th>
                                            <th class="sorting">Price</th>
                                            <th class="sorting">Item</th>
                                            <th class="sorting">Quantity</th>
                                            <th class="sorting">To Account</th>
                                            <th class="sorting">Receipt</th>
                                            <th class="sorting">Status</th>
                                            <th class="sorting">Purchase Date</th>
                                            <th class="sorting" style="width: 120.016px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($userOrderHistories as $history)  
                                            <tr role="row" class="odd">
                                                <td>
                                                    {{$history->id}}
                                                 </td>
                                                <td>
                                                    {{$history->user->name}}
                                                </td>
                                                <td>
                                                    {{ $history->packageItem->package->name }}
                                                </td>
                                                <td>
                                                    {{ $history->packageItem->currency ?? '' }} {{ $history->packageItem->price ?? 'N/A' }} 
                                                </td>
                                                <td>
                                                    {{$history->packageItem->item}}
                                                </td>
                                                <td>
                                                    {{$history->packageItem->qty}}
                                                </td>

                                                <td>
                                                    {{$history->company_account_no}}
                                                </td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $history->receipt) }}" alt="Receipt Image">
                                                </td>
                                                <td>
                                                    {{$history->status}}
                                                </td>
                                                <td>
                                                    {{ $history->created_at->format('d M Y') }}
                                                </td>
                                              
                                                <td  class="power_icon_data editDelete">
                                                    <form action="{{ route('update-order-status') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{ $history->id }}">
                                                        
                                                        <button 
                                                            class="btn btn-xs {{ $history->status == 'pending' ? 'btn-green' : 'btn-secondary' }}" 
                                                            type="submit" 
                                                            {{ $history->status != 'pending' ? 'disabled' : '' }}
                                                        >
                                                            Approve
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr role="row" class="odd">
                                                <td>
                                                    No Order History
                                                </td>
                                            
                                            </tr>
                                        @endforelse    

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

    @endsection
