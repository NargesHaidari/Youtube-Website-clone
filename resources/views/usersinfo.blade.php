<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Registration - YouTube</title>

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

            padding: 30px 15px;
        }

        .form-container {
            width: 100%;
            max-width: 700px;

            background-color: #ffffff;

            border: 1px solid #e5e5e5;
            border-radius: 12px;

            padding: 35px;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            font-size: 26px;
            color: #0f0f0f;
        }

        .form-header h2::after {
            content: "";

            display: block;

            width: 55px;
            height: 4px;

            background-color: #ff0000;

            margin: 12px auto 0;

            border-radius: 10px;
        }

        /* دو ستونه کردن فرم */
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            width: 100%;
        }

        .form-group label {
            display: block;

            font-size: 14px;
            font-weight: 600;

            color: #0f0f0f;

            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;

            padding: 12px 14px;

            font-size: 15px;

            color: #0f0f0f;

            background-color: #ffffff;

            border: 1px solid #c6c6c6;

            border-radius: 6px;

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

        .form-group input[type="file"] {
            padding: 10px;

            cursor: pointer;

            background-color: #fafafa;
        }

        .form-group input[type="file"]::file-selector-button {
            background-color: #f2f2f2;

            border: none;
            border-radius: 4px;

            padding: 8px 12px;

            margin-right: 10px;

            cursor: pointer;

            font-weight: 600;
        }

        /* دکمه */
        .submit-btn {
            width: 100%;

            padding: 13px 20px;

            border: none;
            border-radius: 6px;

            background-color: #ff0000;

            color: #ffffff;

            font-size: 15px;
            font-weight: 600;

            cursor: pointer;

            transition: 0.2s ease;
        }

        .submit-btn:hover {
            background-color: #cc0000;
        }

        .submit-btn:active {
            transform: scale(0.98);
        }

        /* دکمه در ستون دوم */
        .button-group {
            display: flex;
            align-items: end;
        }

        /* موبایل */
        @media (max-width: 600px) {

            .form-container {
                padding: 25px 20px;
            }

            form {
                grid-template-columns: 1fr;
            }

            .button-group {
                display: block;
            }

            .form-header h2 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

    <div class="form-container">

        <div class="form-header">
            <h2>Admin Registration</h2>
        </div>

        <form action="{{ route('usersinfo.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- Row 1 -->
            <div class="form-group">
                <label for="name">Full Name</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Enter your name"
                    required
                >
            </div>

            <div class="form-group">
                <label for="age">Age</label>

                <input
                    type="number"
                    id="age"
                    name="age"
                    placeholder="Enter your age"
                    required
                >
            </div>

            <!-- Row 2 -->
            <div class="form-group">
                <label for="email">Email Address</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <!-- Row 3 -->
            <div class="form-group">
                <label for="profile">Profile Image</label>

                <input
                    type="file"
                    id="profile"
                    name="profile"
                    accept="image/*"
                    required
                >
            </div>

            <div class="button-group">
                <button type="submit" class="submit-btn">
                    Register Account
                </button>
            </div>

        </form>

    </div>

</body>
</html>