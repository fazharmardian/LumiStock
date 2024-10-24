<x-layout color="darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:my-14 mt-16">
        <div class="flex flex-col w-full px-4 sm:px-10 pt-6">
            
            <div class="flex flex-col items-start justify-start pt-4 rounded-xl bg-darkblue-400 h-[250px] sm:h-[300px]">
                <h1 class="mb-4 mx-4 text-2xl text-slate-400">Your Borrowed Items</h1>
            
                <!-- Scrollable Container -->
                <div class="flex flex-col w-full max-h-[200px] sm:max-h-[250px] rounded-b-xl overflow-y-auto scrollbar-thin scrollbar-thumb-slate-600 scrollbar-track-darkblue-300">
            
                    @foreach ($lendings as $lending)
                    <div class="px-4 py-3 bg-darkblue-300 border-b border-darkblue-200 flex justify-between items-center">
            
                        <!-- Item Info -->
                        <div class="flex items-start space-x-2">
                            <div class="w-4 h-4 mt-1 {{ $lending->status === 'Lending' ? 'bg-yellow-500' : 'bg-green-500' }} rounded-full">
                            </div>
                            <div class="flex flex-col">
                                <h1 class="text-sm font-medium text-slate-300">{{ Str::limit($lending->items->name, 25) }}</h1>
                                <p class="text-xs text-slate-500">{{ $lending->status }}</p>
                                <p class="text-xs mt-1 text-slate-500">Must Return: <span class="text-indigo-400">{{ $lending->return_date }}</span></p>
                            </div>
                        </div>
            
                        <!-- Return Button -->
                        <div>
                            <button class="text-indigo-500 text-sm font-semibold hover:underline">Return</button>
                        </div>
                    </div>
                    @endforeach
            
                </div>
            </div>

            <div
                class="flex flex-col items-start justify-start mt-6 px-4 pt-4 rounded-xl bg-darkblue-200 h-[250px] sm:h-[300px]">
                <h1 class="mb-4 text-2xl text-slate-400">Pending Request</h1>
            </div>
            <div
                class="flex flex-col items-start justify-start mt-6 px-4 pt-4 rounded-xl bg-darkblue-200 h-[250px] sm:h-[300px]">
                <h1 class="mb-4 text-2xl text-slate-400">Borrow History</h1>
            </div>
        </div>
    </main>
</x-layout>
