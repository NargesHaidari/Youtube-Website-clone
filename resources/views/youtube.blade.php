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

        /* ================= SEARCH ================= */

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

        /* ================= HEADER RIGHT ================= */

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

        /* ================= CATEGORIES ================= */

        .categories {
            display: flex;

            gap: 10px;

            overflow-x: auto;

            margin-bottom: 25px;

            padding-bottom: 3px;
        }

        .categories::-webkit-scrollbar {
            height: 4px;
        }

        .categories::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
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

            gap: 32px 18px;
        }

        .video-card {
            cursor: pointer;

            min-width: 0;
        }

        /* Video thumbnail */

        .thumbnail {
            width: 100%;

            aspect-ratio: 16 / 9;

            background-color: #000;

            border-radius: 10px;

            overflow: hidden;

            position: relative;

            transition: border-radius 0.2s ease;
        }

        .video-card:hover .thumbnail {
            border-radius: 6px;
        }

        .thumbnail video {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            background-color: #000;
        }

        /* ================= VIDEO INFO ================= */

        .video-info {
            display: flex;

            gap: 12px;

            margin-top: 11px;
        }

        /* Channel Avatar */

        .channel-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .channel-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .video-details {
            min-width: 0;
        }

        .video-details h3 {
            font-size: 15px;

            line-height: 21px;

            margin-bottom: 5px;

            color: #0f0f0f;

            font-weight: 600;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }

        .channel-name,
        .video-meta {
            font-size: 13px;

            color: #606060;

            line-height: 19px;
        }

        .channel-name {
            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }

        /* ================= EMPTY STATE ================= */

        .empty-videos {
            grid-column: 1 / -1;

            min-height: 300px;

            display: flex;

            flex-direction: column;

            align-items: center;
            justify-content: center;

            color: #606060;

            text-align: center;
        }

        .empty-videos-icon {
            font-size: 50px;

            margin-bottom: 15px;
        }

        .empty-videos h2 {
            font-size: 20px;

            color: #0f0f0f;

            margin-bottom: 8px;
        }

        .empty-videos p {
            font-size: 14px;
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

            .video-grid {
                grid-template-columns:
                    repeat(auto-fill, minmax(240px, 1fr));
            }
        }

        /* ================= SMALL MOBILE ================= */

        @media (max-width: 600px) {

            header {
                padding: 0 12px;
            }

            .logo span {
                display: none;
            }

            .youtube-icon {
                margin-right: 0;
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

                gap: 25px;
            }

            .thumbnail {
                border-radius: 8px;
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

                    <img
                        src="{{ asset('storage/' . Auth::user()->profile) }}"
                        alt="Profile"
                    >

                </div>

            </a>

        </div>

    </header>


    <!-- ================= MAIN ================= -->

    <div class="layout">


        <!-- ================= SIDEBAR ================= -->

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


        <!-- ================= CONTENT ================= -->

        <main class="content">


            <!-- ================= CATEGORIES ================= -->

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


            <!-- ================= VIDEOS ================= -->

            <div class="video-grid">

                @forelse($videos as $video)

                    <div class="video-card">

                        <!-- Video -->

                        <div class="thumbnail">

                            <video preload="metadata" controls>
                                <source
                                    src="{{ asset('storage/' . $video->video_path) }}"
                                    type="video/mp4"
                                >
                                Your browser does not support the video tag.
                            </video>

                        </div>


                        <!-- Video Information -->

                        <div class="video-info">

                            <!-- Channel Avatar -->

                            <div class="channel-avatar">
                                <img 
                                src="{{ asset('storage/' . $video->channel->channel_image) }}"
                                alt="{{ $video->channel->name }}" >
                            </div>


                            <!-- Details -->

                            <div class="video-details">

                                <h3>{{ $video->title }}</h3>

                                <p class="channel-name">
                                    {{ $video->channel->name ?? 'Unknown Channel' }}
                                </p>

                                <p class="video-meta">
                                    {{ $video->created_at->diffForHumans() }}
                                </p>

                            </div>
                        </div>
                    </div>

                @empty

                    <!-- No Videos -->

                    <div class="empty-videos">

                        <div class="empty-videos-icon">📺</div>
                        <h2>No videos yet</h2>
                        <p>There are no videos available to watch.</p>

                    </div>

                @endforelse

            </div>

        </main>

    </div>


</body>

</html>