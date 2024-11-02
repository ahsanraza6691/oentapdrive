@extends('admin_dashboard.layouts.master')

@section('content')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<style>
    .sidebar-submenu {
        transition: all 0.3s ease;
        overflow: hidden;
    }
</style>

@endsection
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 style="text-align: center">Welcome To Admin Dashboard</h1>
        </div>
    </div>
</div>
<br><br>

<div class="container-fluid">
	<div class="row second-chart-list third-news-update">
		

        <div class="container-fluid">
            <div class="row">
				<div class="col-sm-6 col-xl-3 col-lg-6">
					<div class="card o-hidden">
					  <div class="bg-secondary b-r-4 card-body">
						<div class="media static-top-widget">
						  <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
						  <div class="media-body"><span class="m-0">Vendors</span>
							@if($vendors_count > 0)
								<h4 class="mb-0 counter">{{$vendors_count ?? ''}}</h4><i class="icon-bg" data-feather="user-plus"></i>
							@else
								 <h4 class="mb-0 counter">0</h4><i class="icon-bg" data-feather="user-plus"></i>
							@endif
						  </div>
						</div>
					  </div>
					</div>
				  </div>

              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i class="fa fa-car fa-lg" aria-hidden="true"></i></div>
                      <div class="media-body"><span class="m-0">Cars Listed</span>
                        @if($product_count > 0)
                            <h4 class="mb-0 counter">{{$product_count ?? ''}}</h4>
                        @else
                            <h4 class="mb-0 counter">0</h4>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>

			  <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i class="fa fa-car fa-lg" aria-hidden="true"></i></div>
                      <div class="media-body"><span class="m-0">Car With Driver Listed</span>
                        @if($car_driver_count > 0)
                            <h4 class="mb-0 counter">{{$car_driver_count ?? ''}}</h4>
                        @else
                            <h4 class="mb-0 counter">0</h4>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i class="fa fa-file-text-o fa-lg" aria-hidden="false"></i></div>
                      <div class="media-body"><span class="m-0">Leads Received</span>
                        @if($leads_count > 0)
                            <h4 class="mb-0 counter">{{$leads_count ?? ''}}</h4>
                        @else
                            <h4 class="mb-0 counter">0</h4>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                      <div class="media-body"><span class="m-0">Inquiries</span>
                        @if($car_booking_count > 0)
                            <h4 class="mb-0 counter">{{$car_booking_count ?? ''}}</h4>
                        @else
                            <h4 class="mb-0 counter">0</h4>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Users</span>
                        @if($user_count > 0)
                            <h4 class="mb-0 counter">{{$user_count ?? ''}}</h4><i class="icon-bg" data-feather="user-plus"></i>
                        @else
                             <h4 class="mb-0 counter">0</h4><i class="icon-bg" data-feather="user-plus"></i>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
    	</div>


		{{-- <div class="col-xl-3 xl-50 chart_data_right box-col-12">
			<div class="card">
				<div class="card-body">
					<div class="media align-items-center">
						<div class="media-body right-chart-content">
							<h4>$95,900<span class="new-box">Hot</span></h4>
							<span>Purchase Order Value</span>
						</div>
						<div class="knob-block text-center">
							<input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#7366ff" data-bgcolor="#eef5fb" value="60">
						</div>
					</div>
				</div>
			</div>
		</div> --}}
		{{-- <div class="col-xl-3 xl-50 chart_data_right second d-none">
			<div class="card">
				<div class="card-body">
					<div class="media align-items-center">
						<div class="media-body right-chart-content">
							<h4>$95,000<span class="new-box">New</span></h4>
							<span>Product Order Value</span>
						</div>
						<div class="knob-block text-center">
							<input class="knob1" data-width="50" data-height="70" data-thickness=".3" data-fgcolor="#7366ff" data-linecap="round" data-angleoffset="0" value="60">
						</div>
					</div>
				</div>
			</div>
		</div> --}}
		{{-- <div class="col-xl-4 xl-50 news box-col-6">
			<div class="card">
				<div class="card-header">
					<div class="header-top">
						<h5 class="m-0">News & Update</h5>
						<div class="card-header-right-icon">
							<select class="button btn btn-primary">
								<option>Today</option>
								<option>Tomorrow</option>
								<option>Yesterday</option>
							</select>
						</div>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="news-update">
						<h6>36% off For pixel lights Couslations Types.</h6>
						<span>Lorem Ipsum is simply dummy...</span>
					</div>
					<div class="news-update">
						<h6>We are produce new product this</h6>
						<span> Lorem Ipsum is simply text of the printing... </span>
					</div>
					<div class="news-update">
						<h6>50% off For COVID Couslations Types.</h6>
						<span>Lorem Ipsum is simply dummy...</span>
					</div>
				</div>
				<div class="card-footer">
					<div class="bottom-btn"><a href="#">More...</a></div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 xl-50 appointment-sec box-col-6">
			<div class="row">
				<div class="col-xl-12 appointment">
					<div class="card">
						<div class="card-header card-no-border">
							<div class="header-top">
								<h5 class="m-0">appointment</h5>
								<div class="card-header-right-icon">
									<select class="button btn btn-primary">
										<option>Today</option>
										<option>Tomorrow</option>
										<option>Yesterday</option>
									</select>
								</div>
							</div>
						</div>
						<div class="card-body pt-0">
							<div class="appointment-table table-responsive">
								<table class="table table-bordernone">
									<tbody>
										<tr>
											<td>
												<img class="img-fluid img-40 rounded-circle mb-3" src="{{asset('assets/images/appointment/app-ent.jpg')}}" alt="Image description">
												<div class="status-circle bg-primary"></div>
											</td>
											<td class="img-content-box"><span class="d-block">Venter Loren</span><span class="font-roboto">Now</span></td>
											<td>
												<p class="m-0 font-primary">28 Sept</p>
											</td>
											<td class="text-end">
												<div class="button btn btn-primary">Done<i class="fa fa-check-circle ms-2"></i></div>
											</td>
										</tr>
										<tr>
											<td>
												<img class="img-fluid img-40 rounded-circle" src="{{asset('assets/images/appointment/app-ent.jpg')}}" alt="Image description">
												<div class="status-circle bg-primary"></div>
											</td>
											<td class="img-content-box"><span class="d-block">John Loren</span><span class="font-roboto">11:00</span></td>
											<td>
												<p class="m-0 font-primary">22 Sept</p>
											</td>
											<td class="text-end">
												<div class="button btn btn-danger">Pending<i class="fa fa-check-circle ms-2"></i></div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-12 alert-sec">
					<div class="card bg-img">
						<div class="card-header">
							<div class="header-top">
								<h5 class="m-0">Alert  </h5>
								<div class="dot-right-icon"><i class="fa fa-ellipsis-h"></i></div>
							</div>
						</div>
						<div class="card-body">
							<div class="body-bottom">
								<h6>  10% off For drama lights Couslations...</h6>
								<span class="font-roboto">Lorem Ipsum is simply dummy...It is a long established fact that a reader will be distracted by  </span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 xl-50 notification box-col-6">
			<div class="card">
				<div class="card-header card-no-border">
					<div class="header-top">
						<h5 class="m-0">notification</h5>
						<div class="card-header-right-icon">
							<select class="button btn btn-primary">
								<option>Today</option>
								<option>Tomorrow</option>
								<option>Yesterday</option>
							</select>
						</div>
					</div>
				</div>
				<div class="card-body pt-0">
					<div class="media">
						<div class="media-body">
							<p>20-04-2020 <span>10:10</span></p>
							<h6>Updated Product<span class="dot-notification"></span></h6>
							<span>Quisque a consequat ante sit amet magna...</span>
						</div>
					</div>
					<div class="media">
						<div class="media-body">
							<p>20-04-2020<span class="ps-1">Today</span><span class="badge badge-secondary">New</span></p>
							<h6>Tello just like your product<span class="dot-notification"></span></h6>
							<span>Quisque a consequat ante sit amet magna... </span>
						</div>
					</div>
					<div class="media">
						<div class="media-body">
							<div class="d-flex mb-3">
								<div class="inner-img"><img class="img-fluid" src="{{asset('assets/images/notification/1.jpg')}}" alt="Product-1"></div>
								<div class="inner-img"><img class="img-fluid" src="{{asset('assets/images/notification/2.jpg')}}" alt="Product-2"></div>
							</div>
							<span class="mt-3">Quisque a consequat ante sit amet magna...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 xl-50 appointment box-col-6">
			<div class="card">
				<div class="card-header">
					<div class="header-top">
						<h5 class="m-0">Market Value</h5>
						<div class="card-header-right-icon">
							<select class="button btn btn-primary">
								<option>Year</option>
								<option>Month</option>
								<option>Day</option>
							</select>
						</div>
					</div>
				</div>
				<div class="card-Body">
					<div class="radar-chart">
						<div id="marketchart">       </div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 xl-100 chat-sec box-col-6">
			<div class="card chat-default">
				<div class="card-header card-no-border">
					<div class="media media-dashboard">
						<div class="media-body">
							<h5 class="mb-0">Live Chat</h5>
						</div>
						<div class="icon-box"><i class="fa fa-ellipsis-h"></i></div>
					</div>
				</div>
				<div class="card-body chat-box">
					<div class="chat">
						<div class="media left-side-chat">
							<div class="media-body d-flex">
								<div class="img-profile"> <img class="img-fluid" src="{{asset('assets/images/user.jpg')}}" alt="Profile"></div>
								<div class="main-chat">
									<div class="message-main"><span class="mb-0">Hi deo, Please send me link.</span></div>
									<div class="sub-message message-main"><span class="mb-0">Right Now</span></div>
								</div>
							</div>
							<p class="f-w-400">7:28 PM</p>
						</div>
						<div class="media right-side-chat">
							<p class="f-w-400">7:28 PM</p>
							<div class="media-body text-end">
								<div class="message-main pull-right">
									<span class="mb-0 text-start">How can do for you</span>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="media left-side-chat">
							<div class="media-body d-flex">
								<div class="img-profile"> <img class="img-fluid" src="{{asset('assets/images/user.jpg')}}" alt="Profile"></div>
								<div class="main-chat">
									<div class="sub-message message-main mt-0"><span>It's argenty</span></div>
								</div>
							</div>
							<p class="f-w-400">7:28 PM</p>
						</div>
						<div class="media right-side-chat">
							<div class="media-body text-end">
								<div class="message-main pull-right"><span class="loader-span mb-0 text-start" id="wave"><span class="dot"></span><span class="dot"></span><span class="dot"></span></span></div>
							</div>
						</div>
						<div class="input-group">
							<input class="form-control" id="mail" type="text" placeholder="Type Your Message..." name="text">
							<div class="send-msg"><i data-feather="send"></i></div>
						</div>
					</div>
				</div>
			</div>
		</div> --}}
		{{-- <div class="col-xl-6 col-lg-12 xl-50 calendar-sec box-col-12">
			<div class="card gradient-primary o-hidden">
				<div class="card-body">
					<div class="setting-dot">
						<div class="setting-bg-primary date-picker-setting position-set pull-right"><i class="fa fa-spin fa-cog"></i></div>
					</div>
					<div class="default-datepicker">
						<div class="datepicker-here" data-language="en"></div>
					</div>
					<span class="default-dots-stay overview-dots full-width-dots"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">                </span></span></span>
				</div>
			</div>
		</div> --}}
	{{-- </div> --}}

</div>


<script type="text/javascript">
	var session_layout = '{{ session()->get('layout') }}';
</script>

@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var isHomePage = "{{ Route::currentRouteName() }}" === 'home.index'; // Replace 'home.index' with your actual home route name
        var sidebarLink = document.getElementById("sidebar-link");
        var sidebarSubmenu = document.getElementById("sidebar-submenu");

        if (isHomePage) {
            sidebarSubmenu.style.display = 'block'; // Show the submenu on the home page
        }

        sidebarLink.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent the default action
            if (sidebarSubmenu.style.display === 'block') {
                sidebarSubmenu.style.display = 'none';
            } else {
                sidebarSubmenu.style.display = 'block';
            }
        });
    });
</script>


<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>

@endsection