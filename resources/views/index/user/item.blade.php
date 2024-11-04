<x-layout color="bg-darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:my-14 mt-16">
        <div class="flex flex-col w-full px-4 sm:px-10 pt-6">
            <div class="flex items-center justify-between w-full">
                <h1 class="mb-4 text-2xl text-slate-200">All Items</h1>
                <div class="flex items-center justify-end mb-4 gap-x-2">
                    <form method="GET" action="{{ route('item') }}" class="flex items-end gap-x-2">
                        <select name="category" onchange="this.form.submit()"
                        class="bg-darkblue-200 text-slate-200 rounded-md text-sm py-1 px-2 h-10 border-none focus:ring-0 transition duration-150 ease-in-out">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    
                </div>
            </div>
        
            <div class="grid grid-cols-2 gap-6">
                @foreach ($items as $item)
                <a href="{{ route('item.show', $item->id) }}" 
                    class="group flex flex-col sm:flex-row items-start bg-darkblue-200 rounded-xl p-4 
                    transition-shadow hover:shadow-lg">
            
                    <!-- Image Container -->
                    <div class="w-full aspect-square sm:w-40 h-48 overflow-hidden rounded-md bg-darkblue-400 relative">
                        <img class="object-cover w-full h-full group-hover:opacity-75 transition-opacity duration-300" 
                            src="{{ asset('storage/' . $item->image) }}" alt="Item Image">
                    </div>
            
                    <!-- Content Container -->
                    <div class="flex flex-col justify-between flex-1 mt-2 sm:mt-0 sm:ml-4 space-y-2">
                        <!-- Item Name -->
                        <h2 class="text-gray-300 text-lg sm:text-xl lg:text-2xl font-semibold">
                            {{ Str::limit($item->name, 20, '...') }}
                        </h2>
            
                        <!-- Availability and Category (Hidden on Small Screens) -->
                        <div class="hidden sm:flex items-center space-x-2">
                            <div class="h-3 w-3 rounded-full {{ $item->amount > 0 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                            <span class="text-sm text-slate-400">
                                {{ $item->amount > 0 ? 'Available' : 'Not Available' }}
                            </span>
                        </div>
            
                        <div class="hidden sm:inline-block w-fit mt-2 px-3 py-1 bg-darkblue-400 hover:bg-darkblue-300 rounded-lg">
                            <span class="text-slate-200 text-xs sm:text-sm">{{ $item->category->name }}</span>
                        </div>
            
                        <!-- Item Description (Hidden on Small Screens) -->
                        <p class="hidden sm:block text-gray-500 text-sm sm:text-base line-clamp-2">
                            {{ Str::limit($item->description, 80) }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
            
            <div class="mt-6 flex justify-center">
                {{ $items->links() }}
            </div>

        </div>
    </main>
</x-layout>