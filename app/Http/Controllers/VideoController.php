<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use FFMpeg\FFMpeg as FFMpegProcessor;
use FFMpeg\Coordinate\TimeCode;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        // 1. اعتبارسنجی اطلاعات فرم
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'video' => 'required|file|mimes:mp4,mov,avi,mkv,webm|max:307200',
        ]);

        // 2. ذخیره ویدیو
        $videoPath = $request->file('video')
            ->store('videos', 'public');

        // 3. ساخت نام منحصربه‌فرد برای thumbnail
        $thumbnailPath = 'thumbnails/' . Str::uuid() . '.jpg';

        try {
            // 4. ایجاد پوشه thumbnails در صورت نیاز
            Storage::disk('public')->makeDirectory('thumbnails');

            // 5. گرفتن مسیر کامل فایل ویدیو
            $fullVideoPath = Storage::disk('public')
                ->path($videoPath);

            // 6. باز کردن ویدیو با FFmpeg
            $ffmpeg = FFMpegProcessor::create();

            $videoFile = $ffmpeg->open($fullVideoPath);

            // 7. استخراج یک فریم از ثانیه اول ویدیو
            $frame = $videoFile->frame(
                TimeCode::fromSeconds(1)
            );

            // 8. ذخیره تصویر thumbnail
            $thumbnailFullPath = Storage::disk('public')
                ->path($thumbnailPath);

            $frame->save($thumbnailFullPath);

            // آزاد کردن منابع ویدیو
            $videoFile->close();

        } catch (\Throwable $e) {
            // اگر استخراج تصویر ناموفق بود،
            // فایل ویدیوی ذخیره‌شده را حذف کن
            Storage::disk('public')->delete($videoPath);

            report($e);

            return back()
                ->withInput()
                ->withErrors([
                    'video' => 'استخراج تصویر بندانگشتی ناموفق بود. لطفاً ویدیوی دیگری امتحان کنید.',
                ]);
        }

        try {
            // 9. ذخیره اطلاعات ویدیو و مسیر thumbnail در دیتابیس
            Video::create([
                'channel_id' => auth()->user()->channel->id,
                'title' => $request->title,
                'description' => $request->description,
                'video_path' => $videoPath,
                'thumbnail' => $thumbnailPath,
            ]);

        } catch (\Throwable $e) {
            // اگر ذخیره دیتابیس شکست خورد،
            // فایل‌های ساخته‌شده را حذف کن
            Storage::disk('public')->delete([
                $videoPath,
                $thumbnailPath,
            ]);

            report($e);

            return back()
                ->withInput()
                ->withErrors([
                    'video' => 'ذخیره اطلاعات ویدیو ناموفق بود. لطفاً دوباره تلاش کنید.',
                ]);
        }

        // 10. بازگشت به صفحه اصلی
        return redirect()->route('youtube');
    }

    public function index(){
        $videos = Video::with('channel')
            ->latest()
            ->get();

        return view('youtube', compact('videos'));
    }
}