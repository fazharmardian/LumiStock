<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
        $item = Item::latest()->paginate(10);

        return view('index.admin.item', ['items' => $item]);
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
    public function store(Request $request, Item $items)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'category' => ['required', 'exists:categories,id'],
            'description' => ['required'],
            'amount' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,jpeg,webp']
        ]);

        $path = Storage::disk('public')->put('item_image', $request->image);

        $item = Item::create([
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
    public function show(Item $item)
    {
        $item->load('category');
        return view('index.user.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp']
        ]);

        // Store images
        $path = $item->image ?? null;
        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $path = Storage::disk('public')->put('items_image', $request->image);
        }

        // Update a item
        $item->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);

        // Redirect
        return redirect()->route('dashboard')->with('success','Your item was updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $items)
    {
        //
    }
}
