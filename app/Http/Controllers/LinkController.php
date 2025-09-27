<?php

namespace App\Http\Controllers;

use App\Models\link;
use App\Http\Requests\StorelinkRequest;
use App\Http\Requests\UpdatelinkRequest;

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
    public function create($request)
    {
        ds($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorelinkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelinkRequest $request, link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(link $link)
    {
        //
    }
}
