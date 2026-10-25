<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $channel->name }} - My Channel</title>

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
            height: 58px;
            background: white;
            border-bottom: 1px solid #e5e5e5;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 20px;

            position: sticky;
            top: 0;
            z-index: 10;
        }

        .home-btn {
            text-decoration: none;
            color: #0f0f0f;

            font-size: 14px;
            font-weight: 500;

            padding: 7px 11px;
            border-radius: 7px;

            transition: 0.2s;
        }

        .home-btn:hover {
            background: #f2f2f2;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 6px;

            font-size: 19px;
            font-weight: bold;
        }

        .youtube-icon {
            width: 30px;
            height: 21px;

            background: #ff0000;
            border-radius: 6px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;
            font-size: 11px;
        }


        /* ================= MAIN ================= */

        .channel-container {
            width: 90%;
            max-width: 900px;

            margin: 25px auto;
        }


        /* ================= CHANNEL HEADER ================= */

        .channel-header {
            background: white;

            border: 1px solid #e5e5e5;
            border-radius: 10px;

            padding: 25px;

            display: flex;
            align-items: center;

            gap: 20px;
        }

        .channel-image {
            width: 95px;
            height: 95px;

            border-radius: 50%;
            overflow: hidden;

            flex-shrink: 0;
        }

        .channel-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .channel-info h1 {
            font-size: 24px;
            margin-bottom: 6px;
        }

        .channel-handle {
            color: #606060;

            font-size: 14px;

            margin-bottom: 8px;
        }

        .channel-description {
            color: #444;

            font-size: 14px;
            line-height: 1.5;

            max-width: 600px;
        }


        /* ================= CONTENT GRID ================= */

        .content-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 18px;

            margin-top: 18px;
        }


        /* ================= CARD ================= */

        .card {
            background: white;

            border: 1px solid #e5e5e5;
            border-radius: 10px;

            padding: 20px;
        }

        .card h2 {
            font-size: 18px;

            margin-bottom: 16px;
        }


        /* ================= CHANNEL DETAILS ================= */

        .detail {
            background: #f7f7f7;

            padding: 12px;

            border-radius: 7px;

            margin-bottom: 10px;
        }

        .detail:last-child {
            margin-bottom: 0;
        }

        .detail span {
            display: block;

            color: #606060;

            font-size: 12px;

            margin-bottom: 4px;
        }

        .detail strong {
            font-size: 14px;

            word-break: break-word;
        }


        /* ================= UPLOAD ================= */

        .upload-form {
            display: flex;
            flex-direction: column;

            gap: 12px;
        }

        .form-group {
            display: flex;
            flex-direction: column;

            gap: 5px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;

            padding: 10px;

            border: 1px solid #d5d5d5;
            border-radius: 7px;

            font-family: Arial, sans-serif;
            font-size: 13px;

            outline: none;

            background: white;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #888;
        }

        .form-group textarea {
            height: 75px;

            resize: vertical;
        }

        .form-group input[type="file"] {
            padding: 8px;

            background: #fafafa;

            cursor: pointer;
        }

        .upload-btn {
            width: 100%;

            border: none;
            border-radius: 7px;

            padding: 10px;

            background: #ff0000;
            color: white;

            font-size: 14px;
            font-weight: bold;

            cursor: pointer;

            transition: 0.2s;
        }

        .upload-btn:hover {
            background: #cc0000;
        }


        /* ================= RESPONSIVE ================= */

        @media (max-width: 700px) {

            .header {
                padding: 0 12px;
            }

            .channel-container {
                width: 94%;

                margin: 18px auto;
            }

            .channel-header {
                padding: 20px;

                gap: 15px;
            }

            .channel-image {
                width: 75px;
                height: 75px;
            }

            .channel-info h1 {
                font-size: 20px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }


        @media (max-width: 500px) {

            .channel-header {
                flex-direction: column;

                text-align: center;
            }

            .channel-description {
                text-align: center;
            }

            .logo {
                font-size: 17px;
            }
        }

    </style>
</head>


<body>


    <!-- ================= HEADER ================= -->

    <header class="header">
        
        <div class="logo">
            <div class="youtube-icon">▶</div>
            YouTube
        </div>

        <a href="{{ route('youtube') }}" class="home-btn">← Home</a>

    </header>



    <!-- ================= MAIN ================= -->

    <main class="channel-container">


        <!-- ================= CHANNEL HEADER ================= -->

        <section class="channel-header">

            <div class="channel-image">

                <img
                    src="{{ asset('storage/' . $channel->channel_image) }}"
                    alt="{{ $channel->name }}"
                >

            </div>


            <div class="channel-info">

                <h1>
                    {{ $channel->name }}
                </h1>

                <p class="channel-handle">
                    {{ $channel->handle }}
                </p>

                <p class="channel-description">

                    {{ $channel->description ?: 'No description' }}

                </p>

            </div>

        </section>



        <!-- ================= TWO COLUMNS ================= -->

        <div class="content-grid">


            <!-- ================= CHANNEL INFORMATION ================= -->

            <section class="card">

                <h2>
                    Channel Information
                </h2>


                <div class="detail">

                    <span>
                        Channel Name
                    </span>

                    <strong>
                        {{ $channel->name }}
                    </strong>

                </div>


                <div class="detail">

                    <span>
                        Handle
                    </span>

                    <strong>
                        {{ $channel->handle }}
                    </strong>

                </div>


                <div class="detail">

                    <span>
                        Description
                    </span>

                    <strong>
                        {{ $channel->description ?: 'No description' }}
                    </strong>

                </div>

            </section>



            <!-- ================= UPLOAD VIDEO ================= -->

            <section class="card">

                <h2>
                    Upload Video
                </h2>


                <form
                    action="{{ route('video.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="upload-form"
                >

                    @csrf


                    <!-- Title -->

                    <div class="form-group">

                        <label for="title">
                            Video Title
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Enter video title"
                            required
                        >

                    </div>



                    <!-- Description -->

                    <div class="form-group">

                        <label for="description">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            placeholder="Write a description..."
                        ></textarea>

                    </div>



                    <!-- Video -->

                    <div class="form-group">

                        <label for="video">
                            Video File
                        </label>

                        <input
                            type="file"
                            id="video"
                            name="video"
                            accept="video/*"
                            required
                        >

                    </div>



                    <!-- Upload Button -->

                    <button
                        type="submit"
                        class="upload-btn"
                    >
                        Upload Video
                    </button>

                </form>

            </section>


        </div>


    </main>


</body>
</html>