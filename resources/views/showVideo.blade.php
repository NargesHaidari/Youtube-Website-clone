@extends('layouts.app')

@section('title', $video->title . ' - YouTube')

@push('styles')
<style>
    /* =========================
       Global
    ========================= */

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: #fff;
        color: #0f0f0f;
    }

    a {
        color: inherit;
        text-decoration: none;
    }

    button,
    input {
        font: inherit;
    }

    button {
        cursor: pointer;
    }

    img {
        max-width: 100%;
    }

    /* =========================
       Header
    ========================= */

    .watch-header {
        width: 100%;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 0 28px;
        background: #fff;
        border-bottom: 1px solid #eee;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .watch-logo {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
        font-size: 21px;
        font-weight: 700;
        letter-spacing: -1px;
    }

    .youtube-icon {
        position: relative;
        width: 32px;
        height: 22px;
        flex-shrink: 0;
        background: #f00;
        border-radius: 7px;
    }

    .youtube-icon::after {
        content: "";
        position: absolute;
        left: 13px;
        top: 6px;
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
        border-left: 8px solid #fff;
    }

    .watch-search {
        display: flex;
        align-items: center;
        width: min(600px, 55%);
        height: 42px;
        margin: 0 auto;
    }

    .watch-search input {
        width: 100%;
        min-width: 0;
        height: 100%;
        padding: 0 18px;
        border: 1px solid #ccc;
        border-radius: 24px 0 0 24px;
        outline: none;
        font-size: 15px;
        background: #fff;
    }

    .watch-search input:focus {
        border-color: #1c62b9;
    }

    .watch-search button {
        width: 68px;
        height: 100%;
        flex-shrink: 0;
        border: 1px solid #ccc;
        border-left: none;
        border-radius: 0 24px 24px 0;
        background: #f8f8f8;
        font-size: 16px;
    }

    .watch-search button:hover {
        background: #eee;
    }

    .watch-profile {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        border-radius: 50%;
        overflow: hidden;
    }

    .watch-profile img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* =========================
       Main layout
    ========================= */

    .watch-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        align-items: start;
        gap: 24px;
        width: 100%;
        max-width: 1800px;
        margin: 0 auto;
        padding: 24px 28px 40px;
    }

    .watch-main {
        min-width: 0;
        width: 100%;
    }

    /* =========================
       Video player
    ========================= */

    .player {
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        background: #000;
        border-radius: 12px;
    }

    .player video {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: #000;
    }

    /* =========================
       Video title
    ========================= */

    .watch-title {
        margin: 16px 0;
        font-size: 22px;
        line-height: 1.5;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    /* =========================
       Channel information
    ========================= */

    .video-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin: 16px 0;
    }

    .channel-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .channel-avatar {
        display: block;
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        overflow: hidden;
        border-radius: 50%;
        background: #eee;
    }

    .channel-avatar img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .channel-details {
        min-width: 0;
    }

    .channel-details h3 {
        margin: 0 0 5px;
        font-size: 15px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .channel-details p {
        margin: 0;
        color: #606060;
        font-size: 12px;
    }

    /* =========================
       Subscribe button
    ========================= */

    .subscribe-btn {
        flex-shrink: 0;
        padding: 11px 17px;
        border: none;
        border-radius: 24px;
        background: #0f0f0f;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        transition: background 0.2s;
    }

    .subscribe-btn:hover {
        opacity: 0.75;
    }

    /* =========================
       Action buttons
    ========================= */

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .action-btn {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 14px;
        border: none;
        border-radius: 24px;
        background: #f2f2f2;
        color: #0f0f0f;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
        transition: background 0.2s;
    }

    .action-btn:hover {
        background: #e5e5e5;
    }

    .action-btn i {
        font-size: 16px;
    }

    .like-group {
        display: inline-flex;
        align-items: center;
        gap: 0;
        overflow: hidden;
        border-radius: 24px;
        background: #f2f2f2;
    }

    .like-group .action-btn {
        border-radius: 0;
        background: transparent;
    }

    .like-group .action-btn:hover {
        background: #e5e5e5;
    }

    .like-divider {
        display: block;
        width: 1px;
        height: 24px;
        background: #ccc;
    }

    .like-group .action-btn.liked,
    .like-group .action-btn.disliked {
        color: #065fd4;
    }

    .like-group .action-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* =========================
       Video description
    ========================= */

    .video-description {
        margin-top: 18px;
        padding: 14px 16px;
        border-radius: 12px;
        background: #f2f2f2;
        font-size: 14px;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .description-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        font-weight: 700;
    }

    .description-text {
        margin-top: 10px;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    /* =========================
       Recommended videos
    ========================= */

    .related-videos {
        width: 100%;
        min-width: 0;
    }

    .related-videos h1 {
        margin: 0 0 18px;
        font-size: 19px;
        font-weight: 700;
        line-height: 1.4;
    }

    .related-video {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        width: 100%;
        margin-bottom: 16px;
        color: #0f0f0f;
        text-decoration: none;
    }

    .related-thumbnail {
        width: 155px;
        min-width: 155px;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        border-radius: 9px;
        background: #eee;
    }

    .related-thumbnail img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.2s ease;
    }

    .related-video:hover .related-thumbnail img {
        transform: scale(1.04);
    }

    .no-thumbnail {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        padding: 8px;
        text-align: center;
        font-size: 11px;
        color: #666;
    }

    .related-info {
        flex: 1;
        min-width: 0;
    }

    .related-info h4 {
        margin: 0 0 8px;
        font-size: 14px;
        line-height: 1.45;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .related-info p,
    .related-info small {
        display: block;
        margin: 5px 0 0;
        color: #606060;
        font-size: 12px;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .related-video:hover .related-info h4 {
        color: #444;
    }

    .related-videos > p {
        color: #606060;
        font-size: 14px;
    }

    /* =========================
       Medium screens
    ========================= */

    @media (max-width: 1200px) {
        .watch-layout {
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 18px;
            padding: 22px 20px 35px;
        }

        .related-thumbnail {
            width: 130px;
            min-width: 130px;
        }

        .action-buttons {
            gap: 6px;
        }

        .action-btn {
            padding: 0 11px;
            font-size: 13px;
        }
    }

    /* =========================
       Tablet and mobile
    ========================= */

    @media (max-width: 850px) {
        .watch-layout {
            grid-template-columns: minmax(0, 1fr);
            gap: 30px;
            padding: 18px 0 30px;
        }

        .player {
            border-radius: 0;
        }

        .watch-title,
        .video-toolbar,
        .video-description {
            margin-left: 16px;
            margin-right: 16px;
        }

        .related-videos {
            padding: 0 16px;
        }

        .related-thumbnail {
            width: 190px;
            min-width: 190px;
        }

        .related-info h4 {
            font-size: 15px;
        }

        .watch-search {
            width: min(450px, 55%);
        }
    }

    /* =========================
       Small mobile
    ========================= */

    @media (max-width: 520px) {
        .watch-header {
            height: 56px;
            gap: 10px;
            padding: 0 12px;
        }

        .watch-logo {
            gap: 6px;
            font-size: 17px;
        }

        .youtube-icon {
            width: 27px;
            height: 19px;
            border-radius: 6px;
        }

        .youtube-icon::after {
            left: 11px;
            top: 5px;
            border-top-width: 4px;
            border-bottom-width: 4px;
            border-left-width: 7px;
        }

        .watch-search {
            flex: 1;
            width: auto;
            min-width: 0;
            height: 36px;
        }

        .watch-search input {
            min-width: 0;
            padding: 0 10px;
            font-size: 13px;
        }

        .watch-search button {
            width: 40px;
            font-size: 13px;
        }

        .watch-profile {
            width: 32px;
            height: 32px;
        }

        .watch-title {
            font-size: 18px;
            line-height: 1.45;
            margin-top: 14px;
        }

        .video-toolbar {
            gap: 14px;
        }

        .channel-info {
            gap: 9px;
            flex-wrap: wrap;
        }

        .channel-avatar {
            width: 38px;
            height: 38px;
        }

        .channel-details h3 {
            font-size: 13px;
        }

        .subscribe-btn {
            padding: 9px 13px;
            font-size: 12px;
        }

        .action-buttons {
            gap: 6px;
        }

        .action-btn {
            min-height: 36px;
            padding: 0 11px;
            gap: 6px;
            font-size: 12px;
        }

        .action-btn i {
            font-size: 14px;
        }

        .video-description {
            padding: 12px;
            font-size: 13px;
        }

        .related-thumbnail {
            width: 140px;
            min-width: 140px;
        }

        .related-video {
            gap: 10px;
            margin-bottom: 14px;
        }

        .related-info h4 {
            font-size: 13px;
        }

        .related-info p,
        .related-info small {
            font-size: 11px;
        }
    }
</style>
@endpush

@section('content')

@php
    $likesCount = $video->reactions()
        ->where('type', 'like')
        ->count();

    $dislikesCount = $video->reactions()
        ->where('type', 'dislike')
        ->count();

    $userReaction = auth()->check()
        ? $video->reactions()
            ->where('user_id', auth()->id())
            ->value('type')
        : null;

    $isLiked = $userReaction === 'like';
    $isDisliked = $userReaction === 'dislike';
@endphp

<header class="watch-header">
    <a href="{{ url('/youtube') }}" class="watch-logo">
        <div class="youtube-icon"></div>
        <span>YouTube</span>
    </a>

    <form class="watch-search" action="#" method="GET">
        <input type="text" placeholder="Search">
        <button type="button" aria-label="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>

    @auth
        <a href="{{ route('profile') }}" class="watch-profile">
            <img
                src="{{ Auth::user()->profile ? asset('storage/' . Auth::user()->profile) : 'https://placehold.co/80x80?text=U' }}"
                alt="Profile"
            >
        </a>
    @endauth
</header>

<main class="watch-layout">
    <section class="watch-main">
        <div class="player">
            <video controls autoplay preload="metadata" poster="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : '' }}">
                <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                Your browser does not support video playback.
            </video>
        </div>

        <h1 class="watch-title">{{ $video->title }}</h1>

        <div class="video-toolbar">
            <div class="channel-info">
                <a
                    href="#"
                    class="channel-avatar"
                    aria-label="Channel"
                >
                    <img
                        src="{{ $video->channel && $video->channel->channel_image ? asset('storage/' . $video->channel->channel_image) : 'https://placehold.co/100x100?text=C' }}"
                        alt="{{ $video->channel->name ?? 'Channel' }}"
                    >
                </a>

                <div class="channel-details">
                    <h3>{{ $video->channel->name ?? 'Unknown Channel' }}</h3>
                    <p>Channel</p>
                </div>

                <button class="subscribe-btn" type="button">
                    Subscribe
                </button>
            </div>

            <div class="action-buttons">
                <div class="like-group">
                    <button
                        id="like-button"
                        class="action-btn {{ $isLiked ? 'liked' : '' }}"
                        type="button"
                        data-type="like"
                        data-url="{{ route('video-reactions.toggle', $video->id) }}"
                        @guest
                            disabled
                            title="Please log in to react to this video."
                        @endguest
                        aria-pressed="{{ $isLiked ? 'true' : 'false' }}"
                    >
                        <i class="{{ $isLiked ? 'fa-solid' : 'fa-regular' }} fa-thumbs-up"></i>
                        <span>Like</span>
                        <span id="likes-count">{{ $likesCount }}</span>
                    </button>

                    <span class="like-divider"></span>

                    <button
                        id="dislike-button"
                        class="action-btn {{ $isDisliked ? 'disliked' : '' }}"
                        type="button"
                        data-type="dislike"
                        data-url="{{ route('video-reactions.toggle', $video->id) }}"
                        @guest
                            disabled
                            title="Please log in to react to this video."
                        @endguest
                        aria-pressed="{{ $isDisliked ? 'true' : 'false' }}"
                    >
                        <i class="{{ $isDisliked ? 'fa-solid' : 'fa-regular' }} fa-thumbs-down"></i>
                        <span id="dislikes-count">{{ $dislikesCount }}</span>
                    </button>
                </div>

                <button class="action-btn" type="button">
                    <i class="fa-solid fa-share"></i>
                    <span>Share</span>
                </button>

                <button class="action-btn" type="button">
                    <i class="fa-solid fa-download"></i>
                    <span>Download</span>
                </button>

                <button class="action-btn" type="button">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
            </div>
        </div>

        <div class="video-description">
            <div class="description-meta">
                <span>{{ $video->created_at->diffForHumans() }}</span>
                <span>Video description</span>
            </div>

            <div class="description-text">{{ $video->description ?: 'No description available for this video.' }}</div>
        </div>
    </section>

    <aside class="related-videos">

        <h1>Recommended Videos</h1>

        @forelse ($relatedVideos as $relatedVideo)

            <a
                href="{{ route('show-video', $relatedVideo->id) }}"
                class="related-video"
            >

                <div class="related-thumbnail">

                    @if ($relatedVideo->thumbnail)
                        <img
                            src="{{ asset('storage/' . $relatedVideo->thumbnail) }}"
                            alt="{{ $relatedVideo->title }}"
                        >
                    @else
                        <div class="no-thumbnail">No Thumbnail Available</div>
                    @endif

                </div>

                <div class="related-info">

                    <h4>{{ $relatedVideo->title }}</h4>

                    <p>
                        {{ $relatedVideo->channel->name ?? 'Unknown Channel' }}
                    </p>

                    @if ($relatedVideo->created_at)
                        <small>
                            {{ $relatedVideo->created_at->diffForHumans() }}
                        </small>
                    @endif

                </div>

            </a>

        @empty

            <p>No more videos to display.</p>

        @endforelse

    </aside>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const likeButton = document.getElementById('like-button');
    const dislikeButton = document.getElementById('dislike-button');

    if (!likeButton || !dislikeButton) {
        return;
    }

    const reactionButtons = [likeButton, dislikeButton];

    async function toggleReaction(button) {
        if (reactionButtons.some(btn => btn.disabled)) {
            return;
        }

        reactionButtons.forEach(btn => btn.disabled = true);

        try {
            const response = await fetch(button.dataset.url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': @json(csrf_token()),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    type: button.dataset.type
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Unable to update reaction.');
            }

            const isLiked = data.user_reaction === 'like';
            const isDisliked = data.user_reaction === 'dislike';

            likeButton.classList.toggle('liked', isLiked);
            dislikeButton.classList.toggle('disliked', isDisliked);

            likeButton.setAttribute('aria-pressed', String(isLiked));
            dislikeButton.setAttribute('aria-pressed', String(isDisliked));

            const likeIcon = likeButton.querySelector('i');
            const dislikeIcon = dislikeButton.querySelector('i');

            likeIcon.classList.toggle('fa-solid', isLiked);
            likeIcon.classList.toggle('fa-regular', !isLiked);

            dislikeIcon.classList.toggle('fa-solid', isDisliked);
            dislikeIcon.classList.toggle('fa-regular', !isDisliked);

            document.getElementById('likes-count').textContent = data.likes_count;
            document.getElementById('dislikes-count').textContent = data.dislikes_count;

        } catch (error) {
            console.error('Reaction error:', error);
            alert(error.message || 'Something went wrong. Please try again.');
        } finally {
            reactionButtons.forEach(btn => btn.disabled = false);
        }
    }

    likeButton.addEventListener('click', function () {
        toggleReaction(likeButton);
    });

    dislikeButton.addEventListener('click', function () {
        toggleReaction(dislikeButton);
    });
});
</script>

@endsection