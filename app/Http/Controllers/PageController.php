<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function home()
{
    $page = Page::where('title', 'Home')->first(); // Fetch page data by title
    return view('home', compact('page'));
}

public function service()
{
    $page = Page::where('title', 'Service')->first(); // Fetch page data by title
    return view('service', compact('page'));
}

public function work()
{
    $page = Page::where('title', 'Work')->first(); // Fetch page data by title
    return view('work', compact('page'));
}

public function contact()
{
    $page = Page::where('title', 'Contact')->first(); // Fetch page data by title
    return view('contact', compact('page'));
}

public function about()
{
    $page = Page::where('title', 'About')->first(); // Fetch page data by title
    return view('about', compact('page'));
}


public function updatePage(Request $request)
{
    // Set default values if none are provided
    $request['title'] = $request->title ?? 'Default Title';
    $request['content'] = $request->content ?? 'Default Content';
    $request['color'] = $request->color ?? '#000000'; // Default to black
    $request['font'] = $request->font ?? 'Arial'; // Default to Arial
    $request['description'] = $request->description ?? 'Default Description';

    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'color' => 'nullable|string',
        'font' => 'nullable|string',
        'description' => 'nullable|string',
        'image' => 'nullable|image',
    ]);

    $page = Page::findOrFail($request->id);

    $page->title = $request->title;
    $page->content = $request->content;
    $page->color = $request->color;
    $page->font = $request->font;
    $page->description = $request->description;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $page->image_path = $imagePath;
    }

    $page->save();

    return redirect()->route('admin.panel')->with('success', 'Page updated successfully!');
}

public function createPage()
{
    return view('admin.create');
}
public function storePage(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'color' => 'nullable|string',
        'font' => 'nullable|string',
        'description' => 'nullable|string',
        'image' => 'nullable|image',
    ]);

    $page = new Page();
    $page->title = $request->title;
    $page->content = $request->content;
    $page->color = $request->color;
    $page->font = $request->font;
    $page->description = $request->description;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public'); // Saves to storage/app/public/images
        $page->image_path = $imagePath;
    }

    $page->save();

    return redirect()->route('admin.panel')->with('success', 'Page created successfully!');
}


public function deletePage($id)
{
    $page = Page::findOrFail($id);
    $page->delete();

    return redirect()->route('admin.panel')->with('success', 'Page deleted successfully!');
}

public function adminPanel()
{
    $pages = Page::all();
    return view('admin.panel', compact('pages'));
}

public function editPage($id)
{
    $page = Page::findOrFail($id); // Fetch the page by its ID
    return view('admin.edit', compact('page')); // Return the edit view with page data
}

}
