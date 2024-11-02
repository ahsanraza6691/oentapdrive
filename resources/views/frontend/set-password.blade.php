<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <style>
        * {
            margin: 0;

            padding: 0;

            font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande",
                "Lucida Sans", Arial, sans-serif;
        }

        section {
            display: flex;

            justify-content: center;

            align-items: center;

            min-height: 100vh;

            width: 100%;

            background: url({{asset('assets/images/vender-banner.webp')}}) no-repeat;

            background-position: center;

            background-size: cover;
        }

        .form-box {
            position: relative;

            width: 400px;

            height: 450px;

            background: transparent;

            border: none;

            border-radius: 20px;

            backdrop-filter: blur(15px) brightness(80%);

            display: flex;

            justify-content: center;

            align-items: center;
        }

        h2 {
            font-size: 2em;

            color: #fff;

            text-align: center;
        }

        .inputbox {
            position: relative;

            margin: 30px 0;

            width: 310px;

            border-bottom: 2px solid #fff;
        }

        .inputbox label {
            position: absolute;

            top: 50%;

            left: 5px;

            transform: translateY(-50%);

            color: #fff;

            font-size: 1em;

            pointer-events: none;

            transition: 0.5s;
        }

        /* animations: start */

        input:focus~label,
        input:valid~label {
            top: -5px;
        }

        /* animation:end */

        .inputbox input {
            width: 100%;

            height: 50px;

            background: transparent;

            border: none;

            outline: none;

            font-size: 1em;

            padding: 0 35px 0 5px;

            color: #fff;
        }

        .inputbox ion-icon {
            position: absolute;

            right: 8px;

            color: #fff;

            font-size: 1.2em;

            top: 20px;
        }

        .forget {
            margin: -10px 0 17px;

            font-size: 0.9em;

            color: #fff;

            display: flex;

            justify-content: space-between;
        }

        .forget label input {
            margin-right: 3px;
        }

        .forget a {
            color: #fff;

            text-decoration: none;
        }

        .forget a:hover {
            text-decoration: underline;
        }

        button {
            width: 100%;

            height: 40px;

            border-radius: 40px;

            background-color: #fff;

            border: none;

            outline: none;

            cursor: pointer;

            font-size: 1em;

            font-weight: 600;
        }

        .register {
            font-size: 0.9em;

            color: #fff;

            text-align: center;

            margin: 25px 0 10px;
        }

        .register p a {
            text-decoration: none;

            color: #fff;

            font-weight: 600;
        }

        .register p a:hover {
            text-decoration: underline;
        }

        /* Responsiveness:Start */
        @media screen and (max-width: 480px) {
            .form-box {
                width: 100%;
                border-radius: 0px;
            }
        }
    </style>
</head>

<body>

    <section>

        <div class="form-box">

            <div class="form-value">

                <form id="setPassword" action="{{route('add-password')}}" method="POST">
                    @csrf
                    <h2>Set Password</h2>

                     <div class="inputbox">

                        <ion-icon name="mail-outline"></ion-icon>

                        <input type="email" id="email" name="email" value="{{ request('email') }}" readonly required>

                        {{-- <label>Email</label> --}}

                    </div>

                    <div class="inputbox">

                        <ion-icon name="lock-closed-outline"></ion-icon>

                        <input type="password" id="password" name="password" required>

                        <label>Password</label>

                    </div>

                    <div class="inputbox">

                        <ion-icon name="lock-closed-outline"></ion-icon>

                        <input type="password" id="confirm_password" name="confirm_password" required>

                        <label>Confirm Password</label>
                    </div>
                    <div id="password-error"  style="color: red;"></div>

                    <button type="submit">Submit</button>

                </form>

            </div>

        </div>

    </section>

    <!-- ion-icon installation: Start -->

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!--ion-icon installation: End-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    <script>
    $(document).ready(function() {
        $('#setPassword').submit(function(event) {
            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();

            if (password !== confirmPassword) {
                $('#password-error').text('Passwords do not match.');
                event.preventDefault(); // Prevent form submission
            } else {
                $('#password-error').empty(); // Clear any previous error message
            }
        });
    });


</script>

</body>

</html>
