@extends('vendor_dashboard.layouts.master')
@section('content')

<style>
    .package-box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
            border: 2px solid transparent;
        }

        .package-box:hover {
            transform: translateY(-10px);
            border-color: #ffba00;
        }

        .package-title {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 10px;
        }

        .package-price {
            font-size: 2em;
            color: #ffba00;
            margin: 20px 0px;
        }

        .features {
            list-style: none;
            text-align: left;
            margin-bottom: 20px;
            padding-left: 0;
        }

        .features li {
            margin: 10px 0;
            color: #666;
        }

        .btn-select, .btn-buy {
            display: inline-block;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-select {
            background-color: #ffba00;
            color: #fff;
        }

        .btn-select:hover {
            background-color: #d55c1b;
        }

        .btn-buy {
            background-color: #333;
            color: #fff;
        }

        .btn-buy:hover {
            background-color: #222;
        }
        .modal-header {
            background-color: #343a40;
            color: white;
        }

        .modal-content {
            border-radius: 8px;
        }

        .modal-footer .btn {
            width: 100%;
        }

        .file-upload-label {
            cursor: pointer;
            background-color: #f3681f;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            display: inline-block;
        }

        .file-upload-label:hover {
            background-color: #d55c1b;
        }
        
        .modal-body p {
        font-size: 15px;
        display: flex;
        gap: 10px;
        }
        .modal-body p span {
        color: #ffba00;
        font-weight: 600;
        }
        .btn-close{
            filter:brightness(0) invert(1);
        }
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header py-3">
                        <h5>Buy Refreshes</h5>
                        {{-- <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                                href="{{ route('user-create') }}">Add</a></div> --}}

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Package Cards -->
                            <div class="col-lg-4">
                                <div class="package-box">
                                    <h2 class="package-title">Basic Package</h2>
                                    <div class="package-price">AED 49</div>
                                    <h2 class="package-title">20 Refreshes</h2>
                                    <button class="btn-buy btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#packageModal" onclick="openModal('Basic Package', 'AED 49' , '20 Refreshes')">Buy Now</button>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="package-box">
                                    <h2 class="package-title">Standard Package</h2>
                                    <div class="package-price">AED 99</div>
                                    <h2 class="package-title">50 Refreshes</h2>
                                    <button class="btn-buy btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#packageModal" onclick="openModal('Standard Package', 'AED 99', '50 Refreshes')">Buy Now</button>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="package-box">
                                    <h2 class="package-title">Premium Package</h2>
                                    <div class="package-price">AED 149</div>
                                    <h2 class="package-title">80 Refreshes</h2>
                                    <button class="btn-buy btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#packageModal" onclick="openModal('Premium Package', 'AED 149', '80 Refreshes')">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
    </div>
    <!-- Package Details Modal -->
<div class="modal fade" id="packageModal" tabindex="-1" aria-labelledby="packageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="packageModalLabel">Package Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="modalPackageName"></h5>
                <p class="mb-1"><strong>Price:</strong> <span id="modalPackagePrice"></span></p>
                <p class="mb-1"><strong>Refreshes:</strong> <span id="modaltotalRefreshes"></span></p>
                <p><strong>Account Number:</strong> 1234567890</p>
                
                <!-- File Upload -->
                <p class="mt-3">Please upload the payment receipt for verification.</p>
                <div>
                    <input id="receiptUpload" name="file-upload"
                      type="file" class="receiptUpload" data-default-file=""
                      data-allowed-file-extensions="pdf png jpg jpeg webp gif bmp tiff doc docx xls xlsx ppt pptx heic"
                      required>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                <button type="button" class="btn btn-primary">Submit Payment</button>
            </div>
        </div>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    
<script>
    // Function to open modal and populate details
    function openModal(packageName, packagePrice, totalRefreshes) {
        document.getElementById("modalPackageName").innerText = packageName;
        document.getElementById("modalPackagePrice").innerText = packagePrice;
        document.getElementById("modaltotalRefreshes").innerText = totalRefreshes;
    }

    
</script>

@endsection
