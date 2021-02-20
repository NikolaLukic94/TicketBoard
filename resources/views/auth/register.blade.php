<x-guest-layout>
    <body class="h-full bg-gray-300 pt-40" style="background-color: #b3e6ff">
    <div class="flex items-center justify-center h-full">
        <div class="flex max-w-3xl">
            <div class="bg-white w-1/2 p-8">
                <h1 class="text-gray-600 text-3xl text-center mb-4">Register</h1>
                <form method="POST" action="{{ route('register') }}" class="text-gray-500">
                    @csrf
                    <div class="my-3">
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                     placeholder="Name" required autofocus/>
                    </div>
                    <div class="my-3">
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                     placeholder="Email" :value="old('email')" required/>
                    </div>
                    <div class="my-3">
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                     placeholder="Password"  autocomplete="new-password"/>
                    </div>
                    <div class="my-3">
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                     placeholder="Password Confirmation"  name="password_confirmation" required autocomplete="new-password"/>
                    </div>
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-jet-label for="terms">
                                <div class="flex items-center">
                                    <x-jet-checkbox name="terms" id="terms"/>

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-jet-label>
                        </div>
                    @endif
                    <div class="flex items-center justify-start mt-4 pl-2">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>
                    <div class="my-6 flex">
                        <button class="border rounded w-full py-2 border-blue-700 bg-blue-600 text-white ml-2">Register
                        </button>
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


