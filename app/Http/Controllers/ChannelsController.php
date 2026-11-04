<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;

class ChannelsController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'name' => 'required|string',
            'handle' => 'required|string|unique:channels,handle',
            'description' => 'nullable|string',
            'channel_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $channelPath = $request->file('channel_image')->store('channels', 'public');

        Channel::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'handle' => $request->handle,
            'description' => $request->description,
            'channel_image' => $channelPath
        ]);

        return redirect()->route('myChannel');
    }

    public function edit()
    {
        $channel = Channel::where('user_id', Auth::id())->firstOrFail();

        return view('editChannel', compact('channel'));
    }

    public function update(Request $request)
    {
        $channel = Channel::where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'handle' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'channel_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('channel_image')) {
            $validated['channel_image'] = $request->file('channel_image')
                ->store('channels', 'public');
        }

        $channel->update($validated);

        return redirect()->route('myChannel')
            ->with('success', 'Channel updated successfully!');
    }
}
