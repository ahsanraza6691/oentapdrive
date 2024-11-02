<div class="col-md-3">
    <div class="profile-pic">

    </div>
    <div class="name">
        <h4>{{Auth::user()->name ?? ''}}</h4>
    </div>
    <ul class="prfile_nav">
        <li class="{{ (request()->is('my-profile')) ? 'active' : '' }}">
            <a href="{{ route('my-profile') }}">
                <div class="icon">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="nav_item">
                    <span>
                        My Profile
                    </span>
                </div>
            </a>
        </li>
        <!--<li class="{{ (request()->is('my-activities')) ? 'active' : '' }}">-->
        <!--    <a href="{{route('my-activities')}}">-->
        <!--        <div class="icon">-->
        <!--            <i class="fa-solid fa-car"></i>-->
        <!--        </div>-->
        <!--        <div class="nav_item">-->
        <!--            <span>-->
        <!--                My Activities-->
        <!--            </span>-->
        <!--        </div>-->
        <!--    </a>-->
        <!--</li>-->
        <li class="{{(request()->is('quick-guide')) ? 'active' : '' }}">
            <a href="{{route('quick-guide')}}">
                <div class="icon">
                    <i class="fa-solid fa-circle-question"></i>
                </div>
                <div class="nav_item">
                    <span>
                        Quick Guides
                    </span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('user-logout') }}">
                <div class="icon">
                    <i class="fa-solid fa-power-off"></i>
                </div>
                <div class="nav_item">
                    <span>
                        Logout
                    </span>
                </div>
            </a>
        </li>
    </ul>
</div>
