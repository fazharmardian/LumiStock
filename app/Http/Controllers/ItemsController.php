<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Item;
use App\Models\Lending;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        if ($request->expectsJson()) {
            return response()->json([
                'items' => $items,
            ], 200);
        }

        return view('index.admin.item', [
            'items' => $items,
            'categories' => $categories,
            'search' => $search,
        ]);
    }

    public function apiIndex(Request $request)
    {
        $item = Item::latest()
            ->with('category')
            ->get();

        $category = Category::all();

        return response()->json([
            'items' => $item,
            'categories' => $category,
        ], 200);
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
        $lending = Lending::whereIn('status', ['lending', 'overdue'])
            ->where('id_item', $item->id)->get();

        return view('index.user.show', [
            'item' => $item,
            'lendings' => $lending
        ]);
    }

    public function apiShow(Item $item)
    {
        return response()->json([
            'success' => true,
            'data' => $item
        ], 200);
    }

    public function addBookmark(Request $request, $itemId)
    {
        $request->validate(['item_id' => 'exists:items,id']);

        Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'item_id' => $itemId,
        ]);

        return back()->with('message', 'Item bookmarked successfully!');
    }

    public function removeBookmark($itemId)
    {
        Bookmark::where('user_id', Auth::id())
            ->where('item_id', $itemId)
            ->delete();

        return back()->with('message', 'Bookmark removed successfully!');
    }

    public function apiCheckBook($id)
    {
        $bookmarked = Bookmark::where('user_id', Auth::id())
            ->where('item_id', $id)
            ->exists();

        return response()->json([
            'bookmarked' => $bookmarked
        ]);
    }

    public function apiGetBooked($id)
    {
        $bookmark = Bookmark::where('user_id', $id)->with('item')->get();

        return response()->json([
            'bookmarks' => $bookmark
        ]);
    }

    public function apiBooked(Request $request, $id)
    {
        $validated = Validator::make(['item_id' => $id], ['item_id' => 'exists:items,id']);

        if ($validated->fails()) {
            return response()->json(['error' => 'Invalid item'], 400);
        }

        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('item_id', $id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();

            return response()->json([
                'message' => 'Successfully removed bookmark',
                'bookmarked' => false,
            ], 200);
        } else {
            $bookmark = Bookmark::create([
                'user_id' => Auth::id(),
                'item_id' => $id,
            ]);

            return response()->json([
                'data' => $bookmark,
                'message' => 'Successfully bookmarked the item',
                'bookmarked' => true,
            ], 200);
        }
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
