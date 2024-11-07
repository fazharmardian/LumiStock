<x-layout color="bg-darkblue-500">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="sm:ml-64 sm:mt-14 mt-16">

        <div class="w-full pt-10 px-6 pb-6 sm:px-10">
            <div class="px-4 py-4 bg-darkblue-300 rounded-lg">
                <div x-data="{ open: false, editOpen: false, item: {} }" class="flex items-center justify-between">
                    <h1 class="text-3xl text-slate-200">Item</h1>
                    <button @click="open = true" class="flex items-center h-10 p-3 bg-indigo-500 rounded-md">
                        <span class="text-xl text-slate-200">
                            <i class="fa fa-add"></i>
                        </span>
                    </button>

                    <!-- Add Item Modal -->
                    <div x-show="open" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
                        <div @click.outside="open = false" class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl text-slate-200">Add Item</h2>
                                <span @click="open = false" class="cursor-pointer text-slate-200">
                                    <i class="fa fa-x"></i>
                                </span>
                            </div>

                            <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="flex flex-col mb-2">
                                    <label for="name" class="mb-1 text-sm text-slate-200">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                        required>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <label for="category_id" class="mb-1 text-sm text-slate-200">Category</label>
                                    <select name="category_id" id="category_id"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                        required>
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <label for="amount" class="mb-1 text-sm text-slate-200">Amount</label>
                                    <input type="number" name="amount" id="amount" min="1"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 border-none focus:ring-indigo-500 rounded-md p-2"
                                        required>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <label for="description" class="mb-1 text-sm text-slate-200">Description</label>
                                    <input type="text" name="description" id="description"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 border-none focus:ring-indigo-500 rounded-md p-2"
                                        required>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <label for="image" class="mb-1 text-sm text-slate-200">Image</label>
                                    <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp"
                                        class="bg-darkblue-100 text-gray-500 placeholder-gray-500 rounded-md" required>
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

                    <!-- Success Message -->
                    <div x-data="{ showSuccess: {{ session('success') ? 'true' : 'false' }} }" x-show="showSuccess"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="translate-y-full opacity-0"
                        x-transition:enter-end="translate-y-0 opacity-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="translate-y-0 opacity-100"
                        x-transition:leave-end="translate-y-full opacity-0"
                        class="fixed bottom-5 right-5 z-50 flex items-center justify-between w-72 py-2 px-4 bg-green-500 text-white rounded-lg shadow-lg"
                        style="display: none;">
                        <span class="text-sm">
                            {{ session('success') ?? 'Operation was successful!' }}
                        </span>
                        <button @click="showSuccess = false" class="ml-3 text-md">
                            <i class="fa fa-x"></i>
                        </button>
                    </div>

                </div>

                <div class="w-full my-3 border-t border-white/50"></div>

                <div class="relative overflow-x-auto sm:rounded-lg">
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute top-1 start-0 z-20 flex items-center ps-3 pointer-events-none">
                                <span class="text-gray-500">
                                    <i class="fa fa-magnifying-glass"></i>
                                </span>
                            </div>
                            <form method="GET" action="{{ route('item.index') }}" class="relative mb-4">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search items..." class="block p-2 ps-10 text-sm text-slate-200 border-none rounded-lg w-80 bg-darkblue-100 focus:border-none focus:ring-0">
                            </form>
                        </div>
                    </div>

                    <x-admin.itemTable :items="$items" :categories="$categories"></x-admin.itemTable>
                </div>

                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 mt-4 pb-4">
                    <div class="block text-transparent"></div>
                    <div>
                        {{ $items->links() }}
                    </div>
                </div>
            </div>

        </div>

    </main>
</x-layout>
