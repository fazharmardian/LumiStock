<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lending;
use App\Models\Request as LendingRequest;
use Illuminate\Http\Request as HttpRequest;
use Barryvdh\DomPDF\Facade\Pdf;


class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HttpRequest $request)
    {
        $search = $request->input('search');

        $lending = Lending::when($search, function ($query, $search) {
            return $query->whereHas('users', function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%");
            })->orWhereHas('items', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        })
            ->paginate(10);

        return view('index.admin.lending', ['lendings' => $lending]);
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
    public function store(HttpRequest $request)
    {
        $request->validate([
            'id_user' => ['required', 'exists:users,id'],
            'id_item' => ['required', 'exists:items,id'],
            'total_request' => ['required', 'integer', 'min:1'],
            'must_return' => ['required', 'integer', 'between:1,7'],
            'status' => ['required', 'string'],
        ]);

        $item = Item::findOrFail($request->id_item);
        $status = LendingRequest::findOrFail($request->request_id);

        if ($request->total_request > $item->amount) {
            return back()->with('message', 'Requested amount exceeds available stock.');
        }

        // Calculate the return date based on must_return days
        $returnDate = now()->addDays((int)$request->must_return);

        // Create the lending record
        Lending::create([
            'id_user' => $request->id_user,
            'id_item' => $request->id_item,
            'total_request' => $request->total_request,
            'lend_date' => now(),
            'return_date' => $returnDate,
            'status' => $request->status,
        ]);

        // Update the item's available amount
        $item->update(['amount' => $item->amount - $request->total_request]);

        // Update the status of the lending request
        $status->update(['status' => 'Approved']);

        return back()->with('message', 'Request accepted successfully.');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HttpRequest $request, Lending $lending)
    {
        $item = Item::findOrFail($request->id_item);
        $status = LendingRequest::findOrFail($request->id_request);

        $request->validate([
            'status' => ['required']
        ]);

        $lending->update([
            'status' => $request->status,
            'actual_return_date' => now()
        ]);

        $item->update(['amount' => $item->amount + $request->total_request]);
        $status->update(['status' => 'Approved']);

        return back()->with('message', 'Item Succesfully Returned');
    }

    public function generatePDF()
    {
        // Fetch all requests with their related user and item data
        $lending = Lending::with(['users', 'items'])->get();

        // Load the PDF view with the fetched requests
        $pdf = Pdf::loadView('components.admin.lendingPdf', [
            'lendings' => $lending,
        ]);

        // Return the PDF as a download response
        return $pdf->download('invoice.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lending = Lending::findOrFail($id);

        $lending->delete();

        return back()->with('message', 'Data Sucessfully Deleted');
    }
}
