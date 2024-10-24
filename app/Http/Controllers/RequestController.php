<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index(HttpRequest $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');

        $request = Request::with(['user', 'item'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas(
                    'user',
                    fn($q) =>
                    $q->where('username', 'like', "%{$search}%")
                )
                    ->orWhereHas(
                        'item',
                        fn($q) =>
                        $q->where('name', 'like', "%{$search}%")
                    );
            })
            ->when($type, fn($query) => $query->where('type', $type))
            ->where('status', 'pending')
            ->paginate(10);

        return view('index.admin.request', ['requests' => $request]);
    }

    public function approved(httpRequest $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');

        $request = Request::with(['user', 'item'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas(
                    'user',
                    fn($q) =>
                    $q->where('username', 'like', "%{$search}%")
                )
                    ->orWhereHas(
                        'item',
                        fn($q) =>
                        $q->where('name', 'like', "%{$search}%")
                    );
            })
            ->when($type, fn($query) => $query->where('type', $type))
            ->where('status', 'approved')
            ->paginate(10);

        return view('index.admin.approved', ['requests' => $request]);
    }

    public function store(HttpRequest $request)
    {
        $request->validate([
            'id_user' => ['required', 'exists:users,id'],
            'id_item' => ['required', 'exists:items,id'],
            'total_request' => ['required', 'integer', 'min:1'],
            'type' => ['required', 'string'],
            'rent_id' => ['nullable', 'exists:lendings,id'],
            'status' => ['required', 'string'],
            'return_date' => ['required', 'date', 'after_or_equal:today'],
        ]);


        Request::create([
            'id_user' => $request->id_user,
            'id_item' => $request->id_item,
            'total_request' => $request->total_request,
            'type' => $request->type,
            'rent_id' => $request->rent_id ?? null,
            'request_date' => now(),
            'status' => $request->status,
            'return_date' => $request->return_date,
        ]);

        return back()->with('message', 'Request Sent Successfully');
    }
}
