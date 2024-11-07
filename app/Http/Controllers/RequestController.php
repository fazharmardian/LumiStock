<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Barryvdh\DomPDF\Facade\Pdf;
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
            'return_date' => ['nullable'],
            'must_return' => ['nullable', 'integer', 'between:1,7'],
        ]);

        $existingRequest = Request::where('id_user', $request->id_user)
            ->where('id_item', $request->id_item)
            ->where('status', 'pending')
            ->first();

        $borrowed = Lending::where('id_user', $request->id_user)
            ->where('id_item', $request->id_item)
            ->whereNotNull('actual_return_date')
            ->first();

        if ($existingRequest || $borrowed) {
            return back()->withErrors(['message' => 'You already requested or borrowed this item.']);
        }

        Request::create([
            'id_user' => $request->id_user,
            'id_item' => $request->id_item,
            'total_request' => $request->total_request,
            'type' => $request->type,
            'rent_id' => $request->rent_id ?? null,
            'request_date' => now(),
            'status' => $request->status,
            'return_date' => $request->return_date,
            'must_return' => $request->must_return,
        ]);

        return back()->with('message', 'Request Sent Successfully');
    }

    public function generatePDF()
    {
        // Fetch all requests with their related user and item data
        $requests = Request::with(['user', 'item'])->get();

        // Load the PDF view with the fetched requests
        $pdf = Pdf::loadView('components.admin.requestPdf', [
            'requests' => $requests,
        ]);

        // Return the PDF as a download response
        return $pdf->download('invoice.pdf');
    }

    public function apiIndex()
    {
        try {
            $lending = Lending::where('id_user', Auth::id())
                ->with(['users', 'items'])
                ->get();
            $pending = Request::where('status', 'Pending')
                ->where('id_user', Auth::id())
                ->with(['user', 'item'])
                ->get();

            return response()->json([
                'lendings' => $lending,
                'pendings' => $pending
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching data.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function apiStore(HttpRequest $request)
    {
        // Validate the request input
        $validatedData = $request->validate([
            'id_user' => ['required', 'exists:users,id'],
            'id_item' => ['required', 'exists:items,id'],
            'total_request' => ['required', 'integer', 'min:1'],
            'type' => ['required', 'string'],
            'rent_id' => ['nullable', 'exists:lendings,id'],
            'status' => ['required', 'string'],
            'return_date' => ['nullable'],
            'must_return' => ['nullable', 'integer', 'between:1,7'],
        ]);

        // Check if the user has an existing pending request for the item
        $existingRequest = Request::where('id_user', $request->id_user)
            ->where('id_item', $request->id_item)
            ->where('status', 'pending')
            ->first();

        // Check if the user has already borrowed the item and it’s still in "lending" status
        $borrowed = Lending::where('id_user', $request->id_user)
            ->where('id_item', $request->id_item)
            ->whereNotNull('actual_return_date')
            ->first();

        if ($existingRequest || $borrowed) {
            return response()->json([
                'success' => false,
                'message' => 'You already requested or borrowed this item.',
            ], 400); // 400 Bad Request
        }

        // Create a new request record
        $newRequest = Request::create([
            'id_user' => $request->id_user,
            'id_item' => $request->id_item,
            'total_request' => $request->total_request,
            'type' => $request->type,
            'rent_id' => $request->rent_id ?? null,
            'request_date' => now(),
            'status' => $request->status,
            'return_date' => $request->return_date,
            'must_return' => $request->must_return,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Request Sent Successfully',
            'data' => $newRequest,
        ], 201); // 201 Created
    }

    public function apiDestroy($id)
    {
        $requestRecord = Request::find($id);
        $requestRecord->delete();

        return response()->json(['message' => 'Request cancelled successfully'], 200);
    }


    public function destroy(Request $request)
    {
        $request->delete();

        return back()->with('message', 'Request cancelled succesfuly');
    }
}
