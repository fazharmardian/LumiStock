<x-layout color="bg-darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:mt-14 my-16 flex flex-col">
        <div class="flex flex-col px-6 sm:px-10 pt-4 sm:pt-6">

            <div class="flex flex-col sm:flex-row mt-4 mb-7">
                <div class="flex-shrink-0">
                    <img class="h-40 sm:h-[267px] w-full sm:w-auto object-cover rounded-lg"
                        src="{{ asset('storage/' . $item->image) }}" alt="">
                </div>

                <div class="flex flex-col ml-0 sm:ml-4 mt-4 sm:mt-0">
                    <h1 class="text-2xl sm:text-4xl text-slate-200">
                        {{ $item->name }}
                    </h1>

                    <div class="flex mt-2">
                        <span class="text-slate-200">Status:</span>
                        <span class="ms-2 text-green-500 text-sm sm:text-base">Available</span>
                    </div>

                    <div class="flex mt-2 items-center">
                        <span class="text-slate-200">Category:</span>
                        <a href="{{ route('item', ['category' => $item->category->id]) }}" class="px-2 sm:px-3 py-1 ms-2 bg-darkblue-200 hover:bg-darkblue-300 rounded-lg inline-block w-fit">
                            <span class="text-slate-200 text-xs sm:text-sm">{{ $item->category->name }}</span>
                        </a>
                    </div>

                    <div class="my-4 max-w-full sm:max-w-[300px]">
                        <p class="text-slate-200/80 text-xs sm:text-sm sm:text-left">
                            {{ $item->description }}
                        </p>
                    </div>

                    <div class="flex items-center mt-2">
                        <span class="text-slate-200">Stock:</span>
                        <span class="ms-2 text-sm text-green-500">{{ $item->amount }}</span>
                    </div>

                    <div x-data="{ open: @if ($errors->any()) true @else false @endif }" class="flex mt-2 h-10">
                        <!-- Borrow Button -->
                        <button @click="open = true" {{ $item->amount <= 0 ? 'disabled' : '' }}
                            class="flex items-center justify-center px-8 sm:px-16 bg-darkblue-200 hover:bg-darkblue-300 rounded-lg text-slate-200">
                            <i class="fa fa-crosshairs mr-1 text-lg"></i>
                            <span class="text-md">Borrow</span>
                        </button>
                    
                        <!-- Bookmark Button -->
                        <button class="ml-2 px-3 bg-darkblue-200 hover:bg-darkblue-300 rounded-lg">
                            <i class="fa fa-bookmark text-lg text-slate-200"></i>
                        </button>
                    
                        <!-- Modal -->
                        <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
                            <div @click.outside="open = false" class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                                <div class="flex justify-between">
                                    <h2 class="text-xl text-slate-200 mb-4">Borrow {{ $item->name }}</h2>
                                    <span @click="open = false" class="text-slate-200">
                                        <i class="fa fa-x"></i>
                                    </span>
                                </div>
                    
                                <form action="{{ route('request.store') }}" method="post">
                                    @csrf
                    
                                    <input type="hidden" name="id_user" value="{{ auth()->id() }}">
                                    <input type="hidden" name="id_item" value="{{ $item->id }}">
                                    <input type="hidden" name="type" value="Renting">
                                    <input type="hidden" name="status" value="Pending">
                    
                                    {{-- Item Name --}}
                                    <div class="flex flex-col">
                                        <label class="text-sm text-slate-200" for="name">Item</label>
                                        <input class="placeholder-slate-200 bg-darkblue-100 border-none rounded-md"
                                            type="text" placeholder="{{ $item->name }}" disabled>
                                    </div>
                    
                                    {{-- Return Date --}}
                                    <div x-data="datePicker()" class="mt-2 flex flex-col">
                                        <label class="text-sm text-slate-200" for="return_date">Return Date</label>
                                        <input class="text-slate-200 bg-darkblue-100 border-none rounded-md"
                                            type="date" name="return_date" x-bind:min="minDate" x-bind:max="maxDate"
                                            x-model="returnDate" required>
                                    </div>
                    
                                    {{-- Total Request --}}
                                    <div x-data="{ minAmount: 1, maxAmount: {{ $item->amount }}, amount: null }" class="mt-2 flex flex-col">
                                        <label class="text-sm text-slate-200" for="total_request">Amount</label>
                                        <input class="text-slate-200 placeholder-slate-200 bg-darkblue-100 border-none rounded-md"
                                            type="number" name="total_request" id="total_request"
                                            :min="minAmount" :max="maxAmount" required
                                            @input="if ($event.target.value > maxAmount) $event.target.value = maxAmount;
                                                    if ($event.target.value < minAmount) $event.target.value = minAmount">
                                        @error('total_request')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                    
                                    {{-- General Errors --}}
                                    @if ($errors->any())
                                        <div class="text-red-500 text-xs mt-2">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                    
                                    <div class="flex justify-end mt-6">
                                        <button type="submit"
                                            class="flex px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                            <i class="fa fa-paper-plane"></i>
                                            <span class="ms-2">Request</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>

            <div class="flex flex-col items-start justify-start mt- rounded-xl bg-darkblue-400 h-[250px] sm:h-[300px]">
                <div class="flex flex-col w-full overflow-y-auto no-scrollbar">
                    @forelse ($lendings as $lending)
                        <div class="px-4 py-5 bg-darkblue-300 border-b border-darkblue-200 flex justify-between items-center 
                            {{ $loop->first ? 'rounded-t-xl' : '' }} 
                            {{ $loop->last ? 'rounded-b-xl border-b-0' : '' }}">
                            
                            <div class="flex items-start space-x-2">
                                <div class="w-4 h-4 mt-1 bg-yellow-500 rounded-full"></div>
                                
                                <div class="flex flex-col">
                                    <h1 class="text-sm font-medium text-slate-300">
                                        {{ Str::limit($lending->items->name, 25) }}
                                    </h1>
                                    <p class="text-xs mt-1 text-slate-500">
                                        Borrower: <span class="text-indigo-400">{{ $lending->users->username }}</span>
                                    </p>
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2">
                                        <p class="text-xs mt-1 text-slate-500">
                                            Total Borrowed: <span class="text-indigo-400">{{ $lending->total_request }}</span>
                                        </p>
                                        <p class="text-xs mt-1 text-slate-500">
                                            Return Date: <span class="text-indigo-400">{{ $lending->return_date }}</span>
                                        </p>
                                    </div>
                                    
                                </div>
                            </div>
            
                            <div>
                                <h1 class="text-yellow-500 text-sm font-semibold">
                                    {{ $lending->status }}
                                </h1>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center w-full h-full mt-28 sm:mt-36">
                            <h1 class="text-slate-500">This item is not borrowed by anyone</h1>
                        </div>
                    @endforelse
                </div>
            </div>
            
            
            <div x-data="{ showSuccess: {{ session('message') ? 'true' : 'false' }} }" x-show="showSuccess" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-full opacity-0"
                class="fixed bottom-5 right-5 z-50 flex items-center justify-between w-72 py-2 px-4 bg-green-500 text-white rounded-lg shadow-lg"
                style="display: none;">
                <span class="text-sm">
                    {{ session('success') ?? 'Operation was successful!' }}
                </span>
                <button @click="showSuccess = false" class="ml-3 text-md">
                    <i class="fa fa-x"></i>
                </button>
            </div>

        </div>

    </main>
</x-layout>
