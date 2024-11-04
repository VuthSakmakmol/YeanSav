<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::where('title', 'Home')->first();
        return view('home', ['page' => $page]);
    }

    public function service()
    {
        $page = Page::where('title', 'Service')->first();
        return view('service', ['page' => $page]);
    }

    public function work()
    {
        $page = Page::where('title', 'Work')->first();
        return view('work', ['page' => $page]);
    }

    public function contact()
    {
        $page = Page::where('title', 'Contact')->first();
        return view('contact', ['page' => $page]);
    }

    public function about()
    {
        $page = Page::where('title', 'About')->first();
        return view('about', ['page' => $page]);
    }

    public function updatePage(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();
        return redirect()->route('admin.panel')->with('success', 'Page updated successfully!');
    }
}
