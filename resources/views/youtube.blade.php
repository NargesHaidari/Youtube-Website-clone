<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>YouTube</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #0f0f0f;
        }

        /* ================= HEADER ================= */

        header {
            height: 64px;

            background-color: #ffffff;

            border-bottom: 1px solid #e5e5e5;

            display: flex;
            align-items: center;

            padding: 0 24px;

            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* Logo */

        .logo {
            display: flex;
            align-items: center;

            text-decoration: none;

            color: #0f0f0f;

            font-size: 21px;
            font-weight: bold;

            width: 220px;
        }

        .youtube-icon {
            width: 36px;
            height: 25px;

            background-color: #ff0000;

            border-radius: 7px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-right: 8px;
        }

        .youtube-icon::after {
            content: "";

            width: 0;
            height: 0;

            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
            border-left: 9px solid white;

            margin-left: 2px;
        }

        /* Search */

        .search-container {
            flex: 1;

            max-width: 650px;

            display: flex;

            margin: 0 auto;
        }

        .search-container input {
            flex: 1;

            height: 40px;

            border: 1px solid #c6c6c6;

            border-right: none;

            border-radius: 20px 0 0 20px;

            padding: 0 18px;

            font-size: 15px;

            outline: none;
        }

        .search-container input:focus {
            border-color: #065fd4;
        }

        .search-btn {
            width: 65px;

            height: 40px;

            border: 1px solid #c6c6c6;

            border-radius: 0 20px 20px 0;

            background-color: #f8f8f8;

            cursor: pointer;

            font-size: 18px;
        }

        .search-btn:hover {
            background-color: #eeeeee;
        }

        /* Header Right */

        .header-right {
            width: 220px;

            display: flex;

            justify-content: flex-end;

            align-items: center;

            gap: 20px;
        }

        .header-btn {
            border: none;

            background: none;

            font-size: 21px;

            cursor: pointer;
        }

        /* Profile */

        .profile-link {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .profile {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .profile img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .profile:hover {
            transform: scale(1.08);
        }


        /* ================= MAIN LAYOUT ================= */

        .layout {
            display: flex;
        }


        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 220px;

            min-height: calc(100vh - 64px);

            background-color: #ffffff;

            padding: 15px 10px;

            position: fixed;

            top: 64px;
            left: 0;

            border-right: 1px solid #eeeeee;
        }

        .sidebar-item {
            display: flex;

            align-items: center;

            gap: 18px;

            padding: 12px 15px;

            margin-bottom: 5px;

            border-radius: 8px;

            text-decoration: none;

            color: #0f0f0f;

            font-size: 14px;
        }

        .sidebar-item:hover {
            background-color: #f2f2f2;
        }

        .sidebar-item.active {
            background-color: #f2f2f2;

            font-weight: bold;
        }

        .sidebar-icon {
            font-size: 19px;
        }


        /* ================= CONTENT ================= */

        .content {
            margin-left: 220px;

            width: calc(100% - 220px);

            padding: 25px;
        }


        /* Categories */

        .categories {
            display: flex;

            gap: 10px;

            overflow-x: auto;

            margin-bottom: 25px;
        }

        .category {
            border: none;

            background-color: #f0f0f0;

            padding: 9px 16px;

            border-radius: 8px;

            white-space: nowrap;

            cursor: pointer;

            font-size: 14px;
        }

        .category:hover {
            background-color: #e5e5e5;
        }

        .category.active {
            background-color: #0f0f0f;

            color: white;
        }


        /* ================= VIDEOS ================= */

        .video-grid {
            display: grid;

            grid-template-columns:
                repeat(auto-fill, minmax(280px, 1fr));

            gap: 28px 18px;
        }

        .video-card {
            cursor: pointer;
        }

        .thumbnail {
            width: 100%;

            aspect-ratio: 16 / 9;

            background: linear-gradient(
                135deg,
                #ddd,
                #aaa
            );

            border-radius: 10px;

            display: flex;

            justify-content: center;
            align-items: center;

            font-size: 42px;

            color: #ffffff;

            overflow: hidden;
        }

        .video-info {
            display: flex;

            gap: 12px;

            margin-top: 10px;
        }

        .channel-avatar {
            width: 36px;
            height: 36px;

            min-width: 36px;

            border-radius: 50%;

            background-color: #ff0000;

            color: white;

            display: flex;

            align-items: center;
            justify-content: center;

            font-weight: bold;
        }

        .video-details h3 {
            font-size: 15px;

            line-height: 21px;

            margin-bottom: 5px;

            color: #0f0f0f;
        }

        .channel-name,
        .video-meta {
            font-size: 13px;

            color: #606060;

            line-height: 19px;
        }


        /* ================= MOBILE ================= */

        @media (max-width: 900px) {

            .logo {
                width: auto;
            }

            .sidebar {
                width: 75px;
            }

            .sidebar-item {
                justify-content: center;

                padding: 14px 5px;
            }

            .sidebar-item span:not(.sidebar-icon) {
                display: none;
            }

            .content {
                margin-left: 75px;

                width: calc(100% - 75px);
            }

            .header-right {
                width: auto;
            }
        }


        @media (max-width: 600px) {

            header {
                padding: 0 12px;
            }

            .logo span {
                display: none;
            }

            .search-container {
                margin-left: 15px;
            }

            .header-btn {
                display: none;
            }

            .header-right {
                margin-left: 10px;
            }

            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;

                width: 100%;

                padding: 15px;
            }

            .video-grid {
                grid-template-columns: 1fr;
            }
        }

    </style>

</head>


<body>


    <!-- ================= HEADER ================= -->

    <header>


        <!-- Logo -->

        <a href="/" class="logo">

            <div class="youtube-icon"></div>

            <span>YouTube</span>

        </a>



        <!-- Search -->

        <div class="search-container">

            <input
                type="text"
                placeholder="Search"
            >

            <button class="search-btn">
                🔍
            </button>

        </div>



        <!-- Header Right -->

        <div class="header-right">

            <button class="header-btn">
                🎥
            </button>

            <button class="header-btn">
                🔔
            </button>


            <!-- Profile -->

            <a
                href="{{ route('profile') }}"
                class="profile-link"
            >

                <div class="profile">
                    <img src="{{ asset('storage/'. Auth::user()->profile) }}" alt="Profile">
                </div>

            </a>

        </div>

    </header>



    <!-- ================= MAIN ================= -->

    <div class="layout">


        <!-- Sidebar -->

        <aside class="sidebar">

            <a href="/" class="sidebar-item active">

                <span class="sidebar-icon">🏠</span>

                <span>Home</span>

            </a>


            <a href="#" class="sidebar-item">

                <span class="sidebar-icon">🔥</span>

                <span>Trending</span>

            </a>


            <a href="#" class="sidebar-item">

                <span class="sidebar-icon">📺</span>

                <span>Subscriptions</span>

            </a>


            <a href="#" class="sidebar-item">

                <span class="sidebar-icon">📚</span>

                <span>Library</span>

            </a>


            <a href="#" class="sidebar-item">

                <span class="sidebar-icon">🕐</span>

                <span>History</span>

            </a>

        </aside>



        <!-- Content -->

        <main class="content">


            <!-- Categories -->

            <div class="categories">

                <button class="category active">
                    All
                </button>

                <button class="category">
                    Music
                </button>

                <button class="category">
                    Laravel
                </button>

                <button class="category">
                    Programming
                </button>

                <button class="category">
                    Gaming
                </button>

                <button class="category">
                    News
                </button>

                <button class="category">
                    Tutorials
                </button>

            </div>



            <!-- Videos -->

            <div class="video-grid">


                <!-- Video 1 -->

                <div class="video-card">

                    <div class="thumbnail">
                        ▶
                    </div>

                    <div class="video-info">

                        <div class="channel-avatar">
                            A
                        </div>

                        <div class="video-details">

                            <h3>
                                Learn Laravel From Zero
                            </h3>

                            <p class="channel-name">
                                Programming Academy
                            </p>

                            <p class="video-meta">
                                125K views • 2 days ago
                            </p>

                        </div>

                    </div>

                </div>



                <!-- Video 2 -->

                <div class="video-card">

                    <div class="thumbnail">
                        ▶
                    </div>

                    <div class="video-info">

                        <div class="channel-avatar">
                            C
                        </div>

                        <div class="video-details">

                            <h3>
                                Build Your First Website
                            </h3>

                            <p class="channel-name">
                                Code School
                            </p>

                            <p class="video-meta">
                                85K views • 5 days ago
                            </p>

                        </div>

                    </div>

                </div>



                <!-- Video 3 -->

                <div class="video-card">

                    <div class="thumbnail">
                        ▶
                    </div>

                    <div class="video-info">

                        <div class="channel-avatar">
                            T
                        </div>

                        <div class="video-details">

                            <h3>
                                PHP & Laravel Tutorial
                            </h3>

                            <p class="channel-name">
                                Tech World
                            </p>

                            <p class="video-meta">
                                240K views • 1 week ago
                            </p>

                        </div>

                    </div>

                </div>



                <!-- Video 4 -->

                <div class="video-card">

                    <div class="thumbnail">
                        ▶
                    </div>

                    <div class="video-info">

                        <div class="channel-avatar">
                            D
                        </div>

                        <div class="video-details">

                            <h3>
                                How Databases Work
                            </h3>

                            <p class="channel-name">
                                Developer Hub
                            </p>

                            <p class="video-meta">
                                67K views • 3 days ago
                            </p>

                        </div>

                    </div>

                </div>



                <!-- Video 5 -->

                <div class="video-card">

                    <div class="thumbnail">
                        ▶
                    </div>

                    <div class="video-info">

                        <div class="channel-avatar">
                            W
                        </div>

                        <div class="video-details">

                            <h3>
                                Create a Laravel Project
                            </h3>

                            <p class="channel-name">
                                Web Developers
                            </p>

                            <p class="video-meta">
                                95K views • 4 days ago
                            </p>

                        </div>

                    </div>

                </div>



                <!-- Video 6 -->

                <div class="video-card">

                    <div class="thumbnail">
                        ▶
                    </div>

                    <div class="video-info">

                        <div class="channel-avatar">
                            P
                        </div>

                        <div class="video-details">

                            <h3>
                                PHP Project For Beginners
                            </h3>

                            <p class="channel-name">
                                Programming World
                            </p>

                            <p class="video-meta">
                                310K views • 2 weeks ago
                            </p>

                        </div>

                    </div>

                </div>


            </div>

        </main>

    </div>


</body>

</html>