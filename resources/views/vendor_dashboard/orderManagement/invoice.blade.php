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

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #ff2446;
        }

        .nav-link {
            border: none;
            margin-right: 10px;
        }

        .billingInformation p {
            margin-bottom: 0px;
        }

        .sale-container .summary-comment-container .comment-container {
            margin-top: 20px;
            float: left;
        }

        .control-group,
        .control-group label {
            display: block;
            color: #3a3a3a;
        }


        .control-group textarea.control {
            height: 100px;
            padding: 10px;
            resize: none;
        }

        .control-group .control {
            background: #fff;
            border: 2px solid #c7c7c7;
            border-radius: 3px;
            width: 70%;
            height: 36px;
            display: inline-block;
            vertical-align: middle;
            transition: .2s cubic-bezier(.4, 0, .2, 1);
            padding: 0 10px;
            font-size: 15px;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .checkbox input {
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            height: 24px;
            width: 24px;
            z-index: 100;
        }

        .btn.btn-primary {
            background: #0041ff;
            color: #fff;
        }

        .btn.btn-lg {
            padding: 10px 20px;
        }

        .sale-container .summary-comment-container .comment-container .comment-list {
            margin-top: 40px;
        }

        .sale-container .sale-summary {
            margin-top: 20px;
            height: 130px;
            float: right;
        }

        .summary-comment-container {
            display: flex;
        }

        .sale-container .sale-summary tr td {
            padding: 5px 8px;
            vertical-align: text-bottom;
        }

        .comment-container {
            width: 70%;
            margin-top: 20px;
        }

        table.sale-summary {
            width: 30%;
            margin-top: 20px;
        }

        .border {
            border: 0px solid #dee2e6 !important;
        }

        .checkbox {
            position: relative;
            display: block;
        }

        .checkbox .checkbox-view {
            height: 24px;
            display: inline-block !important;
            vertical-align: middle;
            margin: 10px 0px 10px 20px;

        }

        .checkbox label::before {
            border: 2px solid #bbbbbb;
        }

        .btn {
            margin-top: 20px;
            box-shadow: 0 1px 4px 0 rgb(0 0 0 / 20%), 0 0 8px 0 rgb(0 0 0 / 10%);
            border-radius: 3px;
            border: none;
            color: #fff;
            cursor: pointer;
            transition: .2s cubic-bezier(.4, 0, .2, 1);
            font: inherit;
            display: inline-block;
        }

        .btn-primary {
            background-color: #ff2446 !important;
            border-color: #ff2446 !important;
        }

        .table th {
            width: 200px;
        }

        .table th,
        .table td {
            padding: 8px 4px;
            text-align: center;
        }

        .accordion-button:not(.collapsed) {
            color: #ff2446;
            background-color: #f0f0f0;
            border-radius: 0.25rem;
        }

        .accordion-button:focus {
            border-color: #d7d7d7 !important;
            box-shadow: 0 0 0 0 rgb(13 110 253 / 25%) !important;
        }

        :focus {
            outline-color: #ff2446;
        }

        .accordion-header {
            margin-bottom: 12px;
        }

        .accordion-button.collapsed {
            border-bottom-width: 1px;
            border-radius: 0.25rem;
        }

        .accordion-body {
            padding: 1rem 1.25rem;
            border-top: 1px solid #80808040;
            margin-bottom: 12px;
            border-bottom: 1px solid #80808040;
        }

        .accordion-item:first-of-type .accordion-button {
            border-radius: 0.25rem;
        }
    </style>
    {{-- <div id="order_id"></div> --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <h3>Order History</h3>
                            <ul class="nav nested nav-pills mb-3" id="pills-tab" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pillsInformationTab" data-bs-toggle="pill"
                                        data-bs-target="#pillsInformation" type="button" role="tab"
                                        aria-controls="pillsInformationTab" aria-selected="true">Information
                                    </button>
                                </li>

                            </ul>

                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade active show" id="pillsInformation" role="tabpanel"
                                    aria-labelledby="pillsInformationTab">

                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Order and Account
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="orderInformation">
                                                                <h6>Order Information</h6>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <p>Order ID</p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p><a
                                                                                href="{{ route('orderManagement.show', $order->id) }}">#{{ $order->id }}</a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <p>Order Date</p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p>{{ $order->created_at }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <p>Order Status</p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p>
                                                                            @if ($order->order_status == 1)
                                                                                Pending
                                                                            @endif
                                                                            @if ($order->order_status == 2)
                                                                                Dispatched
                                                                            @endif
                                                                            @if ($order->order_status == 3)
                                                                                Delivered
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <p>Channel</p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p>Default</p>
                                                                    </div>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="orderInformation">
                                                                <h6>Account Information</h6>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <p>Customer Name</p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p>{{ $order->user->name }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <p>Email</p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p>{{ $order->user->email }}</p>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <p>Customer Group</p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p>General</p>
                                                                    </div>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Address
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">



                                                        <div class="col-lg-6">
                                                            <div class="orderInformation">
                                                                <h6>Shipping Address </h6>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="billingInformation">
                                                                            {{-- {{ $order->purchased_item }} --}}
                                                                            @if (!empty($shipping->contact))
                                                                                <p>Phone no: {{ $shipping->contact }}
                                                                                </p>
                                                                            @else
                                                                                <p>Phone no: N/A</p>
                                                                            @endif

                                                                            @if (!empty($shipping->landmark))
                                                                                <p>Landmark: {{ $shipping->landmark }}
                                                                                </p>
                                                                            @else
                                                                                <p>Landmark: N/A</p>
                                                                            @endif


                                                                            @if (!empty($shipping->address))
                                                                                <p>Address: {{ $shipping->address }}
                                                                                </p>
                                                                            @else
                                                                                <p>Address: N/A</p>
                                                                            @endif

                                                                            @if (!empty($shipping->city))
                                                                                <p>City: {{ $shipping->get_city->city }}</p>
                                                                            @else
                                                                                <p>City: N/A</p>
                                                                            @endif

                                                                            @if (!empty($shipping->province))
                                                                                <p>Province: {{ $shipping->get_state->province }}</p>
                                                                            @else
                                                                                <p>Province: N/A</p>
                                                                            @endif
                                                                                <p>Country: Malaysia
                                                                                </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="orderInformation">
                                                                <h6>Billing Address</h6>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="billingInformation">
                                                                            @if (!empty($billing->contact))
                                                                                <p>Phone no: {{ $billing->contact }}
                                                                                </p>
                                                                            @else
                                                                                <p>Phone no: N/A</p>
                                                                            @endif

                                                                            @if (!empty($billing->landmark))
                                                                                <p>Landmark: {{ $billing->landmark }}
                                                                                </p>
                                                                            @else
                                                                                <p>Landmark: N/A</p>
                                                                            @endif


                                                                            @if (!empty($billing->address))
                                                                                <p>Address: {{ $billing->address }}
                                                                                </p>
                                                                            @else
                                                                                <p>Address: N/A</p>
                                                                            @endif

                                                                            @if (!empty($billing->city))
                                                                                <p>City: {{ $billing->get_city->city }}</p>
                                                                            @else
                                                                                <p>City: N/A</p>
                                                                            @endif

                                                                            @if (!empty($billing->province))
                                                                                <p>Province: {{ $billing->get_state->province }}</p>
                                                                            @else
                                                                                <p>Province: N/A</p>
                                                                            @endif

                                                                            <p>Country: Malaysia
                                                                                </p>
                                                                            {{--
                                                                                @if (!empty($order->purchased_items->address))
                                                                                    <p>{{ $order->billing_address->address }}
                                                                                    </p>
                                                                                @endif
                                                                                @if (!empty($order->billing_address->village))
                                                                                    <p>{{ $order->billing_address->village }}
                                                                                    </p>
                                                                                @endif
                                                                                @if (!empty($order->billing_address->city))
                                                                                    <p>{{ $order->billing_address->city }}
                                                                                    </p>
                                                                                @endif
                                                                                @if (!empty($order->billing_address->country))
                                                                                    <p>{{ $order->billing_address->country }}
                                                                                    </p>
                                                                                @endif
                                                                                @if (!empty($order->billing_address->country))
                                                                                    <p>Contact :
                                                                                        {{ $order->billing_address->contact }}
                                                                                    </p>
                                                                                @endif --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Payment and Shipping
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="orderInformation">
                                                                <h6>Payment Information</h6>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <p>Payment Method</p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p>
                                                                            @if ($order->payment_method == 1)
                                                                                Cash On Delivery
                                                                            @endif
                                                                            @if ($order->payment_method == 2)
                                                                                Paypal
                                                                            @endif
                                                                            @if ($order->payment_method == 3)
                                                                                Stripe
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <p>Payment Status</p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p>
                                                                            @if ($order->payment_method == 1)
                                                                                N/A
                                                                            @endif
                                                                            @if ($order->payment_method == 2)
                                                                                Recieved
                                                                            @endif
                                                                            @if ($order->payment_method == 3)
                                                                                Recieved
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item" id="printtable">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                    aria-expanded="false" aria-controls="collapseFour">
                                                    Products Ordered
                                                </button>

                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse"
                                                aria-labelledby="headingFour" data-bs-parent="#accordionExample">

                                                <div class="accordion-body">
                                                {{-- update work 26 also add id printtable --}}
                                                {{-- <button class="remove-btn-css noPrint" onclick="printContent('printtable');">
                                                            <div class="red-back-btn print-btn-css">
                                                                <i class="fa fa-print" aria-hidden="true"></i>
                                                            </div>
                                                </button> --}}
                                                    <div class="table">
                                                        <div class="table-responsive">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th>s.no</th>
                                                                        <th>Product Name</th>
                                                                        <th>Image</th>
                                                                        <th>Quantity</th>
                                                                        <th>Unit Cost</th>
                                                                        <th>Subtotal</th>
                                                                        {{-- <th>Status</th> --}}
                                                                        {{-- <th>Subtotal</th> --}}
                                                                        {{-- <th>Tax Percent</th>
                                                                        <th>Tax Amount</th> --}}
                                                                        {{-- <th>Grand Total</th> --}}
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $total = 0;
                                                                    @endphp

                                                                    @foreach ($order->purchased_items as $product)
                                                                    {{-- {{ dd($order->purchased_items) }} --}}
                                                                        {{-- update work 13 --}}
                                                                        @php
                                                                            $total += $product->total;
                                                                        @endphp
                                                                        <tr>
                                                                            <td>
                                                                                {{ $product->id ?? '' }}
                                                                            </td>
                                                                            <td>
                                                                            {{-- update work 17 --}}
                                                                            @if($product->product_type  == 1)
                                                                                    {{ $product->product->product_name }}

                                                                                    @else
                                                                                         {{ $product->product->product_name }}  {{ $product->attribute_values}}
                                                                                    <br>
                                                                             @endif

                                                                            </td>
                                                                            <td>
                                                                                <img src="{{ asset($product->product_variantion_id ? 'variations/'.$product->variations->image : 'products/'.$product->product->image ) ?? '' }}" alt="Image" width="40px">
                                                                            </td>
                                                                            <td>
                                                                                {{ $product->quantity ?? '' }}

                                                                            </td>

                                                                            <td>${{ $product->price ?? '' }}</td>

                                                                            <td>${{ $product->total ?? '' }}</td>

                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="summary-comment-container">
                                                        <div class="comment-container">

                                                            <ul class="comment-list"></ul>
                                                        </div>
                                                        <table class="sale-summary">
                                                        @php
                                                            $cancel_total  = 0;
                                                        @endphp


                                                        {{-- {{dd($cancel_total)}} --}}
                                                            <tbody>
                                                                {{-- <tr>
                                                                    <td>Subtotal</td>
                                                                    <td>-</td>
                                                                    <td>${{ $total }}</td>
                                                                </tr> --}}
                                                                <tr>
                                                                    <td>Shipping &amp; Handling</td>
                                                                    <td>${{ $order->delivery_fee }}</td>
                                                                </tr>

                                                                {{-- {{dd($cancel_data)}} --}}
                                                                <tr>
                                                                    <td>Total</td>
                                                                    {{-- update work 18 invoice pricice setting--}}
                                                                    <td>

                                                                      @if($product->cancellation_status == 1 || $product->cancellation_status == 1)
                                                                      ${{ $total - $cancel_data }}
                                                                     @else
                                                                     ${{ $total }}
                                                                     @endif
                                                                      </td>
                                                                </tr>

                                                                {{-- <tr class="border">
                                                                    <td>Tax</td>
                                                                    <td>-</td>
                                                                    <td>$0.00</td>
                                                                </tr> --}}

                                                                {{-- update work 18 --}}
                                                                <tr class="bold">
                                                                    <td>Grand Total</td>

                                                                    <td>
                                                                    @if($product->cancellation_status == 1 || $product->cancellation_status == 2)
                                                                    ${{ $total + $order->delivery_fee - $cancel_data}}
                                                                    @else
                                                                     ${{ $total + $order->delivery_fee}}
                                                                     @endif
                                                                    </td>
                                                                </tr>
                                                                {{-- update work 16  invoice pricice setting---}}
                                                                <tr>
                                                                     <td>
                                                                        @if($product->cancellation_status == 2)
                                                                              <span class="span badge rounded-pill pill-badge-danger">Refunded</span>
                                                                         @endif
                                                                          @if($product->cancellation_status == 1)
                                                                                <span class="span badge rounded-pill pill-badge-danger">Cancelled</span>
                                                                            @endif
                                                                        </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (Session::has('order_status'))
        <script>
            toastr.success("{{ Session::get('order_status') }}")
        </script>
    @endif
    @if (Session::has('order_status_error'))
        <script>
            toastr.error("{{ Session::get('order_status_error') }}")
        </script>
    @endif

{{-- update work 26 --}}
  <script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>
@endpush
