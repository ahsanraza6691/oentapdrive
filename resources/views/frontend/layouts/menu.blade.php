<header class="desktopMenu">
    <div class="container-xl">
        <nav>
            <a class="logo" href="{{ route('home') }}">
                <img src="{{asset("web-assets/images/logo.webp")}}" alt="">
            </a>
            <ul class="mainMenu">
                <li>
                    <a href="" data-menu="catMenu">
                        Rent a Car
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <div id="catMenu" class="category-menu">
                        <div class="catRow">
                            <div class="catCol">
                                <h4>Categories</h4>
                                <ul>
                                   <li>
                                        <a href="{{route('rent-cheap-economy-cars-dubai')}}">
                                            Economy Cars
                                        </a>
                                    </li>
                                   <li>
                                        <a href="{{route('luxury-car-rental-dubai')}}">
                                            Luxury Car Rental Dubai
                                        </a>
                                    </li>
                                   <li>
                                        <a href="{{route('rent-sports-cars-in-dubai')}}">
                                            Sports Car Rental Dubai
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('rent-special-edition-car-dubai')}}">
                                            Special Edition
                                        </a>
                                    </li>
                                   <li>
                                        <a href="{{route('rent-muscles-cars-in-dubai')}}">
                                            Muscle Cars
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('rent-hybrid-electrical-cars-dubai')}}">
                                            Electric Cars
                                        </a>
                                    </li>
                                </ul>
                                <h4>Other</h4>
                                <ul>
                                    <li>
                                        <a href="{{route('list-your-rental-cars')}}">
                                            List Your Cars
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('companies')}}">
                                            Directory
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="catCol">
                                <h4>body types</h4>
                                <ul>
                                   <li>
                                        <a href="{{ route('car-rentals', ['type' => 'suv']) }}">SUV</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('car-rentals', ['type' => 'sedan']) }}">Sedan</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('car-rentals', ['type' => 'crossover'])}}">Crossover</a>
                                    </li>
                                    <li>
                                        <a href="{{route('car-rentals', ['type' => 'convertible'])}}">Convertible</a>
                                    </li>
                                    <li>
                                        <a href="{{route('car-rentals', ['type' => 'convertible'])}}">Compact</a>
                                    </li>
                                    <li>
                                        <a href="{{route('car-rentals', ['type' => 'coupe'])}}">Coupe</a>
                                    </li>
                                    <li>
                                        <a href="{{route('car-rentals', ['type' => 'van'])}}">Van</a>
                                    </li>
                                    <li>
                                        <a href="{{route('car-rentals', ['type' => 'special-needs'])}}">Special
                                            Needs</a>
                                    </li>
                                    <li>
                                        <a href="{{route('car-rentals', ['type' => 'hybrid'])}}">Hybrid</a>
                                    </li>
                                    <li>
                                        <a href="{{route('car-rentals', ['type' => 'pickup-truck'])}}">Pickup
                                            Truck</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="catCol">
                                <h4>rental by periods</h4>
                                <ul>
                                    <li><a href="#">Daily Car Rental</a></li>

                                    <li><a href="#">Weekly Car Rental</a></li>

                                    <li><a href="#">Monthly Car Rental</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="" data-menu="brandMenu">
                        Car Brands
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="brandMenu" id="brandMenu">
                        <ul>
                            @foreach ($brands as $brand)
                                <li>
                                    <a class="dropdown-item brand_drop"
                                       href="{{ route('brand-car-rental', ['brand' => urlencode($brand->slug)]) }}">
                                        <img src="{{ asset('brands/' . $brand->brand_image) }}"
                                             alt="">
                                        {{ $brand->brand_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                @if (!empty($services) && count($services) > 0)
                    <li>
                        <a href="" data-menu="catMenu2">
                            Car with Drivers
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <div id="catMenu2" class="category-menu small">
                            <div class="catRow">
                                <div class="catCol">
                                    <ul>
                                        @foreach ($services as $service_type)
                                            <li>
                                                <a class="dropdown-item"
                                                   href="{{ route('car-with-driver', ['service_type' => str_replace(" ", "-",strtolower($service_type))]) }}">
                                                    {{ $service_type }} <strong class="float-end">»</strong>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif

            </ul>
            <div class="headerSearchBar">
                <form action="">
                    <div class="inputCont">
                        <input type="search" id="searchField" placeholder="Search" autocomplete="off">
                        <button class="searchBtn">
                            <i class="fas fa-search"></i>
                        </button>
                        <div id="suggestions" class="suggestions-list"></div> <!-- Div to display suggestions -->
                    </div>
                </form>
                @if (!Auth::check())
                    <a class="themeBtn" href="#" data-bs-toggle="modal" data-bs-target="#login">
                        Login / Signup
                    </a>
                @endif
                @if (Auth::check())
                    <li class="userDropdown">
                        <div class="dropdown">
                            <button data-bs-toggle="dropdown" aria-expanded="false" type="button">
                                <img class="user_img" src="{{ asset('web-assets/images/user.webp') }}" alt="">
                                <span class="text-light">{{Auth::user()->name}}</span>
                            </button>
                            <ul class="dropdown-menu new_dropdown_menu">
                                @if (Auth::check() && Auth::user()->role == 3)
                                    <li><a class="dropdown-item"
                                           href="{{ route('my-profile') }}">Dashboard</a></li>
                                    <li><a class="dropdown-item"
                                           href="{{ route('wishlist') }}">Wishlist</a></li>
                                    <li><a class="dropdown-item"
                                           href="{{ route('user-logout') }}">Logout</a></li>
                                @endif
                                @if (Auth::check() && Auth::user()->role == 2)
                                    <li><a class="dropdown-item"
                                           href="{{ route('vendor-dashboard') }}">Dashboard</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('rent-car.index') }}">
                                            Car Listing
                                        </a>
                                    </li>
                                    <li>
                                        <form id="logout-form" action="{{ route('vendor-logout') }}"
                                              method="POST">
                                            @csrf
                                            <button class="dropdown-item" type="submit">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                @endif

                                @if (Auth::check() && Auth::user()->role == 1)
                                    <li><a class="dropdown-item"
                                           href="{{ route('admin-home') }}">Dashboard</a></li>

                                @endif
                                {{-- <li><a class="dropdown-item" href="#">Something </a></li> --}}
                            </ul>
                        </div>
                    </li>
                @endif
            </div>
        </nav>
    </div>
</header>

<header class="mobileMenu">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <nav>
                    <button>
                        <i class="fas fa-map-pin"></i>
                        <span>Dubai</span>
                    </button>
                    <div class="mobileSearchBar mobile">
                        <form action="{{route('rent-a-car-dubai')}}">
                            <div class="inputCont">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <input type="search" name="" id="" placeholder="Search for car rental in Dubai">
                            </div>
                        </form>
                    </div>
                    <button class="userBtn" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </nav>
            </div>
        </div>
    </div>
    <div class="sideMenu">
        <div class="nav">
            <button class="closeBtn">
                <i class="fas fa-times"></i>
            </button>
            <ul>
                <li>
                    @if (!Auth::check())
                        <a class="themeBtn loginPopup" href="#" data-bs-toggle="modal" data-bs-target="#login">
                            Login / Signup
                        </a>
                    @endif
                    @if (Auth::check())
                        <div class="userCont">
                            <img class="user_img" data-bs-toggle="dropdown" aria-expanded="false"
                                 src="{{ asset('web-assets/images/user.webp') }}" alt="">
                            <span>{{Auth::user()->name}}</span>
                        </div>
                    @endif
                </li>
                @if (Auth::check() && Auth::user()->role == 3)
                    <li><a class="dropdown-item"
                           href="{{ route('my-profile') }}">Dashboard</a></li>
                    <li><a class="dropdown-item"
                           href="{{ route('wishlist') }}">Wishlist</a></li>
                @endif
                @if (Auth::check() && Auth::user()->role == 2)
                    <li><a class="dropdown-item"
                           href="{{ route('vendor-dashboard') }}">Dashboard</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('rent-car.index') }}">
                            Car Listing
                        </a>
                    </li>
                    {{--                    <li>--}}
                    {{--                        <form id="logout-form" action="{{ route('vendor-logout') }}"--}}
                    {{--                              method="POST">--}}
                    {{--                            @csrf--}}
                    {{--                            <button class="dropdown-item" type="submit">--}}
                    {{--                                Logout--}}
                    {{--                            </button>--}}
                    {{--                        </form>--}}
                    {{--                    </li>--}}
                @endif
                @if (Auth::check() && Auth::user()->role == 1)
                    <li><a class="dropdown-item"
                           href="{{ route('admin-home') }}">Dashboard</a></li>
                @endif
                <li>
                    <a href="{{ route('home') }}"><span>Home</span></a>
                </li>
                <li>
                    <a href="javascript:;" data-menu="rent"><span>Rent a Car</span><i
                                class="fas fa-caret-right"></i></a>
                </li>
                <li>
                    <a href="javascript:;" data-menu="brands"><span>Car Brands</span><i class="fas fa-caret-right"></i></a>
                </li>
                <li>
                    <a href="javascript:;" data-menu="cwd"><span>Car with Drivers</span><i
                                class="fas fa-caret-right"></i></a>
                </li>
                <li>
                    <a href="{{ route('about-us') }}"><span>About Us</span></a>
                </li>
                <li>
                    <a href="{{ route('blogs') }}"><span>Blogs</span></a>
                </li>
                <li>
                    <a href="{{ route('faq') }}"><span>FAQs</span></a>
                </li>
                <li>
                    <a href="{{ route('contact-us') }}"><span>Contact Us</span></a>
                </li>
                @if (Auth::check() && Auth::user()->role == 3)
                    <li>
                        <a class="logoutBtn" href="{{ route('user-logout') }}">
                            Logout
                        </a>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->role == 2)
                    <li>
                        <form id="logout-form" action="{{ route('vendor-logout') }}"
                              method="POST">
                            @csrf
                            <button class="logoutBtn" type="submit">
                                Logout
                            </button>
                        </form>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->role == 1)
                    <li>
                        <a class="logoutBtn"
                           href="{{ route('admin-home') }}">
                            Logout
                        </a>
                    </li>
                @endif
            </ul>
            <div class="subMenu" id="rent">
                <button class="subMenuCloseBtn">
                    <i class="fas fa-times"></i>
                </button>
                <ul>
                    <li>
                        <h4>Categories</h4>
                    </li>
                   <li>
                        <a href="{{route('rent-cheap-economy-cars-dubai')}}">
                            <span>Economy Cars</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('luxury-car-rental-dubai')}}">
                            <span>Luxury Car Rental Dubai</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('rent-sports-cars-in-dubai')}}">
                            <span>Sports Car Rental Dubai</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('rent-special-edition-car-dubai')}}">
                            <span>Special Edition</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('rent-muscles-cars-in-dubai')}}">
                            <span>Muscle Cars</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('rent-hybrid-electrical-cars-dubai')}}">
                            <span>Electric Cars</span>
                        </a>
                    </li>
                    <li>
                        <h4>Other</h4>
                    </li>
                    <li>
                        <a href="{{route('list-your-rental-cars')}}">
                            <span>List Your Cars</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('companies')}}">
                            <span>Directory</span>
                        </a>
                    </li>
                    <li>
                        <h4>body types</h4>
                    </li>
                    <li>
                        <a href="{{ route('car-rentals', ['type' => 'suv']) }}">
                            <span>SUV</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('car-rentals', ['type' => 'sedan']) }}">
                            <span>Sedan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('car-rentals', ['type' => 'crossover']) }}">
                            <span>Crossover</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('car-rentals', ['type' => 'convertible']) }}">
                            <span>Convertible</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('car-rentals', ['type' => 'compact']) }}">
                            <span>Compact</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('car-rentals', ['type' => 'coupe']) }}">
                            <span>Coupe</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('car-rentals', ['type' => 'van']) }}">
                            <span>Van</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('car-rentals', ['type' => 'special-needs']) }}">
                            <span>Special Needs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('car-rentals', ['type' => 'hybrid']) }}">
                            <span>
                                Hybrid
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('car-rentals', ['type' => 'pickup-truck']) }}">
                            <span>
                                Pickup Truck
                            </span>
                        </a>
                    </li>
                    <li>
                        <h4>rental by periods</h4>
                    </li>
                    <li><a href="#">Daily Car Rental</a></li>

                    <li><a href="#">Weekly Car Rental</a></li>

                    <li><a href="#">Monthly Car Rental</a></li>
                </ul>
            </div>
            <div class="subMenu" id="brands">
                <button class="subMenuCloseBtn">
                    <i class="fas fa-times"></i>
                </button>
                <ul>
                   @foreach ($brands as $brand)
                        <li>
                            <a href="{{ route('brand-car-rental', ['brand' => urlencode($brand->slug)]) }}">
                                <img src="{{ asset('brands/' . $brand->brand_image) }}"
                                     alt="">
                                <span>{{ $brand->brand_name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="subMenu" id="cwd">
                <button class="subMenuCloseBtn">
                    <i class="fas fa-times"></i>
                </button>
                <ul>
                    @foreach ($services as $service_type)
                        <li>
                            <a href="{{route('car-with-driver',['service_type' => str_replace(" ", "-",strtolower($service_type))])}}">
                                <span>{{$service_type}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</header>
