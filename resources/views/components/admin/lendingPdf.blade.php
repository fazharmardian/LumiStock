<x-layout color="">
    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Rent At</th>
                    <th>Must Return At</th>
                    <th>Return At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lendings as $lending)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lending->items->name }}</td>
                        <td>{{ $lending->users->username }}</td>
                        <td>{{ $lending->status }}</td>
                        <td>{{ $lending->total_request }}</td>
                        <td>{{ $lending->lend_date }}</td>
                        <td>{{ $lending->return_date }}</td>
                        <td>{{ $lending->actual_return_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No Items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>

<style>
    body {
        font-family: Arial, sans-serif;
    }
    
    .table-container {
        width: 100%;
        margin: 20px 0;
    }
    
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
        font-size: 12px;
    }
    
    .custom-table th, .custom-table td {
        padding: 10px;
        border: 1px solid #333;
        text-align: center;
    }
    
    .custom-table th {
        background-color: #4a90e2;
        color: white;
        text-transform: uppercase;
        font-weight: bold;
    }
    
    .custom-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    .custom-table tbody tr:nth-child(odd) {
        background-color: #eaf1f8;
    }
    
    .custom-table tbody tr:hover {
        background-color: #d3e4f2;
    }
</style>
