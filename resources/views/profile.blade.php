<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile - YouTube</title>
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

        /* ================= HEADER ================= */

        .header {
            height: 56px;
            background: white;
            border-bottom: 1px solid #e5e5e5;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 18px;

            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Home */

        .home-btn {
            display: flex;
            align-items: center;
            gap: 5px;

            text-decoration: none;
            color: #0f0f0f;

            font-size: 13px;
            font-weight: 500;

            padding: 7px 10px;
            border-radius: 7px;

            transition: background 0.2s;
        }

        .home-btn:hover {
            background: #f2f2f2;
        }

        .home-icon {
            font-size: 17px;
        }

        /* YouTube Logo */

        .logo {
            display: flex;
            align-items: center;
            gap: 5px;

            font-size: 18px;
            font-weight: bold;
        }

        .youtube-icon {
            width: 29px;
            height: 20px;

            background: #ff0000;
            border-radius: 6px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;
            font-size: 10px;
        }

        /* Header Profile */

        .header-profile {
            width: 32px;
            height: 32px;

            border-radius: 50%;
            overflow: hidden;
        }

        .header-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        /* ================= MAIN ================= */

        .profile-container {
            max-width: 820px;

            margin: 25px auto;

            padding: 0 15px;
        }


        /* ================= PROFILE TOP ================= */

        .profile-top {
            background: white;

            border-radius: 10px;

            padding: 22px;

            display: flex;
            align-items: center;

            gap: 20px;

            border: 1px solid #e5e5e5;
        }

        .profile-image {
            width: 95px;
            height: 95px;

            border-radius: 50%;
            overflow: hidden;

            flex-shrink: 0;
        }

        .profile-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .profile-info h1 {
            font-size: 22px;
            margin-bottom: 7px;
        }

        .profile-info p {
            color: #606060;

            margin-bottom: 4px;

            font-size: 13px;
        }


        /* ================= MY CHANNEL ================= */

        .my-channel-area {
            margin-left: auto;
            align-self: center;
        }

        .my-channel-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 105px;
            height: 36px;

            padding: 0 15px;

            background: #0f0f0f;
            color: white;

            border-radius: 18px;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition: 0.2s;
        }

        .my-channel-btn:hover {
            opacity: 0.8;
        }


        /* ================= USER INFORMATION ================= */

        .information-card {
            margin-top: 18px;

            background: white;

            border: 1px solid #e5e5e5;

            border-radius: 10px;

            padding: 20px;
        }

        .information-card h2 {
            font-size: 17px;

            margin-bottom: 16px;
        }

        .info-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 10px;
        }

        .info-item {
            background: #f8f8f8;

            padding: 12px;

            border-radius: 7px;
        }

        .info-item span {
            display: block;

            font-size: 11px;

            color: #606060;

            margin-bottom: 5px;
        }

        .info-item strong {
            font-size: 13px;
        }


        /* ================= CHANNEL ================= */

        .channel-card {
            margin-top: 18px;

            background: white;

            border: 1px solid #e5e5e5;

            border-radius: 10px;

            padding: 20px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;
        }

        .channel-text h2 {
            font-size: 17px;

            margin-bottom: 5px;
        }

        .channel-text p {
            color: #606060;

            font-size: 13px;
        }

        .create-channel-btn {
            background: #0f0f0f;

            color: white;

            border: none;

            border-radius: 18px;

            padding: 9px 16px;

            font-size: 13px;

            font-weight: bold;

            cursor: pointer;

            text-decoration: none;

            white-space: nowrap;

            transition: background 0.2s;
        }

        .create-channel-btn:hover {
            background: #272727;
        }


        /* ================= MOBILE ================= */

        @media (max-width: 650px) {

            .header {
                padding: 0 10px;
            }

            .profile-container {
                margin: 18px auto;
            }

            .profile-top {
                flex-direction: column;

                text-align: center;

                padding: 20px;
            }

            .profile-image {
                width: 80px;
                height: 80px;
            }

            .profile-info h1 {
                font-size: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .channel-card {
                flex-direction: column;

                align-items: flex-start;
            }

            .create-channel-btn {
                width: 100%;

                text-align: center;
            }

            .my-channel-area {
                width: 100%;

                margin-left: 0;

                margin-top: 5px;
            }

            .my-channel-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- ================= HEADER ================= -->

    <header class="header">

        <div class="header-left">

            <!-- Back to Home -->

            <a href="{{ route('youtube') }}" class="home-btn">
                <span class="home-icon">←</span>
                <span>Home</span>
            </a>

            <!-- YouTube Logo -->

            <div class="logo">
                <div class="youtube-icon">
                    ▶
                </div>

                YouTube
            </div>

        </div>


        <!-- Current User -->

        <div class="header-profile">

            <img
                src="{{ asset('storage/' . Auth::user()->profile) }}"
                alt="Profile"
            >

        </div>

    </header>


    <!-- ================= PROFILE ================= -->

    <main class="profile-container">

        <!-- Profile Header -->

        <section class="profile-top">

            <div class="profile-image">

                <img
                    src="{{ asset('storage/' . Auth::user()->profile) }}"
                    alt="Profile"
                >

            </div>


            <div class="profile-info">

                <h1>
                    {{ Auth::user()->name }}
                </h1>

                <p>
                    {{ Auth::user()->email }}
                </p>

                <p>
                    Age: {{ Auth::user()->age }}
                </p>

            </div>

            <div class="my-channel-area">
                @if($channel)
                    <a href="{{ route('myChannel') }}" class="my-channel-btn">
                        My Channel
                    </a>
                @endif
            </div>

        </section>


        <!-- User Information -->

        <section class="information-card">

            <h2>
                Personal Information
            </h2>

            <div class="info-grid">

                <div class="info-item">

                    <span>Name</span>

                    <strong>
                        {{ Auth::user()->name }}
                    </strong>

                </div>


                <div class="info-item">

                    <span>Age</span>

                    <strong>
                        {{ Auth::user()->age }}
                    </strong>

                </div>


                <div class="info-item">

                    <span>Email</span>

                    <strong>
                        {{ Auth::user()->email }}
                    </strong>

                </div>


                <div class="info-item">

                    <span>Account</span>

                    <strong>
                        YouTube User
                    </strong>

                </div>

            </div>

        </section>


        <!-- Create Channel -->

        @if(!$channel)
        <section class="channel-card">

            <div class="channel-text">

                <h2>
                    Create your channel
                </h2>

                <p>
                    Share videos and start building your own YouTube channel.
                </p>

            </div>


            <a href="{{ route('createChannel') }}" class="create-channel-btn">
                Create Channel
            </a>

        </section>
        @endif

    </main>

</body>
</html>