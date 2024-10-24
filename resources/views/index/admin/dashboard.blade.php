<x-layout color="darkblue-500">
    <x-admin.navbar></x-admin.navbar>
    <x-admin.sidebar></x-admin.sidebar>
    <main class="sm:ml-64 sm:mt-14 mt-16">

        <div class="w-full pt-4 px-6 sm:px-10">
            <div class="flex items-center">
                <div class="flex flex-col">
                    <h1 class="text-2xl text-slate-200">Hello {{ auth()->user()->username }}</h1>
                    <p class="text-slate-500">Welcome to the admin panel</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-10">
                <div class="flex flex-col py-6 px-8 bg-darkblue-100 rounded-lg">
                    <div class="flex justify-start">
                        <span class="text-4xl text-indigo-500">
                            <i class="fa fa-circle-user"></i>
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <h1 class="text-md text-slate-500">Total of User</h1>
                        <h1 class="text-xl text-slate-200">{{ $total_user }}</h1>
                    </div>
                </div>
            
                <div class="flex flex-col py-6 px-8 bg-darkblue-100 rounded-lg">
                    <div class="flex justify-start">
                        <span class="text-4xl text-yellow-500">
                            <i class="fa fa-box-open"></i>
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <h1 class="text-md text-slate-500">Total of Item</h1>
                        <h1 class="text-xl text-slate-200">{{ $total_item }}</h1>
                    </div>
                </div>
            
                <div class="flex flex-col py-6 px-8 bg-darkblue-100 rounded-lg">
                    <div class="flex justify-start">
                        <span class="text-4xl text-green-500">
                            <i class="fa fa-bell-concierge"></i>
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <h1 class="text-md text-slate-500">Total of Request</h1>
                        <h1 class="text-xl text-slate-200">{{ $total_request }}</h1>
                    </div>
                </div>
            
                <div class="flex flex-col py-6 px-8 bg-darkblue-100 rounded-lg">
                    <div class="flex justify-start">
                        <span class="text-4xl text-red-500">
                            <i class="fa fa-hand-holding"></i>
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <h1 class="text-md text-slate-500">Total of Lending</h1>
                        <h1 class="text-xl text-slate-200">{{ $total_lending }}</h1>
                    </div>
                </div>
            </div>
            
            <div class="w-full mt-10 py-2 px-4 bg-darkblue-100 rounded-lg">
                <h1 class="text-2xl text-slate-200">Lending Graph</h1>
            </div>
        </div>
    </main>
</x-layout>