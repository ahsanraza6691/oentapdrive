@extends('frontend.layouts.new_header')
@section('title', 'Muscle Car Rental in Dubai | Best Rates UAE | OneTapDrive')
@section('content')

    <section class="linkingSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="filterBtnRow">
                        <ul class="linkingCont">
                            <li><a href="{{route('home')}}" class="fa fa-home"></a></li>
                            <!-- Dynamic location -->
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="javascript:void(0)">{{ request()->query('city') ?? 'Dubai' }}</a></li>
                            <li class="javascript:void(0)"><span>Rent Muscle Cars Dubai</span></li>
                        </ul>
                        <div class="filter_action">
                            <button class="styled_button rounded_sm filter_action" id="filterBtn" type="button">
                                {{-- <div></div>
                                <div></div>
                                <div></div> --}}
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="productsSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-3">
                    <div class="mobileAdd">
                        <img src="{{asset("/web-assets/images/appBanner.jpg")}}" alt="">
                    </div>
                </div>
                <div class="col-lg-9">
                   <div class="adsBannerCont">
                       <div class="swiper-button-prev"></div>
                       <div class="adsBannerSlider swiper">
                           <div class="swiper-wrapper">
                               <div class="swiper-slide">
                                   <figure class="addBanner">
                                       <img src="{{asset('/web-assets/images/ads/1.jpg')}}" alt="">
                                   </figure>
                               </div>
                               <div class="swiper-slide">
                                   <figure class="addBanner">
                                       <img src="{{asset('/web-assets/images/ads/2.jpg')}}" alt="">
                                   </figure>
                               </div>
                               <div class="swiper-slide">
                                   <figure class="addBanner">
                                       <img src="{{asset('/web-assets/images/ads/3.jpg')}}" alt="">
                                   </figure>
                               </div>
                           </div>
                       </div>
                       <div class="swiper-button-next"></div>
                   </div>
                </div>
            </div>
            @include('frontend.partials.filter-component')
        </div>
    </section>

    <section class="py-3 aboutSec">
        <div class="container-md">
            <div class="row">
                <div class="col-12">
                    <div class="aboutContent contentWrap">
                        <p>
                            The demand for comfort on trips is more of a compulsion. The integrity
                            and exclusiveness of BMW does not require any mention and certainly
                            fits you for any trip. Get easy BMW car rental in Dubai with
                            OneClickDrive, the hub for luxury car rentals. We have a wide range of
                            BMW models to choose from in accordance with your needs.
                        </p>
                        <h2 class="secHeading">BMW Car Advantages:</h2>
                        <p>
                            Symbol of Luxury: Needless to say, BMW is all about luxury. It is one
                            of the most common and widely preferred luxury cars. BMW is used by
                            both middle class and upper class people. The style it abbreviates is
                            on another level. The materials they are manufactured with are top
                            notch even if you judge the lowest models. BMW is a premium car with
                            all luxury and comfort that easily surpasses other car brands in
                            popularity.
                        </p>
                        <p>
                            Sign of Versatility: BMW hits a level where it can not be compared to
                            any other car brands. This is no doubt the best vehicle with the best
                            technology in every segment. There are full electric BMW cars that are
                            sure to tempt you like no other.
                        </p>
                        <p>
                            Dynamic Capabilities: BMW is known to be the greatest road car brand
                            in the world, today. You cannot think of anything beyond BMW on the
                            road. The unique front engine car wheel drive platform in BMW models,
                            helps the vehicles in maintaining 50/50 distribution of weight that
                            adds to neutral handling and predictable sterling.
                        </p>
                        <p>
                            Reliability: If reliability is concerned, BMW is the first name. The
                            car brand is known for its warranty and amazing customer support
                            system. BMW is more of a treasure that will keep going forever with
                            proper maintenance.
                        </p>
                        <p>
                            Equipment: You might think that BMW is more expensive than many other
                            ordinary car brands that provide you with many fascinating deals. But
                            when compared with the specifications of BMW, it is so much equipped,
                            having numerous specs that lacks in any other manufacturer model. The
                            specification BMW offers blows competition out of the water. It is a
                            sign of perfection.
                        </p>
                        <h2 class="secHeading">Best BMW Car Models to Rent In Dubai:</h2>
                        <p>
                            Rent a BMW in Dubai with the help of OneClickDrive very easily by
                            choosing from your favorite model. Amongst numerous models that we
                            provide for hire, BMW 4 Series Convertible, BMW X6 SUV and BMW 730-li
                            are no doubt the best and are widely popular. There are various other
                            model options available directly on the website and mobile app.
                        </p>
                        <h2 class="secHeading">Best BMW Car Rental Deals and Offers:</h2>
                        <p>
                            OneClickDrive gives you the convenience to choose from various rent
                            options. We have amazing offers for daily, weekly and monthly basis.
                            Book BMW cars for rent starting from AED 299/day.
                        </p>
                        <h2 class="secHeading">Why OneClickDrive?</h2>
                        <p>
                            Booking a car for a trip to some unknown country is always a risky
                            task. It is more challenging to find an authentic car rental company
                            that would provide you with trustworthy and dedicated service. Well,
                            your hassle of searching for a loyal car rental service for your next
                            trip to Dubai comes to an end. Besides travelers, residents of UAE can
                            directly book by comparing the rates from over 100+ car rental
                            suppliers and finalize the best deal. OneClickDrive ensures quality
                            car rental service all over Dubai and you can rent your favorite car
                            model at the most competitive rates. BMW car hire in Dubai is now
                            easier and hassle free as you can rent your car in just one click.
                            Nearly all models are available and you get them at unbelievable
                            rental rates.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-3 faqSec">
        <div class="container-md">
            <div class="row">
                <div class="col-12">
                    <div class="aboutContent">
                        <h2 class="secHeading">Frequently Asked Questions</h2>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                        Why is driving a BMW recommended in Dubai?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            Among the popular car choices, BMW is definitely a favorite. In Dubai, more
                                            so,
                                            as itâ€™s perfect for Sheikh Zayed Road as well as on the highways
                                            stretching
                                            across the Emirates. Being one of the most scenic places for those seeking a
                                            luxurious adventure on wheels, BMWs are the most-in-demand cars in Dubai.
                                            Youâ€™ll be driving alongside exotic cars such as Porsche, Mercedes Benz,
                                            Audi,
                                            not to mention a range of sports cars.Many tourists and residents in Dubai
                                            rent
                                            a BMW to soak the pleasure of driving a luxurious sedan. The spacious cabin,
                                            extra legroom, advanced driving and safety features are what BMW vehicles
                                            are
                                            most known for.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                        Can I take the BMW rental car to Abu Dhabi from Dubai?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            Yes, you can! Most customers rent a luxury sedan in Dubai to visit Abu Dhabi
                                            and
                                            other emirates. Itâ€™s definitely the best way to explore the UAE. Car
                                            rental
                                            companies allow their vehicles to be driven anywhere in the UAE, barring a
                                            few
                                            locations such as Jebel Hafeet, Jebel Jais and desert areas. Be sure to plan
                                            your drives in advance to make the most of it. Google Maps is your best
                                            friend!If youâ€™re planning a trip to the Grand Mosque, Louvre or Yas
                                            Marina,
                                            consider renting for 2 or more days to offset the additional mileage charge
                                            you
                                            will incur. As most car rentals, including luxury and sports cars, come with
                                            a
                                            standard mileage limit of 250-km per day. Dubai to Abu Dhabi is a good
                                            150-km
                                            away so youâ€™ll probably be clocking over 300 km on the journey back.Best
                                            practice: Consult with the car rental agency regarding your trip plan for
                                            suggestions. Additional mileage packages may be available.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                        Which type of BMW cars are available for rent in Dubai?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            OneClickDrive.com works with several car rental companies across the world.
                                            In
                                            Dubai, we work with quite a few BMW car rental providers. You can choose
                                            among
                                            cars with a range of engine sizes and additional features, including GPS
                                            navigation, safety and performance enhancements. The BMW sedan comes in
                                            various
                                            4-door sedan, convertible models with advanced features. Different models
                                            including: BMW 2-series, 3-series, 550i, 550 mpower, 730li, 750li, X5, X6
                                            and
                                            more. If youâ€™re looking for a rare BMW car model, contact our suppliers
                                            who
                                            have listed a BMW. They might be able to cater to your distinguished needs.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aboutContent">
                        <p>
                            <span>note:</span> The above listings including the
                            prices are updated by the respective car rental company. Incase the
                            car is not available at the price mentioned (exclusive of VAT), please
                            inform us and weâ€™ll get back to you with the best alternative. Happy
                            renting!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text_yellow" id="offcanvasExampleLabel">Send an Instant Inquiry</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <p>The supplier will directly connect with you</p>
            </div>
            <form id="carEnquiry" method="POST">
                @csrf
                <input type="hidden" name="car_id" id="car_id">
                <input type="hidden" name="vendor_id" id="vendor_id">
                <div>
                    <div class="img-cont-drv">
                        <div class="row justcent m-0 m-b-10">
                            <div class="col-md-4 ps-0">
                                <img id="car_image" loading="lazy" class="w-100 rounded"
                                     src="{{asset('images')}}"
                                     alt="Supplier logo" title="Supplier Logo">
                            </div>
                            <div class="col-md-8">
                                <div>
                                    <p class="title_car fw-bold mb-1" id="car_title">MG 5 2024</p>
                                    <p class="mb-1 title_para" id="min_booking">Minimum 2 day booking</p>
                                    <p class="mb-1 pb-1 title_para" id="car_company">Al Maseer Rent A Car</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <div>
                                <label for="name">Name</label><br>
                                <input class="form-control" name="name" type="text" value="{{Auth::user()->name ?? ''}}"
                                       placeholder="{{Auth::user()->name ?? ''}}" id="name" required>
                            </div>
                            <div class="mt-3">
                                <label for="number">Contact Number</label><br>
                                <input class="form-control" type="number" value="{{Auth::user()->contact ?? ''}}"
                                       name="contact" placeholder="{{Auth::user()->contact ?? ''}}" id="number"
                                       required>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input" name="whatsapp_enabled" type="checkbox" value="1"
                                       id="whats_enable">
                                <label class="form-check-label" for="whats_enable">
                                    WhatsApp Enabled
                                </label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div>
                                <label for="email_enq">Email</label><br>
                                <input class="form-control" name="email" value="{{Auth::user()->email ?? '' }}"
                                       type="email" placeholder="{{Auth::user()->email ?? ''}}" id="email_enq" required>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="send_suppliers">
                                <label class="form-check-label" for="send_suppliers">
                                    Send request to multiple suppliers
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn_warning px-3">Send Enquiry</button>
                        <p class="mt-3 enq_para" id="text_para">
                            Your inquiry will be sent to Al Maseer Rent A Car without any obligation or cost to you. You
                            agree to be contacted by OneTapDrive and its partners.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

@section('script')

    <script>

        $('.carEnquiry').on('click', function () {
            var id = $(this).attr("data-id");
            var car_id = $("#car_id").val(id);
            $.ajax({
                url: '{{ route('get-car-details') }}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function (response) {
                    $("#car_title").html('');
                    $("#min_booking").html('');
                    $("#car_company").html('');
                    $("#text para").html('');
                    console.log(response.details.id);
                    if (response.status == 200) {
                        $("#vendor_id").val(response.details.user_id);
                        $("#car_title").html(response.details.get_brand_name.brand_name + ' ' + response.details.model_name + ' ' + response.details.make_year);
                        $("#min_booking").html('Minimum' + ' ' + response.details.days + ' ' + 'day booking');
                        $("#car_company").html(response.details.get_user.company_name);
                        $("#text_para").html('Your inquiry will be sent to' + ' ' + response.details.get_user.company_name + ' ' + 'without any obligation or cost to you. You agree to be contacted by OneTapDrive and its partners.');
                        console.log(response.details.get_images[0].images);
                        if (response.details.get_images && response.details.get_images.length > 0) {
                            var basePath = 'https://onetapdrive.com/public/images/';
                            var imagePath = basePath + response.details.get_images[0].images;
                            $("#car_image").attr("src", imagePath);
                        }
                    }
                }
            });
        });
    </script>

    <script>
        $("#carEnquiry").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 100

                },
                email: {
                    required: true,
                    maxlength: 100
                },
                contact: {
                    required: true
                },

            },
            messages: {
                name: {
                    required: 'Name field is required'
                },
                email: {
                    required: 'Email field is required'
                },
                contact: {
                    required: 'Contact field is required'
                },
            },

            submitHandler: function (form, e) {

                e.preventDefault();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var form = $("#carEnquiry");
                // var name = $("#name").val();
                $.ajax({
                    type: 'POST',
                    url: "{{route('send-enquiry')}}",
                    data: form.serialize(),
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (response, data) {
                        if (response.status == 200) {
                            swal({
                                title: "Enquiry!",
                                text: response.message,
                                type: "success",
                                icon: "success",
                            }).then(function () {
                            });
                            $('#carEnquiry')[0].reset();
                        }

                        if (response.status == 400) {
                            $.each(response.errors, function (prefix, val) {
                                toastr.error(val[0]);
                            });
                        }
                    }
                });
            }
        });
    </script>




    <script>
        $(document).ready(function () {
            $('.wishlist-button').on('click', function () {
                var button = $(this);
                var productId = $(this).data('product-id');
                var heartIcon = button.find('.fa-heart');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('wishlist.add') }}',
                    type: 'GET',
                    data: {
                        product_id: productId
                    },
                    success: function (response) {
                        if (response.status == 401) {
                            toastr.error(response.message);
                        }
                        if (response.status != 401) {
                            if (heartIcon.hasClass('fa-heart')) {
                                heartIcon.addClass('red_heart');
                                // heartIcon.removeClass('fa-heart');
                            } else {
                                heartIcon.removeClass('red_heart');
                                heartIcon.addClass('fa-heart'); // Add the 'fa-heart' class
                            }
                        }

                        // Update the heart icon after adding to the wishlist
                        if (response.status == 200) {
                            toastr.success('Product added to wishlist');
                        }
                        if (response.status == 202) {
                            heartIcon.removeClass('red_heart');
                            toastr.success('Product removed from wishlist');
                        }
                    }
                });
            });
        });


        document.addEventListener("DOMContentLoaded", function () {
            const myWpElements = document.querySelectorAll(".my_wp");
            const my_wp_nums = document.querySelectorAll(".my_wp_num");

            myWpElements.forEach((myWpElement, index) => {
                myWpElement.addEventListener("focus", function () {
                    my_wp_nums[index].classList.remove("d-none");
                    console.log("focus.");
                    myWpElement.style.width = "170px";
                });

                myWpElement.addEventListener("blur", function () {
                    my_wp_nums[index].classList.add("d-none");
                    console.log("blur");
                    myWpElement.style.width = "47px";
                });
            });

            const myWpElements1 = document.querySelectorAll(".my_wp1");
            const my_wp_nums1 = document.querySelectorAll(".my_wp_num1");

            myWpElements1.forEach((myWpElement1, index) => {
                myWpElement1.addEventListener("focus", function () {
                    my_wp_nums1[index].classList.remove("d-none");
                    console.log("focus.");
                    myWpElement1.style.width = "170px";
                });

                myWpElement1.addEventListener("blur", function () {
                    my_wp_nums1[index].classList.add("d-none");
                    console.log("blur");
                    myWpElement1.style.width = "47px";
                });
            });
        });
    </script>
<script>
    // Wait for the document to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Select the form and the filter elements
        const filterForm = document.getElementById('filterForm');

        // Add change event listeners to the filter elements
        filterForm.addEventListener('change', function() {
            filterForm.submit(); // Submit the form when price filter changes
        });

        // priceOrder.addEventListener('change', function() {
        //     filterForm.submit(); // Submit the form when price order changes
        // });
    });
</script>
@endsection

@endsection
