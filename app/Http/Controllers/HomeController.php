<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Devotional;
use App\Models\HomeLink;
use App\Models\Product;
use App\Models\QuickLink;
use App\Models\Welcome;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $home_banner = Banner::where('is_page', 0)->orderBy('order_by', 'asc')->where('status', 1)->get();
    $home_about = Welcome::first();
    $home_links = HomeLink::first();
    $quick_links = QuickLink::first();

    return view('site.home', compact('home_banner', 'home_about', 'home_links', 'quick_links'));
  }

  public function about()
  {
    $about_us = AboutUs::first();
    $home_banner = Banner::where('is_page', 1)->where('page', 'about')->where('status', 1)->first();

    return view('site.about', compact('about_us', 'home_banner'));

  }

  public function word_for_day()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'word_for_today')->where('status', 1)->first();
    $word_for_day = Devotional::where('status', 1)->where('page', 'word_for_today')->get();
    return view('site.word_for_day', compact('home_banner', 'word_for_day'));

  }

  public function blog()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'blog')->where('status', 1)->first();
    $blog = Devotional::where('status', 1)->where('page', 'blog')->get();

    return view('site.blog', compact('home_banner', 'blog'));

  }

  public function itinerary()
  {
    // dd('Hii');
    $home_banner = Banner::where('is_page', 1)->where('page', 'itinerary')->where('status', 1)->first();

    return view('site.itinerary', compact('home_banner'));

  }

  public function contact_us()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'contact')->where('status', 1)->first();

    return view('site.contact_us', compact('home_banner'));

  }

  public function prayer_request()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'prayer_request')->where('status', 1)->first();

    return view('site.prayer_request', compact('home_banner'));

  }

  public function online_donation()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_donation')->where('status', 1)->first();


    return view('site.online_donation', compact('home_banner'));

  }

  public function scheduling()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'scheduling')->where('status', 1)->first();


    return view('site.scheduling', compact('home_banner'));

  }

  public function books()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_store')->where('status', 1)->first();

    $books = Product::where('category_id', 1)->where('status', 1)->orderBy('id', 'desc')->paginate(9);


    return view('site.books', compact('home_banner', 'books'));

  }

  public function sermon_manuscripts_downloaded()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_store')->where('status', 1)->first();

    $books = Product::where('category_id', 6)->where('status', 1)->orderBy('id', 'desc')->paginate(9);


    return view('site.sermon_manuscripts_downloaded', compact('home_banner', 'books'));

  }

  public function sermon_manuscripts_shipped()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_store')->where('status', 1)->first();

    $books = Product::where('category_id', 7)->where('status', 1)->orderBy('id', 'desc')->paginate(9);


    return view('site.sermon_manuscripts_shipped', compact('home_banner', 'books'));

  }

  public function sermon_series_shipped()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_store')->where('status', 1)->first();

    $books = Product::where('category_id', 8)->where('status', 1)->orderBy('id', 'desc')->paginate(9);


    return view('site.sermon_series_shipped', compact('home_banner', 'books'));

  }

  public function workbooks_manuals()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_store')->where('status', 1)->first();

    $books = Product::where('category_id', 9)->where('status', 1)->orderBy('id', 'desc')->paginate(9);


    return view('site.workbooks_manuals', compact('home_banner', 'books'));

  }

  public function other_products()
  {
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_store')->where('status', 1)->first();

    $books = Product::where('category_id', 10)->where('status', 1)->orderBy('id', 'desc')->paginate(9);


    return view('site.other_products', compact('home_banner', 'books'));

  }
}
