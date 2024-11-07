<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Item;
use App\Models\Lending;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $item = Item::latest()->paginate('16');
        $book = Item::where('category_id', '16')->latest()->paginate('5');
        $electronic = Item::where('category_id', '17')->latest()->paginate('5');
        $furniture = Item::where('category_id', '15')->latest()->paginate('5');

        return view('index.user.dashboard', [
            'items' => $item,
            'books' => $book,
            'electronics' => $electronic,
            'furnitures' => $furniture,
        ]);
    }

    public function item(HttpRequest $request)
    {
        $search = $request->input('search');
        $qcategory = $request->input('category');

        $items = Item::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when($qcategory, function ($query, $qcategory) {
                return $query->where('category_id', $qcategory);
            })
            ->latest()
            ->paginate(10);

        $categories = Category::all();

        return view('index.user.item', [
            'items' => $items,
            'categories' => $categories
        ]);
    }


    public function lending()
    {
        $lending = Lending::where('id_user', Auth::id())->get();
        $pending = Request::where('status', 'Pending')
            ->where('id_user', Auth::id())->get();

        return view('index.user.lending', [
            'lendings' => $lending,
            'pendings' => $pending
        ]);
    }

    public function bookmark ()
    {
        $bookmark = Bookmark::where('user_id', Auth::id())
        ->with('item')
        ->latest()
        ->paginate(10);

        return view('index.user.bookmark', ['bookmarks' => $bookmark]);
    }

    public function profile ()
    {
        $item = Lending::where('id_user', Auth::id())
        ->where('status', 'returned')
        ->count();

        $send = Request::where('id_user', Auth::id())
        ->count();
        
        $approved = Request::where('id_user', Auth::id())
        ->where('status', 'approved')
        ->count();

        return view('index.user.profile', [
            'items' => $item,
            'sends' => $send,
            'approved' => $approved
        ]);
    }

    public function about()
    {
        return view('index.user.about');
    }
}
