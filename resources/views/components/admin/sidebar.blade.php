<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-50 w-64 h-screen bg-darkblue-300 transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <a href="/" class="flex self-start my-4 ml-1">
            <span
                class="text-xl font-semibold sm:text-2xl whitespace-nowrap text-slate-200">LumiStock</span>
        </a>
        <ul class="mt-4 space-y-2 font-medium">

            <li>
                <x-sidelink href="/" :active="request()->is('admin/dashboard')"> 
                    <span class="flex items-center justify-center w-5 h-5 mb-1 text-slate-200 transition duration-75">
                        <i class="fa fa-gauge"></i>
                    </span>
                    <span class="ms-3">Dashboard</span>
                </x-sidelink>
            </li>

            <p class="ml-2 text-sm text-slate-200">Manage</p>

            <li>
                <x-sidelink href="{{ route('user.index') }}" :active="request()->is('admin/user')"> 
                    <span class="flex items-center justify-center w-5 h-5 mb-1 text-slate-200 transition duration-75">
                        <i class="fa fa-user"></i>
                    </span>
                    <span class="ms-3">User</span>
                </x-sidelink>
            </li>
            <li>
                <x-sidelink href="{{ route('item.index') }}" :active="request()->is('items')"> 
                    <span class="flex items-center justify-center w-5 h-5 text-slate-200 transition duration-75">
                        <i class="fa fa-box-open"></i>
                    </span>
                    <span class="ms-3">Item</span>
                </x-sidelink>
            </li>
            <li>
                <x-sidelink href="{{ route('request.index') }}" :active="request()->is('admin/request')"> 
                    <span class="flex items-center justify-center w-5 h-5 text-slate-200 transition duration-75">
                        <i class="fa fa-bell-concierge"></i>
                    </span>
                    <span class="ms-3">Request</span>
                </x-sidelink>
            </li>
            <li>
                <x-sidelink href="/" :active="request()->is('admin/lending')"> 
                    <span class="flex items-center justify-center w-5 h-5 mb-1 text-slate-200 transition duration-75">
                        <i class="fa fa-book-open"></i>
                    </span>
                    <span class="ms-3">Lending</span>
                </x-sidelink>
            </li>
            <p class="ml-2 text-sm text-slate-200">More</p>
            <li>
                <x-sidelink href="/" :active="request()->is('setting')"> 
                    <span class="flex items-center justify-center w-5 h-5 mb-1 text-slate-200 transition duration-75">
                        <i class="fa fa-gear"></i>
                    </span>
                    <span class="ms-3">Setting</span>
                </x-sidelink>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" 
                class="flex items-center p-2 text-slate-200 rounded-lg hover:bg-darkblue-100 group">
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