<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index.admin.item');
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
    public function store(Request $request, Items $items)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'category' => ['required','exists:categories,id'],
            'description' => ['required'],
            'amount' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,jpeg,webp']
        ]);

        $path = Storage::disk('public')->put('item_image', $request->image);

        $item = Items::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'amount' => $request->amount,
            'image' => $path
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Items $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Items $items)
    {
        //
    }
}
