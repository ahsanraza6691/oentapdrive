<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vendor Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="{{asset("web-assets/css/plugins.css")}}">
    <link rel="stylesheet" href="{{asset("web-assets/css/custom.css")}}">
    <link rel="stylesheet" href="{{asset("web-assets/css/responsive.css")}}">
</head>

<body>
  <style>
.login-card {
    min-height: 100vh;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    margin: 0 auto;
    background: url("{{asset('/web-assets/images/login_bg_blur.jpg')}}");
    background-position: center;
    padding: 30px 12px
}

.login-card .logo {
    display: block;
    margin-bottom: 30px;
    text-align: center
}

.login-card .btn-showcase .btn {
    line-height: 1;
    padding: 10px 15px;
    margin: 0
}

.login-card .btn-showcase .btn+.btn {
    margin-left: 5px
}

.login-card .btn-showcase .btn svg {
    height: 16px;
    vertical-align: bottom
}

.login-card .login-main {
    min-width: 450px;
    padding: 40px;
    border-radius: 10px;
    -webkit-box-shadow: 0 0 37px rgba(8, 21, 66, 0.05);
    box-shadow: 0 0 37px rgba(8, 21, 66, 0.05);
    margin: 0 auto;
    background-color: #fff;
      max-width: 800px;
}

.login-card .login-main .theme-form h4 {
    margin-bottom: 5px
}

.login-card .login-main .theme-form label {
    font-size: 15px;
    letter-spacing: 0.4px
}

.login-card .login-main .theme-form .checkbox label::before {
    background-color: #f9f9fa;
    border: 1px solid #dfdfdf
}

.login-card .login-main .theme-form .or {
    position: relative
}

.login-card .login-main .theme-form .or:before {
    content: "";
    position: absolute;
    width: 65%;
    height: 2px;
    background-color: #f3f3ff;
    top: 9px;
    z-index: 0;
    right: 0
}

.login-card .login-main .theme-form input {
    background-color: #f3f3ff;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease
}

.login-card .login-main .theme-form input::-webkit-input-placeholder {
    color: #999
}

.login-card .login-main .theme-form input:hover,
.login-card .login-main .theme-form input:focus {
    border: 1px solid #b9c1cc;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease
}

.login-card .login-main .theme-form p {
    margin-bottom: 25px;
    font-size: 14px;
    color: #898989
}

.login-card .login-main .theme-form .form-group {
    margin-bottom: 10px;
    position: relative
}

.login-card .login-main .theme-form .link {
    position: absolute;
    top: 10px;
    right: 0
}
    .login-card {
    width: 100% !important;
    height: 100% !important;
    background-size: cover !important;
    background-position: center !important;
}
.btn-primary {
    background-color: #ffffff !important;
    border-color:rgba(0, 0, 0, 0.8) !important;
    color: rgba(0, 0, 0, 0.8) !important;
    margin-top: 12px;
}
.login-card .login-main {
    background-color: var(--white);
  	border: 2px solid var(--theme-color);
}
.login-card .login-main .theme-form h4 {
    color: white !important;
}
.login-card .login-main .theme-form p {
    color: #ffffff !important;
    margin-bottom: 20px !important;
}
.login-card .login-main .theme-form label {
    color: white !important;
}
.pageHeading {
    margin: 0 auto 30px auto;
    width: fit-content;
    border-bottom: 3px solid var(--theme-color);
    padding-bottom: 5px;
}
    a{
    	color: var(--theme-color);
    }
    a:hover{
    	color: var(--secondary-color);
    }

    @media only screen and (max-width: 767px){
        .login-card .login-main {
            padding: 30px;
            min-width: 400px;
        }
        .mobile_hide {
            display: none;
        }

    }

  </style>
  
  <div class="container-fluid p-0">
      <div class="login-card">
        <div class="login-main">
          <h1 class="pageHeading">Login</h1>
        <div class="row m-0">
          <div class="col-md-6 mobile_hide">
          	<img class="popupImg img-fluid" src="{{asset('assets/images/login-img.webp')}}" alt="">
            <h6 class="text-center mt-2">
            	Expand your reach with OneTapDrive and get a steady stream of leads to grow your business like never before.
            </h6>
          </div>
            <div class="col-md-6">
              
                    <div>
                         
                            <form action="{{route('vendor-login')}}" method="POST">
                              @csrf

                              <div class="inputCont">
                                  <h6>Email</h6>
                                  <input type="email" name="email" id="email" value="{{old('email')}}" required>
                              </div>

                              <div class="inputCont">
                                  <h6>Password</h6>
                                  <input type="password" name="password" id="password" value="{{old('password')}}" required>
                              </div>
                              <div class="inputCont forget">
                                <a href="#">Forgot Password?</a>
                              </div>
                              <div class="inputCont text-center mt-1">
                                  <button class="themeBtn">
                                      Login
                                  </button>
                              </div>

                              <div class="register text-center mt-3">

                                  <p>Don't have an account? <a href="{{route('list-your-rental-cars')}}">Sign Up</a></p>

                              </div>

                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- <section class="loginSec">
    <div class="bgImg">
        <img src="{{asset('/web-assets/images/carImg.png')}}" alt="">
    </div>
    <div class="content">
        <h1 class="pageHeading">Login</h1>
        <form action="{{route('vendor-login')}}" method="POST">
            @csrf

            <div class="inputCont">
                <h6>Email</h6>
                <input type="email" name="email" id="email" value="{{old('email')}}" required>
            </div>

            <div class="inputCont">
                <h6>Password</h6>
                <input type="password" name="password" id="password" value="{{old('password')}}" required>
            </div>
            <div class="inputCont forget">
                <a href="#">Forgot Password</a>
            </div>
            <div class="inputCont">
                <button class="themeBtn">
                    Login
                </button>
            </div>

             <div class="register">

                <p>Don't have an account? <a href="#">Sign Up</a></p>

            </div> 

        </form>
    </div>
</section> --}}

{{--<section>

    <div class="form-box">

        <div class="form-value">


        </div>

    </div>

</section> --}}

<!-- ion-icon installation: Start -->

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif
<!--ion-icon installation: End-->

</body>

</html>
