<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Channel - YouTube</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            color: #0f0f0f;
        }

        /* Header */

        .header {
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .back-link {
            text-decoration: none;
            color: #0f0f0f;
            font-size: 15px;
            padding: 10px 14px;
            border-radius: 8px;
        }

        .back-link:hover {
            background: #f2f2f2;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 21px;
            font-weight: bold;
        }

        .youtube-icon {
            width: 34px;
            height: 24px;
            background: #ff0000;
            color: white;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .header-profile {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            overflow: hidden;
        }

        .header-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Main */

        .container {
            max-width: 650px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .form-card {
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 14px;
            padding: 35px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h1 {
            font-size: 27px;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #c6c6c6;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            font-family: inherit;
            background: white;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #065fd4;
            box-shadow: 0 0 0 1px #065fd4;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 115px;
        }

        .handle-input {
            display: flex;
            align-items: center;
            border: 1px solid #c6c6c6;
            border-radius: 8px;
            overflow: hidden;
        }

        .handle-input:focus-within {
            border-color: #065fd4;
            box-shadow: 0 0 0 1px #065fd4;
        }

        .handle-prefix {
            padding-left: 13px;
            color: #606060;
        }

        .handle-input input {
            border: none;
            box-shadow: none !important;
        }

        .handle-input input:focus {
            border: none;
        }

        .form-group input[type="file"] {
            background: #fafafa;
            padding: 11px;
        }

        .error-box {
            background: #fff0f0;
            color: #c5221f;
            border-radius: 8px;
            padding: 13px 16px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .error-box ul {
            padding-left: 20px;
        }

        .create-btn {
            width: 100%;
            border: none;
            border-radius: 24px;
            background: #ff0000;
            color: white;
            padding: 14px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .create-btn:hover {
            opacity: 0.7;
        }

        .cancel-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #606060;
            text-decoration: none;
            font-size: 14px;
        }

        .cancel-link:hover {
            color: #0f0f0f;
        }

        @media (max-width: 600px) {
            .header {
                padding: 0 12px;
            }

            .header-left {
                gap: 8px;
            }

            .logo {
                font-size: 17px;
            }

            .form-card {
                padding: 24px 18px;
            }

            .form-header h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->

    <header class="header">

        <div class="header-left">

            <a href="{{ route('profile') }}" class="back-link">
                ← Profile
            </a>

            <div class="logo">
                <div class="youtube-icon">▶</div>
                YouTube
            </div>

        </div>

        <a href="{{ route('profile') }}" class="header-profile">
            <img
                src="{{ asset('storage/' . Auth::user()->profile) }}"
                alt="Profile"
            >
        </a>

    </header>


    <!-- Create Channel Form -->

    <main class="container">

        <div class="form-card">

            <div class="form-header">
                <h1>Create your channel</h1>
            </div>


            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form
                action="{{ route('channel.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <!-- Channel Name -->

                <div class="form-group">
                    <label for="name">Channel Name</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="your channel name"
                        maxlength="100"
                        required
                    >
                </div>


                <!-- Handle -->

                <div class="form-group">
                    <label for="handle">Handle</label>

                    <div class="handle-input">
                        <span class="handle-prefix">@</span>

                        <input
                            type="text"
                            id="handle"
                            name="handle"
                            value="{{ old('handle') }}"
                            placeholder="Enter a unique handle"
                            required
                        >
                    </div>
                </div>


                <!-- Description -->

                <div class="form-group">
                    <label for="description">Description</label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Tell viewers about your channel..."
                    >{{ old('description') }}</textarea>
                </div>


                <!-- Channel Image -->

                <div class="form-group">
                    <label for="channel_image">Channel Image</label>

                    <input
                        type="file"
                        id="channel_image"
                        name="channel_image"
                        accept="image/jpeg,image/png,image/webp"
                        required
                    >
                </div>


                <button type="submit" class="create-btn">
                    Create Channel
                </button>

                <a href="{{ route('profile') }}" class="cancel-link">
                    Cancel
                </a>

            </form>

        </div>

    </main>

</body>
</html>