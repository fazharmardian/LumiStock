<x-layout color="bg-darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:my-14 mt-16">
        <div class="flex flex-col w-full px-4 sm:px-10 pt-6">

            <div class="flex flex-col items-start justify-start pt-4 rounded-xl bg-darkblue-400 h-[250px] sm:h-[300px]">
                <h1 class="mb-4 mx-4 text-2xl text-slate-400">Your Borrowed Items</h1>

                <div
                    class="flex flex-col w-full max-h-[200px] sm:max-h-[250px] rounded-b-xl overflow-y-auto no-scrollbar">
                    @forelse ($lendings as $lending)
                        <div
                            class="px-4 py-3 bg-darkblue-300 border-b border-darkblue-200 flex justify-between items-center">

                            <div class="flex items-start space-x-2">
                                <div
                                    class="w-4 h-4 mt-1 {{ $lending->status === 'Lending' ? 'bg-yellow-500' : 'bg-green-500' }} rounded-full">
                                </div>
                                <div class="flex flex-col">
                                    <a href="{{ route('item.show', $lending->items) }}" class="text-sm font-medium text-slate-300 hover:text-slate-500">
                                        {{ Str::limit($lending->items->name, 25) }}</a>
                                    <p class="text-xs text-slate-500">{{ $lending->status }}</p>
                                    <p class="text-xs mt-1 text-slate-500">
                                        Must Return: <span class="text-indigo-400">{{ $lending->return_date }}</span>
                                    </p>
                                </div>
                            </div>

                            <div x-data="{ accept: false }">
                                @switch($lending->status)
                                    @case('Lending')
                                        <button @click="accept = true"
                                            class="text-indigo-500 text-sm font-semibold hover:underline">Return</button>

                                        <div x-show="accept" x-cloak
                                            class="fixed inset-0 z-50 flex justify-center items-center bg-black/50">
                                            <div @click.outside="accept = false"
                                                class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                                                <div class="flex justify-between items-center mb-4">
                                                    <h2 class="text-xl text-slate-200">Return Request</h2>
                                                    <span @click="accept = false" class="cursor-pointer text-slate-200">
                                                        <i class="fa fa-x"></i>
                                                    </span>
                                                </div>
                                                <p class="text-gray-500 mb-6">Are you sure you want to send this request?</p>
                                                <form action="{{ route('request.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="rent_id" value="{{ $lending->id }}">
                                                    <input type="hidden" name="id_user" value="{{ $lending->id_user }}">
                                                    <input type="hidden" name="id_item" value="{{ $lending->id_item }}">
                                                    <input type="hidden" name="total_request"
                                                        value="{{ $lending->total_request }}">
                                                    <input type="hidden" name="return_date"
                                                        value="{{ $lending->return_date }}">
                                                    <input type="hidden" name="status" value="Pending">
                                                    <input type="hidden" name="type" value="Returning">
                                                    <div class="flex justify-end">
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-700 transition">
                                                            <i class="fa fa-paper-plane"></i>
                                                            <span class="ms-1">Send</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @break

                                    @case('Returned')
                                        <h1 class="text-green-500 text-sm font-semibold">Returned</h1>
                                    @break

                                    @default
                                        <div class="hidden"></div>
                                @endswitch
                            </div>

                        </div>
                        @empty
                            <div class="flex justify-center items-center w-full h-full">
                                <h1 class="text-slate-500">You have no borrowed items</h1>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div
                    class="flex flex-col items-start justify-start mt-4 pt-4 rounded-xl bg-darkblue-400 h-[250px] sm:h-[300px]">
                    <h1 class="mb-4 mx-4 text-2xl text-slate-400">Pending Request</h1>

                    <div
                        class="flex flex-col w-full max-h-[200px] sm:max-h-[250px] rounded-b-xl overflow-y-auto no-scrollbar">
                        @forelse ($pendings as $pending)
                            <div
                                class="px-4 py-3 bg-darkblue-300 border-b border-darkblue-200 flex justify-between items-center">
                                <div class="flex items-start space-x-2">
                                    <div
                                        class="w-4 h-4 mt-1 {{ $pending->type === 'Renting' ? 'bg-yellow-500' : 'bg-green-500' }} rounded-full">
                                    </div>
                                    <div class="flex flex-col">
                                        <a href="{{ route('item.show', $pending->item) }}" class="text-sm font-medium text-slate-300 hover:text-slate-500">
                                            {{ Str::limit($pending->item->name, 25) }}</a>
                                        <p class="text-xs mt-1 text-slate-500">
                                            Total Request: <span
                                                class="text-indigo-400">{{ $pending->total_request }}</span>
                                        </p>
                                        <div class="flex mt-1 gap-x-2">
                                            <p class="text-xs text-slate-500">
                                                Return Date: <span
                                                    class="text-indigo-400">{{ $pending->return_date }}</span>
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                Type <span
                                                    class="{{ $pending->type === 'Renting' ? 'text-yellow-500' : 'text-green-500' }}">{{ $pending->type }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div x-data="{ open: false }">
                                    <button @click="open = true" class="text-red-500 text-sm font-semibold">Cancel</button>

                                    <div x-show="open" x-cloak
                                        class="fixed inset-0 z-50 flex justify-center items-center bg-black/50">
                                        <div @click.outside="open = false"
                                            class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                                            <div class="flex justify-between items-center mb-4">
                                                <h2 class="text-xl text-slate-200">Cancel Request</h2>
                                                <span @click="open = false" class="cursor-pointer text-slate-200">
                                                    <i class="fa fa-x"></i>
                                                </span>
                                            </div>
                                            <p class="text-gray-500 mb-6">Are you sure you wan to cancel this request ?</p>
                                            <form action="{{ route('request.destroy', $pending) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <div class="flex justify-between">
                                                    <div class="block"></div>
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800 transition">
                                                        <i class="fa fa-xmark"></i>
                                                        <span class="ms-1">Cancel</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex justify-center items-center w-full h-full">
                                <h1 class="text-slate-500">You have no pending request</h1>
                            </div>
                        @endforelse
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

                <div x-data="{ showError: {{ $errors->any() ? 'true' : 'false' }} }" x-show="showError" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="translate-y-full opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="translate-y-full opacity-0"
                    class="fixed bottom-5 right-5 z-50 flex items-center justify-between w-80 py-2 px-4 bg-red-500 text-white rounded-lg shadow-lg"
                    style="display: none;">

                    <span class="text-sm">
                        {{ $errors->first() ?? 'There was an error processing your request.' }}
                    </span>

                    <button @click="showError = false" class="ml-3 text-md">
                        <i class="fa fa-x"></i>
                    </button>
                </div>

            </div> <!-- Closing div for the main content container -->
        </main>
    </x-layout>
