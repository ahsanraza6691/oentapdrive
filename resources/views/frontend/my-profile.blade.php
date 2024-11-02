@extends('frontend.layouts.header')
@section('title', 'Rent a Car Dubai | Home')
@section('content')
    <style>
        .edit_modal_icon i {
            font-size: 40px;
            color: #f58220;
        }

        .edit_modal_icon {
            text-align: center;
        }

        .edit_modal input[type=text] {
            height: 35px;
            padding: 12px;
        }

        .edit_modal .modal-footer {
            border: none;
            justify-content: center;
        }

        .styled_button.animate_width::before {
            background: #f76300;
        }

        .edit_modal .styled_button {
            background: #f58220;
        }
    </style>

    <section>
        <div class="content_wrap">
            <div class="row">

                @include('frontend.partials.profile-sidebar')
                <div class="col-md-9">

                    
                    @if (Session::has('error_message'))
                    <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
                        {{-- <strong>Error ! </strong> --}}
                        {{ Session::get('error_message') }}.
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                            data-bs-original-title="" title=""></button>
                    </div>
                @endif

                @if (Session::has('success_message'))
                    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                        {{-- <strong>Success ! </strong> --}}
                        {{ Session::get('success_message') }}.
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                            data-bs-original-title="" title=""></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                    <div class="row">


                        @include('frontend.partials.profile header')





                        <div class="col-12">
                            <p class="progress_text mt-4">
                                Your profile is {{ number_format($profileCompletion, 0) }} % completed
                            </p>
                            <div class="progress">
                                <div class="progress-bar progress_bg" role="progressbar"
                                    style="width: {{ number_format($profileCompletion, 0) }}%;"
                                    aria-valuenow="{{ number_format($profileCompletion, 0) }}" aria-valuemin="0"
                                    aria-valuemax="100">{{ number_format($profileCompletion, 0) }}%</div>
                            </div>
                            <div class="personal_data">
                                <div class="data-box">
                                    <label for="">Name</label>
                                    <div class="data-edit">
                                        <label for="">{{ Auth::user()->name ?? '' }}</label>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit_name_modal">Edit</a>
                                    </div>
                                </div>

                                <div class="data-box">
                                    <label for="">Email</label>
                                    <div class="data-edit">
                                        <label for="">{{ Auth::user()->email ?? '' }}</label>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit_email_modal">Edit</a>
                                    </div>
                                </div>
                                <div class="data-box">
                                    <label for="">Mobile no.</label>
                                    <div class="data-edit">
                                        <label for="">{{ Auth::user()->phone_number ?? '' }}</label>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit_phone_modal">Edit</a>
                                    </div>
                                </div>
                                <div class="data-box">
                                    <label for="">Date of birth</label>
                                    <div class="data-edit">
                                        <label for="">{{ Auth::user()->date_of_birth ?? '' }}</label>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit_dob_modal">Edit</a>
                                    </div>
                                </div>
                                <div class="data-box">
                                    <label for="">Nationality</label>
                                    <div class="data-edit">
                                        <label for="">{{ ucfirst(Auth::user()->nationality ?? '') }}</label>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#edit_nationality_modal">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- First and last name modal --}}
    <div class="modal fade" id="edit_name_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit_name_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered edit_modal">
            <form action="{{ route('update-profile') }}" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_name_modalLabel">Update Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12 my-3">
                                <div class="edit_modal_icon">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="first_name" id="first-name" placeholder="First Name" required
                                    value="{{ Auth::user()->first_name ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="last_name" id="last-name" placeholder="Last Name" required
                                    value="{{ Auth::user()->last_name ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mb-4">
                        <button type="submit" class="styled_button animate_width">Save</button>
                        <button type="button" class="styled_button animate_width"
                            data-bs-dismiss="modal">Cancel</button>

                    </div>
            </form>

        </div>
    </div>
    </div>

    {{-- Email Modal --}}
    <div class="modal fade" id="edit_email_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit_email_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered edit_modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_email_modalLabel">Update Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-12 my-3">
                                <div class="edit_modal_icon">
                                    <i class="fa-solid fa-envelope-open-text"></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="email" name="edit_email" class="form-control" id="edit_email"
                                    placeholder="Email Adress" value="{{ Auth::user()->email ?? '' }}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer mb-4">
                    <button type="button" class="styled_button animate_width">Send OTP</button>
                    <button type="button" class="styled_button animate_width" data-bs-dismiss="modal">Cancel</button>
                    <p class="text-center mt-2">Please check your Spam box in case you don’t receive our email in your
                        Inbox</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Phone Modal --}}
    <div class="modal fade" id="edit_phone_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit_phone_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered edit_modal">
            <form action="{{ route('update-profile') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_phone_modalLabel">Update Phone</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="row">
                                <div class="col-12 my-3">
                                    <div class="edit_modal_icon">
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    </div>
                                    <p class="text-center mt-2">Please check your Spam box in case you don’t receive our
                                        email
                                        in your Inbox</p>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="edit_phone" class="form-control" id="edit_phone"
                                        placeholder="Phone" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer mb-4">
                        <button type="submit" class="styled_button animate_width">Save</button>
                        {{-- <button type="button" class="styled_button animate_width">Send OTP</button> --}}
                        <button type="button" class="styled_button animate_width"
                            data-bs-dismiss="modal">Cancel</button>

                    </div>
                </div>
            </form>

        </div>
    </div>

    {{-- DOB Modal --}}
    <div class="modal fade" id="edit_dob_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit_dob_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered edit_modal">
            <form action="{{ route('update-profile') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_dob_modalLabel">Update date of birth</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12">
                                <input type="date" name="date_of_birth" class="form-control" id="edit_dob"
                                    placeholder="Phone" value="{{ Auth::user()->date_of_birth ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mb-4">
                        <button type="submit" class="styled_button animate_width">Save</button>
                        <button type="button" class="styled_button animate_width"
                            data-bs-dismiss="modal">Cancel</button>

                    </div>
                </div>
            </form>

        </div>
    </div>


    {{-- DOB Modal --}}
    <div class="modal fade" id="edit_nationality_modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="edit_nationality_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered edit_modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_nationality_modalLabel">Update Nationality</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update-profile') }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <select name="nationality" class="form-select">
                                    <option value="">-- select one --</option>
                                    <option value="afghan" {{ Auth::user()->nationality === 'afghan' ? 'selected' : '' }}>
                                        Afghan</option>
                                    <option value="albanian"
                                        {{ Auth::user()->nationality === 'albanian' ? 'selected' : '' }}>Albanian</option>
                                    <option value="algerian"
                                        {{ Auth::user()->nationality === 'algerian' ? 'selected' : '' }}>Algerian</option>
                                    <option value="american"
                                        {{ Auth::user()->nationality === 'american' ? 'selected' : '' }}>American</option>
                                    <option value="andorran"
                                        {{ Auth::user()->nationality === 'andorran' ? 'selected' : '' }}>Andorran</option>
                                    <option value="angolan"
                                        {{ Auth::user()->nationality === 'angolan' ? 'selected' : '' }}>Angolan</option>
                                    <option value="antiguans"
                                        {{ Auth::user()->nationality === 'antiguans' ? 'selected' : '' }}>Antiguans
                                    </option>
                                    <option value="argentinean"
                                        {{ Auth::user()->nationality === 'argentinean' ? 'selected' : '' }}>Argentinean
                                    </option>
                                    <option value="armenian"
                                        {{ Auth::user()->nationality === 'armenian' ? 'selected' : '' }}>Armenian</option>
                                    <option value="australian"
                                        {{ Auth::user()->nationality === 'australian' ? 'selected' : '' }}>Australian
                                    </option>
                                    <option value="austrian"
                                        {{ Auth::user()->nationality === 'austrian' ? 'selected' : '' }}>Austrian</option>
                                    <option value="azerbaijani"
                                        {{ Auth::user()->nationality === 'azerbaijani' ? 'selected' : '' }}>Azerbaijani
                                    </option>
                                    <option value="bahamian"
                                        {{ Auth::user()->nationality === 'bahamian' ? 'selected' : '' }}>Bahamian</option>
                                    <option value="bahraini"
                                        {{ Auth::user()->nationality === 'bahraini' ? 'selected' : '' }}>Bahraini</option>
                                    <option value="bangladeshi"
                                        {{ Auth::user()->nationality === 'bangladeshi' ? 'selected' : '' }}>Bangladeshi
                                    </option>
                                    <option value="barbadian"
                                        {{ Auth::user()->nationality === 'barbadian' ? 'selected' : '' }}>Barbadian
                                    </option>
                                    <option value="barbudans"
                                        {{ Auth::user()->nationality === 'barbudans' ? 'selected' : '' }}>Barbudans
                                    </option>
                                    <option value="batswana"
                                        {{ Auth::user()->nationality === 'batswana' ? 'selected' : '' }}>Batswana</option>
                                    <option value="belarusian"
                                        {{ Auth::user()->nationality === 'belarusian' ? 'selected' : '' }}>Belarusian
                                    </option>
                                    <option value="belgian"
                                        {{ Auth::user()->nationality === 'belgian' ? 'selected' : '' }}>Belgian</option>
                                    <option value="belizean"
                                        {{ Auth::user()->nationality === 'belizean' ? 'selected' : '' }}>Belizean</option>
                                    <option value="beninese"
                                        {{ Auth::user()->nationality === 'beninese' ? 'selected' : '' }}>Beninese</option>
                                    <option value="bhutanese"
                                        {{ Auth::user()->nationality === 'bhutanese' ? 'selected' : '' }}>Bhutanese
                                    </option>
                                    <option value="bolivian"
                                        {{ Auth::user()->nationality === 'bolivian' ? 'selected' : '' }}>Bolivian</option>
                                    <option value="bosnian"
                                        {{ Auth::user()->nationality === 'bosnian' ? 'selected' : '' }}>Bosnian</option>
                                    <option value="brazilian"
                                        {{ Auth::user()->nationality === 'brazilian' ? 'selected' : '' }}>Brazilian
                                    </option>
                                    <option value="british"
                                        {{ Auth::user()->nationality === 'british' ? 'selected' : '' }}>British</option>
                                    <option value="bruneian"
                                        {{ Auth::user()->nationality === 'bruneian' ? 'selected' : '' }}>Bruneian</option>
                                    <option value="bulgarian"
                                        {{ Auth::user()->nationality === 'bulgarian' ? 'selected' : '' }}>Bulgarian
                                    </option>
                                    <option value="burkinabe"
                                        {{ Auth::user()->nationality === 'burkinabe' ? 'selected' : '' }}>Burkinabe
                                    </option>
                                    <option value="burmese"
                                        {{ Auth::user()->nationality === 'burmese' ? 'selected' : '' }}>Burmese</option>
                                    <option value="burundian"
                                        {{ Auth::user()->nationality === 'burundian' ? 'selected' : '' }}>Burundian
                                    </option>
                                    <option value="cambodian"
                                        {{ Auth::user()->nationality === 'cambodian' ? 'selected' : '' }}>Cambodian
                                    </option>
                                    <option value="cameroonian"
                                        {{ Auth::user()->nationality === 'cameroonian' ? 'selected' : '' }}>Cameroonian
                                    </option>
                                    <option value="canadian"
                                        {{ Auth::user()->nationality === 'canadian' ? 'selected' : '' }}>Canadian</option>
                                    <option value="cape verdean"
                                        {{ Auth::user()->nationality === 'cape verdean' ? 'selected' : '' }}>Cape Verdean
                                    </option>
                                    <option value="central african"
                                        {{ Auth::user()->nationality === 'central african' ? 'selected' : '' }}>Central
                                        African</option>
                                    <option value="chadian"
                                        {{ Auth::user()->nationality === 'chadian' ? 'selected' : '' }}>Chadian</option>
                                    <option value="chilean"
                                        {{ Auth::user()->nationality === 'chilean' ? 'selected' : '' }}>Chilean</option>
                                    <option value="chinese"
                                        {{ Auth::user()->nationality === 'chinese' ? 'selected' : '' }}>Chinese</option>
                                    <option value="colombian"
                                        {{ Auth::user()->nationality === 'colombian' ? 'selected' : '' }}>Colombian
                                    </option>
                                    <option value="comoran"
                                        {{ Auth::user()->nationality === 'comoran' ? 'selected' : '' }}>Comoran</option>
                                    <option value="congolese"
                                        {{ Auth::user()->nationality === 'congolese' ? 'selected' : '' }}>Congolese
                                    </option>
                                    <option value="costa rican"
                                        {{ Auth::user()->nationality === 'costa rican' ? 'selected' : '' }}>Costa Rican
                                    </option>
                                    <option value="croatian"
                                        {{ Auth::user()->nationality === 'croatian' ? 'selected' : '' }}>Croatian</option>
                                    <option value="cuban" {{ Auth::user()->nationality === 'cuban' ? 'selected' : '' }}>
                                        Cuban</option>
                                    <option value="cypriot"
                                        {{ Auth::user()->nationality === 'cypriot' ? 'selected' : '' }}>Cypriot</option>
                                    <option value="czech" {{ Auth::user()->nationality === 'czech' ? 'selected' : '' }}>
                                        Czech</option>
                                    <option value="danish" {{ Auth::user()->nationality === 'danish' ? 'selected' : '' }}>
                                        Danish</option>
                                    <option value="djibouti"
                                        {{ Auth::user()->nationality === 'djibouti' ? 'selected' : '' }}>Djibouti</option>
                                    <option value="dominican"
                                        {{ Auth::user()->nationality === 'dominican' ? 'selected' : '' }}>Dominican
                                    </option>
                                    <option value="dutch" {{ Auth::user()->nationality === 'dutch' ? 'selected' : '' }}>
                                        Dutch</option>
                                    <option value="east timorese"
                                        {{ Auth::user()->nationality === 'east timorese' ? 'selected' : '' }}>East Timorese
                                    </option>
                                    <option value="ecuadorean"
                                        {{ Auth::user()->nationality === 'ecuadorean' ? 'selected' : '' }}>Ecuadorean
                                    </option>
                                    <option value="egyptian"
                                        {{ Auth::user()->nationality === 'egyptian' ? 'selected' : '' }}>Egyptian</option>
                                    <option value="emirian"
                                        {{ Auth::user()->nationality === 'emirian' ? 'selected' : '' }}>Emirian</option>
                                    <option value="equatorial guinean"
                                        {{ Auth::user()->nationality === 'equatorial guinean' ? 'selected' : '' }}>
                                        Equatorial Guinean</option>
                                    <option value="eritrean"
                                        {{ Auth::user()->nationality === 'eritrean' ? 'selected' : '' }}>Eritrean</option>
                                    <option value="estonian"
                                        {{ Auth::user()->nationality === 'estonian' ? 'selected' : '' }}>Estonian</option>
                                    <option value="ethiopian"
                                        {{ Auth::user()->nationality === 'ethiopian' ? 'selected' : '' }}>Ethiopian
                                    </option>
                                    <option value="fijian" {{ Auth::user()->nationality === 'fijian' ? 'selected' : '' }}>
                                        Fijian</option>
                                    <option value="filipino"
                                        {{ Auth::user()->nationality === 'filipino' ? 'selected' : '' }}>Filipino</option>
                                    <option value="finnish"
                                        {{ Auth::user()->nationality === 'finnish' ? 'selected' : '' }}>Finnish</option>
                                    <option value="french" {{ Auth::user()->nationality === 'french' ? 'selected' : '' }}>
                                        French</option>
                                    <option value="gabonese"
                                        {{ Auth::user()->nationality === 'gabonese' ? 'selected' : '' }}>Gabonese</option>
                                    <option value="gambian"
                                        {{ Auth::user()->nationality === 'gambian' ? 'selected' : '' }}>Gambian</option>
                                    <option value="georgian"
                                        {{ Auth::user()->nationality === 'georgian' ? 'selected' : '' }}>Georgian</option>
                                    <option value="german" {{ Auth::user()->nationality === 'german' ? 'selected' : '' }}>
                                        German</option>
                                    <option value="ghanaian"
                                        {{ Auth::user()->nationality === 'ghanaian' ? 'selected' : '' }}>Ghanaian</option>
                                    <option value="greek" {{ Auth::user()->nationality === 'greek' ? 'selected' : '' }}>
                                        Greek</option>
                                    <option value="grenadian"
                                        {{ Auth::user()->nationality === 'grenadian' ? 'selected' : '' }}>Grenadian
                                    </option>
                                    <option value="guatemalan"
                                        {{ Auth::user()->nationality === 'guatemalan' ? 'selected' : '' }}>Guatemalan
                                    </option>
                                    <option value="guinea-bissauan"
                                        {{ Auth::user()->nationality === 'guinea-bissauan' ? 'selected' : '' }}>
                                        Guinea-Bissauan</option>
                                    <option value="guinean"
                                        {{ Auth::user()->nationality === 'guinean' ? 'selected' : '' }}>Guinean</option>
                                    <option value="guyanese"
                                        {{ Auth::user()->nationality === 'guyanese' ? 'selected' : '' }}>Guyanese</option>
                                    <option value="haitian"
                                        {{ Auth::user()->nationality === 'haitian' ? 'selected' : '' }}>Haitian</option>
                                    <option value="herzegovinian"
                                        {{ Auth::user()->nationality === 'herzegovinian' ? 'selected' : '' }}>Herzegovinian
                                    </option>
                                    <option value="honduran"
                                        {{ Auth::user()->nationality === 'honduran' ? 'selected' : '' }}>Honduran</option>
                                    <option value="hungarian"
                                        {{ Auth::user()->nationality === 'hungarian' ? 'selected' : '' }}>Hungarian
                                    </option>
                                    <option value="icelander"
                                        {{ Auth::user()->nationality === 'icelander' ? 'selected' : '' }}>Icelander
                                    </option>
                                    <option value="indian"
                                        {{ Auth::user()->nationality === 'indian' ? 'selected' : '' }}>Indian</option>
                                    <option value="indonesian"
                                        {{ Auth::user()->nationality === 'indonesian' ? 'selected' : '' }}>Indonesian
                                    </option>
                                    <option value="iranian"
                                        {{ Auth::user()->nationality === 'iranian' ? 'selected' : '' }}>Iranian</option>
                                    <option value="iraqi" {{ Auth::user()->nationality === 'iraqi' ? 'selected' : '' }}>
                                        Iraqi</option>
                                    <option value="irish" {{ Auth::user()->nationality === 'irish' ? 'selected' : '' }}>
                                        Irish</option>
                                    <option value="israeli"
                                        {{ Auth::user()->nationality === 'israeli' ? 'selected' : '' }}>Israeli</option>
                                    <option value="italian"
                                        {{ Auth::user()->nationality === 'italian' ? 'selected' : '' }}>Italian</option>
                                    <option value="ivorian"
                                        {{ Auth::user()->nationality === 'ivorian' ? 'selected' : '' }}>Ivorian</option>
                                    <option value="jamaican"
                                        {{ Auth::user()->nationality === 'jamaican' ? 'selected' : '' }}>Jamaican</option>
                                    <option value="japanese"
                                        {{ Auth::user()->nationality === 'japanese' ? 'selected' : '' }}>Japanese</option>
                                    <option value="jordanian"
                                        {{ Auth::user()->nationality === 'jordanian' ? 'selected' : '' }}>Jordanian
                                    </option>
                                    <option value="kazakhstani"
                                        {{ Auth::user()->nationality === 'kazakhstani' ? 'selected' : '' }}>Kazakhstani
                                    </option>
                                    <option value="kenyan"
                                        {{ Auth::user()->nationality === 'kenyan' ? 'selected' : '' }}>Kenyan</option>
                                    <option value="kittian and nevisian"
                                        {{ Auth::user()->nationality === 'kittian and nevisian' ? 'selected' : '' }}>
                                        Kittian and Nevisian</option>
                                    <option value="kuwaiti"
                                        {{ Auth::user()->nationality === 'kuwaiti' ? 'selected' : '' }}>Kuwaiti</option>
                                    <option value="kyrgyz"
                                        {{ Auth::user()->nationality === 'kyrgyz' ? 'selected' : '' }}>Kyrgyz</option>
                                    <option value="laotian"
                                        {{ Auth::user()->nationality === 'laotian' ? 'selected' : '' }}>Laotian</option>
                                    <option value="latvian"
                                        {{ Auth::user()->nationality === 'latvian' ? 'selected' : '' }}>Latvian</option>
                                    <option value="lebanese"
                                        {{ Auth::user()->nationality === 'lebanese' ? 'selected' : '' }}>Lebanese</option>
                                    <option value="liberian"
                                        {{ Auth::user()->nationality === 'liberian' ? 'selected' : '' }}>Liberian</option>
                                    <option value="libyan"
                                        {{ Auth::user()->nationality === 'libyan' ? 'selected' : '' }}>Libyan</option>
                                    <option value="liechtensteiner"
                                        {{ Auth::user()->nationality === 'liechtensteiner' ? 'selected' : '' }}>
                                        Liechtensteiner</option>
                                    <option value="lithuanian"
                                        {{ Auth::user()->nationality === 'lithuanian' ? 'selected' : '' }}>Lithuanian
                                    </option>
                                    <option value="luxembourger"
                                        {{ Auth::user()->nationality === 'luxembourger' ? 'selected' : '' }}>Luxembourger
                                    </option>
                                    <option value="macedonian"
                                        {{ Auth::user()->nationality === 'macedonian' ? 'selected' : '' }}>Macedonian
                                    </option>
                                    <option value="malagasy"
                                        {{ Auth::user()->nationality === 'malagasy' ? 'selected' : '' }}>Malagasy</option>
                                    <option value="malawian"
                                        {{ Auth::user()->nationality === 'malawian' ? 'selected' : '' }}>Malawian</option>
                                    <option value="malaysian"
                                        {{ Auth::user()->nationality === 'malaysian' ? 'selected' : '' }}>Malaysian
                                    </option>
                                    <option value="maldivan"
                                        {{ Auth::user()->nationality === 'maldivan' ? 'selected' : '' }}>Maldivan</option>
                                    <option value="malian"
                                        {{ Auth::user()->nationality === 'malian' ? 'selected' : '' }}>Malian</option>
                                    <option value="maltese"
                                        {{ Auth::user()->nationality === 'maltese' ? 'selected' : '' }}>Maltese</option>
                                    <option value="marshallese"
                                        {{ Auth::user()->nationality === 'marshallese' ? 'selected' : '' }}>Marshallese
                                    </option>
                                    <option value="mauritanian"
                                        {{ Auth::user()->nationality === 'mauritanian' ? 'selected' : '' }}>Mauritanian
                                    </option>
                                    <option value="mauritian"
                                        {{ Auth::user()->nationality === 'mauritian' ? 'selected' : '' }}>Mauritian
                                    </option>
                                    <option value="mexican"
                                        {{ Auth::user()->nationality === 'mexican' ? 'selected' : '' }}>Mexican</option>
                                    <option value="micronesian"
                                        {{ Auth::user()->nationality === 'micronesian' ? 'selected' : '' }}>Micronesian
                                    </option>
                                    <option value="moldovan"
                                        {{ Auth::user()->nationality === 'moldovan' ? 'selected' : '' }}>Moldovan</option>
                                    <option value="monacan"
                                        {{ Auth::user()->nationality === 'monacan' ? 'selected' : '' }}>Monacan</option>
                                    <option value="mongolian"
                                        {{ Auth::user()->nationality === 'mongolian' ? 'selected' : '' }}>Mongolian
                                    </option>
                                    <option value="moroccan"
                                        {{ Auth::user()->nationality === 'moroccan' ? 'selected' : '' }}>Moroccan</option>
                                    <option value="mosotho"
                                        {{ Auth::user()->nationality === 'mosotho' ? 'selected' : '' }}>Mosotho</option>
                                    <option value="motswana"
                                        {{ Auth::user()->nationality === 'motswana' ? 'selected' : '' }}>Motswana</option>
                                    <option value="mozambican"
                                        {{ Auth::user()->nationality === 'mozambican' ? 'selected' : '' }}>Mozambican
                                    </option>
                                    <option value="namibian"
                                        {{ Auth::user()->nationality === 'namibian' ? 'selected' : '' }}>Namibian</option>
                                    <option value="nauruan"
                                        {{ Auth::user()->nationality === 'nauruan' ? 'selected' : '' }}>Nauruan</option>
                                    <option value="nepalese"
                                        {{ Auth::user()->nationality === 'nepalese' ? 'selected' : '' }}>Nepalese</option>
                                    <option value="new zealander"
                                        {{ Auth::user()->nationality === 'new zealander' ? 'selected' : '' }}>New
                                        Zealander</option>
                                    <option value="ni-vanuatu"
                                        {{ Auth::user()->nationality === 'ni-vanuatu' ? 'selected' : '' }}>Ni-Vanuatu
                                    </option>
                                    <option value="nicaraguan"
                                        {{ Auth::user()->nationality === 'nicaraguan' ? 'selected' : '' }}>Nicaraguan
                                    </option>
                                    <option value="nigerien"
                                        {{ Auth::user()->nationality === 'nigerien' ? 'selected' : '' }}>Nigerien</option>
                                    <option value="north korean"
                                        {{ Auth::user()->nationality === 'north korean' ? 'selected' : '' }}>North Korean
                                    </option>
                                    <option value="northern irish"
                                        {{ Auth::user()->nationality === 'northern irish' ? 'selected' : '' }}>Northern
                                        Irish</option>
                                    <option value="norwegian"
                                        {{ Auth::user()->nationality === 'norwegian' ? 'selected' : '' }}>Norwegian
                                    </option>
                                    <option value="omani" {{ Auth::user()->nationality === 'omani' ? 'selected' : '' }}>
                                        Omani</option>
                                    <option value="pakistani"
                                        {{ Auth::user()->nationality === 'pakistani' ? 'selected' : '' }}>Pakistani
                                    </option>
                                    <option value="palauan"
                                        {{ Auth::user()->nationality === 'palauan' ? 'selected' : '' }}>Palauan</option>
                                    <option value="panamanian"
                                        {{ Auth::user()->nationality === 'panamanian' ? 'selected' : '' }}>Panamanian
                                    </option>
                                    <option value="papua new guinean"
                                        {{ Auth::user()->nationality === 'papua new guinean' ? 'selected' : '' }}>Papua
                                        New Guinean</option>
                                    <option value="paraguayan"
                                        {{ Auth::user()->nationality === 'paraguayan' ? 'selected' : '' }}>Paraguayan
                                    </option>
                                    <option value="peruvian"
                                        {{ Auth::user()->nationality === 'peruvian' ? 'selected' : '' }}>Peruvian</option>
                                    <option value="polish"
                                        {{ Auth::user()->nationality === 'polish' ? 'selected' : '' }}>Polish</option>
                                    <option value="portuguese"
                                        {{ Auth::user()->nationality === 'portuguese' ? 'selected' : '' }}>Portuguese
                                    </option>
                                    <option value="qatari"
                                        {{ Auth::user()->nationality === 'qatari' ? 'selected' : '' }}>Qatari</option>
                                    <option value="romanian"
                                        {{ Auth::user()->nationality === 'romanian' ? 'selected' : '' }}>Romanian</option>
                                    <option value="russian"
                                        {{ Auth::user()->nationality === 'russian' ? 'selected' : '' }}>Russian</option>
                                    <option value="rwandan"
                                        {{ Auth::user()->nationality === 'rwandan' ? 'selected' : '' }}>Rwandan</option>
                                    <option value="saint lucian"
                                        {{ Auth::user()->nationality === 'saint lucian' ? 'selected' : '' }}>Saint Lucian
                                    </option>
                                    <option value="salvadoran"
                                        {{ Auth::user()->nationality === 'salvadoran' ? 'selected' : '' }}>Salvadoran
                                    </option>
                                    <option value="samoan"
                                        {{ Auth::user()->nationality === 'samoan' ? 'selected' : '' }}>Samoan</option>
                                    <option value="san marinese"
                                        {{ Auth::user()->nationality === 'san marinese' ? 'selected' : '' }}>San Marinese
                                    </option>
                                    <option value="sao tomean"
                                        {{ Auth::user()->nationality === 'sao tomean' ? 'selected' : '' }}>Sao Tomean
                                    </option>
                                    <option value="saudi" {{ Auth::user()->nationality === 'saudi' ? 'selected' : '' }}>
                                        Saudi</option>
                                    <option value="scottish"
                                        {{ Auth::user()->nationality === 'scottish' ? 'selected' : '' }}>Scottish</option>
                                    <option value="senegalese"
                                        {{ Auth::user()->nationality === 'senegalese' ? 'selected' : '' }}>Senegalese
                                    </option>
                                    <option value="serbian"
                                        {{ Auth::user()->nationality === 'serbian' ? 'selected' : '' }}>Serbian</option>
                                    <option value="seychellois"
                                        {{ Auth::user()->nationality === 'seychellois' ? 'selected' : '' }}>Seychellois
                                    </option>
                                    <option value="sierra leonean"
                                        {{ Auth::user()->nationality === 'sierra leonean' ? 'selected' : '' }}>Sierra
                                        Leonean</option>
                                    <option value="singaporean"
                                        {{ Auth::user()->nationality === 'singaporean' ? 'selected' : '' }}>Singaporean
                                    </option>
                                    <option value="slovakian"
                                        {{ Auth::user()->nationality === 'slovakian' ? 'selected' : '' }}>Slovakian
                                    </option>
                                    <option value="slovenian"
                                        {{ Auth::user()->nationality === 'slovenian' ? 'selected' : '' }}>Slovenian
                                    </option>
                                    <option value="solomon islander"
                                        {{ Auth::user()->nationality === 'solomon islander' ? 'selected' : '' }}>Solomon
                                        Islander</option>
                                    <option value="somali"
                                        {{ Auth::user()->nationality === 'somali' ? 'selected' : '' }}>Somali</option>
                                    <option value="south african"
                                        {{ Auth::user()->nationality === 'south african' ? 'selected' : '' }}>South
                                        African</option>
                                    <option value="south korean"
                                        {{ Auth::user()->nationality === 'afghan' ? 'selected' : '' }}>South Korean
                                    </option>
                                    <option value="spanish"
                                        {{ Auth::user()->nationality === 'south korean' ? 'selected' : '' }}>Spanish
                                    </option>
                                    <option value="sri lankan"
                                        {{ Auth::user()->nationality === 'sri lankan' ? 'selected' : '' }}>Sri Lankan
                                    </option>
                                    <option value="sudanese"
                                        {{ Auth::user()->nationality === 'sudanese' ? 'selected' : '' }}>Sudanese</option>
                                    <option value="surinamer"
                                        {{ Auth::user()->nationality === 'surinamer' ? 'selected' : '' }}>Surinamer
                                    </option>
                                    <option value="swazi" {{ Auth::user()->nationality === 'swazi' ? 'selected' : '' }}>
                                        Swazi</option>
                                    <option
                                        value="swedish"{{ Auth::user()->nationality === 'swedish' ? 'selected' : '' }}>
                                        Swedish</option>
                                    <option value="swiss" {{ Auth::user()->nationality === 'swiss' ? 'selected' : '' }}>
                                        Swiss</option>
                                    <option value="syrian"
                                        {{ Auth::user()->nationality === 'syrian' ? 'selected' : '' }}>Syrian</option>
                                    <option value="taiwanese"
                                        {{ Auth::user()->nationality === 'taiwanese' ? 'selected' : '' }}>Taiwanese
                                    </option>
                                    <option value="tajik" {{ Auth::user()->nationality === 'tajik' ? 'selected' : '' }}>
                                        Tajik</option>
                                    <option value="tanzanian"
                                        {{ Auth::user()->nationality === 'tanzanian' ? 'selected' : '' }}>Tanzanian
                                    </option>
                                    <option value="thai" {{ Auth::user()->nationality === 'thai' ? 'selected' : '' }}>
                                        Thai</option>
                                    <option value="togolese"
                                        {{ Auth::user()->nationality === 'togolese' ? 'selected' : '' }}>Togolese</option>
                                    <option value="tongan"
                                        {{ Auth::user()->nationality === 'tongan' ? 'selected' : '' }}>Tongan</option>
                                    <option value="trinidadian or tobagonian"
                                        {{ Auth::user()->nationality === 'trinidadian or tobagonian' ? 'selected' : '' }}>
                                        Trinidadian or Tobagonian</option>
                                    <option value="tunisian"
                                        {{ Auth::user()->nationality === 'tunisian' ? 'selected' : '' }}>Tunisian</option>
                                    <option value="turkish"
                                        {{ Auth::user()->nationality === 'turkish' ? 'selected' : '' }}>Turkish</option>
                                    <option value="tuvaluan"
                                        {{ Auth::user()->nationality === 'tuvaluan' ? 'selected' : '' }}>Tuvaluan</option>
                                    <option value="ugandan"
                                        {{ Auth::user()->nationality === 'ugandan' ? 'selected' : '' }}>Ugandan</option>
                                    <option value="ukrainian"
                                        {{ Auth::user()->nationality === 'ukrainian' ? 'selected' : '' }}>Ukrainian
                                    </option>
                                    <option value="uruguayan"
                                        {{ Auth::user()->nationality === 'uruguayan' ? 'selected' : '' }}>Uruguayan
                                    </option>
                                    <option value="uzbekistani"
                                        {{ Auth::user()->nationality === 'uzbekistani' ? 'selected' : '' }}>Uzbekistani
                                    </option>
                                    <option value="venezuelan"
                                        {{ Auth::user()->nationality === 'venezuelan' ? 'selected' : '' }}>Venezuelan
                                    </option>
                                    <option value="vietnamese"
                                        {{ Auth::user()->nationality === 'vietnamese' ? 'selected' : '' }}>Vietnamese
                                    </option>
                                    <option value="welsh" {{ Auth::user()->nationality === 'welsh' ? 'selected' : '' }}>
                                        Welsh</option>
                                    <option value="yemenite"
                                        {{ Auth::user()->nationality === 'yemenite' ? 'selected' : '' }}>Yemenite</option>
                                    <option value="zambian"
                                        {{ Auth::user()->nationality === 'zambian' ? 'selected' : '' }}>Zambian</option>
                                    <option value="zimbabwean"
                                        {{ Auth::user()->nationality === 'zimbabwean' ? 'selected' : '' }}>Zimbabwean
                                    </option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer mb-4">
                    <button type="submit" class="styled_button animate_width">Save</button>
                    <button type="button" class="styled_button animate_width" data-bs-dismiss="modal">Cancel</button>

                </div>
                </form>

            </div>
        </div>
    </div>

@endsection
