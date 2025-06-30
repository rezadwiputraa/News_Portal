<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Banner;
use App\Models\BannerAdvertisement;
use App\Models\News;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $featureds = News::where('is_featured', true)->get();
        $news = News::orderBy('created_at', 'desc')->get()->take(4);
        $authors = Author::all()->take(4);
        $advertisements = BannerAdvertisement::orderBy('created_at', 'desc')->get()->take(1);

        return view('pages.landing', compact('banners', 'featureds', 'news', 'authors', 'advertisements'));
    }

}
