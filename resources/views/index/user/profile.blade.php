<x-layout color="bg-darkblue-500">
    <x-user.navbar />
    <x-user.sidebar />

    <main class="sm:ml-64 sm:my-14 mt-16" x-data="{ editing: false }">
        <div class="flex flex-col w-full px-4 sm:px-10 pt-6">
            <div class="relative flex flex-col rounded-xl h-[300px]">
                <!-- Hero Image -->
                <div class="relative rounded-xl overflow-hidden bg-darkblue-200 h-[200px]">
                    <div class="absolute inset-0 z-30 bg-black/50 rounded-xl"></div>
                    <img class="rounded-xl object-cover h-full w-full object-center"
                        src="{{ asset('storage/images/hero.jpg') }}">
                </div>

                <!-- Avatar and Username -->
                <div
                    class="absolute bottom-0 left-10 z-50 h-[200px] w-[200px] overflow-hidden bg-darkblue-100 rounded-full">
                    <template x-if="!editing">
                        @if (auth()->user()->avatar === '')
                            <img class="object-cover w-full h-full"
                                src="{{ asset('storage/' . auth()->user()->avatar) }}">
                        @else
                            <img class="object-cover w-full h-full"
                                src="{{ asset('storage/avatars/default_profile.jpg') }}">
                        @endif
                    </template>
                    <template x-if="editing">
                        <input type="file" name="avatar" class="w-full h-full opacity-0 cursor-pointer"
                            form="profileForm" />
                        <h1 class="text-slate-400">Input Image</h1>
                    </template>
                </div>

                <div class="ml-64 mt-2">
                    <template x-if="!editing">
                        <h1 class="capitalize text-4xl text-slate-200">{{ auth()->user()->username }}</h1>
                    </template>
                    <template x-if="editing">
                        <input type="text" name="username" value="{{ auth()->user()->username }}"
                            class="bg-darkblue-400 text-slate-200 px-2 py-1 rounded-md" form="profileForm" />
                    </template>

                    <p class="mt-1 capitalize text-lg text-slate-400">{{ auth()->user()->role }}</p>
                </div>
            </div>

            <!-- User Info Section -->
            <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="space-y-2">
                    <template x-if="!editing">
                        <p class="text-indigo-300">Email: <span
                                class="text-slate-500">{{ auth()->user()->email }}</span></p>
                    </template>
                    <template x-if="editing">
                        <input type="email" name="email" value="{{ auth()->user()->email }}"
                            class="bg-darkblue-400 text-slate-500 px-2 py-1 rounded-md border-none ring-0 outline-none focus:border-none focus:ring-0 focus:outline-indigo-500" form="profileForm" />
                    </template>

                    <template x-if="!editing">
                        <p class="text-indigo-300">Joined:
                            <span class="text-slate-500">{{ auth()->user()->created_at->format('F d, Y') }}</span>
                        </p>
                    </template>
                    <template x-if="editing">
                        <input type="password" name="password" placeholder="password" value=""
                            class="bg-darkblue-400 text-slate-400 placeholder-slate-500 px-2 py-1 rounded-md border-none ring-0 outline-none focus:border-none focus:ring-0 focus:outline-indigo-500" form="profileForm" />
                    </template>

                </div>

                <div class="mt-4 sm:mt-0 flex">
                    <template x-if="!editing">
                        <button @click="editing = true" class="px-4 py-2 space-x-1 text-indigo-500 rounded-lg">
                            <span><i class="fa fa-pen"></i></span>
                            <span>Edit Profile</span>
                        </button>
                    </template>

                    <template x-if="editing">
                        <div class="flex flex-col">
                            <button type="submit" form="profileForm"
                                class="px-4 py-2 space-x-1 text-green-500 rounded-lg">
                                <span><i class="fa fa-save"></i></span>
                                <span>Save</span>
                            </button>
                            <button @click="editing = false" class="ml-2 px-4 py-2 space-x-1 text-red-500 rounded-lg">
                                <span><i class="fa fa-times"></i></span>
                                <span>Cancel</span>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-darkblue-300 rounded-xl p-6 text-center">
                    <p class="text-2xl font-bold text-slate-200">{{ $items }}</p>
                    <p class="text-slate-400">Items returned</p>
                </div>
                <div class="bg-darkblue-300 rounded-xl p-6 text-center">
                    <p class="text-2xl font-bold text-slate-200">{{ $sends }}</p>
                    <p class="text-slate-400">Request sent</p>
                </div>
                <div class="bg-darkblue-300 rounded-xl p-6 text-center">
                    <p class="text-2xl font-bold text-slate-200">{{ $approved }}</p>
                    <p class="text-slate-400">Request approved</p>
                </div>
            </div>
        </div>

        <!-- Profile Update Form -->
        <form id="profileForm" action="{{ route('profile.update', auth()->user()->id) }}" method="POST"
            enctype="multipart/form-data" class="hidden">
            @csrf
            @method('PUT')
        </form>
    </main>
</x-layout>
