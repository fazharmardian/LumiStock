<x-layout color="bg-darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:my-14 mt-16">
        <div class="flex flex-col w-full px-4 sm:px-10 pt-6 bg-darkblue-500">

            <div class="flex flex-col md:flex-row items-center justify-between px-4 sm:px-16 rounded-xl 
                        bg-darkblue-200 h-auto md:h-[300px] space-y-6 md:space-y-0 md:space-x-8 py-8">

                <!-- Text Section -->
                <div class="flex-1 flex flex-col space-y-4 sm:space-y-6 text-center md:text-left">
                    <h1 class="text-white text-2xl sm:text-3xl md:text-4xl font-bold leading-snug md:max-w-[450px]">
                        Hello! Ready to manage and borrow items with ease?
                    </h1>
                    <p class="text-slate-200 text-sm sm:text-base md:text-lg max-w-[400px] mx-auto md:mx-0">
                        Simplify the management process with our advanced system designed just for you.
                    </p>
                </div>

                <!-- Image Section (Hidden on Small Screens) -->
                <div class="hidden lg:block w-full md:w-1/2 lg:w-1/3 h-[250px] md:h-full overflow-hidden rounded-lg">
                    <img class="w-full h-full object-cover" src="{{ asset('storage/images/dash.png') }}"
                        alt="Dashboard Image">
                </div>
            </div>



            <div class="flex-col my-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl text-slate-200">Latest Items</h1>
                    <a href="{{ route('item') }}" class="px-2 text-2xl text-slate-200 hover:bg-darkblue-200 rounded-lg">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

                <div class="flex w-full relative mt-3 overflow-x-auto no-scrollbar">
                    <div class="flex gap-x-4">
                        @foreach ($items as $item)
                            <a href="{{ route('item.show', $item->id) }}"
                                class="flex-col justify-center items-center w-[200px] p-3 rounded-lg bg-darkblue-200">
                                <img class="w-full h-48 object-cover rounded-lg"
                                    src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                <div class="flex items-center mt-2">
                                    <div
                                        class="block h-3 w-3 {{ $item->amount > 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full">
                                    </div>
                                    <h1
                                        class="ml-1 text-sm {{ $item->amount > 0 ? 'text-green-300' : 'text-red-300' }}">
                                        {{ $item->amount > 0 ? 'Available' : 'Not Available' }}</h1>
                                </div>
                                <h1 class="mt-1 text-slate-200">{{ Str::limit($item->name, 20, '...') }}</h1>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex mb-3 justify-start items-center">
                <h1 class="text-2xl text-slate-200">Items Category</h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">

                <div class="bg-darkblue-200 rounded-xl py-5 px-6">
                    <div class="flex mb-4 justify-between">
                        <h2 class="text-gray-300 text-xl sm:text-2xl">Cleaning</h2>
                        <a href="" class="px-2 text-xl text-slate-500 hover:bg-darkblue-500 rounded-lg">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    <div class="flex flex-col space-y-6">
                        @foreach ($books as $book)
                            <a href="{{ route('item.show', $book->id) }}"
                                class="flex items-start space-x-3 group rounded-lg">
                                <div class="w-16 h-20 overflow-hidden rounded-md bg-darkblue-400 relative">
                                    <img class="object-cover w-full h-full group-hover:opacity-60 transition-opacity duration-300"
                                        src="{{ asset('storage/' . $book->image) }}">
                                </div>
                                <div class="flex flex-col justify-between">
                                    <h1 class="text-slate-200 group-hover:text-gray-500 text-lg font-medium">
                                        {{ Str::limit($book->name, 20, '...') }}
                                    </h1>
                                    <div class="flex items-center mt-1 space-x-2">
                                        <div
                                            class="h-3 w-3 {{ $book->amount > 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full">
                                        </div>
                                        <span
                                            class="text-sm transition-colors duration-300 {{ $book->amount > 0 ? 'text-green-300 group-hover:text-green-400' : 'text-red-300 group-hover:text-red-400' }}">
                                            {{ $book->amount > 0 ? 'Available' : 'Not Available' }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="bg-darkblue-200 rounded-xl py-5 px-6">
                    <div class="flex mb-4 justify-between">
                        <h2 class="text-gray-300 text-xl sm:text-2xl">Electronics</h2>
                        <a href="" class="px-2 text-xl text-slate-500 hover:bg-darkblue-500 rounded-lg">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    <div class="flex flex-col space-y-6">
                        @foreach ($electronics as $electronic)
                            <a href="{{ route('item.show', $electronic->id) }}"
                                class="flex items-start space-x-3 group rounded-lg">
                                <div class="w-16 h-20 overflow-hidden rounded-md bg-darkblue-400 relative">
                                    <img class="object-cover w-full h-full group-hover:opacity-60 transition-opacity duration-300"
                                        src="{{ asset('storage/' . $electronic->image) }}">
                                </div>
                                <div class="flex flex-col justify-between">
                                    <h1 class="text-slate-200 group-hover:text-gray-500 text-lg font-medium">
                                        {{ Str::limit($electronic->name, 20, '...') }}
                                    </h1>
                                    <div class="flex items-center mt-1 space-x-2">
                                        <div
                                            class="h-3 w-3 {{ $electronic->amount > 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full">
                                        </div>
                                        <span
                                            class="text-sm transition-colors duration-300 {{ $electronic->amount > 0
                                                ? 'text-green-300 group-hover:text-green-400'
                                                : 'text-red-300 group-hover:text-red-400' }}">
                                            {{ $electronic->amount > 0 ? 'Available' : 'Not Available' }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="bg-darkblue-200 rounded-xl py-5 px-6">
                    <div class="flex mb-4 justify-between">
                        <h2 class="text-gray-300 text-xl sm:text-2xl">Sports</h2>
                        <a href="" class="px-2 text-xl text-slate-500 hover:bg-darkblue-400 rounded-lg">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    <div class="flex flex-col space-y-6">
                        @foreach ($furnitures as $furniture)
                            <a href="{{ route('item.show', $furniture->id) }}"
                                class="flex items-start space-x-3 group rounded-lg">
                                <div class="w-16 h-20 overflow-hidden rounded-md bg-darkblue-400 relative">
                                    <img class="object-cover w-full h-full group-hover:opacity-60 transition-opacity duration-300"
                                        src="{{ asset('storage/' . $furniture->image) }}">
                                </div>
                                <div class="flex flex-col justify-between">
                                    <h1 class="text-slate-200 group-hover:text-gray-500 text-lg font-medium">
                                        {{ Str::limit($furniture->name, 20, '...') }}
                                    </h1>
                                    <div class="flex items-center mt-1 space-x-2">
                                        <div
                                            class="h-3 w-3 {{ $furniture->amount > 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full">
                                        </div>
                                        <span
                                            class="text-sm transition-colors duration-300 {{ $furniture->amount > 0
                                                ? 'text-green-300 group-hover:text-green-400'
                                                : 'text-red-300 group-hover:text-red-400' }}">
                                            {{ $furniture->amount > 0 ? 'Available' : 'Not Available' }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </main>
</x-layout>
