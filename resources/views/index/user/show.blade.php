<x-layout color="darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:mt-14 mt-16 flex flex-col">
        <div class="flex flex-col px-6 sm:px-10 pt-4 sm:pt-6">

            <div class="flex flex-col sm:flex-row mt-4 mb-10">
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
                        <div
                            class="px-2 sm:px-3 py-1 ms-2 bg-darkblue-200 hover:bg-darkblue-300 rounded-lg inline-block w-fit">
                            <span class="text-slate-200 text-xs sm:text-sm">{{ $item->category->name }}</span>
                        </div>
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

                    <div x-data="{ open: false }" class="flex mt-2 h-10">
                        <button @click="open = true"
                            class="flex items-center justify-center px-8 sm:px-16 bg-darkblue-200 hover:bg-darkblue-300 rounded-lg text-slate-200">
                            <i class="fa fa-crosshairs mr-1 text-lg"></i>
                            <span class="text-md">Borrow</span>
                        </button>
                        <button class="ml-2 px-3 bg-darkblue-200 hover:bg-darkblue-300 rounded-lg">
                            <i class="fa fa-bookmark text-lg text-slate-200"></i>
                        </button>

                        <!-- Modal -->
                        <div x-show="open" x-transition
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
                            <div @click.outside="open = false"
                                class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                                <div class="flex justify-between">
                                    <h2 class="text-xl text-slate-200 mb-4">Borrow {{ $item->name }}</h2>
                                    <span @click="open = false" class="text-slate-200">
                                        <i class="fa fa-x"></i>
                                    </span>
                                </div>

                                <form action="{{ route('request.store') }}" method="post" x-data="formValidation()"
                                    @input="checkFormValidity()">
                                    @csrf

                                    {{-- Hidden Input --}}
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
                                    <div class="mt-2 flex flex-col">
                                        <label class="text-sm text-slate-200" for="return_date">Date</label>
                                        <input class="text-slate-200 bg-darkblue-100 border-none rounded-md"
                                            type="date" name="return_date" x-model="formData.return_date" required>
                                    </div>

                                    {{-- Total Request --}}
                                    <div x-data="{ minAmount: 1, maxAmount: {{ $item->amount }}, amount: null }" class="mt-2 flex flex-col">
                                        <label class="text-sm text-slate-200" for="total_request">Amount</label>
                                        <input
                                            class="text-slate-200 placeholder-slate-200 bg-darkblue-100 border-none rounded-md"
                                            type="number" name="total_request" id="total_request"
                                            :min="minAmount" :max="maxAmount"
                                            x-model.number="formData.total_request" required
                                            @input="if (formData.total_request > maxAmount) formData.total_request = maxAmount; 
                                                    if (formData.total_request < minAmount) formData.total_request = minAmount">
                                    </div>

                                    <div class="flex justify-end mt-6">
                                        <button type="submit"
                                            class="flex px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50"
                                            :disabled="!isFormValid">
                                            <span><i class="fa fa-paper-plane"></i></span>
                                            <span class="ms-2">Request</span>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div
                class="flex items-center justify-between px-4 sm:px-16 rounded-xl bg-darkblue-200 h-[250px] sm:h-[300px]">
            </div>
        </div>

    </main>
</x-layout>
