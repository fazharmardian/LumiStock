<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $item = Item::latest()->paginate('16');

        return view('index.user.dashboard', ['items' => $item]);
    }
}
