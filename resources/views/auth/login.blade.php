<x-guest-layout>
    <body class="h-full bg-gray-300 pt-40" style="background-color: #b3e6ff">
    <div class="flex items-center justify-center h-full">
        <div class="flex max-w-3xl">
            <div class="bg-white w-1/2 p-8">
                <h1 class="text-gray-600 text-3xl text-center mb-4">SIGN IN</h1>
                <form method="POST" action="{{ route('login') }}" class="text-gray-500">
                    @csrf
                    <div class="my-3">
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" placeholder="Email" name="email"
                                     :value="old('email')" required autofocus/>
                    </div>
                    <div class="my-3">
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" placeholder="Password"
                                     name="password" required autocomplete="current-password"/>
                    </div>
                    <div class="my-3 justify-between flex items-center">
                        <div>
                            <x-jet-checkbox id="remember_me" name="remember"/>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-blue-500">{{ __('Forgot your password?') }}</a>
                        @endif
                    </div>
                    <div class="my-6 flex">
                        <button class="border rounded w-full py-2 border-blue-700 bg-blue-600 text-white ml-2">SIGN IN</button>
                    </div>
                </form>
            </div>
            <div class="w-1/2">
                <img src="https://ajtaylor-electrical.co.uk/wp-content/uploads/2019/01/IT-business-support-new.jpg"
                     alt=""
                     class="w-full h-full object-cover"/>
            </div>
        </div>
    </div>
    </body>
</x-guest-layout>


