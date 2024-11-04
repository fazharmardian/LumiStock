<aside id="logo-sidebar" aria-label="Sidebar"
    class="fixed top-0 left-0 z-50 w-64 h-screen bg-darkblue-300 transition-transform -translate-x-full sm:translate-x-0">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <a href="/" class="flex my-4 ml-6">
            <img src="" class="h-8 me-3"/>
            <span
                class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-slate-200">LumiStock</span>
        </a>
        <ul class="mt-16 space-y-2 font-medium">
            <p class="ml-2 text-sm text-slate-200">Menu</p>
            <li>
                <x-sidelink href="/" :active="request()->is('dashboard')"> 
                    <span class="flex items-center justify-center w-5 h-5 mb-1 text-slate-200 transition duration-75">
                        <i class="fa fa-house"></i>
                    </span>
                    <span class="ms-3">Home</span>
                </x-sidelink>
            </li>
            <li>
                <x-sidelink href="{{ route('item') }}" :active="request()->is('item')"> 
                    <span class="flex items-center justify-center w-5 h-5 text-slate-200 transition duration-75">
                        <i class="fa fa-box-open"></i>
                    </span>
                    <span class="ms-3">Items</span>
                </x-sidelink>
            </li>
            <li>
                <x-sidelink href="{{ route('lending') }}" :active="request()->is('lending')"> 
                    <span class="flex items-center justify-center w-5 h-5 mb-1 text-slate-200 transition duration-75">
                        <i class="fa fa-hand-holding"></i>
                    </span>
                    <span class="ms-3">Lending</span>
                </x-sidelink>
            </li>
            <li>
                <x-sidelink href="{{ route('bookmark') }}" :active="request()->is('bookmark')"> 
                    <span class="flex items-center justify-center w-5 h-5 mb-1 text-slate-200 transition duration-75">
                        <i class="fa fa-bookmark"></i>
                    </span>
                    <span class="ms-3">Bookmark</span>
                </x-sidelink>
            </li>
            <p class="ml-2 text-sm text-slate-200">More</p>
            <li>
                <x-sidelink href="/" :active="request()->is('setting')"> 
                    <span class="flex items-center justify-center w-5 h-5 mb-1 text-slate-200 transition duration-75">
                        <i class="fa fa-circle-info"></i>
                    </span> 
                    <span class="ms-3">About</span>
                </x-sidelink>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" 
                class="flex items-center p-2 text-slate-200 rounded-lg hover:bg-darkblue-100  group">
                @csrf
                    <button class="flex">
                    <span class="flex-shrink-0 w-5 h-5 text-slate-200 transition duration-75">
                        <i class="fa fa-sign-out"></i>
                    </span>
                    <span class="flex-1 ms-3">Sign Out</span>
                </button>
                </form>
            </li>
        </ul>
    </div>
</aside>