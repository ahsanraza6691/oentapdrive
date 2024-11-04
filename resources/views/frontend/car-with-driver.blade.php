@extends('frontend.layouts.new_header')
@section('title', 'Car with Driver | OneTapDrive')
@section('content')

    <section class="linkingSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="filterBtnRow">
                        <ul class="linkingCont">
                            <li><a href="/" class="fa fa-home"></a></li>
                            <li><a href="#0">Dubai</a></li>
                            <li><a href="#0">car brand</a></li>
                            <li class="current"><span>By brand / by Vehicle type</span></li>
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
            <div class="row adsRow">
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
                        <h2 class="secHeading">Professional Chauffeur Service Dubai</h2>
                        <p>
                            Get the best on-ground transportation 24x7 across the emirates. Our
                            experienced drivers and range of premium cars are available 24x7.
                            OneTapDrive offers the most dependable chauffeured car services in
                            the UAE: Be it a limo pick-up for your VIP guests at the airport or a
                            family day out. Make a hassle-free booking today!
                        </p>
                        <p>
                            We offer the most affordable yet perfect car and driver service across
                            the UAE including hourly chauffeur service, airport transfer service,
                            limousine service, event transportation and so on. For custom / bulk
                            bookings, feel free to get in touch with us.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testiSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-5">
                    <div class="headingCont">
                        <h3>
                            Our Community
                        </h3>
                        <p>
                            The experiences shared by our distinguished users have always helped us up our game. The
                            OneClickDrive Marketplace is often re engineered as we follow a "Listen Understand Improve"
                            cycle
                        </p>
                    </div>
                </div>
                {{--                <div class="col-md-7">--}}
                {{--                    <h2 class="secHeading">--}}
                {{--                        Testimonials--}}
                {{--                    </h2>--}}
                {{--                    <div class="swiper testiSwiper">--}}
                {{--                        <div class="swiper-wrapper">--}}
                {{--                            <div class="swiper-slide">--}}
                {{--                                <div class="testimonialCard">--}}
                {{--                                    <div class="userInfo">--}}
                {{--                                        <figure>--}}
                {{--                                            <img loading="lazy" src="{{asset('/web-assets/images/user.webp')}}" alt="">--}}
                {{--                                        </figure>--}}
                {{--                                        <div class="info">--}}
                {{--                                            <h4>John Doe</h4>--}}
                {{--                                            <p>May 25 2023</p>--}}
                {{--                                            <div class="rating">--}}
                {{--                                                <i class="fas fa-star"></i>--}}
                {{--                                                <i class="fas fa-star"></i>--}}
                {{--                                                <i class="fas fa-star"></i>--}}
                {{--                                                <i class="fas fa-star"></i>--}}
                {{--                                                <i class="fas fa-star"></i>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <p>--}}
                {{--                                        <span>Service Was Excellent</span>--}}
                {{--                                        In publishing and graphic design, Lorem ipsum is a placeholder text--}}
                {{--                                        commonly used to demonstrate the visual form of a document or a typeface--}}
                {{--                                        without relying on meaningful content. Lorem ipsum may be used as a--}}
                {{--                                        placeholder before final copy is available.--}}
                {{--                                    </p>--}}
                {{--                                    <div class="source">--}}
                {{--                                        <span>Source: </span>--}}
                {{--                                        <img loading="lazy" src="{{asset("/web-assets/images/google-logo.webp")}}" alt="">--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </section>

    <section class="apartSec">
        <div class="container-lg">
            <div class="row gap-md-0 gap-5">
                <div class="col-12">
                    <h2 class="secHeading">
                        Affordable Chauffeur Services in Dubai
                    </h2>
                    <p>
                        Sit back and relax while we drive you across Dubai, Abu Dhabi, Sharjah and other emirates in a
                        range of sedans, SUVs and vans.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="apartBox">
                        <figure>
                            <i class="fa fa-quote-left"></i>
                        </figure>
                        <div class="content">
                            <h4>All-inclusive rates</h4>
                            <p>
                                Our unbeatable rates include fuel, salik (toll), taxes and all
                                other charges. Pay in advance and have your guests chauffeured
                                with ease.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="apartBox">
                        <figure>
                            <i class="fa fa-quote-left"></i>
                        </figure>
                        <div class="content">
                            <h4>All-inclusive rates</h4>
                            <p>
                                Our unbeatable rates include fuel, salik (toll), taxes and all
                                other charges. Pay in advance and have your guests chauffeured
                                with ease.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="apartBox">
                        <figure>
                            <i class="fa fa-quote-left"></i>
                        </figure>
                        <div class="content">
                            <h4>All-inclusive rates</h4>
                            <p>
                                Our unbeatable rates include fuel, salik (toll), taxes and all
                                other charges. Pay in advance and have your guests chauffeured
                                with ease.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-3 aboutSec">
        <div class="container-md">
            <div class="row">
                <div class="col-12">
                    <div class="aboutContent contentWrap">
                        <h2 class="secHeading">What is Chauffeur Service in Dubai?</h2>

                        <p>
                            Dubai Chauffeur service is excellent for renting a car with a
                            <strong>professional driver. Car rental Dubai with driver </strong>
                            offers a fantastic collection of luxury cars with drivers to explore
                            the <strong>famous city</strong> in UAE. Often these companies provide
                            tailor-made tours for visitors and residents. The rental
                            <strong>company transport</strong> is savior if you need an executive
                            car with a driver to pick you up from the airport or for business
                            meetings.
                        </p>
                        <p>
                            This <strong>excellent service</strong> is available around UAE, and
                            now you can have it in Abu Dhabi.
                        </p>
                        <h2 class="secHeading">How do I book Car Rentals with a driver in Dubai?</h2>

                        <p>
                            Car rental with a driver in Dubai is hassle-free and easy. You can
                            easily browse through various car with driver websites to overview the
                            offers made by different companies.
                        </p>
                        <p>
                            From here, you can quickly narrow down what you want. Companies like
                            OneTapDrive offer <strong>Executive chauffeur services</strong> with
                            cars at affordable prices and rent a car with drivers monthly, weekly
                            or even hourly <strong>for cheap chauffeur service.</strong>
                        </p>
                        <h2 class="secHeading">Luxury Car Rental Dubai with Driver</h2>
                        <p>
                            Dubai is one of the most incredible travel destinations in the world,
                            with a vast number of visitors from around the globe!
                        </p>
                        <p>
                            <strong>Rental cars in Dubai</strong> with drivers allow you to take
                            in the city in all its glory. Whether it’s a luxury car, SUV car or
                            luxury bus to choose from or comfortable 4x4s, we’ve got you covered!
                        </p>

                        <h2 class="secHeading">Valid Reasons to Rent a Car with a Driver in Dubai</h2>
                        <p>
                            Are you someone who tires easily when traveling to far-off places in a
                            car, or are you a tourist or local in Dubai who doesn’t enjoy driving?
                        </p>
                        <p>
                            You can take a seat, unwind and enjoy the journey by hiring a car with
                            a driver in Dubai with <strong>chauffeur service online.</strong>
                        </p>
                        <p>
                            Then opt for a car with
                            <strong>chauffeur services in Dubai</strong> that offer experienced
                            drivers for you to travel around the UAE without worry!
                        </p>
                        <p>
                            You won’t have to worry about where to park when you get
                            <strong>professional chauffeur services</strong> because the driver
                            will be in charge of all of that.
                        </p>
                        <p>
                            Car rental in Dubai with a driver also helps you save money, as the
                            exorbitant cab fare can eat up your budget; undoubtedly, it’s a
                            <strong>reliable service</strong> you can depend on around the clock.
                        </p>
                        <p>
                            The One Click Drive’s extensive fleet of vehicles provides all the
                            ease you are looking for in a busy city like Dubai. Enjoy
                            <strong>Abu Dhabi City tours</strong> in style and make an impression
                            on onlookers.
                        </p>
                        <p>
                            So if you are considering taking a trip, we advise you to rent a
                            <strong>luxury car with a driver in Dubai</strong> from local
                            suppliers listed on our platform, whether it is
                            <strong>luxury buses</strong>, <strong>luxury cars</strong> or
                            <strong> luxury vans</strong>. You can rely on
                            <strong>breathtaking luxury</strong> with closed eyes to ensure your
                            rental experience is as convenient as possible.
                        </p>

                        <h2 class="secHeading">Chauffeur Car with Driver Service for Every Need</h2>
                        <p><strong>A to B Transfer Service</strong></p>
                        <p>
                            Whether you’re in Dubai for a <strong>business meeting</strong> or
                            want to explore its stunning beaches and architectural beauty, Dubai
                            suppliers at OneTapDrive have you covered!
                        </p>
                        <p>
                            From point-to-point transportation with professional drivers to
                            airport transfers, you can
                            <strong>hire a car in Dubai with driver</strong> at your convenience!
                        </p>
                        <p>
                            With this reliable transportation service, the biggest marketplace for
                            all <strong>multinational companies</strong>, you can go to your
                            meetings on time and be free of the hassle of
                            <strong>city transfer.</strong>
                        </p>
                        <h2 class="secHeading">Corporate Events</h2>
                        <p>
                            When it comes to corporate events, everything needs to be planned
                            carefully. Our platform has a reliable full-day
                            <strong>rent a car with driver Dubai</strong> that ensures that
                            transportation to the event venue is the last concern on your mind.
                            You can rent some of the most luxurious cars, such as Mercedes,
                            Lamborghini, Audi, Rolls Royce and more, without the hassle of monthly
                            car installments!
                        </p>
                        <h2 class="secHeading">
                            Special Occasions like Weddings, Birthday or Anniversary Parties
                        </h2>
                        <p>
                            If you want to provide your guests with exceptional treatment, why not
                            go for a <strong>luxury car rental Dubai with driver?</strong>
                        </p>

                        <p>
                            This ensures they can be picked up and dropped off at the venue of the
                            wedding, birthday or anniversary party.
                        </p>
                        <p>
                            With <strong>luxury chauffeur service in Dubai,</strong> you can enjoy
                            <strong>luxurious rides</strong> around the city with comfort and
                            ease.
                        </p>

                        <h2 class="secHeading">Why Car Rental with Driver in Dubai with OneTapDrive?</h2>
                        <p>
                            <strong>Car Renting Made Easy:</strong> We connect you to an extensive
                            network of rent-a-car with driver companies in Dubai that offer
                            excellent deals and cars catered to your needs.
                        </p>
                        <p>
                            <strong>Flexibility:</strong> You can choose daily, weekly or monthly
                            rental options, or you can even customise depending on your
                            requirement.
                        </p>
                        <p>
                            <strong>Wide Array of Options:</strong> Select from many executive and
                            luxury cars driven by professional chauffeurs, and travel freely at
                            your own pace.
                        </p>
                        <p>
                            <strong>Budget-friendly Choices:</strong> We work with many car
                            rentals with driver suppliers in Dubai who offer the lowest and most
                            competitive rates across the UAE.
                        </p>
                        <h2 class="secHeading">Car Hire with Driver in Dubai For Personal Usage</h2>
                        <p>
                            If you’re looking for a way to do a Dubai city tour without worrying
                            about public transportation, rent a car with a driver in Dubai. With
                            this service, you can simply contact a trained driver with a car and
                            let them know where you want to go. The driver will then take care of
                            everything from driving you to your destination to taking care of
                            parking rules.
                        </p>

                        <p>
                            This is an excellent option if you’re busy and don’t have time to wait
                            for buses, metro or taxi drivers. Plus, it’s much safer than driving
                            yourself.
                        </p>
                        <p>
                            You can go shopping and have a combined shopping trip with your
                            friends and family if you are new to the city You can also enjoy a
                            city tour with your friends and family.
                        </p>
                        <h2 class="secHeading">Car Rental Dubai with Driver for Business Travel</h2>
                        <p>
                            Getting the most out of your business trip is vital if you’re
                            traveling for work. With
                            <strong>Dubai luxury car rental with a driver,</strong> you can have
                            someone take care of your driving. With plenty of time, you can relax
                            and focus on what’s important: getting your work done.
                        </p>
                        <p>
                            The chauffeur will also be able to help you find the best tourist
                            attractions in your destination.
                        </p>

                        <p>
                            Renting a car with a driver in Dubai is perfect for busy
                            <strong>business associates</strong> who dont want to worry about
                            driving. Plus, it’s a great way to get around town without worrying
                            about parking, traffic, or navigation.
                        </p>
                        <h2 class="secHeading">Economical car rental in Dubai with a driver</h2>
                        <p>
                            If you’re looking for a <strong>cheap rental car</strong> with a
                            driver in Dubai, look no further than the OneTapDrive marketplace.
                            With so many local suppliers, you can find one that fits your budget
                            and needs. Our suppliers also offer various service options, including
                            pickups from the airport and drop-offs at your hotel or destination.
                        </p>
                        <h2 class="secHeading">OneTapDrive- Unlock Extraordinary Adventures</h2>
                        <p>
                            At OneTapDrive, we cater to your every adventure-seeking desire.
                            Whether you’re looking to explore the scenic beauty of the city in
                            chauffeur driven cars, sail the pristine waters on a
                            <a href="" class="clr_primary">luxurious yacht,</a> rent
                            high-performance <a href="" class="clr_primary">sports cars</a> for an
                            exhilarating drive, or embark on an unforgettable
                            <a href="{{route('desert-safari')}}" class="clr_primary">desert safari,</a> we
                            have it all covered. Immerse yourself in the lap of luxury and
                            experience the thrill of our diverse offerings.
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

    <script>
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
@endsection
