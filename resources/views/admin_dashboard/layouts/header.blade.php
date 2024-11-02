@php
  use Carbon\Carbon;
@endphp
<div class="page-header noPrint">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="mb-3 w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Search Cuba .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span
                                class="sr-only">Loading...</span></div>
                        <i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="{{ route('home') }}"><img class="img-fluid"
                        src="{{ asset('public/assets/images/logo.png') }}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
            </div>
        </div>
        <div class="left-header col horizontal-wrapper ps-0">
        </div>
        <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">
                {{-- notification --}}
                {{-- <li class="onhover-dropdown">
                  <div class="notification-box"><i data-feather="bell"> </i><span
                    class="badge rounded-pill badge-secondary">{{ count(order_notification()) > 0 ? count(order_notification()) : '' }}</span></div>
                    @if (count(order_notification()) > 0)
                    <ul class="notification-dropdown onhover-show-div">
                        <li><i data-feather="bell"></i>
                            <h6 class="f-18 mb-0">Notitications</h6>
                        </li>



                        @foreach (order_notification() as $order_notification)
                        @php
                          $dt = Carbon::create($order_notification->created_at);
                        @endphp
                        <li>
                          <p onclick="orderNotification('{{ $order_notification->order_id }}')"><i class="fa fa-circle-o me-3 font-success"></i>New Order #{{ $order_notification->order_id }}<span class="pull-right">{{ $dt->diffForHumans() }}</span></p>
                        </li>
                        @endforeach



                        <li><button class="btn btn-primary" id="viewAllOrderNotification">Check all notification</button></li>
                      </ul>
                      @endif
                      </li> --}}
                {{-- notification --}}
                <!--<li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i-->
                <!--            data-feather="maximize"></i></a></li>-->
                <li class="profile-nav onhover-dropdown p-0 me-0">
                    <div class="media profile-media">
                        <!--<img class="b-r-10" src="{{ asset('assets/images/dashboard/profile.jpg') }}" alt="">-->
                        <img class="b-r-10" width="40px" src="{{ asset('assets/images/logo-icon.png') }}" alt="">
                        <div class="media-body">
                            <span class="text-light">{{ ucfirst(Auth::user()->name) }}</span>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        {{-- <li><a href="#"><i data-feather="user"></i><span>Account </span></a></li> --}}
                        <li>
                            {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> --}}
                            {{-- <i data-feather="log-in"> </i> <span>{{ __('Logout') }}<span> --}}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                {{-- <li> --}}
                                <button class="btn btn-dark px-3 bg_dark border-0" type="submit">
                                    <i data-feather="log-out"> </i><span class="text-light">Log Out</span>
                                </button>
                                {{-- </li> --}}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">
      <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
      <div class="ProfileCard-details">
      <div class="ProfileCard-realName">@{{name}}</div>
      </div>
      </div>
    </script>
        <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
    </div>
</div>
