<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Fetch data for the home page
        $page = Page::where('title', 'Home')->first();

        // Pass the $page variable to the view
        return view('pages.home', compact('page'));
    }

    

    public function work()
    {
        // Fetch data for the work page
        $page = Page::where('title', 'Our Work')->first();

        return view('pages.work', compact('page'));
    }

    public function contact()
    {
        // Fetch data for the contact page
        $page = Page::where('title', 'Contact')->first();

        return view('pages.contact', compact('page'));
    }

    public function about()
    {
        // Fetch data for the about page
        $page = Page::where('title', 'About Us')->first();

        return view('pages.about', compact('page'));
    }
}
