
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Channel</title>
    <link rel="stylesheet" href="{{ asset('css/channel-edit.css') }}">
    
    <style>   
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            color: #222;
            padding: 25px 15px;
        }

        .edit-container {
            max-width: 550px;
            margin: auto;
            background: white;
            border-radius: 10px;
            padding: 22px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        .edit-header {
            margin-bottom: 20px;
        }

        .edit-header h1 {
            font-size: 21px;
            margin-bottom: 5px;
        }

        .edit-header p {
            font-size: 12px;
            color: #777;
        }

        .form-section {
            padding: 17px 0;
            border-top: 1px solid #eee;
        }

        .form-section h2 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 9px 11px;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
            font-size: 12px;
            font-family: inherit;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
        }

        .image-preview {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .image-preview img {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #eee;
        }

        .upload-btn {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            font-size: 11px;
        }

        .upload-btn:hover {
            background: #f3f4f6;
        }

        .image-info p {
            font-size: 10px;
            color: #888;
            margin-top: 7px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            border-top: 1px solid #eee;
            padding-top: 16px;
        }

        .cancel-btn,
        .save-btn {
            padding: 9px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .cancel-btn {
            color: #333;
            border: 1px solid #ddd;
            background: white;
        }

        .save-btn {
            background: #FF0000;
            color: white;
            border: none;
        }

        .save-btn:hover {
            opacity: 0.7;
        }

        .save-btn:active {
            opacity: 0.5;
        }

        .error {
            display: block;
            color: #dc2626;
            font-size: 11px;
            margin-top: 5px;
        }

        @media (max-width: 500px) {
            body {
                padding: 12px;
            }

            .edit-container {
                padding: 17px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions a,
            .form-actions button {
                text-align: center;
                width: 100%;
            }
        }

    </style>

</head>
<body>

<div class="edit-container">

    <div class="edit-header">
        <h1>Customize Channel</h1>
    </div>

    <form action="{{ route('channel.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-section">

            <div class="form-group">
                <label for="name">Channel Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $channel->name) }}"
                    placeholder="Enter channel name"
                    required
                >
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="handle">Handle</label>
                <input
                    type="text"
                    id="handle"
                    name="handle"
                    value="{{ old('handle', $channel->handle) }}"
                    placeholder="@yourchannel"
                    required
                >
                @error('handle')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Tell people about your channel..."
                >{{ old('description', $channel->description) }}</textarea>

                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="form-section">

            <h2>Profile Picture</h2>

            <div class="image-preview">

                @if($channel->channel_image)
                    <img
                        src="{{ asset('storage/' . $channel->channel_image) }}"
                        id="preview"
                        alt="Channel Image"
                    >
                @else
                    <img
                        src="https://placehold.co/120x120?text=Channel"
                        id="preview"
                        alt="Channel Image"
                    >
                @endif

                <div class="image-info">
                    <label for="channel_image" class="upload-btn">
                        Change Picture
                    </label>

                    <input
                        type="file"
                        id="channel_image"
                        name="channel_image"
                        accept="image/*"
                        hidden
                    >

                    <p>JPG, PNG or WEBP. Maximum size: 2MB.</p>
                </div>

            </div>

            @error('channel_image')
                <span class="error">{{ $message }}</span>
            @enderror

        </div>

        <div class="form-actions">
            <a href="{{ url('/myChannel') }}" class="cancel-btn">
                Cancel
            </a>

            <button type="submit" class="save-btn">
                Save Changes
            </button>
        </div>

    </form>

</div>

<script>
    const imageInput = document.getElementById('channel_image');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    });
</script>

</body>
</html>
