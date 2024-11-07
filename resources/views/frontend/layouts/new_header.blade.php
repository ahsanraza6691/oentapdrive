<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

            /* Style the suggestions list */
    .suggestions-list {
        position: absolute;
        background-color: #fff;
        border: 1px solid #ddd;
        max-height: 200px;
        overflow-y: auto;
        width: 100%;
    }
    .suggestion-item {
        padding: 10px;
        cursor: pointer;
    }
    .suggestion-item:hover {
        background-color: #f0f0f0;
    }
        @media (max-width: 991.98px) {
            .desktopMenu, .heroSec, .searchBar.desktop, .testiSec, .docSec {
                display: none;
            }
        }
        .loader_otp {
            border: 2px solid #f3f3f3;
            border-radius: 50%;
            border-top: 2px solid var(--theme-color);
            width: 16px;
            height: 16px;
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-right: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>
    @if (isset($details))
        <meta property="og:title"
              content="{{ $details->get_brand_name->brand_name ?? '' }} {{ $details->model_name ?? '' }} {{ $details->make_year ?? '' }}">
        <meta property="og:description" content="Your Description Here">
        <meta property="og:image" content="{{ asset('images/') }}/{{ $details->get_images[0]->images }}">
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="630"/>
    @endif
    <link style="width: 100%" rel="icon" href="{{asset('web-assets/images/fav.webp')}}" type="image/png">
    <link rel="stylesheet" href="{{asset("web-assets/css/plugins.css")}}">
    <link rel="stylesheet" href="{{asset("web-assets/css/custom.css")}}">
    <link rel="stylesheet" href="{{asset("web-assets/css/responsive.css")}}">
    @yield('style')
    <title>@yield('title')</title>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-N4RRTT5F');</script>
    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RQZ461ZLKR"></script>
    <script> window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-RQZ461ZLKR'); </script>
    <meta name="google-site-verification" content="qWp4ndLf_-nwSyjg9JdPIJQyFoa-3i6GrRA0tUzHXlQ"/>

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N4RRTT5F"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
@include('frontend.layouts.menu')
@yield('content')
@include("frontend.layouts.footer")

{{-- Login Modal --}}

<!-- Modal -->
<div class="modal fade loginModal" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="staticBackdropLabel">
                    Sign up / Login to OneTapDrive
                </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <img class="popupImg img-fluid" src={{ asset('assets/images/login-img.webp') }}
                                    alt="">
                            <p>
                                Ease your car rental search across the world Access exclusive features with a free
                                account View saved cars, contacted listings and more
                            </p>
                        </div>
                        <div class="col-md-7">
                            <div class="btnCont">
                                <a href="{{ Route('login.google-redirect') }}" class="themeBtn google">
                                    <i class="fab fa-google"></i>
                                    <span>
                                        Sign in with Google
                                    </span>
                                </a>
                            </div>
                            <div class="divider">
                                <span>OR</span>
                            </div>
                            <form id="emailOtp">
                                @csrf
                                <div class="inputCont">
                                    <input placeholder="Email" id="email" name="email" type="email" required>
                                </div>
                                <div class="inputCont checkbox">
                                    <input id="agree" name="agree" type="checkbox" required>
                                    <label for="agree">
                                        <p>
                                            By continuing, you agree to our
                                            <a href="">Terms Of Service</a>
                                            and
                                            <a href="">Privacy Policy</a>.
                                        </p>
                                    </label>
                                </div>
                                <div class="inputCont">
                                    <button class="themeBtn" type="submit">
                                        Send OTP
                                        <span class="loader_otp" style="display: none;"></span> <!-- loader_otp -->
                                    </button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- OTP Modal --}}
<div class="modal fade loginModal" id="otp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="staticBackdropLabel">
                    Sign up / Login to OneTapDrive
                </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="otpModal">
                <div class="container-fluid">
                    <div class="row otp_modal">
                        <div class="col-md-5">
                            <img class="popupImg img-fluid" src={{ asset('assets/images/login-img.webp') }}
                                    alt="">
                            <p>
                                Ease your car rental search across the world Access exclusive features with a free
                                account View saved cars, contacted listings and more
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="otpDetailCont">
                                <h4>Verification Code</h4>
                                <p>An OTP is sent to your email</p>
                                <a href="" id="otpemail"></a>
                                <h5 class="mt-4">ENTER 4 DIGIT OTP</h5>
                                <form id="verifyOtp">
                                    @csrf
                                  <input type="hidden" id="verifyEmail" name="verify_email">
                                    <div class="inputCont otpCont">
                                        <input type="text" class="otp-input" name="otp_code[]" pattern="\d"
                                               maxlength="1">
                                        <input type="text" class="otp-input" name="otp_code[]" pattern="\d"
                                               maxlength="1" disabled>
                                        <input type="text" class="otp-input" name="otp_code[]" pattern="\d"
                                               maxlength="1" disabled>
                                        <input type="text" class="otp-input" name="otp_code[]" pattern="\d"
                                               maxlength="1" disabled>
                                    </div>
                                    <div class="inputCont">

                                        <button class="themeBtn" role="button">
                                            Verify
                                        </button>
                                    </div>
                                    <input type="hidden" id="verificationCode">
                                    <input type="hidden" id="emailverificationCode">
                                </form>
                                <div class="smallText">
                                    <p>
                                        Haven't received it yet?
                                        <a href="#" target="_blank">Resend</a>
                                    </p>
                                    <p>
                                        In case you don't find our email in your inbox, please check your Spam folder.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('web-assets/js/plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('web-assets/js/index.js?version=1')}}"></script>
@yield('script')

<script type="text/javascript">

    const routes = {
        brand: "{{ route('brand-car-rental', ['brand' => ':slug']) }}",
        model: "{{ route('car-details', ['slug' => ':slug']) }}",
        user: "{{ route('company-profile', ['slug' => ':slug']) }}"
    };

    document.getElementById('searchField').addEventListener('input', function () {
        let query = this.value;

        if (query.length > 2) {
            fetch(`{{ route('search.suggestions') }}?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let suggestions = document.getElementById('suggestions');
                    suggestions.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            let div = document.createElement('div');
                            div.classList.add('suggestion-item');
                            div.textContent = item.match;

                            div.addEventListener('click', () => {
                                let url;

                                if (item.type === 'brand') {
                                    url = routes.brand.replace(':slug', item.slug);
                                } else if (item.type === 'model') {
                                    url = routes.model.replace(':slug', item.slug);
                                } else if (item.type === 'user') {
                                    url = routes.user.replace(':slug', item.slug);
                                }
                                if (url) {
                                    window.location.href = url;
                                }
                            });

                            suggestions.appendChild(div);
                        });
                    } else {
                        suggestions.innerHTML = '<div class="suggestion-item">No results found</div>';
                    }
                })
                .catch(error => console.error('Error fetching suggestions:', error));
        } else {
            document.getElementById('suggestions').innerHTML = '';
        }
    });






</script>
<script type="text/javascript">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error('{{ $error }}');
    @endforeach
    @endif
    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        var otpInputs = document.querySelectorAll(".otp-input");

        function setupOtpInputListeners(inputs) {
            inputs.forEach(function (input, index) {
                input.addEventListener("input", function () {
                    var currentIndex = Array.from(inputs).indexOf(this);
                    var inputValue = this.value.trim();

                    if (!/^\d$/.test(inputValue)) {
                        this.value = "";
                        return;
                    }

                    if (inputValue && currentIndex < 3) {
                        inputs[currentIndex + 1].removeAttribute("disabled");
                        inputs[currentIndex + 1].focus();
                    }

                    updateOTPValue(inputs);
                });

                input.addEventListener("keydown", function (ev) {
                    var currentIndex = Array.from(inputs).indexOf(this);

                    if (!this.value && ev.key === "Backspace" && currentIndex > 0) {
                        inputs[currentIndex - 1].focus();
                    }
                });
            });
        }

        function updateOTPValue(inputs) {
            var otpValue = "";

            inputs.forEach(function (input) {
                otpValue += input.value;
            });

            document.getElementById("verificationCode").value = otpValue;
            document.getElementById("emailverificationCode").value = otpValue;
        }

        setupOtpInputListeners(otpInputs);

        otpInputs[0].focus(); // Set focus on the first OTP input field
        $('#emailOtp').on('submit', function (e) {
    e.preventDefault();
    
    // Show loader_otp on button
    var submitButton = $(".themeBtn");
    submitButton.prop('disabled', true);  // Disable button
    submitButton.find('.loader_otp').show();  // Show loader_otp

    var form = $("#emailOtp");
    var email = $("#email").val();

    $.ajax({
        type: "POST",
        url: '{{ route('email-otp') }}',
        data: form.serialize(),
        success: function (response) {
            // Clear input fields
            $("#email").val('');
            $("#agree").prop('checked', false);

            if (response.status == 200) {
                $('#otp').modal('show');
                $('#login').modal('hide');
                $('#otpemail').text(email);
                $('#verifyEmail').val(email);
                toastr.success('OTP sent on email!');
            } else {
                toastr.error('Failed to send OTP. Please try again!');
            }
        },
        error: function (xhr, status, error) {
            console.error("Error=>", error);
            toastr.error('An error occurred! Please try again later.');
        },
        complete: function () {
            // Hide loader_otp and re-enable button
            submitButton.prop('disabled', false);
            submitButton.find('.loader_otp').hide();
        }
    });
});


        $('#verifyOtp').on('submit', function (e) {
            e.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var form = $("#verifyOtp");
            $.ajax({
                type: "POST",
                url: '{{ route('email-verify') }}',
                data: form.serialize(),
                success: function (response, data) {
                    if (response.status == 200) {
                        toastr.success('Otp verified successfully !');
                        window.location.href = "{{ route('my-profile') }}"
                    }
                    if (response.status == 502) {
                        toastr.error('Incorrect OTP code  !');
                    }
                }
            })
        });
    });
</script>
<script>
    $(document).ready(function(){
     

        $("#carmake").on('change', function () {
            var brand = $("#carmake").val();
            console.log(brand)
            $("#showbut").css("display", "");
            $.ajax({
                url: '{{ route('get_car_models') }}',
                type: 'GET',
                data: {
                    brand: brand
                },
                beforeSend: function () {
    
                    console.log("----------- beforeSend -------------");
    
    
                    $('#carmodel2').html(`<option   value ="0">Loading....</option>`);
    
                },
    
                success: function (response) {
                    if (response.status == 200) {
                        $('#carmodel2').html('');
                        $('#year2').html();
    
    
                        if (response != '') {
                            console.log("response " + response);
    
                            $('#carmodel2').append(
                                `<option value ="0">Select Car Model</option>`
                            );
                            $.each(response.get_models, function (value, i) {
    
    
                                $('#carmodel2').append(
                                    `<option data-state="unselected"  value ="${i.model_name}">${i.model_name}</option>`
                                );
                                $('#year2').append(
                                    `<option data-state="unselected" value ="${i.make_year}">${i.make_year}</option>`
                                )
                            });
    
    
                            @if (isset($_GET['carmodel']) && !empty($_GET['carmodel']))
    
                            console.log("carmodel " + "<?php echo $_GET['carmodel']; ?>");
                            $('#carmodel2').val("<?php echo $_GET['carmodel']; ?>");
                            $("#carmodel2").change();
                            @endif
    
                        } else {
                            $('#carmodel2').append(
                                `<option   value ="">Data Not Found</option>`
                            );
                        }
                    }
    
                }
            });
        })
        @if (!empty(request()->get('brand')))
            $("#carmake").change();
        @endif
    
        $("#carmodel2").on('change', function () {
            var model_name = $(this).val();
    
            $.ajax({
                url: '{{ route('get_make_years') }}',
                type: 'GET',
                data: {
                    model_name: model_name
                },
                beforeSend: function () {
    
                    console.log("----------- beforeSend -------------");
    
    
                    $('#year2').html(`<option   value ="0">Loading....</option>`);
    
                },
                success: function (response) {
                    if (response.status == 200) {
                        $('#year2').html('');
                        if (response != '') {
                            $.each(response.make_year, function (value, i) {
                                $('#year2').append(
                                    `<option data-state="unselected"  value ="${i.make_year}">${i.make_year}</option>`
                                )
                            });
                        }
                    } else {
                        $('#year2').append(
                            `<option   value ="">Data Not Found</option>`
                        );
                    }
                }
            });
        })
    })
    </script>
</body>
</html>
