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

        </div>
    </main>
</x-layout>
