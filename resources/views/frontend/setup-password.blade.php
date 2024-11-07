<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vendor Login</title>
    <link style="width: 100%" rel="icon" href="{{asset('web-assets/images/fav.webp')}}" type="image/png">
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
          <h1 class="pageHeading">Setup Your Password</h1>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('post-setup-password')}}">
                    @csrf()
                    <div class="inputCont">
                        <h6>Email</h6>
                        <input type="email" name="email" id="email" value="{{$user_details['email']}}" disabled>
                        <input type="hidden" name="token" value="{{EncryptionService::encrypt(json_encode(["user_email" => $user_details->email]))}}">
                    </div>

                    <div class="inputCont">
                        <h6>Password</h6>
                        <input type="password" name="password" id="password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputCont">
                        <h6>Confirm Password</h6>
                        <input type="password" name="password_confirmation" id="password_confirmation" required>
                        @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputCont text-center mt-3">
                        <button class="themeBtn">
                            Setup Password
                        </button>
                    </div>

                </form>
                      
            </div>
        </div>
    </div>




</body>

</html>
