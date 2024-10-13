<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $items = Items::all();

        return view('index.user.dashboard', ['items' => $items]);
    }
}
