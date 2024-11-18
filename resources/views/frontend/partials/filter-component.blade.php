
<div class="row">
    <div class="col-lg-3">
        <div class="filterCont">
            @php
                $params = [ "brand" => request()->route('brand', 'default-brand')];
                if (!empty(request()->route('type'))) {
                    $params = [ "type" => request()->route('type', 'default-category')];
                }
            @endphp
            <form method="GET" action="{{ route(Route::currentRouteName(), $params) }}">
                <div id="filters" class="filters">
                    <h2>
                        Filters
                    </h2>

                    <div class="collapse_wrap">
                        <div class="collapse_items">
                            <!-- Location -->

                            <div id="location" class="custom_collapse"
                                 @if (isset($_GET['city']) && !empty($_GET['city'])) style="height: 118px;" @endif>
                                <button type="button" onclick="onOpenCollapse('location')">
                                    <span> Location </span>
                                    <i id="location-arrow" class="fa fa-angle-down"></i>
                                </button>

                                <div id="location-content" class="collapse_content">
                                    <select class="form-control" name="city">
                                        {{-- <option value="">Select Location</option> --}}

                                        @php
                                            $uniqueCities = [];
                                        @endphp

                                        @if ($filters_data)
                                            @foreach ($filters_data as $car)
                                                @php
                                                    $city = $car->city ?? '';
                                                    if (!in_array($city, $uniqueCities)) {
                                                        $uniqueCities[] = $city;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif

                                        @foreach ($uniqueCities as $city)
                                            <option value="{{ $city }}" {{!empty(request()->get("city")) && request()->get("city") == $city ? "data-state=selected" : "data-state=unselected"}} {{!empty(request()->get("city")) && request()->get("city") == $city ? "selected" : ""}}>{{ $city }}</option>
                                        @endforeach

                                    </select>
                                    <button class="updateBtn">update</button>
                                </div>
                            </div>

                            <!-- Car Brand / Model -->
                            <div id="carBrand" class="custom_collapse"
                                 @if (isset($_GET['brand']) && !empty($_GET['brand'])) style="height: 240px;" @endif>
                                <button type="button" onclick="onOpenCollapse('carBrand')">
                                    <span> Car Brand / Model </span>
                                    <i id="carBrand-arrow" class="fa fa-angle-down"></i>
                                </button>
                                <form method="GET" action="{{ route(Route::currentRouteName(), $params) }}">
                                    <div id="carBrand-content" class="collapse_content">
                                        <div>
                                            <input type="hidden" id="language" value="english">
                                            <input type="hidden" id="css" value=""> 
                                            <label title="">Car Brand</label> 
                                            <span id="show_before4"> 
                                                <select class="form-control" name="brand" id="carmake">
                                                    <option value="">Select Car Make</option>
                                                    @php
                                                        $brandCounts = [];
                                                    @endphp
                                                    @if (!empty($filters_data))
                                                        @foreach ($filters_data as $car)
                                                            @php
                                                                $brandName = $car->get_brand_name->brand_name ?? '';

                                                                if (isset($brandCounts[$brandName])) {
                                                                    $brandCounts[$brandName]++;
                                                                }
                                                                $brandCounts[$brandName] = 1;
                                                            @endphp
                                                        @endforeach
                                                    @endif

                                                    @if (!empty($brandCounts))
                                                        @foreach ($brandCounts as $brandName => $count)
                                                            @php
                                                                $brandId = '';
                                                                foreach ($filters_data as $car) {
                                                                    if ( $car->get_brand_name->brand_name === $brandName ) {
                                                                        $brandId = $car->brand_id;
                                                                        break;
                                                                    }
                                                                }
                                                            @endphp
                                                            <option value="{{ $brandId }}" {{!empty(request()->get("brand")) && request()->get("brand") == $brandId ? "data-state=selected" : "data-state=unselected"}} {{!empty(request()->get("brand")) && request()->get("brand") == $brandId ? "selected" : ""}}> {{ $brandName }} ({{ $count }}) </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </span>
                                        </div>
                                        <span id="show_heading" class="bodrdis" style="display: inline;">
                                            <label class="mt-3" title="">Car Model</label>
                                            <div id="show_sub_categories" style="color: black; display: block;">
                                                <select class="form-control" name="carmodel" id="carmodel2">
                                                    <option value="0" selected="selected">Select Car Model</option>
                                                </select>
                                            </div>
                                        </span>
                                        <button class="updateBtn">update</button>
                                    </div>
                                </form>


                            </div>

                            <!-- Model Year -->
                            <div id="modelYear" class="custom_collapse"
                                 @if (isset($_GET['year']) && !empty($_GET['year'])) style="height: 118px;" @endif>
                                <button type="button" onclick="onOpenCollapse('modelYear')">
                                    <span> Model Year </span>
                                    <i id="modelYear-arrow" class="fa fa-angle-down"></i>
                                </button>
                                <div id="modelYear-content" class="collapse_content">
                                    <select class="form-control" name="year" id="year2">
                                        <option value="" selected="selected">Select</option>
                                    </select>
                                    <button class="updateBtn">update</button>
                                </div>
                            </div>

                            <!-- No. of Seats -->
                            <div id="seats" class="custom_collapse"
                                 @if (isset($_GET['passengers']) && !empty($_GET['passengers'])) style="height: 188px;" @endif>
                                <button type="button" onclick="onOpenCollapse('seats')">
                                    <span> No. of Seats </span>
                                    <i id="seats-arrow" class="fa fa-angle-down"></i>
                                </button>
                                <div id="seats-content" class="collapse_content">
                                    <div class="form-check">
                                        <div class="checkboxInput">
                                            <input type="checkbox" value="1-2" id="flexCheckChecked" name="passengers[]" {{ !empty(request()->get('passengers')) && in_array("1-2", request()->get('passengers')) ? "data-state=checked" : "data-state=unchecked" }} {{ !empty(request()->get('passengers')) && in_array("1-2", request()->get('passengers')) ? "checked" : "" }} >
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            1-2 Seats
                                        </label>
                                        <button class="updateBtn">update</button>
                                    </div>
                                    <div class="form-check">
                                        <div class="checkboxInput">
                                            <input type="checkbox" value="4-5" id="flexCheckChecked2" name="passengers[]" {{ !empty(request()->get('passengers')) && in_array("4-5", request()->get('passengers')) ? "data-state=checked" : "data-state=unchecked" }} {{ !empty(request()->get('passengers')) && in_array("4-5", request()->get('passengers')) ? "checked" : "" }} >
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <label class="form-check-label" for="flexCheckChecked2">
                                            4-5 Seats
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <div class="checkboxInput">
                                            <input type="checkbox" value="6-7" id="flexCheckChecked3" name="passengers[]" {{ !empty(request()->get('passengers')) && in_array("6-7", request()->get('passengers')) ? "data-state=checked" : "data-state=unchecked" }}  {{ !empty(request()->get('passengers')) && in_array("6-7", request()->get('passengers')) ? "checked" : "" }} >
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <label class="form-check-label" for="flexCheckChecked3">6-7 Seats</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Vehicle Type -->
                            
                            <!-- <div id="vehicleType" class="custom_collapse"
                                 @if (isset($_GET['category']) && !empty($_GET['category'])) style="height: 260px;" @endif>
                                <button type="button" onclick="onOpenCollapse('vehicleType')">
                                    <span> Vehicle Type </span>
                                    <i id="vehicleType-arrow" class="fa fa-angle-down"></i>
                                </button>
                                <div id="vehicleType-content" class="collapse_content checkboxCollapse">
                                    @php
                                        $categories = [];

                                        if (!empty($filters_data)) {
                                            foreach ($filters_data as $car) {
                                                $category = $car->category;
                                                if (isset($categories[$category])) {
                                                    $categories[$category]++;
                                                } else {
                                                    $categories[$category] = 1;
                                                }
                                            }
                                        }

                                        // Filter the unique categories
                                        $uniqueCategories = array_keys($categories);
                                    @endphp

                                    @php
                                        $checked = '';
                                        $count = 0;
                                    @endphp

                                    @if (!empty($uniqueCategories))
                                        @foreach ($uniqueCategories as $category)
                                            <div class="form-check">
                                                <div class="checkboxInput">
                                                    <input class="" type="checkbox" name="category[]" value="{{ $category }}" id="{{ $category }}" {{ !empty(request()->get('category')) && in_array($category, request()->get('category')) ? "data-state=checked" : "data-state=unchecked" }} {{ !empty(request()->get('category')) && in_array($category, request()->get('category')) ? "checked" : "" }}>
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <label class="form-check-label" for="{{ $category }}">
                                                    {{ $category }} ({{ $categories[$category] }})
                                                </label>
                                                @if ($count == 0)
                                                    <button class="updateBtn">update</button>
                                                @endif
                                                @php
                                                    $count++;
                                                @endphp
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div> -->

                            <!-- Price Range -->
                            <div id="priceRange" class="custom_collapse"
                                 @if (
                                     (isset($_GET['min_price']) && !empty($_GET['min_price'])) ||
                                         (isset($_GET['max_price']) && !empty($_GET['max_price']))) style="height: 164px;" @endif>
                                <button type="button" onclick="onOpenCollapse('priceRange')">
                                    <span> Price Range </span>
                                    <i id="priceRange-arrow" class="fa fa-angle-down"></i>
                                </button>
                                <div id="priceRange-content" class="collapse_content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="day" class="form-label f_12">Minimum Budget</label>
                                                <input type="number" name="min_price" class="form-control"
                                                       id="day" min="0"
                                                       @if (isset($_GET['min_price']) && !empty($_GET['min_price'])) value="{{ $_GET['min_price'] }}" @endif>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="month" class="form-label f_12">Maximum Budget</label>
                                                <input type="number" name="max_price" class="form-control" id="month" min="0" @if (isset($_GET['max_price']) && !empty($_GET['max_price'])) value="{{ $_GET['max_price'] }}" @endif>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="updateBtn" style="display:block">update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rental Period -->
                            <div id="rentalPeriod" class="custom_collapse"
                                 @if (isset($_GET['min_days_booking']) && !empty($_GET['min_days_booking'])) style="height: 118px;" @endif>
                                <button type="button" onclick="onOpenCollapse('rentalPeriod')">
                                    <span> Rental Period </span>
                                    <i id="rentalPeriod-arrow" class="fa fa-angle-down"></i>
                                </button>
                                @php
                                    $rental_periods = [
                                        "Select rental period",
                                        "1 day",
                                        "2 day",
                                        "3 day",
                                        "4 day",
                                        "5 day",
                                        "6 day",
                                        "7+ day",
                                        "30" => "30 day",
                                    ];
                                @endphp
                                <div id="rentalPeriod-content" class="collapse_content">
                                    <select class="form-control" id="min_days_booking2" name="min_days_booking">
                                        @foreach ($rental_periods as $index => $rental_period)
                                            @if ($index === 0)
                                                <option value="0" {{empty(request()->get("min_days_booking")) ? "data-state=selected" : "data-state=unselected"}} >Select rental period</option>
                                            @else
                                                <option value="{{$index}}" {{!empty(request()->get("min_days_booking")) && request()->get("min_days_booking") == $index ? "data-state=selected" : "data-state=unselected"}} {{!empty(request()->get("min_days_booking")) && request()->get("min_days_booking") == $index ? "selected" : ""}}>{{$rental_period}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <button class="updateBtn">update</button>
                                </div>
                            </div>

                            <!-- Car Features -->
                            <div id="carFeatures" class="custom_collapse"
                                 @if (isset($_GET['car_features']) && !empty($_GET['car_features'])) style="height: 1412px;" @endif>
                                <button type="button" onclick="onOpenCollapse('carFeatures')">
                                    <span> Car Features </span>
                                    <i id="carFeatures-arrow" class="fa fa-angle-down"></i>
                                </button>
                                <div id="carFeatures-content" class="collapse_content">

                                    @if (!empty($filters_data))
                                        @foreach ($filters_data->unique('car_features') as $fetaures)
                                            @php
                                                $car_features = explode(',', $fetaures->car_features);
                                            @endphp
                                        @endforeach
                                    @endif

                                    @php
                                        $checked = '';
                                        $count = 0;
                                    @endphp

                                    @if (!empty($car_features))
                                        @foreach ($car_features as $feature)
                                            @if (isset($_GET['car_features']) && !empty($_GET['car_features']))
                                                @php
                                                    $arrayToCheck = $_GET['car_features'];
                                                    $checked = '';
                                                    if (in_array($feature, $arrayToCheck)) {
                                                        $checked = 'checked';
                                                    }
                                                @endphp
                                            @endif

                                            <div class="form-check">
                                                <div class="checkboxInput">
                                                    <input class="" name="car_features[]" type="checkbox" value="{{ $feature }}" id="checkbox" {{ !empty(request()->get('car_features')) && in_array($feature, request()->get('car_features')) ? "data-state=checked" : "data-state=unchecked" }} {{ !empty(request()->get('car_features')) && in_array($feature, request()->get('car_features')) ? "checked" : "" }}>
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <label class="form-check-label" for="{{ $feature }}">
                                                    {{ $feature }}
                                                </label>
                                                @if ($count == 0)
                                                    <button class="updateBtn">update</button>
                                                @endif
                                                @php
                                                    $count++;
                                                @endphp
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <!-- Payment Mode -->
                        {{-- <div id="paymentMode" class="custom_collapse">
                            <button type="button" onclick="onOpenCollapse('paymentMode')">
                                <span> Payment Mode </span>
                                <i id="paymentMode-arrow" class="fa fa-angle-down"></i>
                            </button>
                            <div id="paymentMode-content" class="collapse_content">
                                <div class="form-check">
                                    <input class="form-check-input" name="payment_method[]" type="checkbox"
                                        value="Credit Card" id="Credit_Card">
                                    <label class="form-check-label" for="Credit_Card">
                                        Credit Card
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="payment_method[]" type="checkbox"
                                        value="Debit Card" id="Debit_Card">
                                    <label class="form-check-label" for="Debit_Card">
                                        Debit Card
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="payment_method[]" type="checkbox"
                                        value="Cash" id="cash">
                                    <label class="form-check-label" for="cash">
                                        Cash
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="payment_method[]" type="checkbox"
                                        value="Bitcoin/Crypto" id="Bitcoin/Crypto">
                                    <label class="form-check-label" for="Bitcoin/Crypto">
                                        Bitcoin/Crypto
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Transmission -->
                            <div id="transmission" class="custom_collapse"
                                 @if (isset($_GET['transmission']) && !empty($_GET['transmission'])) style="height: 152px;" @endif>
                                <button type="button" onclick="onOpenCollapse('transmission')">
                                    <span> Transmission </span>
                                    <i id="transmission-arrow" class="fa fa-angle-down"></i>
                                </button>
                                <div id="transmission-content" class="collapse_content">
                                    @php
                                        $transmissionCounts = [];

                                        if (!empty($filters_data)) {
                                            foreach ($filters_data as $car) {
                                                $transmission = $car->transmission;
                                                if (isset($transmissionCounts[$transmission])) {
                                                    $transmissionCounts[$transmission]++;
                                                } else {
                                                    $transmissionCounts[$transmission] = 1;
                                                }
                                            }
                                        }

                                    @endphp

                                    @php
                                        $checked = '';
                                    @endphp
                                    @if (!empty($transmissionCounts))
                                        @foreach ($transmissionCounts as $transmission => $count)
                                            <div class="form-check">
                                                <div class="checkboxInput">
                                                    <input type="checkbox" name="transmission[]" value="{{ $transmission }}" id="{{ $transmission }}" {{ !empty(request()->get('transmission')) && in_array($transmission, request()->get('transmission')) ? "data-state=checked" : "data-state=unchecked" }} {{ !empty(request()->get('transmission')) && in_array($transmission, request()->get('transmission')) ? "checked" : "" }}>
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <label class="form-check-label" for="{{ $transmission }}">
                                                    {{ $transmission }} ({{ $count }})
                                                </label>
                                                <button class="updateBtn">update</button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Fuel Type -->
                            <div id="fuelType" class="custom_collapse"
                                 @if (isset($_GET['fuel_type']) && !empty($_GET['fuel_type'])) style="height: 188px;" @endif>
                                <button type="button" onclick="onOpenCollapse('fuelType')">
                                    <span> Fuel Type </span>
                                    <i id="fuelType-arrow" class="fa fa-angle-down"></i>
                                </button>
                                <div id="fuelType-content" class="collapse_content">
                                    @php
                                        $fuelTypeCounts = [];

                                        if (!empty($filters_data)) {
                                            foreach ($filters_data as $car) {
                                                $fuelType = $car->fuel_type;
                                                if (isset($fuelTypeCounts[$fuelType])) {
                                                    $fuelTypeCounts[$fuelType]++;
                                                } else {
                                                    $fuelTypeCounts[$fuelType] = 1;
                                                }
                                            }
                                        }

                                    @endphp
                                    @php
                                        $fuelType_count = 0;
                                    @endphp
                                    @if (!empty($fuelTypeCounts))
                                        @foreach ($fuelTypeCounts as $fuelType => $count)
                                            <div class="form-check">
                                                <div class="checkboxInput">
                                                    <input type="checkbox" name="fuel_type[]" value="{{ $fuelType }}" id="{{ $fuelType }}" {{ $checked }} {{ !empty(request()->get('fuel_type')) && in_array($fuelType, request()->get('fuel_type')) ? "data-state=checked" : "data-state=unchecked" }} {{ !empty(request()->get('fuel_type')) && in_array($fuelType, request()->get('fuel_type')) ? "checked" : "" }}>
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <label class="form-check-label" for="{{ $fuelType }}">
                                                    {{ $fuelType }}
                                                </label>
                                                @if ($fuelType_count == 0)
                                                    <button class="updateBtn">update</button>
                                                @endif
                                                @php
                                                    $fuelType_count++;
                                                @endphp
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Car Colors -->
                            <div id="carColors" class="custom_collapse"
                                 @if (isset($_GET['car_colors']) && !empty($_GET['car_colors']))  style="height: 548px;" @endif>
                                <button type="button" onclick="onOpenCollapse('carColors')">
                                    <span> Car Colors </span>
                                    <i id="carColors-arrow" class="fa fa-angle-down"></i>
                                </button>
                                <div id="carColors-content" class="collapse_content">
                                    @php
                                        $colorCounts = [];

                                        if (!empty($filters_data)) {
                                            foreach ($filters_data as $car) {
                                                $colors = explode(',', $car->car_colors);

                                                foreach ($colors as $color) {
                                                    $color = trim($color); // Trim any leading/trailing spaces
                                                    if (isset($colorCounts[$color])) {
                                                        $colorCounts[$color]++;
                                                    } else {
                                                        $colorCounts[$color] = 1;
                                                    }
                                                }
                                            }
                                        }

                                    @endphp
                                    @php
                                        $color_count = 0;
                                    @endphp
                                    @if (!empty($colorCounts))
                                        @foreach ($colorCounts as $color => $count)
                                            <div class="form-check">
                                                <div class="checkboxInput">
                                                    <input name="car_colors[]" type="checkbox" {{ !empty(request()->get('car_colors')) && in_array($color, request()->get('car_colors')) ? "data-state=checked" : "data-state=unchecked" }} value="{{ $color }}" id="{{ $color }}" {{ !empty(request()->get('car_colors')) && in_array($color, request()->get('car_colors')) ? "checked" : "" }}>
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <label class="form-check-label" for="{{ $color }}">
                                                    {{ $color }}
                                                </label>
                                                @if ($color_count == 0)
                                                    <button class="updateBtn">update</button>
                                                    @php
                                                        $color_count++;
                                                    @endphp
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <!-- Minimum Required Age -->
                            {{-- <div id="minRequiredAge" class="custom_collapse">
                            <button type="button" onclick="onOpenCollapse('minRequiredAge')">
                                <span> Minimum Required Age </span>
                                <i id="minRequiredAge-arrow" class="fa fa-angle-down"></i>
                            </button>
                            <div id="minRequiredAge-content" class="collapse_content">
                                <select class="form-control" id="min_required_age2" name="min_required_age">
                                    <option value="0">Select Minimum Age</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25+</option>
                                </select>
                            </div>
                        </div> --}}
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between w-100 btnCont">
                        @php
                            $currenturl = url()->full();
                        @endphp
                        @if ($currenturl != 'https://onetapdrive.com/services')
                            <a href="{{ route('clear-filters') }}" class="themeBtn">
                                Clear Filters
                            </a>
                        @endif
                        <button class="themeBtn">Show Result</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="container-fluid">
            <div class="contentArea">
                <div class="row carRow">
                    <div class="col-12">
                            <h2 class="secHeading">{{ \App\Helpers\Helper::getCategoryTitleBySlug() }}</h2>                       
                        <p>
                            {{ \App\Helpers\Helper::getCategoryDescriptionBySlug()}}
                        </p>
                    </div>
                    <div class="col-9">
                        <div class="filterTags">
                            @if(!empty($appliedFilters))
                                <a href="{{route('rent-a-car-dubai')}}">
                                    <button class="filterTag all">
                                        Clear all filters
                                        <i class="fas fa-times"></i>
                                    </button>
                                </a>
                            @endif
                            @foreach($appliedFilters as $filterName => $filterValue)
                                @php
                                    // Get the current query parameters except the current filter
                                    $queryParams = request()->except($filterName);
                            
                                    // Ensure the required 'brand' parameter is included in the route
                                    $urlWithoutFilter = route(request()->route()->getName(), array_merge($params, $queryParams));
                                @endphp
                            
                                <a href="{{ $urlWithoutFilter }}">
                                    <button class="filterTag">
                                        {{ is_array($filterValue) ? implode(', ', array_map(fn($value) => \Illuminate\Support\Str::ucfirst($value), $filterValue)) : \Illuminate\Support\Str::ucfirst($filterValue) }}
                                        <i class="fas fa-times"></i>
                                    </button>
                                </a>
                            @endforeach
                        
                        </div>
                    </div>
                    <div class="col-3">
                        <form id="filterForm" method="GET" action="{{ route(Route::currentRouteName(), $params) }}">
                        <div class="inputCont sort">
                            <select autocomplete="off" name="sort" id="sortSelect">
                                <option {{ request()->get('sort') == "featured" ? "selected" : "" }}value="featured">Sort: Featured</option>
                                <option {{ request()->get('sort') == "daily_low_to_high" ? "selected" : "" }} value="daily_low_to_high">Daily (low to high)</option>
                                <option {{ request()->get('sort') == "daily_high_to_low" ? "selected" : "" }} value="daily_high_to_low">Daily (high to low)</option>
                                <option {{ request()->get('sort') == "weekly_low_to_high" ? "selected" : "" }} value="weekly_low_to_high">Weekly (low to high)</option>
                                <option {{ request()->get('sort') == "monthly_low_to_high" ? "selected" : "" }} value="monthly_low_to_high">Monthly (low to high)</option>
                                <option {{ request()->get('sort') == "passengers_low_to_high" ? "selected" : "" }} value="passengers_low_to_high">Passengers (low to high)</option>
                                <option {{ request()->get('sort') == "passengers_high_to_low" ? "selected" : "" }} value="passengers_high_to_low">Passengers (high to low)</option>
                            </select>
                        </div>
                        </form>
                    </div>
                    @if (count($cars) > 0)
                        @foreach ($cars as $key => $value)
                            <div class="col-lg-12 col-sm-6">
                                {{-- dd{{$value}} --}}
                                <div class="carCard fullCard serviceCard">
                                    <a class="imgCont"
                                       href="{{ route('car-details', ['slug' => $value->slug]) }}">
                                        <img
                                            src="{{ asset('images/') }}/{{ $value->get_images[0]->images }}"
                                            alt=""/>
                                    </a>
                                    <div class="favCont">
                                        @if (!empty($value->is_admin_approve == 1))
                                            <button>
                                                <i class="fa fa-check fs_13"></i> Verified
                                            </button>
                                        @endif
                                        @if ($value->is_featured == 1)
                                            <button class="featured">
                                                <i class="fa fa-star fs_13 mb-1 text-light"></i> Featured
                                            </button>
                                        @endif
                                        @if ($value->is_featured == 2)
                                            <button class="premium">
                                                <i class="fa fa-star fs_13 mb-1 text-light"></i> Premium
                                            </button>
                                        @endif
                                    </div>
                                    <div class="wishlistCont">
                                        @if (Auth::check())
                                            @php
                                                $wishlistProduct = Auth::user()
                                                    ->wishlist()
                                                    ->where('product_id', $value->id)
                                                    ->first();
                                            @endphp
                                            @if ($wishlistProduct)
                                                <button class="themeBtn wishlist-button"
                                                        data-product-id="{{ $value->id }}">
                                                    <i class="fa fa-heart red_heart"></i>
                                                </button>
                                            @else
                                                <button class="themeBtn wishlist-button"
                                                        data-product-id="{{ $value->id }}">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            @endif
                                        @else
                                            <button class="themeBtn wishlist-button"
                                                    data-product-id="{{ $value->id }}">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                        @endif
                                    </div>
                                    <a href="{{ route('car-details', ['slug' => $value->slug]) }}"
                                       class="contentWrap">
                                        <div class="content">
                                            <h2 class="title">{{ $value->get_brand_name->brand_name ?? '' }}
                                                {{ $value->model_name ?? '' }} {{ $value->make_year ?? '' }}</h2>
                                            <div class="tags">
                                            <span
                                                class="properties_border">{{ $value->category ?? '' }}</span>
                                                <span class="properties_border">{{ $value->car_doors ?? '' }}
                                                                <svg stroke="currentColor"
                                                                     fill="currentColor" stroke-width="0"
                                                                     viewBox="0 0 512 512" height="1em"
                                                                     width="1em"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M149.6 41L42.88 254.4c23.8 24.3 53.54 58.8 78.42 97.4 24.5 38.1 44.1 79.7 47.1 119.2h270.3L423.3 41H149.6zM164 64h230l8 192H74l90-192zm86.8 17.99l-141 154.81L339.3 81.99h-88.5zM336 279h64v18h-64v-18z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                <span class="properties_border">{{ $value->passengers ?? '' }}
                                                                <svg stroke="currentColor"
                                                                     fill="currentColor" stroke-width="0"
                                                                     viewBox="0 0 24 24" height="1em"
                                                                     width="1em"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill="none"
                                                                          d="M0 0h24v24H0V0z"></path>
                                                                    <path
                                                                        d="M15 5v7H9V5h6m0-2H9c-1.1 0-2 .9-2 2v9h10V5c0-1.1-.9-2-2-2zm7 7h-3v3h3v-3zM5 10H2v3h3v-3zm15 5H4v6h2v-4h12v4h2v-6z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                <span class="properties_border">{{ $value->bags ?? '' }}
                                                                <svg stroke="currentColor"
                                                                     fill="currentColor" stroke-width="0"
                                                                     viewBox="0 0 24 24" height="1em"
                                                                     width="1em"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill="none"
                                                                          d="M0 0h24v24H0z"></path>
                                                                    <path
                                                                        d="M17 6h-2V3c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v3H7c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2 0 .55.45 1 1 1s1-.45 1-1h6c0 .55.45 1 1 1s1-.45 1-1c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM9.5 18H8V9h1.5v9zm3.25 0h-1.5V9h1.5v9zm.75-12h-3V3.5h3V6zM16 18h-1.5V9H16v9z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                            </div>
                                            <div class="rent_details">

                                                @php
                                                    $minMileage = null;
                                                @endphp
                                                @foreach ($value->get_mileage as $mileage)
                                                    @php
                                                        $mileageValues = [
                                                            $mileage->one_month,
                                                            $mileage->three_months,
                                                            $mileage->six_months,
                                                            $mileage->nine_months,
                                                            $mileage->twelve_months,
                                                        ];
                                                        $nonNullMileageValues = array_filter(
                                                            $mileageValues,
                                                            fn($v) => !is_null($v),
                                                        );

                                                        if (!empty($nonNullMileageValues)) {
                                                            $currentMinMileage = min($nonNullMileageValues);
                                                            if ($minMileage === null || $currentMinMileage < $minMileage) {
                                                                $minMileage = $currentMinMileage;
                                                            }
                                                        }
                                                    @endphp
                                                @endforeach

                                                @if ($minMileage !== null)
                                                    <p class="price">
                                                        <span class="colored">
                                                            AED {{ $minMileage }} / Month
                                                        </span>
                                                    </p>
                                                @else
                                                    <p class="price">
                                                        <span class="colored">
                                                            AED {{ $value->weekly_rent }} / Week
                                                        </span>
                                                    </p>
                                                    <p class="price duration">
                                                        <i class="fa fa-road"></i>
                                                        <span>{{ $value->weekly_mileage }} km</span>
                                                    </p>
                                                @endif

                                            </div>
                                            <div class="other_details">
                                                <div class="right_details_area">
                                                    @if (!empty($value->delivery_days))
                                                        <p>
                                                            <span><i class="fa fa-check"></i></span>
                                                            Delivery :
                                                            {{ $value->delivery_days }}
                                                        </p>
                                                    @endif
                                                    @if ($value->daily_availablity == 'Yes')
                                                        <p>
                                                            <span><i class="fa fa-check"></i></span> 1 day
                                                            rental
                                                            available
                                                        </p>
                                                    @endif

                                                    @if ($value->insurance_per_day)
                                                        <p>
                                                            <span><i class="fa fa-check"></i></span>
                                                            Insurance
                                                            included
                                                        </p>
                                                    @endif


                                                    {{-- <p>
                                                            <span><i class="fa fa-bitcoin"></i></span>Crypto payment accepted
                                                        </p> --}}
                                                    @if (!empty($value->security_deposit))
                                                        <p>
                                                            <span><i class="fa fa-info"></i></span>Security
                                                            Deposit : AED
                                                            {{ $value->security_deposit }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="left_details_area">
                                                <div class="customBadge"></div>
                                                <img
                                                    src="{{ asset('company_logo/') }}/{{ $value->get_user->company_logo ?? '' }}"
                                                    alt=""/>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="btnCont">
                                        <button class="themeBtn">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                        <button class="themeBtn whatsapp">
                                            <i class="fab fa-whatsapp"></i>
                                        </button>
                                        <button class="themeBtn enquiry carEnquiry">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <h1 class="text-center mt-5">No data Found</h1>
                        </div>
                    @endif

                    <div class="col-12">
                        <div class="text-center  mb-3">
                            Showing {{ $cars->firstItem() }} to {{ $cars->lastItem() }}
                            of total {{ $cars->total() }} Cars
                        </div>
                        <div class="paginationCont">
                            {{ $cars->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>