@extends('frontend.layouts.new_header')
@section('title', 'About Us | OneTapDrive')
@section('content')
    <section class="heroSec">
        <img src="{{asset("web-assets/images/hero_bg.jpg")}}" alt="">
        <div class="content">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <h1>
                            Welcome to
                            <span>
                                OneTapDrive
                            </span>
                        </h1>
                        <p>
                            where we make renting cars easy. We are UAE’s leading car rental
                            portal. We connect you to our extensive network of rental partners
                            that offer the best deals and cars to fit your every need.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="aboutSec">
        <div class="container-md">
            <div class="row align-items-center flex-lg-row flex-column-reverse gap-lg-0 gap-4">
                <div class="col-lg-7">
                    <div class="aboutContent">
                        <h2 class="secHeading">About Us</h2>
                        <p>
                            Welcome to OneTapDrive, where renting cars is made simple and convenient. We are the UAE's
                            premier car rental platform, connecting you with a vast network of rental partners who
                            provide the best deals and a wide selection of vehicles to suit your every need.
                        </p>
                        <p>
                            Enjoy a seamless booking experience by exploring car rentals on our website and mobile app.
                            Discover unbeatable offers on budget-friendly options, <span class="coloured">luxury and sports cars,</span>
                            as well as car-with-driver and driver-on-hire services across Dubai, Abu Dhabi, Sharjah, and
                            select cities worldwide.
                        </p>
                        <p>
                            Our rental partners guarantee the lowest prices on a diverse range of cars. Choose from
                            flexible rental plans, including daily, weekly, and monthly options, with custom deals
                            tailored to your specific needs.
                        </p>
                        <p>
                            Travel effortlessly with our additional partner services, including 24/7 chauffeur and
                            airport transfer services, as well as on-demand driver services—all at the most competitive,
                            all-inclusive rates. Select from a curated fleet of executive and luxury vehicles, driven by
                            professional chauffeurs, and enjoy traveling at your own pace.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <figure class="aboutImg">
                        <img src="{{asset("/web-assets/images/buildin.webp")}}" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <section class="apartSec">
        <div class="container-lg">
            <div class="row gap-md-0 gap-5">
                <div class="col-12">
                    <h2 class="secHeading">
                        What sets us apart
                    </h2>
                </div>
                <div class="col-md-4">
                    <div class="apartBox">
                        <figure>
                            <img src="{{asset("/web-assets/images/apart1.webp")}}" alt="">
                        </figure>
                        <div class="content">
                            <h4>Exclusive Cars</h4>
                            <p>
                                Whether you’re looking for budget-friendly cars or exclusive luxury and sports cars, we
                                have you covered.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="apartBox">
                        <figure>
                            <img src="{{asset("/web-assets/images/apart2.webp")}}" alt="">
                        </figure>
                        <div class="content">
                            <h4>Exclusive Cars</h4>
                            <p>
                                Whether you’re looking for budget-friendly cars or exclusive luxury and sports cars, we
                                have you covered.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="apartBox">
                        <figure>
                            <img src="{{asset("/web-assets/images/apart3.webp")}}" alt="">
                        </figure>
                        <div class="content">
                            <h4>Exclusive Cars</h4>
                            <p>
                                Whether you’re looking for budget-friendly cars or exclusive luxury and sports cars, we
                                have you covered.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="aboutSec">
        <div class="container-md">
            <div class="row align-items-center gap-lg-0 gap-4">
                <div class="col-lg-7">
                    <figure class="aboutImg">
                        <iframe
                            width="420"
                            height="315"
                            src="https://www.youtube.com/embed/tsr7UFi-rjs"
                        >
                        </iframe>
                    </figure>
                </div>
                <div class="col-lg-5">
                    <div class="aboutContent">
                        <h2 class="secHeading">Mission</h2>
                        <p>
                            Our core purpose is to be your gateway to the local car rental industry across the world and
                            make the process of renting cars easy and transparent.
                        </p>
                        <h2 class="secHeading">Vision</h2>
                        <p>
                            Our vision is to be the world’s leading car rental portal and add value to our users’
                            experiences through constant innovation and improvements.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="listingSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <h2 class="secHeading mb-5">
                        The <span class="clr_primary">oneTapDrive</span> Experience
                    </h2>
                </div>
                <div class="col-md-7">
                    <div class="aboutContent">
                        <h3>
                            For Users
                        </h3>
                        <p>
                            Explore our portal and book the car of your choice at
                            all-inclusive prices in just a few clicks
                        </p>
                        <p>
                            Book directly from our verified car rental partners and be
                            assured of expert service
                        </p>
                        <p>
                            Compare using various filters like car brand, model, location,
                            budget and other features to find a car as per your
                            requirements
                        </p>
                        <p>
                            Book chauffeur-driven cars and driver-on-demand with ease from
                            reputed service providers
                        </p>
                        <p>
                            Contact our rental partners instantly through phone, email,
                            and WhatsApp
                        </p>
                        <p>
                            Compare live car rental offers from multiple companies at a
                            glance
                        </p>
                        <p>
                            We follow a stringent onboarding process of our rental
                            partners, assuring the best service and quality
                        </p>
                        <p>
                            Each car is verified with real photos before being listed on
                            our portal so you can book confidently
                        </p>
                        <p>
                            Reverse the search by submitting a ‘Find Me A Car’ request to
                            get rental quotes from multiple companies
                        </p>
                        <a href="" class="themeBtn">
                            Start Renting
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="aboutContent">
                        <h3>
                            For Partners
                        </h3>
                        <h6>
                            Car Rental Companies
                        </h6>
                        <ul>
                            <li>
                                <img
                                    alt="image"
                                    src="{{asset('web-assets/images/growth.webp')}}"
                                />
                                <p>
                                    Grow your business and increase your visibility by
                                    partnering with <a href="/">oneTapDrive</a>
                                </p>
                            </li>
                            <li>
                                <img
                                    alt="image"
                                    src="{{asset('web-assets/images/booking.webp')}}"
                                />
                                <p>
                                    Grow your business and increase your visibility by
                                    partnering with <a href="/">oneTapDrive</a>
                                </p>
                            </li>
                            <li>
                                <img
                                    alt="image"
                                    src="{{asset('web-assets/images/speedometer.webp')}}"
                                />
                                <p>
                                    Grow your business and increase your visibility by
                                    partnering with <a href="/">oneTapDrive</a>
                                </p>
                            </li>
                            <li>
                                <img
                                    alt="image"
                                    src="{{asset('web-assets/images/dashboard.webp')}}"
                                />
                                <p>
                                    Grow your business and increase your visibility by
                                    partnering with <a href="/">oneTapDrive</a>
                                </p>
                            </li>
                        </ul>
                        <a href="" class="themeBtn">
                            List Your Car
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="howToSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-7">
                    <div class="aboutContent">
                        <h3>
                            How to rent a car
                        </h3>
                        <ul>
                            <li>
                            <span>
                                Browse offers on oneTapDrive.com
                            </span>
                                <p>
                                    Register and use our mobile app for a better experience
                                </p>
                            </li>
                            <li>
                            <span>
                                Select your preferred car among hundreds of options
                            </span>
                                <p>
                                    Narrow down your search by using the filters, as per your requirement
                                </p>
                            </li>
                            <li>
                            <span>
                                Connect with listed suppliers offering the car(s) you wish to hire and mention your required dates
                            </span>
                                <p>
                                    You can contact them directly via Phone or WhatsApp
                                </p>
                                <p>
                                    Rental fee and deposit payment can be made by Card or Cash at the time of delivery
                                </p>
                                <p>
                                    Share your feedback with us if the company is unresponsive or the car is unavailable
                                </p>
                            </li>
                            <li>
                            <span>
                                Book with the company of your choice
                            </span>
                            </li>
                            <li>
                            <span>
                                Drive away!
                            </span>
                            </li>
                        </ul>
                        <h3>
                            Important Tips
                        </h3>
                        <ul>
                            <li>
                                <span>
                                    At the time of car delivery, check for existing dents and scratches
                                </span>
                                <p>
                                    Shoot a video and share with the service provider beforehand
                                </p>
                            </li>
                            <li>
                                <span>
                                    Be sure to deal with the same company as listed on OneTapDrive
                                </span>
                                <p>
                                    Save a copy of the car rental agreement
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <figure class="iphoneVideo">
                        <img src="{{asset('/web-assets/images/iphone.webp')}}" alt="">
                        <video autoplay loop muted>
                            <source src="{{asset("/web-assets/images/about-video.mp4")}}">
                        </video>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <section class="gallerySec">
        @foreach(range(0, 8) as $index)
            <img src="{{ asset('/web-assets/images/cars/' . $index+1 . '.webp') }}" alt="Image {{ $index }}">
        @endforeach
    </section>
@endsection
