<x-layout color="bg-darkblue-500">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="sm:ml-64 sm:mt-14 mt-16">

        <div class="w-full pt-10 px-6 sm:px-10">
            <div x-data="{ open: false }" class="px-4 py-4 bg-darkblue-300 rounded-lg">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl text-slate-200">User</h1>
                    <button @click="open = true" class="flex items-center h-10 p-3 bg-indigo-500 rounded-md">
                        <span class="text-xl text-slate-200">
                            <i class="fa fa-add"></i>
                        </span>
                    </button>

                    <!-- Add Modal -->
                    <div x-show="open" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
                        <div @click.outside="open = false" class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl text-slate-200">Add User</h2>
                                <span @click="open = false" class="cursor-pointer text-slate-200">
                                    <i class="fa fa-x"></i>
                                </span>
                            </div>
                            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <!-- User Name -->
                                <div class="flex flex-col mb-2">
                                    <label for="username" class="mb-1 text-sm text-slate-200">Username</label>
                                    <input type="text" name="username" id="username"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                        required>
                                </div>

                                <!-- Email -->
                                <div class="flex flex-col mb-2">
                                    <label for="email" class="mb-1 text-sm text-slate-200">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                        required>
                                </div>

                                <!-- Password -->
                                <div class="flex flex-col mb-2">
                                    <label for="password" class="mb-1 text-sm text-slate-200">Password</label>
                                    <input type="password" name="password" id="password"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                        required>
                                </div>

                                <!-- Role -->
                                <div class="flex flex-col mb-2">
                                    <label for="role" class="mb-1 text-sm text-slate-200">Role</label>
                                    <select name="role" id="role"
                                        class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                        required>
                                        <option value="" disabled selected>Select a role</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                        <!-- Add more roles as necessary -->
                                    </select>
                                </div>

                                <!-- Avatar -->
                                <div class="flex flex-col mb-2">
                                    <label for="avatar" class="mb-1 text-sm text-slate-200">Avatar</label>
                                    <input type="file" name="avatar" id="avatar" accept=".jpg,.jpeg,.png,.webp"
                                        class="bg-darkblue-100 text-gray-500 placeholder-gray-500 rounded-md">
                                </div>

                                <!-- Submit Button -->
                                <div class="flex flex-col justify-end mt-4">
                                    <button type="submit"
                                        class="flex items-center px-3 py-2 text-sm text-white bg-indigo-500 rounded-md hover:bg-indigo-600 transition">
                                        <i class="fa fa-plus"></i>
                                        <span class="ml-2">Add User</span>
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                <div class="w-full my-3 border-t border-white/50"></div>

                <div class="relative overflow-x-auto sm:rounded-lg">
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 ">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute top-1 start-0 z-20 flex items-center ps-3 pointer-events-none">
                                <span class="text-gray-500">
                                    <i class="fa fa-magnifying-glass"></i>
                                </span>
                            </div>
                            <form method="GET" action="{{ route('user.index') }}" class="relative mb-4">
                                <input type="text" name="search" id="table-search-input"
                                    class="block p-2 ps-10 text-sm text-slate-200 border-none rounded-lg w-80 bg-darkblue-100 focus:border-none focus:ring-0"
                                    placeholder="Search for users" value="{{ request('search') }}">
                            </form>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right border-collapse">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-darkblue-500 dark:bg-darkblue-300 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-slate-200">No</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">User</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Position</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Status</th>
                                <th scope="col" class="px-6 py-3 text-slate-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="bg-darkblue-300 border-b-2 border-darkblue-500 hover:bg-darkblue-400">
                                    <td class="px-6 py-4 text-slate-200 capitalize">
                                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                    <th scope="row"
                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="w-12 h-12 overflow-auto rounded-full bg-slate-100">
                                            @if ($user->avatar === '')
                                                <img class="object-cover w-full h-full"
                                                    src="{{ asset('storage/avatars/default_profile.jpg') }}">
                                            @else
                                                <img class="object-cover w-full h-full"
                                                    src="{{ asset('storage/' . $user->avatar) }}">
                                            @endif
                                        </div>
                                        <div class="ps-3">
                                            <div class="text-base font-semibold text-slate-200">{{ $user->username }}
                                            </div>
                                            <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4 text-slate-200 capitalize">{{ $user->role }}</td>
                                    <td class="px-6 py-4 text-slate-200 capitalize">
                                        <div class="flex items-center space-x-2">
                                            @if (Cache::has('user-is-online-' . $user->id))
                                                <div class="h-4 w-4 mb-1 bg-green-500 rounded-full"></div>
                                                <span>Online</span>
                                            @else
                                                <div class="h-4 w-4 mb-1 bg-slate-500 rounded-full"></div>
                                                <span>Offline</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td x-data="{ edit: false, openDelete: false }" class="flex items-center px-6 py-4 space-x-2">
                                        <div>
                                            <button @click="edit = true"
                                                class="font-medium text-yellow-500 hover:underline">
                                                <span><i class="fa fa-pen"></i></span>
                                            </button>
                                            <button @click="openDelete = true"
                                                class="font-medium text-red-500 hover:underline">
                                                <span><i class="fa fa-trash-can"></i></span>
                                            </button>
                                        </div>

                                        <div x-show="edit" x-transition
                                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
                                            x-cloak>
                                            <div @click.outside="edit = false"
                                                class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                                                <div class="flex justify-between items-center mb-4">
                                                    <h2 class="text-xl text-slate-200">Add User</h2>
                                                    <span @click="edit = false" class="cursor-pointer text-slate-200">
                                                        <i class="fa fa-x"></i>
                                                    </span>
                                                </div>

                                                <form action="{{ route('user.update', $user->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Username -->
                                                    <div class="flex flex-col mb-2">
                                                        <label for="username"
                                                            class="mb-1 text-sm text-slate-200">Username</label>
                                                        <input type="text" name="username" id="username"
                                                            value="{{ $user->username }}"
                                                            class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                                            required>
                                                    </div>

                                                    <!-- Email -->
                                                    <div class="flex flex-col mb-2">
                                                        <label for="email"
                                                            class="mb-1 text-sm text-slate-200">Email</label>
                                                        <input type="email" name="email" id="email"
                                                            value="{{ $user->email }}"
                                                            class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                                            required>
                                                    </div>

                                                    <!-- Password (Optional) -->
                                                    <div class="flex flex-col mb-2">
                                                        <label for="password"
                                                            class="mb-1 text-sm text-slate-200">Password</label>
                                                        <input type="password" name="password" id="password"
                                                            class="bg-darkblue-100 text-slate-200 placeholder-slate-200 rounded-md p-2 border-none focus:ring-indigo-500">
                                                        <p class="text-slate-500 text-sm mt-1">Leave blank to keep the
                                                            current password.</p>
                                                    </div>

                                                    <!-- Role -->
                                                    <div class="flex flex-col mb-2">
                                                        <label for="role"
                                                            class="mb-1 text-sm text-slate-200">Role</label>
                                                        <select name="role" id="role"
                                                            class="bg-darkblue-100 text-slate-200 rounded-md p-2 border-none focus:ring-indigo-500"
                                                            required>
                                                            <option value="user"
                                                                {{ $user->role === 'user' ? 'selected' : '' }}>User
                                                            </option>
                                                            <option value="admin"
                                                                {{ $user->role === 'admin' ? 'selected' : '' }}>Admin
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <!-- Avatar -->
                                                    <div class="flex flex-col mb-2">
                                                        <label for="avatar"
                                                            class="mb-1 text-sm text-slate-200">Avatar</label>
                                                        <div class="flex items-center space-x-4">
                                                            <img src="{{ asset('storage/' . ($user->avatar ?? 'avatars/default_profile.jpg')) }}"
                                                                alt="Current Avatar"
                                                                class="w-16 h-16 rounded-full object-cover">
                                                            <input type="file" name="avatar" id="avatar"
                                                                accept=".jpg,.jpeg,.png,.webp"
                                                                class="bg-darkblue-100 text-gray-500 rounded-md">
                                                        </div>
                                                        <p class="text-slate-500 text-sm mt-1">Leave empty to keep the
                                                            current avatar.</p>
                                                    </div>

                                                    <!-- Submit and Cancel Buttons -->
                                                    <div class="flex justify-end mt-4 space-x-2">
                                                        <button type="submit"
                                                            class="px-4 py-2 text-sm text-white bg-green-500 rounded-md hover:bg-green-600 transition">
                                                            <i class="fa fa-save"></i>
                                                            <span class="ml-2">Update User</span>
                                                        </button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                        <div x-show="openDelete" x-transition x-cloak
                                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                                            <div @click.outside="openDelete = false"
                                                class="bg-darkblue-300 rounded-lg p-6 w-[70%] sm:w-[400px]">
                                                <div class="flex justify-between items-center mb-4">
                                                    <h2 class="text-xl text-slate-200">Delete User</h2>
                                                    <span @click="openDelete = false"
                                                        class="cursor-pointer text-slate-200">
                                                        <i class="fa fa-x"></i>
                                                    </span>
                                                </div>

                                                <p class="text-slate-300 mb-6">Are you sure you want to delete this
                                                    user? This action cannot be undone.</p>

                                                <div class="flex justify-end space-x-2">

                                                    <!-- Delete Form -->
                                                    <form action="{{ route('user.destroy', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-4 py-2 text-sm text-white bg-red-500 rounded-md hover:bg-red-600 transition">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-slate-200">No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 mt-4 pb-4 ">
                    <div class="block text-transparent">
                    </div>
                    <div>
                        {{ $users->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
