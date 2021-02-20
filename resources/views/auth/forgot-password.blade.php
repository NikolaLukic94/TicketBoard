<x-guest-layout>
    <body class="h-full bg-gray-300 pt-40" style="background-color: #b3e6ff">
    <div class="flex items-center justify-center h-full">
        <div class="flex max-w-4xl">
            <div class="bg-white w-1/2 p-8">
                <h1 class="text-gray-600 text-3xl text-center mb-4">Password Recovery</h1>
                <div class="my-3">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-4 pt-2 pb-2 text-sm text-gray-600">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>
                    <div class="my-3">
                        <x-jet-validation-errors class="mb-4"/>
                    </div>
                </div>
                <div class="my-3">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="block">
                            <x-jet-label for="email" value="{{ __('Email') }}"/>
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                         :value="old('email')" required autofocus/>
                        </div>
                        <div class="my-6 flex">
                            <button class="border rounded w-full py-2 border-blue-700 bg-blue-600 text-white ml-2">{{ __('Email Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
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


