<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() 
    {
        $item = Item::latest()->paginate('16');
        $book = Item::where('category_id', '6')->latest()->paginate('5');
        $electronic = Item::where('category_id', '1')->latest()->paginate('5');
        $furniture = Item::where('category_id', '2')->latest()->paginate('5');

        return view('index.user.dashboard', [
            'items' => $item,
            'books' => $book,
            'electronics' => $electronic,
            'furnitures' => $furniture,
        ]);
    }

    public function item()
    {
        $item = Item::latest()->paginate('10');

        return view('index.user.item', ['items' => $item,]);
    }

    public function lending()
    {
        $lending = Lending::where('id_user', Auth::id())->get();

        return view('index.user.lending', ['lendings' => $lending]);
    }
}
