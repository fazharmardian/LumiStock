@props(['items', 'categories'])

<table class="w-full text-sm text-left border-collapse">
    <thead class="text-xs text-gray-700 uppercase bg-darkblue-500 dark:bg-darkblue-300 dark:text-gray-400">
        <tr>
            <th class="px-6 py-3 text-slate-200">No</th>
            <th class="px-6 py-3 text-slate-200">Name</th>
            <th class="px-6 py-3 text-slate-200">Category</th>
            <th class="px-6 py-3 text-slate-200">Description</th>
            <th class="px-6 py-3 text-slate-200">Stock</th>
            <th class="px-6 py-3 text-slate-200">Status</th>
            <th class="px-6 py-3 text-slate-200">Image</th>
            <th class="px-6 py-3 text-slate-200">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
            <tr class="bg-darkblue-300 border-b-2 border-darkblue-500 hover:bg-darkblue-400">
                <td class="px-6 py-4 text-slate-200">{{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }}</td>
                <td class="px-6 py-4 text-slate-200">{{ $item->name }}</td>
                <td class="px-6 py-4 text-slate-200">{{ $item->category->name }}</td>
                <td class="px-6 py-4 text-slate-200">{{ $item->description }}</td>
                <td class="px-6 py-4 text-slate-200">{{ $item->amount }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                        <span class="text-gray-500">Available</span>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="w-12 h-12 overflow-auto rounded-md bg-slate-100">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="">
                    </div>
                </td>
                <td x-data="{ openDeleteModal: false, editOpen: false }" class="px-6 py-4">
                    <div class="flex items-center gap-x-2">
                        <!-- Edit Button -->
                        <button @click="editOpen = true" class="text-yellow-500">
                            <i class="fa fa-pen"></i>
                        </button>

                        <!-- Delete Button to trigger the modal -->
                        <button @click="openDeleteModal = true" class="text-red-500">
                            <i class="fa fa-trash-can"></i>
                        </button>
                    </div>

                    <!-- Edit Item Modal -->
                    <div x-show="editOpen" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
                        <div @click.outside="editOpen = false"
                            class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl text-slate-200">Edit Item</h2>
                                <span @click="editOpen = false" class="cursor-pointer text-slate-200">
                                    <i class="fa fa-x"></i>
                                </span>
                            </div>

                            <form action="{{ route('item.update', $item->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="flex flex-col mb-2">
                                    <label for="edit_name" class="mb-1 text-sm text-slate-200">Name</label>
                                    <input type="text" name="name" id="edit_name" value="{{ $item->name }}"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                        required>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <label for="edit_category_id" class="mb-1 text-sm text-slate-200">Category</label>
                                    <select name="category_id" id="edit_category_id"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                        required>
                                        <option value="" disabled>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <label for="edit_amount" class="mb-1 text-sm text-slate-200">Amount</label>
                                    <input type="number" name="amount" id="edit_amount" min="1"
                                        value="{{ $item->amount }}"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 border-none focus:ring-indigo-500 rounded-md p-2"
                                        required>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <label for="edit_description"
                                        class="mb-1 text-sm text-slate-200">Description</label>
                                    <input name="description" id="edit_description" type="text"
                                        value="{{ $item->description }}"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 border-none focus:ring-indigo-500 rounded-md p-2"
                                        required>
                                </div>


                                <div class="flex flex-col mb-2">
                                    <label for="edit_image" class="mb-1 text-sm text-slate-200">Image</label>
                                    <input type="file" name="image" id="edit_image" accept=".jpg,.jpeg,.png,.webp"
                                        class="bg-darkblue-100 text-gray-500 placeholder-gray-500 rounded-md">
                                    <small class="text-gray-500">Leave blank to keep the current image.</small>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <button type="submit"
                                        class="flex items-center px-3 py-2 text-sm text-white bg-indigo-500 rounded-md hover:bg-indigo-600 transition">
                                        <i class="fa fa-save"></i>
                                        <span class="ml-2">Save Changes</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div x-show="openDeleteModal" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
                        <div class="bg-darkblue-500 rounded-lg p-6 w-[90%] sm:w-[400px]">
                            <h2 class="text-xl font-semibold text-slate-200 mb-4">Confirm Delete</h2>
                            <p class="text-gray-300 mb-6">Are you sure you want to delete this item? This action cannot
                                be undone.</p>

                            <div class="flex justify-end gap-x-3">
                                <!-- Cancel Button -->
                                <button @click="openDeleteModal = false"
                                    class="px-4 py-2 bg-darkblue-100 text-slate-200 rounded-md hover:bg-darkblue-200 transition">
                                    Cancel
                                </button>

                                <!-- Confirm Delete Button -->
                                <form method="POST" action="{{ route('item.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                        Delete
                                    </button>
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
