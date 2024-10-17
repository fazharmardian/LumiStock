<x-layout color="darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:mt-14 mt-16 flex flex-col">
        <div class="flex flex-col px-6 sm:px-10 pt-4 sm:pt-6">

            <div class="flex flex-col sm:flex-row mt-4 mb-10">
                <div class="flex-shrink-0">
                    <img class="h-40 sm:h-[267px] w-full sm:w-auto object-cover rounded-lg"
                        src="{{ asset('storage/' . $item->image) }}" alt="">
                </div>

                <div class="flex flex-col ml-0 sm:ml-4 mt-4 sm:mt-0">
                    <h1 class="text-2xl sm:text-4xl text-slate-200">
                        {{ $item->name }}
                    </h1>

                    <div class="flex mt-2">
                        <span class="text-slate-200">Status:</span>
                        <span class="ms-2 text-green-500 text-sm sm:text-base">Available</span>
                    </div>

                    <div class="flex mt-2 items-center">
                        <span class="text-slate-200">Category:</span>
                        <div
                            class="px-2 sm:px-3 py-1 ms-2 bg-darkblue-200 hover:bg-darkblue-300 rounded-lg inline-block w-fit">
                            <span class="text-slate-200 text-xs sm:text-sm">{{ $item->category->name }}</span>
                        </div>
                    </div>

                    <div class="my-4 max-w-full sm:max-w-[300px]">
                        <p class="text-slate-200/80 text-xs sm:text-sm sm:text-left">
                            {{ $item->description }}
                        </p>
                    </div>

                    <div class="flex items-center mt-2">
                        <span class="text-slate-200">Stock:</span>
                        <span class="ms-2 text-sm text-green-500">{{ $item->amount }}</span>
                    </div>

                    <div x-data="{ open: false }" class="flex mt-2 h-10">
                        <button @click="open = true"
                            class="flex items-center justify-center px-8 sm:px-16 bg-darkblue-200 hover:bg-darkblue-300 rounded-lg text-slate-200">
                            <i class="fa fa-crosshairs mr-1 text-lg"></i>
                            <span class="text-md">Borrow</span>
                        </button>
                        <button class="ml-2 px-3 bg-darkblue-200 hover:bg-darkblue-300 rounded-lg">
                            <i class="fa fa-bookmark text-lg text-slate-200"></i>
                        </button>
                        
                        <!-- Modal -->
                        <div x-show="open" x-transition
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
                            <div @click.outside="open = false" class="bg-white rounded-lg p-6 w-[90%] sm:w-[400px]">
                                <h2 class="text-xl font-semibold mb-4">Confirm Borrow</h2>
                                <p class="text-gray-700 mb-6">Are you sure you want to borrow this item?</p>
                                <div class="flex justify-end">
                                    <button @click="open = false"
                                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg mr-2">
                                        Cancel
                                    </button>
                                    <button class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg">
                                        Confirm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div
                class="flex items-center justify-between px-4 sm:px-16 rounded-xl bg-darkblue-200 h-[250px] sm:h-[300px]">
            </div>
        </div>

    </main>
</x-layout>
