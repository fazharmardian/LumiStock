<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = Item::latest()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        $categories = Category::all();

        return view('index.admin.item', [
            'items' => $items,
            'categories' => $categories,
            'search' => $search,
        ]);
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
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required'],
            'amount' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,jpeg,webp']
        ]);

        $path = Storage::disk('public')->put('item_image', $request->image);

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'image' => $path
        ]);

        return back()->with('success', 'Item added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $lending = Lending::where('status', 'lending')->where('id_item', $item->id)->get();

        return view('index.user.show', [
            'item' => $item,
            'lendings' => $lending
        ]);
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
        $request->validate([
            'name' => ['required', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required'],
            'amount' => ['required', 'numeric'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,jpeg,webp']
        ]);

        if ($request->hasFile('image')) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }

            $path = Storage::disk('public')->put('item_image', $request->image);
        } else {
            $path = $item->image;
        }

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'image' => $path
        ]);

        return back()->with('success', 'Item updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        $item->delete();

        return back()->with('success', 'Item deleted successfully.');
    }
}
