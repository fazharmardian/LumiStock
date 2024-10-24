<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lending;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $user = User::count();
        $item = Item::count();
        $request = ModelsRequest::count();
        $lending = Lending::count();

        return view('index.admin.dashboard', [
            'total_user' => $user,
            'total_item' => $item,
            'total_request' => $request,
            'total_lending' => $lending,
        ]);
    }
}