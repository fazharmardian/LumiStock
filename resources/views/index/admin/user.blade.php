<x-layout color="darkblue-500">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="sm:ml-64 sm:mt-14 mt-16">

        <div class="w-full pt-10 px-6 sm:px-10">
            <div x-data="{ open: false }" class="px-4 py-4 bg-darkblue-300 rounded-lg">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl text-slate-200">User</h1>
                    <button @click="open = true" class="flex items-center h-10 p-3 bg-indigo-500 rounded-md">
                        <span class="text-xl text-slate-200">
                            <i class="fa fa-add"></i>
                        </span>
                    </button>

                    <!-- Add Modal -->
                    <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
                        <div @click.outside="open = false" class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl text-slate-200">Add User</h2>
                                <span @click="open = false" class="cursor-pointer text-slate-200">
                                    <i class="fa fa-x"></i>
                                </span>
                            </div>
                            <form action="" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="w-full my-3 border-t border-white/50"></div>

                <div class="relative overflow-x-auto sm:rounded-lg">
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 ">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div
                                class="absolute top-1 start-0 z-50 flex items-center ps-3 pointer-events-none">
                                <span class="text-gray-500">
                                    <i class="fa fa-magnifying-glass"></i>
                                </span>
                            </div>
                            <form method="GET" action="{{ route('user.index') }}" class="relative mb-4">
                                <input type="text" name="search" id="table-search-input"
                                    class="block p-2 ps-10 text-sm text-slate-200 border-none rounded-lg w-80 bg-darkblue-100 focus:border-none focus:ring-0"
                                    placeholder="Search for users" value="{{ request('search') }}">
                            </form>                            
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right border-collapse">
                        <thead class="text-xs text-gray-700 uppercase bg-darkblue-500 dark:bg-darkblue-300 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-slate-200">User</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Position</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Status</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="bg-darkblue-300 border-b-2 border-darkblue-500 hover:bg-darkblue-400">
                                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="w-12 h-12 overflow-auto rounded-full bg-slate-100">
                                            <img src="https://picsum.photos/200" alt="">
                                        </div>
                                        <div class="ps-3">
                                            <div class="text-base font-semibold text-slate-200">{{ $user->username }}</div>
                                            <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4 text-slate-200 capitalize">{{ $user->role }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                            <span class="text-gray-500">Online</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-slate-200">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>

                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 mt-4 pb-4 ">
                    <div class="block text-transparent">
                    </div>
                    <div>
                        {{ $users->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
