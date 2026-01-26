<x-guest-layout>

    <div class="w-full max-w-md  rounded-2xl p-10 space-y-8 border border-gray-100">
        <!-- Logo/Header -->
        <div class="text-center">
            <div class="mx-auto  flex items-center justify-center ">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>
            <h1 class="text-2xl font-extrabold text-[#333333]">Welcome</h1>
            <p class="text-[#666666] mt-1 text-sm">Sign up to continue to create an account</p>
        </div>
        <form method="POST" action="{{ route('register') }}" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-[#333333] mb-1" />
                <div class="relative" x-data="{ show: false }">
                    <input :type="show ? 'text': 'password' " id="password"
                        class="w-full px-4 py-3 border border-[#E5E7EB] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4DA8DA]/80 focus:border-transparent transition placeholder:text-gray-400"
                        type="password" name="password" required autocomplete="current-password"
                        placeholder="••••••••" />
                    <button  @click="show = !show"  type="button"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#999] hover:text-[#333] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="confirm_password" :value="__('Confirm Password')"
                    class="block text-sm font-medium text-[#333333] mb-1" />
                <div class="relative" x-data="{ show :false }">
                    <input :type="show ? 'text' : 'password'" id="password_confirmation"
                        class="w-full px-4 py-3 border border-[#E5E7EB] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4DA8DA]/80 focus:border-transparent transition placeholder:text-gray-400"
                        type="password" name="password_confirmation" required autocomplete="current-password"
                        placeholder="••••••••" />
                    <button @click="show = !show"  type="button"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#999] hover:text-[#333] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-500" />
            </div>

            <div class="flex flex-row items-center  mt-4 justify-between">
        
                <x-loading-button label=" {{ __('Register') }}" class="w-96" />
                <a href="{{route('login')}}"> <span class="underline text-gray-400 text-sm hover:to-blue-500">I have an account </span> </a>
            </div>
        </form>
    </div>
</x-guest-layout>