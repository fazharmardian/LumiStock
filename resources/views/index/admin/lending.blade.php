<x-layout color="bg-darkblue-500">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="sm:ml-64 sm:mt-14 mt-16">

        <div class="w-full pt-10 px-6 sm:px-10">
            <div class="px-4 py-4 bg-darkblue-300 rounded-lg">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl text-slate-200">Lending</h1>
                </div>
                <div class="w-full my-3 border-t border-white/50"></div>

                <div class="relative overflow-x-auto sm:rounded-lg">
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 ">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute top-1 start-0 z-20 flex items-center ps-3 pointer-events-none">
                                <span class="text-gray-500">
                                    <i class="fa fa-magnifying-glass"></i>
                                </span>
                            </div>
                            <form method="GET" action="{{ route('lending.index') }}" class="relative mb-4">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search items..."
                                    class="block p-2 ps-10 text-sm text-slate-200 border-none rounded-lg w-80 bg-darkblue-100 focus:border-none focus:ring-0">
                            </form>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left border-collapse">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-darkblue-500 dark:bg-darkblue-300 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3 text-slate-200">No</th>
                                <th class="px-6 py-3 text-slate-200">User</th>
                                <th class="px-6 py-3 text-slate-200">Item</th>
                                <th class="px-6 py-3 text-slate-200">Status</th>
                                <th class="px-6 py-3 text-slate-200">Total</th>
                                <th class="px-6 py-3 text-slate-200">Rent At</th>
                                <th class="px-6 py-3 text-slate-200">Must Return At</th>
                                <th class="px-6 py-3 text-slate-200 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lendings as $lending)
                                <tr class="bg-darkblue-300 border-b-2 border-darkblue-500 hover:bg-darkblue-400">
                                    <td class="px-6 py-4 text-slate-200">
                                        {{ ($lendings->currentPage() - 1) * $lendings->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 text-lg text-slate-200">{{ $lending->users->username }}</td>
                                    <td class="px-6 py-4 text-slate-200">{{ $lending->items->name }}</td>
                                    <td class="px-6 py-4 text-slate-200">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full me-2 
                                                {{ $lending->status === 'Returned' ? 'bg-green-500' : ($lending->status === 'Overdue' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                            </div>
                                            <span>
                                                {{ $lending->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-200">{{ $lending->total_request }}</td>
                                    <td class="px-6 py-4 text-slate-200">{{ $lending->lend_date }}</td>
                                    <td class="px-6 py-4 text-slate-200">{{ $lending->return_date }}</td>
                                    <td class="flex justify-center px-6 py-4">
                                        <div x-data="{ accept: false }" class="flex items-center gap-x-2">
                                            <button @click="accept = true" class="ms-1 text-red-500">
                                                <i class="fa fa-trash-can"></i>
                                            </button>

                                            {{-- <!-- Accept Modal -->
                                            <div x-show="accept" x-cloak
                                                class="fixed inset-0 z-50 flex justify-center items-center bg-black/50">
                                                <div @click.outside="accept = false"
                                                    class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h2 class="text-xl text-slate-200">Accept Request</h2>
                                                        <span @click="accept = false"
                                                            class="cursor-pointer text-slate-200">
                                                            <i class="fa fa-x"></i>
                                                        </span>
                                                    </div>
                                                    <p class="text-gray-500 mb-6">Are you sure you want to accept this
                                                        {{ $lending->items->name }} request?</p>
                                                    <form action="{{ route('request.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="rent_id"
                                                            value="{{ $lending->id }}">
                                                        <input type="hidden" name="id_user"
                                                            value="{{ $lending->id_user }}">
                                                        <input type="hidden" name="id_item"
                                                            value="{{ $lending->id_item }}">
                                                        <input type="hidden" name="total_request"
                                                            value="{{ $lending->total_request }}">
                                                        <input type="hidden" name="return_date"
                                                            value="{{ $lending->return_date }}">
                                                        <input type="hidden" name="status" value="Pending">
                                                        <input type="hidden" name="type" value="Returning">
                                                        <div class="flex justify-between">
                                                            <div class="block"></div>
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-700 transition">
                                                                <i class="fa fa-check"></i>
                                                                <span class="ms-1">Accept</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div> --}}

                                            <!-- Accept Modal -->
                                            <div x-show="accept" x-cloak
                                                class="fixed inset-0 z-50 flex justify-center items-center bg-black/50">
                                                <div @click.outside="accept = false"
                                                    class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h2 class="text-xl text-slate-200">Delete Items</h2>
                                                        <span @click="accept = false"
                                                            class="cursor-pointer text-slate-200">
                                                            <i class="fa fa-x"></i>
                                                        </span>
                                                    </div>
                                                    <p class="text-gray-500 mb-6">Are you sure you want to accept this
                                                        Items ?
                                                        This action cannot be undone</p>
                                                    <form action="{{ route('lending.destroy', $lending->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="flex justify-between">
                                                            <div class="block"></div>
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 transition">
                                                                <i class="fa fa-check"></i>
                                                                <span class="ms-1">Accept</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-slate-200">
                                        <div class="flex justify-center items-center h-full">
                                            No Items found.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 mt-4 pb-4 ">
                    <div class="block"></div>
                    <div>
                        {{ $lendings->links() }}
                    </div>
                </div>

                <div x-data="{ showSuccess: {{ session('message') ? 'true' : 'false' }} }" x-show="showSuccess" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="translate-y-full opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="translate-y-full opacity-0"
                    class="fixed bottom-5 right-5 z-50 flex items-center justify-between w-72 py-2 px-4 bg-green-500 text-white rounded-lg shadow-lg"
                    style="display: none;">
                    <span class="text-sm">
                        {{ session('message') ?? 'Operation was successful!' }}
                    </span>
                    <button @click="showSuccess = false" class="ml-3 text-md">
                        <i class="fa fa-x"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>
</x-layout>
