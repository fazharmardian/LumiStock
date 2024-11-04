<x-layout color="bg-darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:my-14 mt-16">
        <div class="flex flex-col w-full px-4 sm:px-10 pt-6">
            <div class="flex items-center justify-between w-full">
                <h1 class="mb-4 text-2xl text-slate-200">Bookmark Items</h1>
            </div>
            <div class="grid grid-cols-2 gap-6">
                @forelse ($bookmarks as $bookmark)
                <a href="{{ route('item.show', $bookmark->item->id) }}" 
                    class="group flex flex-col lg:flex-row items-start lg:bg-darkblue-200 rounded-xl sm:p-4 
                    transition-shadow hover:shadow-lg">
            
                    <div class="w-full aspect-square lg:w-40 h-48 overflow-hidden rounded-md bg-darkblue-400 relative">
                        <img class="object-cover w-full h-full group-hover:opacity-75 transition-opacity duration-300" 
                            src="{{ asset('storage/' . $bookmark->item->image) }}" alt="Item Image">
                    </div>
            
                    <div class="flex flex-col justify-between flex-1 mt-2 lg:mt-0 lg:ml-4 space-y-2">
                        <h2 class="text-gray-300 text-lg md:text-xl lg:text-2xl font-semibold">
                            {{ Str::limit($bookmark->item->name, 20, '...') }}
                        </h2>
            
                        <div class="hidden lg:flex items-center space-x-2">
                            <div class="h-3 w-3 rounded-full {{ $bookmark->item->amount > 0 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                            <span class="text-sm text-slate-400">
                                {{ $bookmark->item->amount > 0 ? 'Available' : 'Not Available' }}
                            </span>
                        </div>
            
                        <div class="hidden lg:inline-block w-fit mt-2 px-3 py-1 bg-darkblue-400 hover:bg-darkblue-300 rounded-lg">
                            <span class="text-slate-200 text-xs lg:text-sm">{{ $bookmark->item->category->name }}</span>
                        </div>
            
                        <p class="hidden lg:block text-gray-500 text-sm lg:text-base line-clamp-2">
                            {{ Str::limit($bookmark->item->description, 80) }}
                        </p>
                    </div>
                </a>
                @empty
                <div>
                    <h1 class="text-slate-500">There are no bookmarked items.</h1>
                </div>
                @endforelse
            </div>

            <div class="mt-6 flex justify-center">
                {{ $bookmarks->links() }}
            </div>

        </div>
    </main>
</x-layout>
