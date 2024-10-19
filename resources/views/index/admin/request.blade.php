<x-layout color="darkblue-500">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="sm:ml-64 sm:mt-14 mt-16">
        
        <div class="w-full pt-10 px-6 sm:px-10">
            <div class="px-4 py-4 bg-darkblue-300 rounded-lg">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl text-slate-200">User</h1>
                    <button class="flex items-center h-10 p-3 bg-indigo-500 rounded-md">
                        <span class="text-xl text-slate-200">
                            <i class="fa fa-add"></i>
                        </span>
                    </button>
                </div>
                <div class="w-full my-3 border-t border-white/50"></div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 ">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <span class="text-gray-500">
                                    <i class="fa fa-magnifying-glass"></i>
                                </span>
                            </div>
                            <input type="text"
                                class="block p-2 ps-10 text-sm text-slate-200 border-none rounded-lg w-80 bg-darkblue-100 focus:border-none focus:ring-0"
                                placeholder="Search for users">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right border-collapse">
                        <thead class="text-xs text-gray-700 uppercase bg-darkblue-500 dark:bg-darkblue-300 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-slate-200">No</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Item</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">User</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Total</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Type</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Status</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Request Date</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Return Date</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)    
                            <tr class="bg-darkblue-300 border-b-2 border-darkblue-500 hover:bg-darkblue-400">
                                <td class="px-6 py-4 text-slate-200">{{ $loop->iteration }}</td>
                                <td scope="row" class="flex items-center px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold text-slate-200">{{ $request->item->name }}</div>
                                </th>
                                <td class="px-6 py-4 text-slate-200">{{ $request->user->username }}</td>
                                <td class="px-6 py-4 text-slate-200">{{ $request->total_request }}</td>
                                <td class="px-6 py-4 text-slate-200">{{ $request->type }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div>
                                        <span class="text-gray-500">{{ $request->status }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-200">{{ $request->request_date }}</td>
                                <td class="px-6 py-4 text-slate-200">{{ $request->return_date }}</td>
                                <td class="flex px-6 py-4 gap-x-4">
                                    <span class="text-yellow-500">
                                        <i class="fa fa-pen"></i>
                                    </span>
                                    <span class="text-red-500">
                                        <i class="fa fa-trash-can"></i>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 mt-4 pb-4 ">
                        <div>
                            {{ $requests->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
