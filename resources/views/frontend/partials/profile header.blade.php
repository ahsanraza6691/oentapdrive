@php
$view_count = App\Models\ViewCar::where('user_id', Auth::user()->id)->count();
$wishlist_count = App\Models\Wishlist::where('user_id', Auth::user()->id)->count();
$contact_count = App\Models\ContactedCar::where('user_id', Auth::user()->id)->count();
@endphp
<style>
    .profile_box.active {
    color: #f58220;
    border: 1px solid #f58220;
}
</style>
<div class="col-md-4 col-sm-6 mt-md-0 mt-3">
    <a href="{{ route('wishlist') }}">
        <div class="profile_box {{(request()->is('wishlist')) ? 'active' : '' }}">
            <div class="num_icon">
                <div class="num">
                    <h5>{{$wishlist_count ?? ''}}</h5>
                </div>
                <div class="icon">
                    <i class="fa-regular fa-heart"></i>
                </div>
            </div>
            <p class="text">
                Wishlist
            </p>
        </div>
    </a>
</div>
<div class="col-md-4 col-sm-6 mt-md-0 mt-3">
    <a href="{{ route('contacted') }}">
        <div class="profile_box {{(request()->is('contacted')) ? 'active' : '' }}">
            <div class="num_icon">
                <div class="num">
                    <h5>{{$contact_count ?? ''}}</h5>
                </div>
                <div class="icon">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
            </div>
            <p class="text">
                Contacted
            </p>
        </div>
    </a>
</div>
{{-- <div class="col-md-3 col-sm-6 mt-md-0 mt-3">
    <a href="{{ route('bookings') }}">
        <div class="profile_box {{(request()->is('bookings')) ? 'active' : '' }}">
            <div class="num_icon">
                <div class="num">
                    <h5>1</h5>
                </div>
                <div class="icon">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
            </div>
            <p class="text">
                Bookings
            </p>
        </div>
    </a>
</div> --}}
<div class="col-md-4 col-sm-6 mt-md-0 mt-3">
    <a href="{{ route('viewed-cars') }}">
        <div class="profile_box {{(request()->is('viewed-cars')) ? 'active' : '' }}">
            <div class="num_icon">
                <div class="num">
                    <h5>{{$view_count ?? ''}}</h5>
                </div>
                <div class="icon">
                    <i class="fa-regular fa-eye"></i>
                </div>
            </div>
            <p class="text">
                Viewed Cars
            </p>
        </div>
    </a>
</div>
