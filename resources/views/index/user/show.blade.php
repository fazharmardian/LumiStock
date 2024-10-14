<x-layout color="darkblue-500">
    <x-user.navbar/>
    <x-user.sidebar/>

    <main class="sm:ml-64 sm:mt-14 mt-16">
        <div class="px-10 pt-6">
            <div
                class="flex items-center justify-between px-4 sm:px-16 rounded-xl bg-darkblue-200 h-[225px] sm:h-[275px]">
            </div>
            <div class="flex mt-4">
                <div class="">
                    <h1 class="text-4xl text-slate-200">{{ $item->name }}</h1>
                </div>
                <button class="ml-6 px-16 bg-darkblue-200 rounded-lg">
                    <span class="mr-1 text-lg text-slate-200">
                        <i class="fa fa-crosshairs"></i>
                    </span>
                    <span class="text-md text-slate-200">
                        Borrow
                    </span>
                </button>
                <button class="ml-2 px-3 bg-darkblue-200 rounded-lg">
                    <span class="text-lg text-slate-200">
                        <i class="fa fa-bookmark"></i>
                    </span>
                </button>
            </div>
        </div>
    </main>
</x-layout>