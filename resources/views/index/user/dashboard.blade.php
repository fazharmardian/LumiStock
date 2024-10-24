<x-layout color="darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:my-14 mt-16">
        <div class="flex flex-col w-full px-10 pt-6 bg-darkblue-500">

            <div class="flex items-center justify-between px-4 sm:px-16 rounded-xl bg-darkblue-200 h-[250px] sm:h-[300px]">
                <div class="flex flex-col space-y-4 sm:space-y-6">
                    <h1
                        class="text-white text-2xl sm:text-4xl text-center sm:text-left font-bold sm:max-w-[450px] leading-snug">
                        Hello! Ready to manage and borrow items with ease?
                    </h1>
                    <p class="text-slate-200 text-sm sm:text-lg text-center sm:text-left max-w-[400px]">
                        Simplify the management process with our advanced system designed just for you.
                    </p>
                </div>
                <div class="h-full hidden sm:block">
                    <img class="w-full h-full object-cover rounded-lg" src="{{ asset('storage/images/dash.png') }}"
                        alt="">
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
                                class="flex-col justify-center items-center w-[170px] sm:w-[200px] p-3 rounded-lg bg-darkblue-200">
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

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                <div class="bg-darkblue-200 rounded-xl py-5 px-6">
                    <div class="flex mb-4 justify-between">
                        <h2 class="text-gray-300 text-xl sm:text-2xl">Books</h2>
                        <a href="" class="px-2 text-xl text-slate-500 hover:bg-darkblue-500 rounded-lg">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    <div class="flex flex-col space-y-6">
                        @foreach ($books as $book)
                        <a href="{{ route('item.show', $book->id) }}"
                            class="flex items-start space-x-3 hover:bg-darkblue-400 group rounded-lg">
                            <div class="w-16 h-20 overflow-hidden rounded-md bg-darkblue-400 relative">
                                <img class="object-cover w-full h-full group-hover:opacity-60 transition-opacity duration-300"
                                    src="{{ asset('storage/' . $book->image) }}">
                            </div>
                            <div class="flex flex-col justify-between">
                                <h1 class="text-slate-200 group-hover:text-gray-500 text-lg font-medium">
                                    {{ Str::limit($book->name, 20, '...') }}
                                </h1>
                                <div class="flex items-center mt-1 space-x-2">
                                    <div class="h-3 w-3 {{ $book->amount > 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full">
                                    </div>
                                    <span class="text-sm transition-colors duration-300 {{ $book->amount > 0
                                        ? 'text-green-300 group-hover:text-green-400'
                                        : 'text-red-300 group-hover:text-red-400' }}">
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
                            class="flex items-start space-x-3 hover:bg-darkblue-400 group rounded-lg">
                            <div class="w-16 h-20 overflow-hidden rounded-md bg-darkblue-400 relative">
                                <img class="object-cover w-full h-full group-hover:opacity-60 transition-opacity duration-300"
                                    src="{{ asset('storage/' . $electronic->image) }}">
                            </div>
                            <div class="flex flex-col justify-between">
                                <h1 class="text-slate-200 group-hover:text-gray-500 text-lg font-medium">
                                    {{ Str::limit($electronic->name, 20, '...') }}
                                </h1>
                                <div class="flex items-center mt-1 space-x-2">
                                    <div class="h-3 w-3 {{ $electronic->amount > 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full">
                                    </div>
                                    <span class="text-sm transition-colors duration-300 {{ $electronic->amount > 0
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
                        <h2 class="text-gray-300 text-xl sm:text-2xl">Furnitures</h2>
                        <a href="" class="px-2 text-xl text-slate-500 hover:bg-darkblue-500 rounded-lg">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    <div class="flex flex-col space-y-6">
                        @foreach ($furnitures as $furniture)
                            <a href="{{ route('item.show', $furniture->id) }}"
                                class="flex items-start space-x-3 hover:bg-darkblue-400 group rounded-lg">
                                <div class="w-16 h-20 overflow-hidden rounded-md bg-darkblue-400 relative">
                                    <img class="object-cover w-full h-full group-hover:opacity-60 transition-opacity duration-300"
                                        src="{{ asset('storage/' . $furniture->image) }}">
                                </div>
                                <div class="flex flex-col justify-between">
                                    <h1 class="text-slate-200 group-hover:text-gray-500 text-lg font-medium">
                                        {{ Str::limit($furniture->name, 20, '...') }}
                                    </h1>
                                    <div class="flex items-center mt-1 space-x-2">
                                        <div class="h-3 w-3 {{ $furniture->amount > 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full">
                                        </div>
                                        <span class="text-sm transition-colors duration-300 {{ $furniture->amount > 0
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
