@extends('frontend.layouts.header')
@section('title', 'Rent a Car Dubai | Home')
@section('content')

    <section>
        <div class="content_wrap">
            <div class="row">
                @include('frontend.partials.profile-sidebar')
                <div class="col-md-9">
                    <div class="name">
                        <h4>WheelsOnClick Quick Guide<span class=""> / </span>Car Rentals</h4>
                    </div>
                    <div class="row mt-4">

                        <h5>Selection</h5>
                        <p>
                            Renting a car with WheelsOnClick is quick and easy. You can compare offers from different
                            providers and even filter searches based on parameters such as car brand, location, budget, and
                            duration.
                        </p>
                        <h5>Partners</h5>
                        <p>
                            We have over 150+ car rental companies listed on our marketplace. All verified listings are
                            reviewed by our team before being published.
                        </p>
                        <h5>Deals</h5>
                        <p>The prices, offers and deals are added and updated by the car rental companies directly. In case
                            of an unavailable car / listing, kindly contact us.</p>
                        <h5>Bookings</h5>
                        <p>
                            Once you’ve found the car rental that’s right for you, click the chat or call button to directly
                            contact the company for bookings or inquiries.
                        </p>
                        <h5>Deposits</h5>
                        <p>
                            All rental cars are subject to a deposit. It’s always best to use a credit card to make the
                            deposit. This ensures that the deposit will be released automatically after 20-30 days. Banks
                            can also help you get it faster if needed.</p>
                        <h5>Insurance</h5>
                        <p>
                            All rental companies found on our marketplace offer standard insurance inclusive of the price.
                            However, you can opt for Collision Damage Waiver (Additional Coverage) for an additional fee.
                            This also varies from company to company.
                        </p>
                        <h5>Complaints</h5>
                        <p>If you suspect fraud, we need your help. Please report any listings that you personally believe are inaccurate or misleading from our Contact Us page.

                        </p>
                        <h5>Car Rental Do’s and Don’ts</h5>
                        <ul>
                            <li>When renting a car, it’s important to follow the terms and conditions set by your chosen car rental company.</li>
                            <li>Please be sure to check the rental car at the time of delivery. Take photos and videos of any dents, scratches or tears before you ride. If there are already defects, please report them beforehand to avoid any misunderstandings later.</li>
                            <li>Remember to keep a digital or printed copy of the contract as proof of rental.</li>
                            </ul>


                            <p>That’s all there is to know about renting a car through OneClickDrive.


                            </p>





                        <button class="styled_button animate_width w-auto">Rent a Car</button>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
