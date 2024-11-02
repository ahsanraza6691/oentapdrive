@extends('vendor_dashboard.layouts.master')
@section('content')
    <style>
        td.editDelete {
            display: flex;
            gap: 10px;
        }

        .pic-holder {
            text-align: center;
            position: relative;
            border-radius: 50%;
            width: 200px;
            height: 200px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            /* margin-bottom: 20px; */
            margin: 0 auto;
        }

        .pic-holder .pic {
            /* height: 100%; */
            width: 100%;
            -o-object-fit: cover;
            object-fit: cover;
            -o-object-position: center;
            object-position: center;
        }

        .pic-holder .upload-file-block,
        .pic-holder .upload-loader {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(90, 92, 105, 0.7);
            color: #f8f9fc;
            font-size: 12px;
            font-weight: 600;
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .pic-holder .upload-file-block {
            cursor: pointer;
        }

        .pic-holder:hover .upload-file-block,
        .uploadProfileInput:focus~.upload-file-block {
            opacity: 1;
        }

        .pic-holder.uploadInProgress .upload-file-block {
            display: none;
        }

        .pic-holder.uploadInProgress .upload-loader {
            opacity: 1;
        }

        /* Snackbar css */
        .snackbar {
            visibility: hidden;
            min-width: 250px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 14px;
            transform: translateX(-50%);
        }

        .snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        .specs_list {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin: 30px 0px;
        }

        .specs_heading {
            width: 200px;
            text-align: center;
            display: flex;
            align-items: center;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Profile</h5>
                        {{-- <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                                href="{{ route('user-create') }}">Add</a></div> --}}

                    </div>
                    <div class="card-body">
                        <form action="{{route('update-vendorProfile')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-center">Upload Profile</h5>
                                    <div class="pic-holder">

                                        <!-- uploaded pic shown here -->
                                        <img id="profilePic" class="pic"
                                            src="{{asset('company_logo')}}/{{Auth::user()->company_logo}}">

                                        <Input class="uploadProfileInput" type="file" name="company_logo"
                                            id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
                                        <label for="newProfilePhoto" class="upload-file-block">
                                            <div class="text-center">
                                                <div class="mb-2">
                                                    <i class="fa fa-camera fa-2x"></i>
                                                </div>
                                                <div class="text-uppercase">
                                                    Update <br /> Profile Photo
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="name" class="form-label">Company Name :</label>
                                    <input type="text" class="form-control" name="company_name" placeholder="Enter name here..." value="{{Auth::user()->company_name}}" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="name" class="form-label">Email :</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email here..." value="{{Auth::user()->email}}" disabled required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="name" class="form-label">Phone :</label>
                                    <input type="tel" class="form-control" name="contact" placeholder="Enter phone here..." value="{{Auth::user()->contact}}" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="name" class="form-label">Whatsapp :</label>
                                    <input type="tel" class="form-control" name="whatsapp_number" placeholder="Enter phone here..." value="{{Auth::user()->whatsapp_number}}" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="name" class="form-label">Google Map Location (Link):</label>
                                    <input type="url" class="form-control" name="google_map" placeholder="Enter location here..." value="{{Auth::user()->google_map}}" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="name" class="form-label">Complete Address:</label>
                                    <input type="text" class="form-control" name="address" value="{{Auth::user()->address}}" placeholder="Enter location here..."  required>
                                </div>

                                @php
                                $userPaymentModes = explode(',', Auth::user()->payment_modes);
                            @endphp
                            
                            <div class="col-12">
                                <ul class="specs_list">
                                    <div class="specs_heading">
                                        <h6>
                                            Payment Mode:
                                        </h6>
                                    </div>
                                    <li>
                                        <input type="checkbox" class="btn-check" id="credit_card" value="Credit Card" name="payment_modes[]"
                                            autocomplete="off" {{ in_array('Credit Card', $userPaymentModes) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="credit_card">Credit Card</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" value="Debit Card" id="debit_card" name="payment_modes[]"
                                            autocomplete="off" {{ in_array('Debit Card', $userPaymentModes) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="debit_card">Debit Card</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" value="Cash" id="cash" name="payment_modes[]"
                                            autocomplete="off" {{ in_array('Cash', $userPaymentModes) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="cash">Cash</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" value="Bitcoin/Crypto" id="bitcoin/crypto" name="payment_modes[]"
                                            autocomplete="off" {{ in_array('Bitcoin/Crypto', $userPaymentModes) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="bitcoin/crypto"> Bitcoin / Crypto</label>
                                    </li>
                                </ul>
                            </div>
                            
                            @php
                            $userLanguages = explode(',', Auth::user()->languages);
                        @endphp
                            <div class="col-12">
                                <ul class="specs_list">
                                    <div class="specs_heading">
                                        <h6>
                                            Languages Spoken:
                                        </h6>
                                    </div>
                                    <li>
                                        <input type="checkbox" value="English" class="btn-check" id="english"
                                               name="languages[]" autocomplete="off" {{ in_array('English', $userLanguages) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="english">English</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="Arabic" class="btn-check" id="arabic"
                                               name="languages[]" autocomplete="off" {{ in_array('Arabic', $userLanguages) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="arabic">Arabic</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="French" class="btn-check" id="french"
                                               name="languages[]" autocomplete="off" {{ in_array('French', $userLanguages) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="french">French</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="Russian" class="btn-check" id="russian"
                                               name="languages[]" autocomplete="off" {{ in_array('Russian', $userLanguages) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="russian">Russian</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="Spanish" class="btn-check" id="spanish"
                                               name="languages[]" autocomplete="off" {{ in_array('Spanish', $userLanguages) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="spanish">Spanish</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="Turkish" class="btn-check" id="turkish"
                                               name="languages[]" autocomplete="off" {{ in_array('Turkish', $userLanguages) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="turkish">Turkish</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="Chinese" class="btn-check" id="chinese"
                                               name="languages[]" autocomplete="off" {{ in_array('Chinese', $userLanguages) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="chinese">Chinese</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="German" class="btn-check" id="german"
                                               name="languages[]" autocomplete="off" {{ in_array('German', $userLanguages) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="german">German</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-12">
                                    <ul class="specs_list">
                                        <div class="specs_heading">
                                            <h6>
                                                Branch Location:
                                            </h6>
                                        </div>
                                        <li>
                                            <li>
                                                <input placeholder="Location" class="form-control" name="city" value="{{Auth::user()->city}}" type="text" required>
                                            </li>
                                        </li>

                                    </ul>
                                </div>

                                @if(empty(Auth::user()->fast_delivery_locations))
                                <div class="col-12">
                                    <ul class="specs_list">
                                        <div class="specs_heading">
                                            <h6>
                                                Fast Delivery Locations:
                                            </h6>
                                        </div>
                                        <li>
                                            <input type="checkbox" class="btn-check" value="Bluewaters Island" id="bluewaters-island"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="bluewaters-island" > Bluewaters Island</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class="btn-check" value="Business Bay" id="business--bay"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="business--bay">Business Bay</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="DIFC" class="btn-check" id="DIFC"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="DIFC">DIFC</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Downtown Dubai" class="btn-check" id="downtown-dubai"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="downtown-dubai">Downtown Dubai</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Dubai Hills Estate" class="btn-check" id="dubai-hills-estate"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="dubai-hills-estate">Dubai Hills Estate</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Dubai Marina" class="btn-check" id="dubai-marina"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="dubai-marina">Dubai Marina</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Dubai Waterfront" class="btn-check" id="dubai-waterfront"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="dubai-waterfront">Dubai Waterfront</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Dubai World Central" class="btn-check" id="dubai-world-central"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="dubai-world-central">Dubai World Central</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Emirates Hills" class="btn-check" id="emirates-hills"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="emirates-hills">Emirates Hills</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Jumeirah Beach Residence (JBR)" class="btn-check" id="jumeirah-beach-residence"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="jumeirah-beach-residence">Jumeirah Beach Residence (JBR)</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Jumeirah Heights" class="btn-check" id="jumeirah-heights"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="jumeirah-heights">Jumeirah Heights</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Jumeirah Lake Towers (JLT)" class="btn-check" id="jumeirah-lake-towers"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="jumeirah-lake-towers">Jumeirah Lake Towers (JLT)</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Palm Jumeirah" class="btn-check" id="palm-jumeirah"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="palm-jumeirah">Palm Jumeirah</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Sheikh Zayed Road" class="btn-check" id="sheikh-zayed-road"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="sheikh-zayed-road">Sheikh Zayed Road</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="World Trade Centre" class="btn-check" id="world-trade-centre"
                                                name="fast_delivery_locations[]" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="world-trade-centre">World Trade Centre</label>
                                        </li>
                                    </ul>


                                </div>
                                @else

                                @php
                                $userLocations = explode(',', Auth::user()->fast_delivery_locations);
                               @endphp

                            <div class="col-12">
                                <ul class="specs_list">
                                    <div class="specs_heading">
                                        <h6>
                                            Fast Delivery Locations:
                                        </h6>
                                    </div>
                                    @foreach($userLocations as $location)
                                    <li>
                                        <input type="checkbox" class="btn-check" value="{{ $location }}" id="{{ Str::slug($location) }}"
                                            name="fast_delivery_locations[]" autocomplete="off" {{ in_array($location, $userLocations) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-dark custom_btn" for="{{ Str::slug($location) }}">{{ $location }}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                                {{-- <div class="col-12">
                                    <ul class="specs_list">
                                        <div class="specs_heading">
                                            <h6>
                                                Payment Mode :
                                            </h6>
                                        </div>
                                        <li>
                                            <input type="radio" class="btn-check" id="credit-card"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="credit-card">Credit Card</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="cash"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="cash">Cash</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="bitcoi-crypto"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="bitcoi-crypto">Bitcoin / Crypto</label>
                                        </li>
                                    </ul>
                                </div> --}}

                                {{-- <div class="col-12">
                                    <ul class="specs_list">
                                        <div class="specs_heading">
                                            <h6>
                                                Car Fleet :
                                            </h6>
                                        </div>
                                        <li>
                                            <input type="radio" class="btn-check" id="SUV"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="SUV">SUV</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="luxury-car"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="luxury-car">Luxury Car</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Muscle"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="Muscle">Muscle</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Convertible"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="Convertible">Convertible</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Sedan"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="Sedan">Sedan</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Coupe"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="Coupe">Coupe</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="sports-car"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="sports-car">Sports Car</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Hybrid"
                                                name="language" autocomplete="off">
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="Hybrid">Hybrid</label>
                                        </li>
                                    </ul>
                                </div> --}}

                                {{-- <div class="col-12">
                                    <ul class="specs_list">
                                        <div class="specs_heading">
                                            <h6>
                                                Delivery & Pick-Up Services:
                                            </h6>
                                        </div>
                                        <li>
                                            <select class="form-control">
                                                <option selected disabled value="Select Delivery and Pick-up Service">Select Delivery and Pick-up Service</option>
                                                <option value="Branch Pick-up">Branch Pick-up</option>
                                                <option value="Delivery to You">Delivery to You</option>
                                                <option value="Airport Delivery">Airport Delivery</option>
                                            </select>
                                        </li>

                                    </ul>


                                </div> --}}

                                <div class="col-12">
                                    <ul class="specs_list m-0">
                                        <div class="specs_heading">
                                            <h5>
                                                Shop Timing:
                                            </h5>
                                        </div>
                                    </ul>
                                </div>

                                @if(empty( $shopTimings))
                                <div class="col-12">
                                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <ul class="specs_list">
                                            <div class="specs_heading">
                                                <h6>
                                                    {{ $day }} :
                                                </h6>
                                            </div>
                                            <input type="hidden" name="day_of_week[]" value="{{ $day }}">
                                            <li>
                                                <input placeholder="e.g. 24 Hours" name="opening_time[]" class="form-control" type="time">
                                            </li>
                                            <li>
                                                <input placeholder="e.g. 24 Hours" name="closing_time[]" class="form-control" type="time">
                                            </li>
                                        </ul>
                                    @endforeach
                                    {{-- <button type="submit" class="btn btn-primary">Save Timings</button> --}}
                                </div>
                                @else


                                <div class="col-12">
                                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <ul class="specs_list">
                                            <div class="specs_heading">
                                                <h6>
                                                    {{ $day }} :
                                                </h6>
                                            </div>
                                            <input type="hidden" name="day_of_week[]" value="{{ $day }}">
                                            <li>
                                                <input placeholder="e.g. 24 Hours" name="opening_time[]" class="form-control" type="time" 
                                                       value="{{ $shopTimings[$day]->opening_time ?? '' }}">
                                            </li>
                                            <li>
                                                <input placeholder="e.g. 24 Hours" name="closing_time[]" class="form-control" type="time" 
                                                       value="{{ $shopTimings[$day]->closing_time ?? '' }}">
                                            </li>
                                        </ul>
                                    @endforeach
                                    {{-- <button type="submit" class="btn btn-primary">Save Timings</button> --}}
                                </div>
                                @endif
                                

                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>.


    <script>
        $(document).on("change", ".uploadProfileInput", function() {
            var triggerInput = this;
            var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
            var holder = $(this).closest(".pic-holder");
            var wrapper = $(this).closest(".profile-pic-wrapper");
            $(wrapper).find('[role="alert"]').remove();
            triggerInput.blur();
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) {
                return;
            }
            if (/^image/.test(files[0].type)) {
                // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function() {
                    $(holder).addClass("uploadInProgress");
                    $(holder).find(".pic").attr("src", this.result);
                    $(holder).append(
                        '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
                    );

                    // Dummy timeout; call API or AJAX below
                    setTimeout(() => {
                        $(holder).removeClass("uploadInProgress");
                        $(holder).find(".upload-loader").remove();
                        // If upload successful
                        if (Math.random() < 0.9) {
                            $(wrapper).append(
                                '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
                            );

                            // Clear input after upload
                            $(triggerInput).val("");

                            setTimeout(() => {
                                $(wrapper).find('[role="alert"]').remove();
                            }, 3000);
                        } else {
                            $(holder).find(".pic").attr("src", currentImg);
                            $(wrapper).append(
                                '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
                            );

                            // Clear input after upload
                            $(triggerInput).val("");
                            setTimeout(() => {
                                $(wrapper).find('[role="alert"]').remove();
                            }, 3000);
                        }
                    }, 1500);
                };
            } else {
                $(wrapper).append(
                    '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
                );
                setTimeout(() => {
                    $(wrapper).find('role="alert"').remove();
                }, 3000);
            }
        });
    </script>



    {{-- @if (Session::has('Update_Faqs'))
    <script>
        toastr.success('Faqs Updated', '{{ Session::get('Update_Faqs') }}', 'success')
    </script>
@endif --}}
@endsection
