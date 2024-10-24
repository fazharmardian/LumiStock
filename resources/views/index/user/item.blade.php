<x-layout color="darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:my-14 mt-16">
        <div class="flex flex-col w-full px-4 sm:px-10 pt-6">
            <h1 class="mb-4 text-2xl text-slate-200">All Items</h1>
        
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach ($items as $item)
                <a href="{{ route('item.show', $item->id) }}" 
                    class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-4 bg-darkblue-200 
                    rounded-xl p-4 transition-shadow hover:shadow-lg">
        
                    <div class="w-full sm:w-40 h-48 overflow-hidden rounded-md bg-darkblue-400 relative">
                        <img class="object-cover w-full h-full group-hover:opacity-75 transition-opacity duration-300" 
                            src="{{ asset('storage/' . $item->image) }}" alt="Item Image">
                    </div>
        
                    <div class="flex flex-col justify-between flex-1">
                        <h2 class="text-gray-300 text-lg sm:text-xl lg:text-2xl font-semibold">
                            {{ Str::limit($item->name, 20, '...') }}
                        </h2>
        
                        <div class="flex items-center mt-2 space-x-2">
                            <div class="h-3 w-3 rounded-full {{ $item->amount > 0 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                            <span class="text-sm text-slate-400">
                                {{ $item->amount > 0 ? 'Available' : 'Not Available' }}
                            </span>
                        </div>
        
                        <div class="w-fit mt-2 inline-block px-3 py-1 bg-darkblue-400 hover:bg-darkblue-300 rounded-lg">
                            <span class="text-slate-200 text-xs sm:text-sm">{{ $item->category->name }}</span>
                        </div>
        
                        <p class="mt-2 ms-1 text-gray-500 text-sm sm:text-base line-clamp-2">
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