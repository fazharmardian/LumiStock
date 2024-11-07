<x-layout color="bg-darkblue-500">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="sm:ml-64 sm:mt-14 mt-16">

        <div class="w-full pt-10 px-6 sm:px-10">
            <div class="px-4 py-4 bg-darkblue-300 rounded-lg">
                <div x-data="{ open: false }" class="flex items-center justify-between">
                    <h1 class="text-3xl text-slate-200">Category</h1>
                    <button @click="open = true" class="flex items-center h-10 p-3 bg-indigo-500 rounded-md">
                        <span class="text-xl text-slate-200">
                            <i class="fa fa-add"></i>
                        </span>
                    </button>

                    <div x-show="open" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
                        <div @click.outside="open = false" class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl text-slate-200">Add Category</h2>
                                <span @click="open = false" class="cursor-pointer text-slate-200">
                                    <i class="fa fa-x"></i>
                                </span>
                            </div>
                            <form action="{{ route('category.store') }}" method="post">
                                @csrf
                                <div class="flex flex-col mb-2">
                                    <label for="name" class="mb-1 text-sm text-slate-200">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                        required>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <button type="submit"
                                        class="flex items-center px-3 py-2 text-sm text-white bg-indigo-500 rounded-md hover:bg-indigo-600 transition">
                                        <i class="fa fa-plus"></i>
                                        <span class="ml-2">Add</span>
                                    </button>
                                </div>
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
                            <div class="absolute top-1 start-0 z-20 flex items-center ps-3 pointer-events-none">
                                <span class="text-gray-500">
                                    <i class="fa fa-magnifying-glass"></i>
                                </span>
                            </div>
                            <form method="GET" action="{{ route('category.index') }}" class="relative mb-4">
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
                                <th class="px-6 py-3 text-slate-200">Name</th>
                                <th class="px-6 py-3 text-slate-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr class="bg-darkblue-300 border-b-2 border-darkblue-500 hover:bg-darkblue-400">
                                    <td class="px-6 py-4 text-slate-200">
                                        {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-200">{{ $category->name }}</td>
                                    <td class="flex px-6 py-4">
                                        <div x-data="{ edit: false, deleteModal: false }" class="flex items-center gap-x-2">
                                            <button @click="edit = true" class="ms-1 text-yellow-500">
                                                <span><i class="fa fa-pen"></i></span>
                                            </button>
                                            <button @click="deleteModal = true" class="ms-1 text-red-500">
                                                <span><i class="fa fa-trash-can"></i></span>
                                            </button>

                                            {{-- Edit Modal --}}
                                            <div x-show="edit" x-transition
                                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
                                                x-cloak>
                                                <div @click.outside="edit = false"
                                                    class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h2 class="text-xl text-slate-200">Edit Category</h2>
                                                        <span @click="edit = false"
                                                            class="cursor-pointer text-slate-200">
                                                            <i class="fa fa-x"></i>
                                                        </span>
                                                    </div>
                                                    <form action="{{ route('category.update', $category->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="flex flex-col mb-2">
                                                            <label for="name"
                                                                class="mb-1 text-sm text-slate-200">Name</label>
                                                            <input type="text" name="name" id="name"
                                                                value="{{ $category->name }}"
                                                                class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                                                required>
                                                        </div>
                                                        <div class="flex justify-end mt-4">
                                                            <button type="submit"
                                                                class="flex items-center px-3 py-2 text-sm text-white bg-indigo-500 rounded-md hover:bg-indigo-600 transition">
                                                                <i class="fa fa-floppy-disk"></i>
                                                                <span class="ml-2">Save</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>

                                            {{-- Delete Modal --}}
                                            <div x-show="deleteModal" x-cloak
                                                class="fixed inset-0 z-50 flex justify-center items-center bg-black/50">
                                                <div @click.outside="deleteModal = false"
                                                    class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h2 class="text-xl text-slate-200">Delete Category</h2>
                                                        <span @click="deleteModal = false"
                                                            class="cursor-pointer text-slate-200">
                                                            <i class="fa fa-x"></i>
                                                        </span>
                                                    </div>
                                                    <p class="text-gray-500 mb-6">Are you sure you want to delete this
                                                        category ?</p>
                                                    <form action="{{ route('category.destroy', $category) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="flex justify-between">
                                                            <div class="block"></div>
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800 transition">
                                                                <i class="fa fa-xmark"></i>
                                                                <span class="ms-1">Delete</span>
                                                            </button>
                                                        </div>
                                                    </form>
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
                        {{ $categories->links() }}
                    </div>
                </div>

                <div x-data="{ showSuccess: {{ session('message') ? 'true' : 'false' }} }" x-show="showSuccess"
                    x-transition:enter="transition ease-out duration-300"
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
