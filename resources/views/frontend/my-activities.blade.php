@extends('frontend.layouts.new_header')
@section('title', 'Rent a Car Dubai | Home')
@section('content')

    <section>
        <div class="content_wrap">
            <div class="row">
                @include('frontend.partials.profile-sidebar')
                <div class="col-md-9">
                    <div class="name">
                        <h4>My Profile</h4>
                    </div>
                    <div class="row">
                        @include('frontend.partials.profile header')
                        <hr class="my-4">
                        <div class="styled_vehicle_card_2">
                            <div class="carousel_wrapper">
                              <div id="demo" class="carousel slide" data-bs-ride="carousel">
                                <!-- Indicators/dots -->
                                <div class="carousel-indicators">
                                  <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active" aria-current="true"></button>
                                  <button type="button" data-bs-target="#demo" data-bs-slide-to="1" class=""></button>
                                  <button type="button" data-bs-target="#demo" data-bs-slide-to="2" class=""></button>
                                </div>
                                <!-- The slideshow/carousel -->
                                <div class="carousel-inner">
                                  <div class="carousel-item active">
                                    <img src={{ asset('assets/images/Hyundai_Santa.webp') }}  alt="Los Angeles" class="d-block" style="width: 100%">
                                  </div>
                                  <div class="carousel-item">
                                    <img src={{ asset('assets/images/Hyundai_Santa.webp') }}  alt="Chicago" class="d-block" style="width: 100%">
                                  </div>
                                  <div class="carousel-item">
                                    <img src={{ asset('assets/images/Hyundai_Santa.webp') }}  alt="New York" class="d-block" style="width: 100%">
                                  </div>
                                </div>

                                <!-- Left and right controls/icons -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                                  <span class="carousel-control-next-icon"></span>
                                </button>
                              </div>
                            </div>

                            <div class="content_wrapper">
                              <h2 class="clr_primary">BMW X6 2022</h2>
                              <div class="tags mb-3" bis_skin_checked="1">
                                <span>SUV</span><span>4
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M149.6 41L42.88 254.4c23.8 24.3 53.54 58.8 78.42 97.4 24.5 38.1 44.1 79.7 47.1 119.2h270.3L423.3 41H149.6zM164 64h230l8 192H74l90-192zm86.8 17.99l-141 154.81L339.3 81.99h-88.5zM336 279h64v18h-64v-18z">
                                        </path>
                                    </svg>
                                </span>
                                <span>4
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="none" d="M0 0h24v24H0V0z"></path>
                                        <path d="M15 5v7H9V5h6m0-2H9c-1.1 0-2 .9-2 2v9h10V5c0-1.1-.9-2-2-2zm7 7h-3v3h3v-3zM5 10H2v3h3v-3zm15 5H4v6h2v-4h12v4h2v-6z">
                                        </path>
                                    </svg>
                                </span>
                                <span>4
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path d="M17 6h-2V3c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v3H7c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2 0 .55.45 1 1 1s1-.45 1-1h6c0 .55.45 1 1 1s1-.45 1-1c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM9.5 18H8V9h1.5v9zm3.25 0h-1.5V9h1.5v9zm.75-12h-3V3.5h3V6zM16 18h-1.5V9H16v9z">
                                        </path>
                                    </svg>
                                </span>
                            </div>
                              <div class="content_container">
                                {{-- <div>
                                  <p>
                                    <span><i class="fa fa-check"></i></span> One day rental
                                    available
                                  </p>
                                  <p>
                                    <span><i class="fa fa-check"></i></span> Insurance
                                    available
                                  </p>
                                  <p>
                                    <span><i class="fa fa-bitcoin"></i></span>Crypto payment
                                    accepted
                                  </p>
                                  <p>
                                    <span><i class="fa fa-info"></i></span>Deposit : AED
                                    2000
                                  </p>
                                  <p>
                                    <span><i class="fa fa-money"></i></span>Refunded in 30
                                    days
                                  </p>
                                </div> --}}
                                <div class="price_tag">
                                  <del>AED 1000</del>
                                  <span><h2 class="clr_primary">AED 900 / day</h2></span>
                                  <span>
                                    <i class="fa fa-road"></i>
                                    <span>250 km</span></span>
                                </div>
                                <div class="price_tag">
                                  <del>AED 1000</del>
                                  <span><h2 class="clr_primary">AED 900 / day</h2></span>
                                  <span>
                                    <i class="fa fa-road"></i>
                                    <span>250 km</span></span>
                                </div>
                              </div>

                              <div class="company_tag">
                                <img src="https://www.oneclickdrive.com/application/views/img/company/euroline-rental-big-logo.png?ve=4.4&amp;height=92&amp;width=auto&amp;fit=resize" alt="">
                                <a class="clr_primary" href="#">
                                  <i class="fa fa-map-marker"></i> Diara
                                </a>
                              </div>

                              <div class="Social_media">
                                <a href="#"><span><i class="fa fa-phone"></i></span></a>
                                <a href="#"><span><i class="fab fa-whatsapp"></i></span></a>
                                <a href="#"><span><i class="fa fa-share"></i></span></a>
                              </div>
                            </div>

                        </div>
                        <p>That’s the end of your list. Browse new offers to add more.</p>
                        <button class="styled_button animate_width w-auto mx-auto ">Continue Search</button>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
