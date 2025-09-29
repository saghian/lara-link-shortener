<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $allLinks = link::all();
        return view('panel.link.index', compact('allLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'linkTitle' => 'required|string|max:100|min:5',
            'mainLink' => 'required|url',
            'shortLink' => 'required|string|alpha_dash|max:50|unique:links,short_link',
            'isActive' => 'required'
        ]);

        $linkData = [
            'title' => $validated['linkTitle'],
            'main_link' => $validated['mainLink'],
            'short_link' => $validated['shortLink'],
            'is_active' => $validated['isActive'] ?? false,
            'view' => '0'
        ];

        $link = Link::create($linkData);

        return redirect()->route('link.index')
            ->with('success', 'لینک با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        //
    }
}
