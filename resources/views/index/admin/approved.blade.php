<x-layout color="darkblue-500">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="sm:ml-64 sm:mt-14 mt-16">

        <div class="w-full pt-10 px-6 sm:px-10">
            <div class="px-4 py-4 bg-darkblue-300 rounded-lg">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl text-slate-200">Request</h1>
                </div>
                <div class="w-full my-3 border-t border-white/50"></div>

                <div class="relative overflow-x-auto sm:rounded-lg">
                    <div class="flex items-center justify-between flex-wrap gap-4 pb-4 md:flex-nowrap">
                        <div class="relative flex-grow md:w-auto">
                            <div class="absolute top-1 start-0 z-50 flex items-start ps-3 pointer-events-none">
                                <span class="text-gray-500">
                                    <i class="fa fa-magnifying-glass"></i>
                                </span>
                            </div>
                            <form method="GET" action="{{ route('approved.index') }}" class="relative w-full">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search items..."
                                    class="block p-2 ps-10 text-sm text-slate-200 border-none rounded-lg w-full md:w-80 
                                        bg-darkblue-100 focus:ring-0">
                            </form>
                        </div>

                        <div class="flex items-center justify-end gap-x-2">
                            <form method="GET" action="{{ route('approved.index') }}"
                                class="flex items-center gap-x-2">
                                <label for="type" class="text-sm text-gray-500">Filter by Type</label>
                                <select name="type" id="type" onchange="this.form.submit()"
                                    class="bg-darkblue-200 text-slate-200 rounded-md text-sm p-2 h-10 border-none focus:ring-0 transition duration-150 ease-in-out">
                                    <option value="">All</option>
                                    <option value="renting" {{ request('type') === 'renting' ? 'selected' : '' }}>
                                        Renting</option>
                                    <option value="returning" {{ request('type') === 'returning' ? 'selected' : '' }}>
                                        Returning</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <x-admin.requestTable :requests="$requests" :green="true"></x-admin.requestTable>
                </div>
                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 mt-4 pb-4 ">
                    <div class="block"></div>
                    <div>
                        {{ $requests->links() }}
                    </div>
                </div>

                <div x-data="{ showSuccess: {{ session('message') ? 'true' : 'false' }} }" x-show="showSuccess" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="translate-y-full opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="translate-y-full opacity-0"
                    class="fixed bottom-5 right-5 z-50 flex items-center justify-between w-72 py-2 px-4 bg-green-500 text-white rounded-lg shadow-lg"
                    style="display: none;">
                    <span class="text-sm">
                        {{ session('message') ?? 'Operation was successful!' }}
                    </span>
                    <button @click="showSuccess = false" class="ml-3 text-md">
                        <i class="fa fa-x"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>
</x-layout>
