<x-layout>
    <main>

        <div class="flex justify-center items-center bg-darkblue-700 h-svh">
            <div class="flex max-w-sm md:max-w-4xl w-full rounded-xl border border-none">
                <div class="flex justify-center pt-10 pb-6 max-w-sm sm:max-w-md w-full bg-darkblue-500 md:rounded-l-xl">

                    <form action="{{ route('login') }}" method="post" class="max-w-xs w-full mx-auto">
                        @csrf
    
                        <h1 class="text-whiteblue-500 text-3xl font-bold text-center mb-12">Sign In</h1>
    
                        <div>
                            <label for="email" class="block text-slate-200 mb-1 text-sm font-medium">Email</label>
                            <input type="text" name="email" id="email" placeholder="Enter Your Email"
                                value="{{ old('email') }}"
                                class="w-full  rounded-xl bg-darkblue-400 text-slate-200 border-none focus:border-sky-950 @error('email') border-red-500  @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
    
                        <div x-data="{ show: false }">
                            <label for="password"
                                class="block text-slate-200 mt-2 mb-1 text-sm font-medium">Password</label>
                            <input :type="show ? 'text' : 'password'" type="password" name="password" id="password"
                                placeholder="Enter Your Password"
                                class="w-full  rounded-xl bg-darkblue-400 text-slate-200 border-none focus:border-sky-950 @error('password') border-red-500  @enderror"></input>
                            
                            <div class="flex flex-row-reverse items-center mr-2 mb-2">
                                <span class="password-icon text-slate-500" toggle="password" @click="show = !show"
                                :class="{ 'block': !show, 'hidden': show }"><i class="fa fa-eye"></i></span>
                                <span class="password-icon text-slate-500" toggle="password" @click="show = !show"
                                :class="{ 'hidden': !show, 'block': show }"><i class="fa fa-eye-slash"></i></span>
                            </div>
                            
    
                            @error('password')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
    
                        </div>
    
                        <div class="flex h-5 mt-2 mb-4 justify-between items-start">
    
                            <div>
                                <input id="remember" type="checkbox" name="remember" class="checkbox" />
                                <label for="remember" class="text-sm font-medium text-slate-200">
                                    Remember me
                                </label>
                            </div>
    
                            <div>
                                <a class="text-blue-500 text-sm mt-1" href="">Forgot your password ?</a>
                            </div>
    
                        </div>
    
                        @error('failed')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
    
                        <div class="flex justify-center mt-10">
                            <button type="submit" class="w-full py-2 px-5 block text-slate-200 bg-blue-500 rounded-md">
                                Sign In
                            </button>
                        </div>
    
                        <div class="flex justify-center mt-6 text-xs">
                            <h1 class="text-slate-200 mr-2">
                                Dont have an account ?
                            </h1>
                            <a href="{{ route('register') }}" class="text-blue-500">
                                Click here
                            </a>
                        </div>
    
                    </form>
    
    
                </div>
                <div class="md:block hidden max-w-md w-full bg-darkblue-400 rounded-r-xl">
                    <div class="flex justify-center items-center h-full">
                        <div class="flex flex-col">
                            <h1 class="text-slate-200/80 text-2xl text-center font-semibold">
                                Welcome to
                            </h1>
                            <h1 class="text-whiteblue-500 text-4xl text-center font-semibold">
                                Aurora Inventory
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </main>
</x-layout>
