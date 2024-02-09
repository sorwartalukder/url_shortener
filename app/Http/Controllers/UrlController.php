<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    //Security
    function __construct()
    {
        $this->middleware('permission:user', ['only' => ['dashboard', 'showForm', 'shortenUrl', 'showResult']]);
    }
    // dashboard
    public function dashboard(Request $request)
    {
        $urls = Url::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(5);
        return view('dashboard', compact("urls"));
    }
    // home 
    public function showForm()
    {
        return view('url.form');
    }

    // create shorten url
    public function shortenUrl(Request $request)
    {
        $url = $this->urlCreateService($request);
        return redirect()->route('url.result', [
            'shortUrl' => $url->short_url,
            'originalUrl' => $url->original_url,
        ]);
    }

    // result
    public function showResult(Request $request)
    {
        $shortUrl = $request->get('shortUrl');
        $originalUrl = $request->get('originalUrl');

        return view('url.result', compact('shortUrl', 'originalUrl'));
    }

    // api fuction
    public function apishortenUrl(Request $request)
    {
        $url = $this->urlCreateService($request);
        return response()->json([
            'shortUrl' => url('url/' . $url->short_url),
            'originalUrl' => $url->original_url
        ], 200);
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


    private function urlCreateService($request)
    {
        // Validate the input
        $request->validate([
            'url' => 'required|url',
        ]);

        $lastUrl = Url::latest()->first();
        // Generate a short URLs
        if ($lastUrl) {
            $shortUrl = $lastUrl->id + 1;
        } else {
            $shortUrl = 1;
        }
        // Check if the generated short URL already exists
        while (Url::where('short_url', $shortUrl)->exists()) {
            $shortUrl++;
        }

        // Save the URL to the database
        $url = Url::create([
            'original_url' => $request->input('url'),
            'short_url' => $shortUrl,
            'user_id' => Auth::user()->id ?? null,
        ]);
        $url->update(['short_url' => $url->id]);
        return $url;
    }
}
