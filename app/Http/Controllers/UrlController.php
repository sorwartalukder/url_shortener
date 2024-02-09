<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Url;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    public function showForm()
    {
        return view('url.form');
    }

    public function shortenUrl(Request $request)
    {
        // Validate the input
        $request->validate([
            'url' => 'required|url',
        ]);

        // Generate a short URL
        $shortUrl = Str::random(6);

        // Save the URL to the database
        Url::create([
            'original_url' => $request->input('url'),
            'short_url' => $shortUrl,
            'user_id' => Auth::user()->id ?? null,
        ]);

        // Display the original and short URLs
        return view('url.result', compact('shortUrl'));
    }
    public function redirectToOriginalUrl($shortUrl)
    {
        // Find the URL in the database
        $url = Url::where('short_url', $shortUrl)->first();

        if (!$url) {
            abort(404);
        }

        // Increment the click count
        $url->increment('click_count');

        // Redirect to the original URL
        return redirect($url->original_url);
    }
}
