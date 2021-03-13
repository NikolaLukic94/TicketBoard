{{--<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">--}}
{{--    @if (Route::has('login'))--}}
{{--        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">--}}
{{--            @auth--}}
{{--                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>--}}
{{--            @else--}}
{{--                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>--}}

{{--                @if (Route::has('register'))--}}
{{--                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>--}}
{{--                @endif--}}
{{--            @endauth--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    @include('partials.canvas')--}}
{{--</div>--}}
<nav class="nav flex flex-wrap items-center justify-between px-4">
    <div class="flex flex-no-shrink items-center mr-6 py-3 text-grey-darkest">
{{--        <li class="border-t md:border-none">--}}
{{--            <p--}}
{{--                class="block md:inline-block px-4 py-2 no-underline promotion transform p-4 text-white mr-4">Ticketing </p>--}}
{{--        </li>--}}
    </div>

    <input class="menu-btn hidden" type="checkbox" id="menu-btn">
    <label class="menu-icon block cursor-pointer md:hidden px-2 py-4 relative select-none" for="menu-btn">
        <span class="navicon bg-grey-darkest flex items-center relative"></span>
    </label>

    <ul class="menu border-b md:border-none flex justify-end list-reset m-0 w-full md:w-auto mt-2">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            <li class="border-t md:border-none">
                <a href="/"
                   class="block md:inline-block px-4 py-3 no-underline text-grey-darkest hover:text-grey-darker font-bold">Home</a>
            </li>
        @else
            <li class="border-t md:border-none">
                <a href="{{ route('login') }}"
                   class="block md:inline-block px-4 py-2 no-underline promotion transform p-4 text-white mr-4">Login</a>
            </li>


            @if (Route::has('register'))
                {{--                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>--}}
                <li class="border-t md:border-none">
                    <a href="{{ route('register') }}"
                       class="block md:inline-block px-4 py-2 no-underline promotion transform p-4 text-white mr-4">Register</a>
                </li>
            @endif
        @endauth
    </ul>
</nav>

<style>
    .promotion {
        background-color: #1a202c;
    }

    .promotion:hover {
        background-color: #fff;
        color: #1a202c;
        border: 1px solid #1a202c;
        font-weight: bold;
    }
</style>
