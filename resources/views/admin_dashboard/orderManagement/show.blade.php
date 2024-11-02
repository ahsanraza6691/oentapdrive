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

    input.inputField {
        width: 100%;
        border: none;
        border: 1px solid #cbcbcb !important;
        outline: none;
    }

    button.submitBtn {
        border: none;
        background-color: #ff2446;
        margin-top: 16px;
        padding: 8px 16px;
        border-radius: 5px;
        width: 100px;
        color: #fff;
    }

    .cancelTextBox {
        text-align: end;
    }

    textarea.inputMessages {
        width: 240px;
        height: 100px;
        resize: none;
        border: 1px solid #999;
        outline: none;
    }

    /* .table th {
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

    .notificationDetails p {
        line-height: 1.1;
    }
.inputMessage {
    resize: none;
    height: 150px;
}

.inputMessage {
    width: 100%;
    margin: 6px 0px;
    padding: 10px 12px;
    outline: none;
    border: 1px solid #999999;
    background-color: #ffffff;
    color: #000000;
}

.invoice-email {
    display: flex;
    align-items: baseline;
    margin-left: 20px;
}
.remove-btn-css {
    border: none;
    background: transparent;
    color: #4d4d4d;
    font-family: montserratRegular;
    font-size: 15px;
}
.print-btn-css i {
    font-size: 30px;
    color: #ff2446;

}
.login-sec-box h1.invoice-no-heading {
    font-size: 30px;
    color: #646364;
    font-weight: bolder;
}
.login-sec-box label, .login-btn span, .login-sec-box h1 {
    color: #989898;
    font-size: 15px;
    margin-bottom: 5px !important;
}
.invoice-email {
    display: flex;
    align-items: baseline;
    margin-left: 20px;
}
.cstm-invoice-tabel {
    width: 100%;
    overflow: auto !important;
}
.mt0 {
    margin-top: 10px !important;
}
.mt4 {
    margin-top: 54px !important;
}
.cstm-invoice-tabel .tabel, th {
    border: 2px solid #dae1e7 !important;
    font-weight: bolder !important;

}
td {
    color: #646364 !important;
    font-size: 15px !important;
    border: 2px solid #dae1e7 !important;
}
.table-striped>tbody>tr:nth-of-type(odd) {
    --bs-table-accent-bg: var(--bs-table-striped-bg);
    color: var(--bs-table-striped-color);
}
.tabel-line {
    border-bottom: 2px solid #989898;
    min-width: 60%;
    max-width: 100%;
    padding: 1px;
    margin: 0px;
    margin-left: 1rem;
}
.mt2 {
    margin-top: 34px !important;
}
.mt1 {
    margin-top: 24px !important;
}
.background-color-total {
            background-color: #fff;
            color: #646364;
 }
 .emailSendButton {
    width: 140px;
    border: none;
    padding: 8px 12px;
    background-color: #ff2446;
    color: #ffffff;
    border-radius: 6px;
}
.buttons {
    display: flex;
    align-items: center;
    justify-content: end;
    gap: 12px;
}
.table {
    margin-bottom: 0px;
    overflow: auto;
}

@media print {

        .noPrint {
            display: none;
        }

        @page {
            margin-top: 0;
            margin-bottom: 0;
        }
        .page-wrapper.compact-wrapper .page-body-wrapper .page-body {
            width: 100%;
            margin-top: 0px;
    margin-left: 0px;
}
.tabel-line {
    min-width: 20%;
    max-width: 40%;
    padding: 1px;
    margin: 0px;
    margin-left: 1rem;
}
    } */

    .invoice-email {
        display: flex;
        align-items: baseline;
        margin-left: 20px;
    }

    .remove-btn-css {
        border: none;
        background: transparent;
        color: #4d4d4d;
        font-family: montserratRegular;
        font-size: 15px;
    }

    .print-btn-css i {
        font-size: 30px;
        color: #ff2446;

    }

    .login-sec-box h1.invoice-no-heading {
        font-size: 30px;
        color: #646364;
        font-weight: bolder;
    }

    .login-sec-box label,
    .login-btn span,
    .login-sec-box h1 {
        color: #989898;
        font-size: 15px;
        margin-bottom: 5px !important;
    }

    .invoice-email {
        display: flex;
        align-items: baseline;
        margin-left: 20px;
    }

    .cstm-invoice-tabel {
        width: 100%;
        overflow: auto !important;
    }

    .mt0 {
        margin-top: 10px !important;
    }

    .mt4 {
        margin-top: 54px !important;
    }

    /* .cstm-invoice-tabel .tabel .tableHeading tr th {
    border: 2px solid #dae1e7 !important;
    font-weight: bolder !important;
} */
    .tableHeading tr th {
        border: 2px solid #dae1e7 !important;
        font-weight: bolder !important;
    }

    #invoiceTbody tr th {
        border: 2px solid #dae1e7 !important;
        font-weight: bolder !important;

    }

    #invoiceTbody tr td {
        color: #646364 !important;
        font-size: 15px !important;
        border: 2px solid #dae1e7 !important;
    }

    .table-striped>#invoiceTbody>tr:nth-of-type(odd) {
        --bs-table-accent-bg: var(--bs-table-striped-bg);
        color: var(--bs-table-striped-color);
    }

    .tabel-line {
        border-bottom: 2px solid #989898;
        min-width: 60%;
        max-width: 100%;
        padding: 1px;
        margin: 0px;
        margin-left: 1rem;
    }

    .mt2 {
        margin-top: 34px !important;
    }

    .mt1 {
        margin-top: 24px !important;
    }

    .background-color-total {
        background-color: #fff;
        color: #646364;
    }

    .emailSendButton {
        width: 140px;
        border: none;
        padding: 8px 12px;
        background-color: #ff2446;
        color: #ffffff;
        border-radius: 6px;
    }

    .buttons {
        display: flex;
        align-items: center;
        justify-content: end;
        gap: 12px;
    }

    .table {
        margin-bottom: 0px;
        overflow: auto;
    }

    @media print {

        .noPrint {
            display: none;
        }

        @page {
            margin-top: 0;
            margin-bottom: 0;
        }

        .page-wrapper.compact-wrapper .page-body-wrapper .page-body {
            width: 100%;
            margin-top: 0px;
            margin-left: 0px;
        }

        .tabel-line {
            min-width: 20%;
            max-width: 40%;
            padding: 1px;
            margin: 0px;
            margin-left: 1rem;
        }

    }

</style>

<div>
    <div class="customizer-links noPrint">
        <div class="nav flex-column nac-pills" id="c-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="c-pills-layouts-tab" data-bs-toggle="pill" href="#c-pills-layouts" role="tab" aria-controls="c-pills-layouts" aria-selected="true" data-original-title="" title="" data-bs-original-title="" style="text-decoration: none; !important">
                <div class="settings">
                    <i class="fa fa-commenting" aria-hidden="true"></i>
                </div>
                <span>Order Notes</span>
            </a>
        </div>
    </div>
    <div class="customizer-contain">
        <div class="tab-content" id="c-pills-tabContent">
            <div class="customizer-header">
                <i class="icofont-close icon-close"></i>
                <h5>Order Notifications</h5>
                {{-- <p class="mb-0">Try It Real Time <i class="fa fa-thumbs-o-up txt-primary"></i></p> --}}
            </div>
            <div class="customizer-body custom-scrollbar">
                <div class="tab-pane" id="c-pills-home" role="tabpanel" aria-labelledby="c-pills-home-tab">
                    <div class="notificationBox">
                        <div class="row">
                            @foreach ($order_notes as $key => $notes )
                            @if($key % 2 == 0)
                            <div class="col-sm-12 col-xl-12 col-lg-12">
                                <div class="card o-hidden">
                                    <div class="bg-primary b-r-4 cardBody">
                                        <div class="media static-top-widget">
                                            <div class="media-body">

                                                <div class="notificationDetails mt-3">
                                                    <p> Order Information.</p>

                                                    <p>
                                                        Status :
                                                        @if ($notes->order_notes_status == 1)
                                                        Pending
                                                        @endif
                                                        @if ($notes->order_notes_status == 2)
                                                        Dispatched
                                                        @endif
                                                        @if ($notes->order_notes_status == 3)
                                                        Delivered
                                                        @endif
                                                        @if ($notes->order_notes_status == 4)
                                                        Cancelled
                                                        @endif
                                                        @if ($notes->order_notes_status == 5)
                                                        On Hold
                                                        @endif
                                                        @if ($notes->order_notes_status == 7)
                                                        Product Cancelled
                                                        @endif
                                                        @if ($notes->order_notes_status == 8)
                                                        Product Refunded
                                                        @endif
                                                        @if ($notes->order_notes_status == 9)
                                                        Product Cancel Request Declined
                                                        @endif
                                                        @if ($notes->order_notes_status == 10)
                                                        Product Refund Request Declined
                                                        @endif
                                                    </p>
                                                    @if(!empty($notes->order_comment))
                                                    <p>Comment : {{$notes->order_comment}}.</p>
                                                    @endif
                                                    {{-- update work 31 --}}
                                                    @if(!empty($notes->product))
                                                    {{-- @foreach($notes->purchased_items as $product_note) --}}
                                                    <p>Product : {{$notes->product->product_name}}.</p>
                                                    @if(!empty($notes->attribute_values))
                                                    {{$notes->attribute_values}}
                                                    @endif
                                                    @endif
                                                    {{-- @endforeach --}}
                                                    {{-- @endif --}}

                                                    <p>Time : {{$notes->status_changed_time}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-sm-12 col-xl-12 col-lg-12">
                                <div class="card o-hidden">
                                    <div class="bg-secondary b-r-4 cardBody">
                                        <div class="media static-top-widget">
                                            <div class="media-body">
                                                <div class="notificationDetails mt-3">
                                                    <p> Order Information.</p>

                                                    <p>Status : Order
                                                        @if ($notes->order_notes_status == 1)
                                                        Pending
                                                        @endif
                                                        @if ($notes->order_notes_status == 2)
                                                        Dispatched
                                                        @endif
                                                        @if ($notes->order_notes_status == 3)
                                                        Delivered
                                                        @endif
                                                        @if ($notes->order_notes_status == 4)
                                                        Cancelled
                                                        @endif
                                                        @if ($notes->order_notes_status == 5)
                                                        On Hold
                                                        @endif
                                                        @if ($notes->order_notes_status == 7)
                                                        Product Cancelled
                                                        @endif
                                                         @if ($notes->order_notes_status == 9)
                                                        Product Cancel Request Declined
                                                        @endif
                                                        @if ($notes->order_notes_status == 10)
                                                        Product Refund Request Declined
                                                        @endif
                                                    </p>
                                                    {{-- update work 31 --}}
                                                    @if(!empty($notes->order_comment))
                                                    <p>Comment : {{$notes->order_comment}}.</p>
                                                    @endif
                                                    {{-- update work 31 --}}
                                                    @if(!empty($notes->product))
                                                    {{-- @foreach($notes->purchased_items as $product_note) --}}
                                                    <p>Product : {{$notes->product->product_name}}.</p>
                                                    @if(!empty($notes->attribute_values))
                                                    {{$notes->attribute_values}}
                                                    @endif
                                                    @endif
                                                    <p>Time : {{$notes->status_changed_time}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- update work --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="noPrint">Order Information</h3>

                    <div class="form theme-form">
                        <ul class="nav nested nav-pills mb-3 noPrint" id="pills-tab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pillsInformationTab" data-bs-toggle="pill" data-bs-target="#pillsInformation" type="button" role="tab" aria-controls="pillsInformationTab" aria-selected="true">Information
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pillsInvoicesTab" data-bs-toggle="pill" data-bs-target="#pillsInvoices" type="button" role="tab" aria-controls="pillsInvoicesTab" aria-selected="false">Order History</button>
                            </li>

                            {{-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pillsInvoicesOneTab" data-bs-toggle="pill" data-bs-target="#pillsInvoicesOne" type="button" role="tab" aria-controls="pillsInvoicesOneTab" aria-selected="false">Invoices One</button>
                            </li> --}}

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pillsInvoicesOneTab" value="{{$order->id}}" onclick="orderInvoiceTab('{{ $order->id }}')" data-bs-toggle="pill" data-bs-target="#pillsInvoicesOne" type="button" role="tab" aria-controls="pillsInvoicesOneTab" aria-selected="false">Invoice</button>
                            </li>

                            {{-- update work 16 --}}
                            @if($order->check_cancel_status == 1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pillsCancelTab" data-bs-toggle="pill" data-bs-target="#pillsCancel" type="button" role="tab" aria-controls="pillsCancelTab" aria-selected="false">Cancellation Request</button>
                            </li>
                            @endif

                            @if($order->check_cancel_status == 2)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pillsShipmentsTab" data-bs-toggle="pill" data-bs-target="#pillsShipments" type="button" role="tab" aria-controls="pillsShipmentsTab" aria-selected="false">Refund Request</button>
                            </li>
                            @endif

                            {{-- @if(!empty($history_status))
                         <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pillsShipmentsTab" data-bs-toggle="pill" data-bs-target="#pillsHistory" type="button" role="tab" aria-controls="pillsHistoryTab" aria-selected="false">Invoice</button>
                        </li>
                        @endif --}}
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            {{-- information tab --}}
                            <div class="tab-pane fade active show" id="pillsInformation" role="tabpanel" aria-labelledby="pillsInformationTab">

                                <div class="accordion" id="accordionExample">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Order and Account
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="orderInformation">
                                                            <h6>Order Information</h6>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <p>Order no</p>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p>#{{ $order->id }}</p>
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
                                                                        @if ($order->order_status == 4)
                                                                        Cancelled
                                                                        @endif
                                                                        @if ($order->order_status == 5)
                                                                        On Hold
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
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <p>Phone no</p>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p>{{ $order->user->contact }}</p>
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
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Address
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">

                                                    <div class="col-lg-6">
                                                        <div class="orderInformation">
                                                            <h6>Shipping Address</h6>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="billingInformation">

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
                                                                        {{-- {{dd($shipping)}} --}}
                                                                        {{-- @if (!empty($shipping->city)) --}}
                                                                        <p>City: {{ $shipping->get_city->city ?? '' }}</p>
                                                                        {{-- @else --}}
                                                                        {{-- <p>City: N/A</p>
                                                                        @endif --}}

                                                                        @if (!empty($shipping->province))
                                                                        <p>State: {{ $shipping->get_state->province  ?? '' }}</p>
                                                                        @else
                                                                        <p>State: N/A</p>
                                                                        @endif

                                                                        {{-- @if (!empty($shipping->country)) --}}
                                                                        <p>Country: Malaysia
                                                                        </p>
                                                                        {{-- @else --}}
                                                                        {{-- <p>Country: N/A
                                                                        </p>
                                                                        @endif --}}


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

                                                                        {{-- {{dd($billing->get_city->city ?? '')}} --}}
                                                                        @if (!empty($billing->city))
                                                                        <p>City: {{ $billing->get_city->city ?? '' }}</p>
                                                                        @else
                                                                        <p>City: N/A</p>
                                                                        @endif
                                                                        {{-- {{dd($billing->province ?? '')}} --}}
                                                                        {{-- update work 31 --}}
                                                                        @if (!empty($billing->province))
                                                                        <p>State: {{ $billing->get_state->province ?? '' }}</p>
                                                                        @else
                                                                        <p>State: N/A</p>
                                                                        @endif

                                                                        {{-- @if (!empty($billing->country)) --}}
                                                                        <p>Country: Malaysia
                                                                        </p>
                                                                        {{-- @else
                                                                        <p>Country: N/A
                                                                        </p> --}}
                                                                        {{-- @endif --}}
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
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Payment and Shipping
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
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

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                Products Ordered
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="table">
                                                    <div class="table-responsive">

                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th>s.no</th>
                                                                    <th>Image</th>
                                                                    <th>Product Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Save Amount</th>
                                                                    <th>Unit Cost</th>
                                                                    <th>Discounted Price</th>
                                                                    <th>Subtotal</th>
                                                                    <!-- <th>Status</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $total = 0;

                                                                    $count = 0;
                                                                    $sub_total_all = 0;
                                                                    $sub_total_product = 0 ;
                                                                @endphp

                                                                @foreach ($order->purchased_items as $product)

                                                                @if($order->order_status_count == 1  ||  $order->order_status_count == 2)
                                                                    @continue;
                                                                @endif

                                                                @if(!empty($product->quantity) || $product->quantity!= null)
                                                                @php
                                                                $cancel_qty = $product->quantity - $product->return_quantity;

                                                                if($cancel_qty == 0){
                                                                    continue;
                                                                }

                                                                @endphp
                                                                @else
                                                                @continue;
                                                                @endif


                                                                @if($product->cancellation_status == 2 || $product->cancellation_status == 1 || $product->cancellation_status == 3  || $product->cancellation_status == 4)
                                                                @php
                                                                $total += 0;
                                                                @endphp
                                                                @else
                                                                @php
                                                                $total += $product->total;
                                                                @endphp
                                                                @endif

                                                                <tr>

                                                                    <td>
                                                                        {{ $product->id ?? '' }}
                                                                    </td>


                                                                    <td>
                                                                        <img src="{{ asset(!empty($product->product_variantion_id) ? 'variations/'.$product->variations->image : 'products/'.$product->product->image ) ?? '' }}" alt="Image" width="40px">
                                                                    </td>

                                                                    <td>
                                                                        {{ $product->product->product_name }}<br>
                                                                        <small style="color: #ff2446">{{ $product->attribute_values }}</small>
                                                                    </td>


                                                                    <td>
                                                                    {{-- update work 6 --}}

                                                                    @if($product->cancellation_status != 5 && $product->cancellation_status !=6)
                                                                        {{ $cancel_qty ?? '' }}
                                                                    @else
                                                                         {{ $product->quantity }}
                                                                    @endif
                                                                  {{-- update work 6 --}}
                                                                    </td>
                                                                    <td>
                                                                        @if ($product->discounted_price != null)

                                                                        RM{{ number_format($product->discount, 2) }}
                                                                        @else
                                                                        -
                                                                        @endif

                                                                    </td>
                                                                    <td>
                                                                        RM{{number_format($product->price,2)}}

                                                                    </td>
                                                                    <td>

                                                                        @if ($product->discount != null)
                                                                        RM{{ number_format($product->discounted_price, 2) }}
                                                                        @else
                                                                        -
                                                                        @endif

                                                                    </td>


                                                                    <td>

                                                                    @php
                                                                    $return_total = 0;
                                                                    @endphp
                                                                     @if(!empty($product->discounted_price))
                                                                        @php

                                                                             $return_total= $product->discounted_price * $cancel_qty;

                                                                         @endphp
                                                                    @else
                                                                    @php
                                                                        $return_total= $product->price * $cancel_qty;
                                                                    @endphp
                                                                {{-- update work 6 --}}
                                                                    @endif

                                                                    @if($product->cancellation_status != 5 && $product->cancellation_status != 6)
                                                                    @php

                                                                        $sub_total_all += $return_total;
                                                                    @endphp
                                                                    @else
                                                                    @php
                                                                        $sub_total_all += $product->total;
                                                                    @endphp
                                                                    @endif


                                                                    {{-- update work 6 --}}
                                                                    @if($product->cancellation_status != 5 && $product->cancellation_status != 6 ) RM{{number_format($return_total,2)}} @else RM{{number_format($product->total,2)}} @endif
                                                                    {{-- update work 6 --}}
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                 @if($order->order_status_count == 1 || $order->order_status_count == 2 )

                                                @else
                                                <div class="summary-comment-container">
                                                    <div class="comment-container">
                                                        @if ($order->order_status != 3 && $order->order_status != 4 )
                                                        <form method="POST" action="{{ route('order.status', ['id' => $order->id]) }}">
                                                            @csrf
                                                            <div class="control-group">
                                                                <label for="order_status" class="required">Order
                                                                    Status </label>
                                                                <select id="order_status" name="order_status" class="control">
                                                                    <option value="" disabled="disabled">
                                                                        --Choose Order Status--</option>
                                                                    <option value="1" {{ $order->order_status == 1 ? 'selected' : '' }}>
                                                                        Pending</option>
                                                                    <option value="2" {{ $order->order_status == 2 ? 'selected' : '' }}>
                                                                        Dispatched</option>
                                                                    <option value="3" {{ $order->order_status == 3 ? 'selected' : '' }}>
                                                                        Delivered</option>
                                                                    {{-- update work 19 --}}
                                                                    <option value="4" {{ $order->order_status == 4 ? 'selected' : '' }}>
                                                                        Canceled</option>
                                                                    <option value="5" {{ $order->order_status == 5 ? 'selected' : '' }}>
                                                                        On Hold</option>
                                                                    {{-- update work 19 --}}
                                                                </select>
                                                                {{-- <div id="">
                                                                    <label for="order_status" class="required">Tracking ID</label>
                                                                    <input type="text" name="tracking_link" class="control">
                                                                </div> --}}

                                                            </div>
                                                            {{-- <div class="control-group"><label for="comment" class="required">Tracking ID</label>
                                                            </div> --}}
                                                            <div class="control-group"><label for="comment" class="required">Comment</label>
                                                                <textarea id="comment" name="comment" data-vv-as="&quot;Comment&quot;" class="control" aria-required="true" aria-invalid="false"></textarea>

                                                            </div>

                                                            <button type="submit" class="btn btn-lg btn-primary loader-bt">
                                                                Submit
                                                            </button>
                                                        </form>
                                                        @endif

                                                        @if ($order->order_status == 4)
                                                        <div class="control-group">
                                                            <label for="order_status" class="required">Order
                                                                status : <span class="span badge rounded-pill pill-badge-danger">Cancelled</span></label>
                                                        </div>
                                                        @endif

                                                        <ul class="comment-list"></ul>
                                                    </div>

                                                    <table class="sale-summary">
                                                        <tbody>

                                                            <tr>
                                                                <td>Shipping &amp; Handling</td>
                                                                <td>RM{{ number_format($order->delivery_fee,2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total</td>
                                                                <td>RM{{number_format($sub_total_all,2)}}  </td>
                                                            </tr>
                                                            <tr class="bold">
                                                                <td>Grand Total</td>
                                                                <td>RM{{number_format($sub_total_all + $order->delivery_fee,2) }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    {{-- tracking --}}

                                    {{-- @if($order->order_status_count != 1 || $order->order_status_count !=2 ) --}}
                                    <div class="accordion-item">
                                    {{-- update work 6 --}}
                                        @if($order->order_status_count != 1 && $order->order_status_count !=2 )
                                            <h2 class="accordion-header" id="headingFive">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                    Order Tracking Details
                                                </button>
                                            </h2>
                                        @endif
                                    {{-- update work 6 --}}
                                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {{-- <div class="table"> --}}
                                                {{-- <div class="table-responsive"> --}}
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="orderInformation">
                                                            <h6>Tracking Details</h6>
                                                            <hr>
                                                        </div>
                                                        <form method="GET" action="{{route('order-tracking', $order->id)}}">
                                                            @csrf
                                                            <div class="row mt-3">
                                                                <div class="col-lg-4">
                                                                    <label>Tracking Link</label><br>
                                                                    <input type="text" name="tracking_link" class="inputField" placeholder="Tracking Link">
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label>Tracking Link</label><br>
                                                                    <input type="number" name="tracking_id" class="inputField" placeholder="Tracking ID">
                                                                </div>
                                                            </div>
                                                            <button class="submitBtn">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endif --}}
                                    {{-- end --}}
                                </div>

                            </div>
                            {{-- end --}}

                            {{-- pillsInvoices --}}
                            <div class="tab-pane fade" id="pillsInvoices" role="tabpanel" aria-labelledby="pillsInvoicesTab">

                                <div class="table" style="padding: 20px 0px;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>SR.No</th>
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Product Status</th>
                                                <th>Payment Status</th>
                                                <th>Invoice Date</th>

                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices->purchased_items as $invoice)
                                            {{-- {{dd($invoice)}} --}}
                                            <tr>
                                                <td>{{ $loop->iteration  }}</td>
                                                <td>{{ $invoices->id }}</td>
                                                <td>{{ $invoices->user->name }}</td>
                                                @if($invoice->product->product_type == 1 )
                                                <td>{{ $invoice->product->product_name ?? ''  }}
                                                </td>
                                                @else
                                                <td>{{ $invoice->product->product_name ?? ''  }}
                                                    <small style="color: #ff2446">{{ $invoice->attribute_values ?? '' }}</small>
                                                </td>
                                                @endif
                                                <td>{{ $invoice->quantity }}</td>
                                                <td>RM{{ $invoice->total }}</td>
                                                @if($invoice->cancellation_status != 1 && $invoice->cancellation_status != 2)
                                                <td>@if($invoices->order_status == 1) Pending @endif @if($invoices->order_status == 2) Dispatch @endif
                                                    @if($invoices->order_status == 3) Delivered @endif
                                                    @if($invoices->order_status == 4) Cancelled By Admin @endif
                                                    @if($invoices->order_status == 5) Hold @endif </td>
                                                @endif
                                                @if($invoice->cancellation_status == 1 || $invoice->cancellation_status == 2)
                                                <td>@if($invoice->cancellation_status == 1) Cancelled @endif @if($invoice->cancellation_status == 2) Refund @endif</td>
                                                @endif

                                                <td>@if($invoices->payment_response == null) Cash On Delivery @else Paid @endif</td>

                                                <td>{{ $invoice->updated_at }}</td>
                                                {{-- <td><a href="{{ route('invoice.index', ['id' => $invoices->id]) }}"><i class="fa fa-eye" aria-hidden="true"></i></a></td> --}}
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            {{-- end --}}

                            {{-- update work 6 --}}

                            {{-- pillsInvoicesOne --}}
                            <div class="tab-pane fade" id="pillsInvoicesOne" role="tabpanel"
                                    aria-labelledby="pillsInvoicesOneTab">
                            {{-- <div class="top-margin">
                                    <div class="login-sec-box position-relative">
                                        <div class="buttons">
                                            <button class="emailSendButton noPrint">Through Email</button>
                                            <button class="remove-btn-css noPrint" onclick="window.print();">
                                                <div class="red-back-btn print-btn-css">
                                                    <i class="fa fa-print" aria-hidden="true"></i>
                                                </div>
                                            </button>
                                        </div>
                                        <div class="invoice-tabel-sec mt1">
                                            <h1 class="invoice-no-heading text-center">Order ID : <span id="orderIdInvoice">#2</span></h1>
                                            <div class="row mt2">
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="invoice-email">
                                                        <label for="">Date :</label>
                                                        <p class="tabel-line" id="orderDateInvoice">30/Dec/2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12  mt1">
                                                            <div class="invoice-email">
                                                                <label for="" class="fw-bold"> Bill To :</label>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12  mt0">
                                                            <div class="invoice-email justify-content-between">
                                                                <label for="">Contact Name :</label>
                                                                <label for="" id="billingContactName">Tofique</label>
                                                            </div>

                                                            <div class="invoice-email justify-content-between">
                                                                <label for="">Address for :</label>
                                                                <label for="" id="billingAddressFor">Home</label>
                                                            </div>


                                                            <div class="invoice-email justify-content-between">
                                                                <label for="">Address :</label>
                                                                <label for="" id="billingAddress">5, 64 - DHA, karachi</label>
                                                            </div>
                                                            <div class="invoice-email justify-content-between">
                                                                <label for="">Phone :</label>
                                                                <label for="" id="billingPhone">0316870666265</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 mt1">
                                                            <div class="invoice-email">
                                                                <label for="" class="fw-bold"> Ship To :</label>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 mt0">
                                                            <div class="invoice-email justify-content-between">
                                                                <label for="">Contact Name :</label>
                                                                <label for="" id="shippingContactName">Tofique</label>
                                                            </div>


                                                            <div class="invoice-email justify-content-between">
                                                                <label for="">Address for :</label>
                                                                <label for="" id="shippingAddressFor">Home</label>
                                                            </div>

                                                            <div class="invoice-email justify-content-between">
                                                                <label for="">Address :</label>
                                                                <label for="" id="shippingAddress">5, 64 - DHA, karachi</label>
                                                            </div>
                                                            <div class="invoice-email justify-content-between">
                                                                <label for="">Phone :</label>
                                                                <label for="" id="shippingPhone">0316870666265</label>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="cstm-invoice-tabel mt2">
                                            <table class="table table-striped">
                                                <thead class="tableHeading">
                                                    <tr>
                                                        <th scope="col" style="font-size:15px !important; color: #646364 !important;">
                                                            S.No</th>

                                                        <th scope="col" style="font-size:15px !important; color: #646364 !important;">
                                                            Products</th>

                                                        <th scope="col" style="font-size:15px !important; color: #646364 !important;">
                                                            QTY</th>
                                                        <th scope="col" style="font-size:15px !important; color: #646364 !important;">
                                                            Unit Price</th>
                                                        <th scope="col" style="font-size:15px !important; color: #646364 !important;">
                                                            Total</th>
                                                            <th scope="col" style="font-size:15px !important; color: #646364 !important;">
                                                                Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="invoiceTbody">
                                                    <tr>
                                                        <th scope="row" style="font-size:15px !important; color: #646364 !important;">
                                                            1</th>
                                                        <td>Amelia Barber</td>
                                                        <td>2</td>
                                                        <td>$573.00</td>
                                                        <td>$1,146.00</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" style="font-size:15px !important; color: #646364 !important;">
                                                            2</th>
                                                        <td>Amelia Barber</td>
                                                        <td>4</td>
                                                        <td>$288.00</td>
                                                        <td>$1,152.00</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" style="font-size:15px !important; color: #646364 !important;">
                                                            3</th>
                                                        <td>Rooney Mann</td>
                                                        <td>3</td>
                                                        <td>$450.00</td>
                                                        <td>$1,350.00</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" style="font-size:15px !important; color: #646364 !important;">
                                                            4</th>
                                                        <td>Rooney Mann</td>
                                                        <td>1</td>
                                                        <td>$687.00</td>
                                                        <td>$687.00</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" style="font-size:15px !important; color: #646364 !important;">
                                                            5</th>
                                                        <td>Simple product with discount</td>
                                                        <td>3</td>
                                                        <td>$850.00</td>
                                                        <td>$2,550.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row mt2">
                                            <div class="col-lg-8"></div>
                                            <div class="col-lg-4 col-md-6" id="summary_amount">

                                                <div class="invoice-email justify-content-end">
                                                    <label for="">Sub Total :</label>
                                                    <p class="tabel-line text-end">$6,885.00</p>
                                                </div>
                                                <div class="invoice-email justify-content-end">
                                                    <label for="">Delivery Fee :</label>
                                                    <p class="tabel-line text-end">$15.00</p>
                                                </div>
                                                <div class="invoice-email justify-content-end">
                                                    <label for="">Discount :</label>
                                                    <p class="tabel-line text-end">$0.00</p>
                                                </div>
                                                <div class="invoice-email justify-content-end">
                                                    <label for="">Total :</label>
                                                    <p class="tabel-line text-end">$6,900.00</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                            </div> --}}

                            <div class="buttons">
                                <button class="emailSendButton noPrint">Through Email</button>
                                <button class="remove-btn-css noPrint" onclick="window.print();">
                                    <div class="red-back-btn print-btn-css">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </div>
                                </button>
                            </div>
                                    <table class="for-blur-background"style="height:100%;width:100%;text-align:center;margin-left:auto;margin-right: auto; background-color: rgb(255, 255, 255);">
                                        <tr>
                                            <th>
                                                <img src="https://lotti.com.my/lotti_dev/public/logos/1668092422.webp"
                                                    alt=""
                                                    style="width:90px;border-radius: 6px;height: 36px; object-fit: contain; background-color: #ff2446; padding: 8px; margin-top: 20px; margin-bottom: 20px;">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h4
                                                    style="font-family:sans-serif;color: #000;text-transform: capitalize;text-align: center;width:79.5%; margin:auto;padding-top: 10px; margin-bottom: 10px;">
                                                    Invoice</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p style="width:80%; margin:auto; text-align: start;">Hi lotti Users,</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p style="width:80%; margin:auto; text-align: start;">Thank you for
                                                    choosing lotti! Items from your order <span
                                                        style="font-weight: 900;color: #000;">#1</span> has been placed.
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p style="width:80%; margin:auto; text-align: start;">It is a long
                                                    established fact that a reader will be distracted by the readable
                                                    content of a page when looking at its layout.</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h4
                                                    style="font-family:sans-serif;color: #000;text-transform: capitalize;text-align: start;width:79.5%; margin:auto;padding-top: 10px; margin-bottom: 6px;">
                                                    Delivery Details</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p
                                                    style="width:80%; margin:auto; display: flex; gap: 16px; text-align: start;">
                                                    <label style="min-width:65px;">Name:</label>
                                                    <span>Lotti Users</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p
                                                    style="width:80%; margin:auto; display: flex; gap: 16px; text-align: start;">
                                                    <label style="min-width:65px;">Address:</label>
                                                    <span>Address here will be distracted by the readable content of a page
                                                        when will uncover many web sites still in their infancy looking at
                                                        its layout. </span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p
                                                    style="width:80%; margin:auto; display: flex; gap: 16px; text-align: start;">
                                                    <label style="min-width:65px;">Phone:</label>
                                                    <span>123456789</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p
                                                    style="width:80%; margin:auto; display: flex; gap: 16px; text-align: start;">
                                                    <label style="min-width:65px;">Email:</label>
                                                    <span>lottiusers@gmail.com</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h4
                                                    style="font-family:sans-serif;color: #000;text-transform: capitalize;text-align: start;width:79.5%; margin:auto;padding-top: 10px; margin-bottom: 6px;">
                                                    Order Details</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p style="width:80%; margin:auto; text-align: start;">
                                                    <label>Items 1</label><br>
                                                    <span>Sold by Lotti</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="padding-bottom: 10px;">
                                                <span
                                                    style="width:78.5%; margin:auto; text-align: start; display: flex; gap: 12px;font-family:sans-serif; font-size: 13px;color: #898b93;">
                                                    <p>
                                                        <img src="https://www.theadreview.com/wp-content/uploads/2021/10/Christopher-Coleman-partner-of-MjSeo-Agency.jpg"
                                                            alt=""
                                                            style="width:120px;border-radius: 5%;height: 110px;object-fit: cover;">
                                                    </p>
                                                    <p
                                                        style="width:60%;text-align: start; display: flex; flex-direction: column; gap: 6px;">
                                                        <span>It is a long established fact that a reader will be distracted
                                                            by the readable content of a page when looking at its
                                                            layout.</span>
                                                        <span>Build in mic - Black</span>
                                                        <span>$120</span>
                                                        <span>x 2</span>
                                                    </p>
                                                </span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p
                                                    style="width:80%; margin:auto; display: flex; text-align: start; justify-content: space-between;">
                                                    <label style="min-width:65px;">Order Total:</label>
                                                    <span>$120</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p
                                                    style="width:80%; margin:auto; display: flex; text-align: start; justify-content: space-between;">
                                                    <label style="min-width:65px;">Delivery Fee:</label>
                                                    <span>$120</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p
                                                    style="width:80%; margin:auto; display: flex; text-align: start; justify-content: space-between;">
                                                    <label style="min-width:65px;">Total Discount:</label>
                                                    <span>$120</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p
                                                    style="width:80%; margin:auto; display: flex; text-align: start; justify-content: space-between; font-weight: 900;">
                                                    <label style="min-width:65px; ">Total payment (With GST):</label>
                                                    <span>$120</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p
                                                    style="width:80%; margin:auto; display: flex; text-align: start; justify-content: space-between;">
                                                    <label style="min-width:65px;">Delivery Method:</label>
                                                    <span>STANDARD</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p
                                                    style="width:80%; margin:auto; display: flex; text-align: start; justify-content: space-between;">
                                                    <label style="min-width:65px;">Paid By:</label>
                                                    <span>COD</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h4
                                                    style="font-family:sans-serif;color: #000;text-transform: capitalize;text-align: start;width:79.5%; margin:auto;padding-top: 10px; margin-bottom: 10px;">
                                                    Need Help?</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h5
                                                    style="font-family:sans-serif;color: #898b93;text-transform: capitalize;text-align: start;width:79.5%; margin:auto;">
                                                    How Can I reviews...?</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p style="width:80%; margin:auto; text-align: start;">It is a long
                                                    established fact that a reader will be distracted by the readable
                                                    content of a page when looking at its layout. The point of using Lorem
                                                    Ipsum is that it has a more-or-less normal distribution.</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h4
                                                    style="font-family:sans-serif;color: #000;text-transform: capitalize;text-align: start;width:79.5%; margin:auto;padding-top: 10px; margin-bottom: 5px;">
                                                    Notes</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p style="width:80%; margin:auto; text-align: start;">For more information,
                                                    that a reader will be distracted by the readable content of a page.</p>
                                            </th>
                                        </tr>


                                        <tr>
                                            <th>
                                                <img src='https://lotti.com.my/lotti_dev/public/logos/1668092422.webp'
                                                    alt=""
                                                    style="width:90px;border-radius: 6px;height: 36px;object-fit: contain; background-color: #ff2446; padding: 8px; margin-top: 20px; margin-bottom: 5px;">
                                            </th>
                                        </tr>

                                        <tr>
                                            <th
                                                style="padding-bottom: 0px;font-family:sans-serif;color: #898b93;font-size: 13px;">
                                                <p style="text-align: center;">
                                                    <span>Privacy Policy</span>
                                                    <span> - </span>
                                                    <span>Terms & Conditions</span>
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-family:sans-serif;color: #898b93;font-size: 13px;padding: 5px;">
                                                <p style="width:80%; margin:auto;">This is an automatically generated
                                                    e-mail from our subscription list,<br> Please do not reply to this
                                                    e-mail.</p>
                                            </th>
                                        </tr>

                                    </table>
                                </div>
                            {{-- end --}}

                            {{-- refund --}}
                            <div class="tab-pane fade" id="pillsShipments" role="tabpanel" aria-labelledby="pillsShipmentsTab">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSeven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                            Refund Request
                                        </button>
                                    </h2>


                                    <div id="collapseSeven" class="accordion-collapse collapseSeven" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                        {{-- <div id="collapseSix" class="accordion-collapse collapse"
                                        aria-labelledby="headingSix" data-bs-parent="#accordionExample"> --}}
                                        <div class="accordion-body">
                                            <div class="table">
                                                <div class="table-responsive">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>s.no</th>
                                                                <th>Image</th>
                                                                <th>Product Name</th>
                                                                <th>Quantity</th>
                                                                <th>Save Amount</th>
                                                                <th>Unit Cost</th>
                                                                <th>Discounted Price</th>
                                                                <th>Subtotal</th>
                                                                {{-- update work 17 --}}
                                                                {{-- <th>Action</th> --}}
                                                                {{-- <th>Item Status</th> --}}
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

                                                            @php
                                                                $return_qty_total  = 0;
                                                            @endphp

                                                          @foreach ($order->purchased_items as $allrefund)
                                                            @php
                                                            $total += 0;
                                                            @endphp
                                                            {{-- @else --}}

                                                            @if($allrefund->order_status == 3 )
                                                            @php
                                                            $total += $allrefund->total ;
                                                            @endphp
                                                            @endif
                                                            @if(!empty($allrefund->discounted_price))
                                                            @php
                                                                 $return_qty_total+= $allrefund->discounted_price* $allrefund->return_quantity;
                                                             @endphp
                                                            @else
                                                            @php
                                                                $return_qty_total+= $allrefund->price * $allrefund->return_quantity;
                                                                @endphp


                                                            @endif


                                                            <tr>
                                                                @if($allrefund->order_status == 3)
                                                                <td>
                                                                    {{ $allrefund->id ?? '' }}
                                                                </td>
                                                                @endif

                                                                @if($allrefund->order_status == 3)
                                                                <td>
                                                                    <img src="{{ asset(!empty($allrefund->product_variantion_id) ? 'variations/'.$allrefund->variations->image : 'products/'.$allrefund->product->image ) ?? '' }}" alt="Image" width="40px">
                                                                </td>

                                                                <td>
                                                                    {{ $allrefund->product->product_name }}<br>
                                                                    <small style="color: #ff2446">{{ $product->attribute_values }}</small>
                                                                </td>

                                                                @if(!empty($allrefund->return_quantity))
                                                                <td>
                                                                    {{ $allrefund->return_quantity ?? '' }}

                                                                </td>
                                                                @else
                                                                <td>
                                                                    {{ $allrefund->quantity ?? '' }}

                                                                </td>
                                                                @endif
                                                                <td>
                                                                    @if ($allrefund->discounted_price != null)

                                                                    RM{{ number_format($allrefund->discount, 2) }}
                                                                    @else
                                                                    -
                                                                    @endif

                                                                </td>


                                                                <td>
                                                                    {{ $allrefund->price ?? '' }}
                                                                </td>
                                                                <td>

                                                                    @if ($allrefund->discount != null)
                                                                    RM{{ number_format($allrefund->discounted_price, 2) }}
                                                                    @else
                                                                    -
                                                                    @endif

                                                                </td>
                                                                @if($return_qty_total != 0)
                                                                <td>

                                                                    RM{{ number_format($return_qty_total, 2) ?? '' }}

                                                                </td>
                                                                @else
                                                                <td>
                                                                    RM{{ number_format($allrefund->total, 2) ?? '' }}
                                                                </td>
                                                                @endif


                                                            </tr>
                                                            @endif
                                                              @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                              @if(!empty($allrefund))
                                              {{-- {{dd($allrefund->order_status == 2)}} --}}
                                            <div class="summary-comment-container">
                                                <div class="comment-container">
                                                   {{-- @foreach ($order->purchased_items as $allrefund ) --}}
                                                    <form method="POST" action="{{ route('order.status', ['id' => $allrefund->id]) }}">
                                                        @csrf

                                                        @if(!empty($allrefund->get_reason))
                                                        <div class="control-group">
                                                            <label for="order_status" class="required"><strong>Refund Reason</strong></label>
                                                            {{$allrefund->get_reason->reason ?? ''}}
                                                            <br>
                                                            <label for="order_status" class="required"><strong>Refund Detail</strong></label>
                                                            {{$allrefund->cancellation_comments ?? ''}}
                                                        </div>
                                                        @endif
                                                        <br>

                                                        <div class="control-group">
                                                            {{-- <label for="order_status" class="required"><strong>Refund Item Images</strong></label> --}}
                                                            <div class="d-flex">
                                                                @if(!empty($allrefund->cancellation_image))
                                                                @foreach (json_decode($allrefund->cancellation_image) as $key => $image)
                                                                <a href="{{url('public/cancellation_image/' . $image)}}" target="_blank">
                                                                    <div class="" style="width:50px; height:50px; margin:0px 6px;">
                                                                        <img src="{{ url('public/cancellation_image/' . $image) }}" alt="" height="100%" width="100%" style="object-fit:contain;">
                                                                    </div>
                                                                </a>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </form>
                                                     {{-- @break; --}}
                                                {{-- @endforeach --}}
                                                @endif

                                                    <ul class="comment-list"></ul>

                                                </div>


                                                <table class="sale-summary">
                                                    <tbody>

                                                        <tr>
                                                            <td>Shipping &amp; Handling</td>
                                                            <td>${{ $allrefund->delivery_fee }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total</td>
                                                            @if($return_qty_total != 0)
                                                            <td>RM{{$return_qty_total }}</td>
                                                            @else
                                                            <td>RM{{ $total }}</td>
                                                            @endif
                                                        </tr>


                                                        <tr class="bold">
                                                            <td>Grand Total</td>

                                                             @if($return_qty_total != 0)
                                                            <td>RM{{$return_qty_total + $allrefund->delivery_fee}}</td>
                                                            @else
                                                            <td>RM{{ $total + $allrefund->delivery_fee }}</td>
                                                            @endif
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="cancelTextBox">
                                                {{-- @if($allrefund->cancellation_status == 3) --}}
                                                <form action="{{route('refund-status',$allrefund->order_id)}}" method="GET">
                                                    @csrf
                                                    <div class="textAreaBox">
                                                        <textarea  id="textareainput" type="text" name="admin_refund_reason" class="inputMessages" placeholder="Type Here..."></textarea>
                                                    </div>
                                                    <a href="#"><button type="submit" class="btn  btn-primary loader-bt">
                                                            Approve
                                                        </button></a>
                                                        {{-- update work  --}}


                                                </form>
                                                <form method="GET" action="{{route('decline_refund-status',$allrefund->order_id) }}">
                                                @csrf
                                                   <textarea id="textareahidden" type="hidden" name="admin_refund_reason" class="inputMessages" placeholder="Type Here..." style="display:none;"></textarea>
                                                 <a href="#"><button type="submit" class="btn  btn-primary loader-bt">
                                                            Decline
                                                        </button></a>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endforeach --}}
                                </div>
                            </div>

                            {{-- end --}}

                            {{-- @if($product->order_status == 2) --}}
                            <div class="tab-pane fade" id="pillsCancel" role="tabpanel" aria-labelledby="pillsCancelTab">
                                <div class="accordion-item">

                                    <h2 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            Cancellation Request
                                        </button>
                                    </h2>

                                    <div id="collapseSix" class="accordion-collapse collapseSix" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                        {{-- <div id="collapseSix" class="accordion-collapse collapse"
                                        aria-labelledby="headingSix" data-bs-parent="#accordionExample"> --}}
                                        <div class="accordion-body">
                                            <div class="table">
                                                <div class="table-responsive">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>s.no</th>
                                                                <th>Image</th>
                                                                <th>Product Name</th>
                                                                <th>Quantity</th>
                                                                <th>Save Amount</th>
                                                                <th>Unit Cost</th>
                                                                <th>Discounted Price</th>
                                                                <th>Subtotal</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $total = 0;
                                                            @endphp

                                                            @php
                                                                $return_qty_total = 0;
                                                                $sub_total_all = 0;
                                                            @endphp


                                                        @foreach ($order->purchased_items as $allcancelled )
                                                            @php
                                                            $total += 0;
                                                            @endphp
                                                            @if($allcancelled->order_status == 2 || $product->order_status == 3)
                                                            @php
                                                            $total += $allcancelled->total;
                                                            $check_quntity = 0;
                                                            @endphp
                                                            @endif

                                                             @if(!empty($allcancelled->discounted_price))
                                                            @php
                                                                 $return_qty_total+= $allcancelled->discounted_price* $allrefund->return_quantity;
                                                             @endphp
                                                            @else
                                                            @php
                                                                $return_qty_total+= $allcancelled->price * $allcancelled->return_quantity;
                                                                @endphp

                                                            @endif

                                                            @if($allcancelled->cancellation_status !=1)
                                                            <tr>
                                                                @if($allcancelled->order_status == 2)
                                                                <td>
                                                                    {{ $allcancelled->id ?? '' }}
                                                                </td>
                                                                @endif

                                                                @if($allcancelled->order_status == 2)
                                                                <td>
                                                                    <img src="{{ asset(!empty($allcancelled->product_variantion_id) ? 'variations/'.$allcancelled->variations->image : 'products/'.$allcancelled->product->image ) ?? '' }}" alt="Image" width="40px">
                                                                </td>

                                                                <td>
                                                                    {{ $allcancelled->product->product_name }}<br>
                                                                    <small style="color: #ff2446">{{ $allcancelled->attribute_values }}</small>
                                                                </td>

                                                                @if(!empty($allcancelled->return_quantity))
                                                                <td>
                                                                    {{ $allcancelled->return_quantity}}
                                                                    @php
                                                                        $check_quntity = $allcancelled->return_quantity;
                                                                    @endphp
                                                                </td>
                                                                @else
                                                                    <td>
                                                                          {{ $allcancelled->quantity}}
                                                                          @php
                                                                          $check_quntity = $allcancelled->return_quantity;
                                                                          @endphp
                                                                    </td>
                                                                @endif

                                                                <td>
                                                                    @if ($allcancelled->discounted_price != null)

                                                                    RM{{ number_format($allcancelled->discount, 2) }}
                                                                    @else
                                                                    -
                                                                    @endif

                                                                </td>
                                                                <td>RM{{number_format($allcancelled->price,2)}}</td>

                                                                <td>
                                                                    @if ($allcancelled->discount != null)
                                                                    RM{{ number_format($allcancelled->discounted_price, 2) }}
                                                                    @else
                                                                    -
                                                                    @endif

                                                                </td>

                                                                <td>

                                                                    @php
                                                                    $return_total = 0;
                                                                    @endphp

                                                                     @if(!empty($allcancelled->discounted_price))
                                                                        @php

                                                                             $return_total= $allcancelled->discounted_price * $check_quntity;

                                                                         @endphp
                                                                    @else
                                                                    @php
                                                                        $return_total= $allcancelled->price * $check_quntity;
                                                                    @endphp

                                                                    @endif

                                                                    @php
                                                                    $sub_total_all += $return_total;
                                                                    @endphp
                                                                    {{-- update work 6 --}}

                                                                    @if($order->order_status_count != 1)
                                                                         RM{{number_format($return_total,2)}}
                                                                    @else
                                                                         RM{{ number_format($allcancelled->total, 2) ?? '' }}
                                                                    @endif

                                                                {{-- update work 6 --}}
                                                                </td>

                                                                @endif

                                                            </tr>
                                                            @endif
                                                              @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            @if(!empty($allcancelled))

                                            <div class="summary-comment-container">
                                                <div class="comment-container">
                                                    @if ($order->order_status != 3 && $order->order_status != 4)
                                                    <form method="POST" action="{{ route('order.status', ['id' => $allcancelled->id]) }}">
                                                        @csrf
                                                        @if(!empty($allcancelled->get_reason))
                                                        <div class="control-group">
                                                            <label for="order_status" class="required"><strong>Cancellation Reason</strong></label>
                                                            {{$allcancelled->get_reason->reason ?? 'N/A'}} <br>
                                                            <label for="order_status" class="required"><strong>Cancellation Detail</strong></label>
                                                            {{$allcancelled->cancellation_comments ?? 'N/A'}}

                                                        </div>
                                                        @endif
                                                    </form>
                                                    @endif

                                                    <ul class="comment-list"></ul>
                                                </div>

                                               <table class="sale-summary">
                                                    <tbody>


                                                        {{-- <tr>
                                                            <td>Shipping &amp; Handling</td>
                                                            <td>RM{{ number_format($allcancelled->delivery_fee,2) }}</td>
                                                        </tr> --}}
                                                        {{-- update work 6 --}}
                                                        <tr>
                                                            <td>Total</td>
                                                            <td>@if($order->order_status_count != 1)RM{{number_format($sub_total_all,2)}} @else RM{{number_format($total,2)}} @endif</td>
                                                        </tr>


                                                        <tr class="bold">
                                                            <td>Grand Total</td>

                                                            <td>@if($order->order_status_count != 1)RM{{number_format($sub_total_all)}} @else RM{{number_format($total + $allcancelled->delivery_fee)}} @endif </td>

                                                        </tr>
                                                        {{-- update work 6 --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="cancelTextBox">
                                                <form method="GET" action="{{route('cancel-status',$allcancelled->order_id)}}">
                                                    @csrf
                                                    <div class="textAreaBox">
                                                        <textarea id="textareacancel" type="text" name="admin_cancel_reason" class="inputMessages" placeholder="Type Here..."></textarea>
                                                    </div>
                                                    <a href="#"><button type="submit" class="btn  btn-primary">
                                                            Approve
                                                        </button></a>

                                               </form>
                                               <form method="GET" action="{{route('decline_cancel-status',$allcancelled->order_id)}}">
                                                @csrf
                                                    <textarea id="textareacancelhidden" type="hidden" name="admin_cancel_reason" class="inputMessages" placeholder="Type Here..." style="display:none;"></textarea>
                                                    <a href="#"><button type="submit" class="btn  btn-primary">
                                                            Decline
                                                    </button></a>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="tab-pane fade" id="pillsHistory" role="tabpanel" aria-labelledby="pillsHistory">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            Order History
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapseSix" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="table">
                                                <div class="table-responsive">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>s.no</th>
                                                                <th>Image</th>
                                                                <th>Product Name</th>
                                                                <th>Quantity</th>
                                                                <th>Save Amount</th>
                                                                <th>Unit Cost</th>
                                                                <th>Discounted Price</th>
                                                                <th>Subtotal</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $total = 0;
                                                            @endphp

                                                            @foreach ($order->purchased_items as $product)

                                                            @php
                                                            $total += 0;
                                                            @endphp
                                                            @if($product->order_status == 2 || $product->order_status == 3)
                                                            @php
                                                            $total += $product->total;
                                                            @endphp
                                                            @endif

                                                            <tr>
                                                                @if($product->order_status == 2)
                                                                <td>
                                                                    {{ $product->id ?? '' }}
                                                                </td>
                                                                @endif

                                                                @if($product->order_status == 2)
                                                                <td>
                                                                    <img src="{{ asset(!empty($product->product_variantion_id) ? 'variations/'.$product->variations->image : 'products/'.$product->product->image ) ?? '' }}" alt="Image" width="40px">
                                                                </td>

                                                                <td>
                                                                    {{ $product->product->product_name }}<br>
                                                                    <small style="color: #ff2446">{{ $product->attribute_values }}</small>
                                                                </td>
                                                                <td>
                                                                    {{ $product->quantity ?? '' }}

                                                                </td>
                                                                <td>
                                                                    @if ($product->discounted_price != null)

                                                                    RM{{ number_format($product->discount, 2) }}
                                                                    @else
                                                                    -
                                                                    @endif

                                                                </td>
                                                                <td>{{ $product->price}}</td>

                                                                <td>

                                                                    @if ($product->discount != null)
                                                                    RM{{ number_format($product->discounted_price, 2) }}
                                                                    @else
                                                                    -
                                                                    @endif

                                                                </td>

                                                                <td>

                                                                   return_total

                                                                </td>

                                                                @endif

                                                            </tr>
                                                            @endforeach
                                                            {{-- @endforeach --}}

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="summary-comment-container">
                                                <div class="comment-container">
                                                    @if ($order->order_status != 3 && $order->order_status != 4)
                                                    <form method="POST" action="{{ route('order.status', ['id' => $order->id]) }}">
                                                        @csrf
                                                        <div class="control-group">
                                                            <label for="order_status" class="required"><strong>Cancellation Reason</strong></label>
                                                            {{$reasons->get_reason->reason ?? 'N/A'}} <br>
                                                            <label for="order_status" class="required"><strong>Cancellation Detail</strong></label>
                                                            {{$reasons->cancellation_comments ?? 'N/A'}}

                                                        </div>

                                                    </form>
                                                    @endif

                                                    <ul class="comment-list"></ul>
                                                </div>
                                                <table class="sale-summary">
                                                    <tbody>

                                                        <tr>
                                                            <td>Shipping &amp; Handling</td>
                                                            <td>RM{{ $order->delivery_fee }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total</td>
                                                            <td>RM{{ $total }}</td>
                                                        </tr>

                                                        <tr class="bold">
                                                            <td>Grand Total</td>
                                                            <td>RM{{ $total + $order->delivery_fee }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                @if($product->cancellation_status == 3)
                                                                <a href="{{route('cancel-status',$order->id)}}"><button type="submit" class="btn  btn-primary loader-bt">
                                                                        Approve
                                                                    </button></a>

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

                    {{-- update work 13 Refund request --}}


                    {{-- @endif --}}
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

<!-- Start Modal -->



<!-- Start Modal -->


@push('scripts')

{{-- update work 19 --}}
<script>
    $(document).ready(function() {
        $(".loader-bt").on('click', function() {
            $("#preloaderSmall").removeClass('loader-active');
        });
    });

</script>
{{-- update work 19 --}}

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
<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print(); {
            {
                --document.body.innerHTML = restorepage;
                --
            }
        }
    }

</script>
{{-- update work 31 --}}

<script>
{{-- function orderInvoiceTab(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('order_invoice') }}",
data : {
id:id
},
beforeSend: function() {
$("#preloaderSmall").removeClass('loader-active');
},
success: function(response) {
$("#preloaderSmall").addClass('loader-active');

}
});
} --}}
</script>

<script>
    function orderInvoiceTab(id) {
        {{-- alert(id); --}}
        $.ajax({
            type: "GET",
            url: "{{ route('order_invoice') }}",
            data : {
                id:id
            },
            beforeSend: function() {
                $("#preloaderSmall").removeClass('loader-active');

            },
            success: function(response) {
                $("#preloaderSmall").addClass('loader-active');
                $("#orderIdInvoice").html("");
                $("#orderIdInvoice").html("#" + response.order.id);

                $("#orderDateInvoice").html("");
                $("#orderDateInvoice").html(response.created_at);

                 $("#billingContactName").html("");
                $("#billingContactName").html(response.billing_address.name);
                $("#billingAddressFor").html("");
                $("#billingAddressFor").html(
                    `${response.billing_address.delivery_label == 1 && response.billing_address.delivery_label != null ? 'Home' : 'Office'}`
                );
                  {{-- update work 31 --}}
                $("#billingAddress").html("");
                $("#billingAddress").html(
                    `${response.billing_address.province}, ${response.billing_address.get_city.city} - ${response.billing_address.landmark}, ${response.billing_address.address}`
                );
                $("#billingPhone").html("");
                $("#billingPhone").html(`${response.billing_address.contact}`);

                // shipping address
                $("#shippingContactName").html("");
                $("#shippingContactName").html(response.shipping_address.name);
                $("#shippingAddressFor").html("");
                $("#shippingAddressFor").html(
                    `${response.shipping_address.delivery_label == 1 && response.shipping_address.delivery_label != null ? 'Home' : 'Office'}`
                );
                $("#shippingAddress").html("");
                $("#shippingAddress").html(
                    `${response.shipping_address.province}, ${response.shipping_address.get_city.city} - ${response.shipping_address.landmark}, ${response.shipping_address.address}`
                );
                $("#shippingPhone").html("");
                $("#shippingPhone").html(`${response.shipping_address.contact}`);

               $("#invoiceTbody").html("");
                let tbody = '';
                for (let x = 0; x < response.purchased_items.length; x++) {
                    console.log(response.order.purchased_items[x].product.product_type);


                    tbody += `

                   <tr>

                    <th scope="row"
                            style="font-size:15px !important; font-family: montserratBold !important; color: #646364 !important;">
                        ${x + 1}</th>

                         ${response.order.purchased_items[x].product.product_type == 1 ?
                       `<td>
                       ${response.purchased_items[x].product_name}</td>` : `<td>
                       ${response.purchased_items[x].product_name} ${response.order.purchased_items[x].attribute_values}</td>` }
                        <td>${response.purchased_items[x].qty}</td>
                         <td>RM${response.purchased_items[x].price}</td>
                        <td>RM${response.purchased_items[x].total}</td>
                        ${response.order.purchased_items[x].order_status == 2 ?
                        `<td>${response.order.purchased_items[x].order_status == 2 ?  `Cancelled` : `Purchased` }
                         </td>` : `<td>${response.order.purchased_items[x].order_status == 3 ?  `Refund` : `Purchased` }
                         </td>` }
                         </tr>
                    `;


                }


                $("#invoiceTbody").html(tbody);
                for (let x = 0; x < response.purchased_items.length; x++) {
                    if (response.order.purchased_items[x].order_status == 2 || response.order
                        .purchased_items[x].order_status == 3) {
                        var unitprice = response.purchased_items[x].total * response.purchased_items[x].qty;
                        var finalprice = response.purchased_items_sum_price - unitprice;
                        console.log(finalprice);
                    }


                    {{-- console.log(unitprice); --}}
                    $("#summary_amount").html(`

                        <div class="invoice-email justify-content-end">
                            <label for="">Sub Total :</label>
                            ${response.order.purchased_items[x].cancellation_status == 2 || response.order.purchased_items[x].cancellation_status == 3 ?
                           ` <p class="tabel-line text-end">RM${response.cancel_item_sum_price}  </p>` : `<p class="tabel-line text-end">RM${response.purchased_items_sum_price}</p>`}
                        </div>
                        <div class="invoice-email justify-content-end">
                            <label for="">Delivery Fee :</label>
                            <p class="tabel-line text-end">RM${response.delivery_fee}</p>
                        </div>
                        <div class="invoice-email justify-content-end">
                            <label for="">Total Save Amount :</label>
                            <p class="tabel-line text-end">RM${response.total_discount}</p>
                        </div>
                        <div class="invoice-email justify-content-end">
                            <label for="">Total :</label>
                            ${response.order.purchased_items[x].cancellation_status == 2 || response.order.purchased_items[x].cancellation_status == 3 ?
                            `<p class="tabel-line text-end">RM${response.canceltotal}</p>` : `<p class="tabel-line text-end">RM${response.total}</p>` }
                        </div>
                `);
                }

            }
        });
    }
</script>

{{-- update work 3 --}}
<script>

$('#textareainput').on('keyup', function(e) {

    var userInput = e.target.value;
    $("#textareahidden").val(userInput);

});

</script>

<script>

$('#textareacancel').on('keyup', function(e) {

    var userInput = e.target.value;
    $("#textareacancelhidden").val(userInput);

});

</script>

@endpush
