<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - YouTube</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;

            background-color: #f9f9f9;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 20px;
        }

        /* Login Container */

        .login-container {
            width: 100%;
            max-width: 430px;

            background-color: #ffffff;

            border: 1px solid #e5e5e5;
            border-radius: 12px;

            padding: 35px;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }


        /* Header */

        .login-header {
            text-align: center;

            margin-bottom: 30px;
        }

        .login-icon {
            width: 55px;
            height: 55px;

            margin: 0 auto 15px;

            display: flex;
            justify-content: center;
            align-items: center;

            background-color: #ff0000;

            border-radius: 50%;

            font-size: 26px;
        }

        .login-header h2 {
            font-size: 26px;

            color: #0f0f0f;

            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 14px;

            color: #606060;
        }


        /* Red Line */

        .login-header h2::after {
            content: "";

            display: block;

            width: 50px;
            height: 4px;

            background-color: #ff0000;

            margin: 12px auto 0;

            border-radius: 10px;
        }


        /* Error Messages */

        .error-box {
            margin-bottom: 20px;

            padding: 12px 15px;

            background-color: #fff0f0;

            border: 1px solid #ffcccc;

            border-radius: 6px;
        }

        .error-box p {
            color: #cc0000;

            font-size: 13px;

            margin-bottom: 5px;
        }

        .error-box p:last-child {
            margin-bottom: 0;
        }


        /* Form */

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            font-size: 14px;

            font-weight: 600;

            color: #0f0f0f;
        }


        /* Inputs */

        .form-group input {
            width: 100%;

            padding: 13px 14px;

            border: 1px solid #c6c6c6;

            border-radius: 6px;

            background-color: #ffffff;

            color: #0f0f0f;

            font-size: 15px;

            outline: none;

            transition: 0.2s ease;
        }

        .form-group input::placeholder {
            color: #777;
        }

        .form-group input:focus {
            border-color: #065fd4;

            box-shadow: 0 0 0 1px #065fd4;
        }


        /* Login Button */

        .login-btn {
            width: 100%;

            padding: 13px 20px;

            margin-top: 5px;

            border: none;

            border-radius: 6px;

            background-color: #ff0000;

            color: #ffffff;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.2s ease;
        }

        .login-btn:hover {
            background-color: #cc0000;
        }

        .login-btn:active {
            transform: scale(0.98);
        }


        /* Register */

        .register-text {
            text-align: center;

            margin-top: 25px;

            padding-top: 20px;

            border-top: 1px solid #eeeeee;

            font-size: 14px;

            color: #606060;
        }

        .register-text a {
            color: #065fd4;

            font-weight: 600;

            text-decoration: none;

            margin-left: 4px;
        }

        .register-text a:hover {
            text-decoration: underline;
        }


        /* Mobile */

        @media (max-width: 500px) {

            .login-container {
                padding: 28px 22px;
            }

            .login-header h2 {
                font-size: 23px;
            }
        }
    </style>
</head>


<body>


    <div class="login-container">


        <!-- Error Messages -->

        @if($errors->any())

            <div class="error-box">

                @foreach($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif



        <!-- Header -->

        <div class="login-header">

            <div class="login-icon">
                🔐
            </div>

            <h2>Welcome Back</h2>

            <p>Login to your account</p>

        </div>



        <!-- Login Form -->

        <form action="{{ route('login.store') }}" method="POST">

            @csrf


            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

            </div>



            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >

            </div>



            <button type="submit" class="login-btn">
                Login
            </button>

        </form>



        <!-- Register -->

        <div class="register-text">

            Don't have an account?

            <a href="/">
                Register
            </a>

        </div>


    </div>


</body>

</html>