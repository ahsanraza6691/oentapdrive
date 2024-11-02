@extends('frontend.layouts.header')
@section('title','Contact Us')

@section('content')

<div class="contact_wrapper">


    <section>
      <div class="content_wrap">
        <h1 class="reveal fade_bottom">Contact Us | WheelsOnClick</h1>
        <p class="reveal fade_bottom">
          Need assistance with a car rental service provider? Or wondering how
          to partner up?
        </p>
        <div class="row">
          <div class="col-lg-6 reveal fade_bottom">
            <div class="contact_form">
              <div class="row">
                <div class="col-lg-6 pb-2 reveal fade_bottom">
                  <label for="">Name</label>
                  <input placeholder="Name" class="form-control" type="text" />
                </div>
                <div class="col-lg-6 pb-2 reveal fade_bottom">
                  <label for="">Contact No</label>
                  <input placeholder="Contact no" class="form-control" type="number" />
                </div>
                <div class="col-lg-6 pb-2 reveal fade_bottom">
                  <label for="">Email</label>
                  <input placeholder="Email" class="form-control" type="email" />
                </div>
                <div class="col-lg-6 pb-2 reveal fade_bottom">
                  <label for="">Subject</label>
                  <input placeholder="Subject" class="form-control" type="text" />
                </div>
                <div class="col-lg-12 pb-2 reveal fade_bottom">
                  <label for="">Query</label>
                  <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="col-lg-12 pb-2 flex_end">
                  <button class="styled_button animate_width">Submit</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 reveal fade_bottom">
            <div class="map">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2822.7806761080233!2d-93.29138368446431!3d44.96844997909819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x52b32b6ee2c87c91%3A0xc20dff2748d2bd92!2sWalker+Art+Center!5e0!3m2!1sen!2sus!4v1514524647889"
                width="600"
                height="450"
                frameborder="0"
                style="border: 0"
                allowfullscreen
              ></iframe>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <h2>Are you a car rental company?</h2>
            <button class="styled_button animate_width">
              List Your Cars With Us
            </button>
            <div class="Social_media">
              <a href="#"
                ><span><i class="fa fa-facebook"></i></span
              ></a>
              <a href="#"
                ><span><i class="fa fa-instagram"></i></span
              ></a>
              <a href="#"
                ><span><i class="fa fa-twitter"></i></span
              ></a>
              <a href="#"
                ><span><i class="fa fa-linkedin"></i></span
              ></a>
              <a href="#"
                ><span><i class="fa fa-map-marker"></i></span
              ></a>
              <a href="#"
                ><span><i class="fa fa-car"></i></span
              ></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-3 reveal fade_bottom p-2">
            <div class="styled_card_1">
              <div class="card_image">
                <img
                  src="https://www.oneclickdrive.com/application/views/images/luxury2.webp?clr=14.6"
                  alt
                />
              </div>
              <div class="styled_divider mb_20">
                <span class="divider_title center"></span>
              </div>
              <div class="card_content">
                <h3 class="font_semi_bold">Toyota</h3>
                <p class="reveal fade_bottom">100 Cars</p>
                <button class="styled_button">View All Car</button>
              </div>
            </div>
          </div>
          <div class="col-lg-3 reveal fade_bottom p-2">
            <div class="styled_card_1">
              <div class="card_image">
                <img
                  src="https://www.oneclickdrive.com/application/views/images/luxury2.webp?clr=14.6"
                  alt
                />
              </div>
              <div class="styled_divider mb_20">
                <span class="divider_title center"></span>
              </div>
              <div class="card_content">
                <h3 class="font_semi_bold">Toyota</h3>
                <p class="reveal fade_bottom">100 Cars</p>
                <button class="styled_button">View All Car</button>
              </div>
            </div>
          </div>
          <div class="col-lg-3 reveal fade_bottom p-2">
            <div class="styled_card_1">
              <div class="card_image">
                <img
                  src="https://www.oneclickdrive.com/application/views/images/luxury2.webp?clr=14.6"
                  alt
                />
              </div>
              <div class="styled_divider mb_20">
                <span class="divider_title center"></span>
              </div>
              <div class="card_content">
                <h3 class="font_semi_bold">Toyota</h3>
                <p class="reveal fade_bottom">100 Cars</p>
                <button class="styled_button">View All Car</button>
              </div>
            </div>
          </div>
          <div class="col-lg-3 reveal fade_bottom p-2">
            <div class="styled_card_1">
              <div class="card_image">
                <img
                  src="https://www.oneclickdrive.com/application/views/images/luxury2.webp?clr=14.6"
                  alt
                />
              </div>
              <div class="styled_divider mb_20">
                <span class="divider_title center"></span>
              </div>
              <div class="card_content">
                <h3 class="font_semi_bold">Toyota</h3>
                <p class="reveal fade_bottom">100 Cars</p>
                <button class="styled_button">View All Car</button>
              </div>
            </div>
          </div>
        </div>
        <div class="space_y"></div>
        <p class="reveal fade_bottom">
          Tired of searching for a ‘rent a car near me’? You have reached just
          the right place. OneClickDrive.com is a leading car rental
          marketplace in Dubai featuring budget-friendly car hire deals from
          reliable rental car companies in the region. You can choose from our
          extensive inventory of over 2000 vehicles listed by trusted car
          rental businesses in the UAE. Whether you’re a tourist looking for a
          car facility or a resident in search of long term rentals, we assure
          you the cheapest rent cars at the best prices starting as low as AED
          30 per day.
        </p>
      </div>
    </section>
    <section class="bg_lime">
      <div class="content_wrap">
        <h2 class="reveal fade_bottom">
          Get the WheelsOnClick Car Rental Appon your smartphone today!
        </h2>
        <div class="row">
          <div class="col-lg-6">
            <ul class="styled_list">
              <li class="reveal fade_bottom">
                - Find offers with detailed info
              </li>
              <li class="reveal fade_bottom">
                - Direct Supplier booking process
              </li>
              <li class="reveal fade_bottom">- Available in 30+ cities</li>
            </ul>
            <div class="app_icons">
              <img
                class="reveal fade_bottom"
                src="https://www.oneclickdrive.com/img/apple-app-icon.svg?v2=123"
                alt="app-store"
              />
              <img
                class="reveal fade_bottom"
                src="https://www.oneclickdrive.com/img/google-app-icon.svg?v2=123"
                alt="google-play-store"
              />
              <img
                class="reveal fade_bottom"
                src="https://www.oneclickdrive.com/img/huawei-01.svg?v2=14"
                alt="app-gallery"
              />
            </div>
          </div>
          <div class="col-lg-6">
            <img
              width="100%"
              src="https://www.oneclickdrive.com/img/app-screenshots-designs.webp"
              alt=""
            />
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="content_wrap">
        <h2>Frequently Asked Questions</h2>
        <div class="collapse_wrap">
          <div class="collapse_items">
            <div id="faq-one" class="custom_collapse">
              <button onclick="onOpenCollapse('faq-one')">
                <span> Why is driving a BMW recommended in Dubai? </span>
                <i id="faq-one-arrow" class="fa fa-angle-down"></i>
              </button>
              <div id="faq-one-content" class="collapse_content">
                <p>
                  Among the popular car choices, BMW is definitely a favorite.
                  In Dubai, more so, as it’s perfect for Sheikh Zayed Road as
                  well as on the highways stretching across the Emirates.
                  Being one of the most scenic places for those seeking a
                  luxurious adventure on wheels, BMWs are the most-in-demand
                  cars in Dubai. You’ll be driving alongside exotic cars such
                  as Porsche, Mercedes Benz, Audi, not to mention a range of
                  sports cars.Many tourists and residents in Dubai rent a BMW
                  to soak the pleasure of driving a luxurious sedan. The
                  spacious cabin, extra legroom, advanced driving and safety
                  features are what BMW vehicles are most known for.
                </p>
              </div>
            </div>
          </div>
          <div class="collapse_items">
            <div id="faq-two" class="custom_collapse">
              <button onclick="onOpenCollapse('faq-two')">
                <span>
                  Can I take the BMW rental car to Abu Dhabi from Dubai?
                </span>
                <i id="faq-two-arrow" class="fa fa-angle-down"></i>
              </button>
              <div id="faq-two-content" class="collapse_content">
                <p>
                  Yes, you can! Most customers rent a luxury sedan in Dubai to
                  visit Abu Dhabi and other emirates. It’s definitely the best
                  way to explore the UAE. Car rental companies allow their
                  vehicles to be driven anywhere in the UAE, barring a few
                  locations such as Jebel Hafeet, Jebel Jais and desert areas.
                  Be sure to plan your drives in advance to make the most of
                  it. Google Maps is your best friend!If you’re planning a
                  trip to the Grand Mosque, Louvre or Yas Marina, consider
                  renting for 2 or more days to offset the additional mileage
                  charge you will incur. As most car rentals, including luxury
                  and sports cars, come with a standard mileage limit of
                  250-km per day. Dubai to Abu Dhabi is a good 150-km away so
                  you’ll probably be clocking over 300 km on the journey
                  back.Best practice: Consult with the car rental agency
                  regarding your trip plan for suggestions. Additional mileage
                  packages may be available.
                </p>
              </div>
            </div>
          </div>
          <div class="collapse_items">
            <div id="faq-three" class="custom_collapse">
              <button onclick="onOpenCollapse('faq-three')">
                <span>
                  Which type of BMW cars are available for rent in Dubai?
                </span>
                <i id="faq-three-arrow" class="fa fa-angle-down"></i>
              </button>
              <div id="faq-three-content" class="collapse_content">
                <p>
                    WheelsOnClick.com works with several car rental companies
                  across the world. In Dubai, we work with quite a few BMW car
                  rental providers. You can choose among cars with a range of
                  engine sizes and additional features, including GPS
                  navigation, safety and performance enhancements. The BMW
                  sedan comes in various 4-door sedan, convertible models with
                  advanced features. Different models including: BMW 2-series,
                  3-series, 550i, 550 mpower, 730li, 750li, X5, X6 and more.
                  If you’re looking for a rare BMW car model, contact our
                  suppliers who have listed a BMW. They might be able to cater
                  to your distinguished needs.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="rental_company_banner">
      <h2 class="reveal fade_bottom">
        ARE YOU A CAR RENTAL COMPANY? JOIN US.
      </h2>
      <a href="">
        <span class="reveal fade_bottom">
          List your cars with the UAE's biggest car rental & leasing
          marketplace today!
        </span>
      </a>
    </section>
  </div>
@endsection
