<nav x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled ? 'bg-darkblue-500 border-b-2 border-whiteblue-900' : 'bg-darkblue-500 border-none'"
    class="fixed top-0 z-40 sm:pl-64 w-full transition-colors duration-300">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            {{-- Side Toggle --}}
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-slate-200 rounded-lg sm:hidden hover:bg-sky-900 focus:outline-none focus:ring-2 focus:ring-sky-700 dark:text-gray-400 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
            </div>
            {{-- Searchbar --}}
            <div class="w-full max-w-60 sm:max-w-2xl relative">
                <input
                    class="w-full pr-10 rounded-lg bg-darkblue-300 border-none focus:ring-whiteblue-500 transition duration-300 ease-in-out
                text-slate-200 placeholder-slate-200 focus:placeholder-slate-400"
                    type="search" placeholder="Search">
                <form class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <button>
                        <i class="fa-solid fa-magnifying-glass text-slate-200"></i>
                    </button>
                </form>
            </div>

            <div class="flex items-center">
                <div class="relative grid place-items-center" x-data="{ open: true }">
                    {{-- Dropdown Button --}}
                    <button @click="open = !open" type="button"
                        class="w-8 h-8 overflow-auto rounded-full bg-slate-100
                    focus:outline-none focus:ring-1 focus:ring-slate-100
                    focus:ring-offset-2 focus:ring-offset-slate-800">
                        <img src="https://picsum.photos/200" alt="">
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="open" @click.outside="open = false"
                        class="bg-darkblue-500 border-whiteblue-900 border absolute top-12 right-0 rounded-lg 
                    w-[225px] p-6 overflow-hidden font-light">

                        <div class="hover:bg-darkblue-300 divide-red-50 pl-4 pr-8 pt-2 pb-1">
                            <p class="text-md text-center font-bold text-slate-200">
                                {{ auth()->user()->username }}
                            </p>
                        </div>

                        <div class="block hover:bg-darkblue-300 text-slate-200 pl-4 pr-8 py-2">
                            <a href="/" class="flex">
                                <span>
                                    <i class="fa fa-user"></i>
                                </span>
                                <span class="ms-2">
                                    My Profile
                                </span>
                            </a>
                        </div>

                        <form action="{{ route('logout') }}" method="post"
                            class="pl-4 pr-8 py-2 hover:bg-darkblue-300">
                            @csrf
                            <button class="flex w-full text-slate-200">
                                <span class="text-slate-200">
                                    <i class="fa fa-sign-out"></i>
                                </span>
                                <span class="ms-2">
                                    Sign Out
                                </span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>
