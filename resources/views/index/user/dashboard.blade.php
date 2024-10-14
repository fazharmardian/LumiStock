<x-layout color="darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />
    <main class="sm:ml-64 sm:mt-14 mt-16">
        <div class="flex flex-col w-full px-10 pt-6 bg-darkblue-500">
            <div
                class="flex items-center justify-between px-4 sm:px-16 rounded-xl bg-darkblue-200 h-[250px] sm:h-[300px]">
                <div class="flex flex-col space-y-4 sm:space-y-6">
                    <h1
                        class="text-white text-2xl sm:text-4xl text-center sm:text-left  font-bold sm:max-w-[450px] leading-snug">
                        Hello ! Ready to manage and borrow items with ease?
                    </h1>
                    <p class="text-slate-200 text-sm sm:text-lg text-center sm:text-left max-w-[400px]">
                        Simplify management process with our advanced system designed just for you.
                    </p>
                </div>
                <div class="h-full hidden sm:block">
                    <img class="w-full h-full object-cover rounded-lg" src="{{ asset('storage/images/dash.png') }}"
                        alt="">
                </div>
            </div>

            <div class="flex-col my-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl text-slate-200">Latest Item</h1>
                    <a href="" class="px-2 text-2xl text-slate-200 hover:bg-darkblue-200 rounded-lg">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                <div class="flex w-full h-[272px] relative mt-3 overflow-x-scroll no-scrollbar">
                    <div class="flex absolute gap-x-4">
                        @foreach ($items as $item)
                            <a href="{{ route('item.show', $item->id) }}" class="flex-col justify-center items-center w-[170px] sm:w-[200px] p-3 rounded-lg bg-darkblue-200">
                                <img class="w-full h-48 object-cover rounded-lg"
                                    src="{{ asset('storage/' . $item->image) }}" alt="">
                                <div class="flex items-center mt-2">
                                    <div
                                        class="block h-3 w-3 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))]  
                                        from-green-400 via-green-300 to-green-300 rounded-full">
                                    </div>
                                    <h1 class="ml-1 text-sm text-green-300">available</h1>
                                </div>
                                <h1 class="mt-1 text-slate-200">{{ $item->name }}</h1>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </main>
</x-layout>
