@props(['requests', 'green' => false, 'approved' => false])

<table class="w-full text-sm text-left rtl:text-right border-collapse">
    <thead class="text-xs text-gray-700 uppercase bg-darkblue-500 dark:bg-darkblue-300 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3 text-slate-200">No</th>
            <th scope="col" class="px-6 py-3 text-slate-200">Item</th>
            <th scope="col" class="px-6 py-3 text-slate-200">User</th>
            <th scope="col" class="px-6 py-3 text-slate-200">Total</th>
            <th scope="col" class="px-6 py-3 text-slate-200">Type</th>
            <th scope="col" class="px-6 py-3 text-slate-200">Status</th>
            <th scope="col" class="px-6 py-3 text-slate-200">Request Date</th>
            <th scope="col" class="px-6 py-3 text-slate-200">Return Date</th>
            <th scope="col" class="px-6 py-3 text-slate-200">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($requests as $request)
            <tr class="bg-darkblue-300 border-b-2 border-darkblue-500 hover:bg-darkblue-400">
                <td class="px-6 py-4 text-slate-200">
                    {{ ($requests->currentPage() - 1) * $requests->perPage() + $loop->iteration }}</td>
                <td scope="row" class="flex items-center px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <div class="ps-3">
                        <div class="text-base text-slate-200">{{ $request->item->name }}</div>
                        </th>
                <td class="px-6 py-4 text-slate-200">{{ $request->user->username }}</td>
                <td class="px-6 py-4 text-slate-200">{{ $request->total_request }}</td>
                <td class="px-6 py-4 text-slate-200">{{ $request->type }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="h-2.5 w-2.5 rounded-full {{ $green ? 'bg-green-500' : 'bg-yellow-500' }} me-2">
                        </div>
                        <span class="text-gray-500">{{ $request->status }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-slate-200">{{ $request->request_date }}</td>
                <td class="px-6 py-4 text-slate-200">
                    {{ $request->must_return ? $request->must_return . ' ' . Str::plural('day', $request->must_return) : $request->return_date }}
                </td>
                <td x-data="{ accept: false, cancelModal: false }" class="flex {{ $approved ?: 'justify-center' }} px-6 py-4 gap-x-4">
                    @if ($approved)
                        <span @click="accept = true" class="text-indigo-500">
                            <i class="fa fa-check"></i>
                        </span>
                    @endif
                    <span @click="cancelModal = true" class="text-red-500">
                        <i class="fa fa-xmark"></i>
                    </span>

                    {{-- Accept Modal --}}
                    <div x-show="accept" class="fixed inset-0  z-50 flex justify-center items-center bg-black/50"
                        x-cloak>
                        <div @click.outside="accept = false"
                            class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl text-slate-200">Accept Request</h2>
                                <span @click="accept = false" class="cursor-pointer text-slate-200">
                                    <i class="fa fa-x"></i>
                                </span>
                            </div>
                            <p class="text-gray-500 mb-6">Are you sure you want to accept this
                                {{ $request->item->name }} request ?</p>
                            <div>
                                @if ($request->type === 'Renting')
                                    <form action="{{ route('lending.store') }}" method="post">
                                        @csrf

                                        <input type="hidden" name="request_id" value="{{ $request->id }}">
                                        <input type="text" name="id_user" value="{{ $request->id_user }}" hidden>
                                        <input type="text" name="id_item" value="{{ $request->id_item }}" hidden>
                                        <input type="text" name="total_request"
                                            value="{{ $request->total_request }}" hidden>
                                        <input type="number" name="must_return" value="{{ $request->must_return }}"
                                            hidden>
                                        <input type="text" name="status" value="Lending" hidden>

                                        <div class="flex justify-between">
                                            <div class="block"></div>
                                            <button type="submit"
                                                class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-700 transition">
                                                <span>
                                                    <i class="fa fa-check"></i>
                                                </span>
                                                <span class="ms-1">
                                                    Accept
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                @elseif ($request->type === 'Returning')
                                    <form
                                        action="{{ $request->rent_id ? route('lending.update', $request->rent_id) : '#' }}"
                                        method="post">
                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="id_request" value="{{ $request->id }}">
                                        <input type="hidden" name="id_item" value="{{ $request->id_item }}">
                                        <input type="text" name="total_request"
                                            value="{{ $request->total_request }}" hidden>
                                        <input type="hidden" name="status" value="Returned">
                                        <div class="flex justify-between">
                                            <div class="block"></div>
                                            <button type="submit"
                                                class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-700 transition">
                                                <span>
                                                    <i class="fa fa-check"></i>
                                                </span>
                                                <span class="ms-1">
                                                    Accept
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- Cancel Modal --}}
                    <div x-show="cancelModal" x-cloak class="fixed inset-0 z-50 flex justify-center items-center bg-black/50">
                        <div @click.outside="cancelModal = false"
                            class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl text-slate-200">Delete Request</h2>
                                <span @click="cancelModal = false" class="cursor-pointer text-slate-200">
                                    <i class="fa fa-x"></i>
                                </span>
                            </div>
                            <p class="text-gray-500 mb-6">Are you sure you want to delete this request ?</p>
                            <form action="{{ route('request.destroy', $request) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <div class="flex justify-between">
                                    <div class="block"></div>
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800 transition">
                                        <i class="fa fa-xmark"></i>
                                        <span class="ms-1">Delete</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="px-6 py-4 text-slate-200">
                    <div class="flex justify-center items-center h-full">
                        No Items found.
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
