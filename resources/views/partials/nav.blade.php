<div id="app" class="bg-gray-900 sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">

    <div class="flex items-center justify-between px-4 py-3 sm:p-0">
        <div class="flex text-left flex-no-shrink mr-0">
            <a class="flex text-base  no-underline hover:text-mstore hover:no-underline" href="/">
                 @include('partials.logo')
            </a>

        </div>

        <div class="block sm:hidden">
            <button class="navbar-burger block  text-blue-500 hover:text-white focus:text-white focus:outline-none">
                <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                <path  fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                </svg>
            </button>
        </div>
    </div>
    <div id="main-nav" class="sm:block sm:w-auto hidden">
        <div class="px-2 pt-2 pb-4 sm:flex sm:p-0">
            <a href="/" class="block px-2 py-1 text-white text-base rounded hover:bg-blue-700 hover:text-white">Home</a>
            <a href="/service" class="mt-1 block px-2 py-1 text-white text-base rounded hover:bg-blue-700 hover:text-white sm:mt-0 sm:ml-2">Services</a>
            <a href="/blog" class="mt-1 block px-2 py-1 text-white text-base rounded hover:bg-blue-700 hover:text-white sm:mt-0 sm:ml-2">Blog</a>
            <a href="/pages/contact" class="mt-1 block px-2 py-1 text-white text-base rounded hover:bg-blue-700 hover:text-white sm:mt-0 sm:ml-2">Contact Us</a>
            @auth
            <div class="relative group hidden sm:block sm:ml-6">
                <div class="flex items-center cursor-pointer text-base text-white  group-hover: border-gray  hover:text-blue  mt-1 px-6 mb-0 sm:mt-0">
                    <img class="h-8 w-8 border-2 border-grey-light rounded-full object-cover" src="{{ Storage::url(Auth::user()->avatar) }}"
                        alt="">
                    <span class="ml-3 text-base text-white hover:text-yellow-700">{{ Auth::user()->name }}</span>
                </div>

                <div class="w-full absolute right-0 mt-0 py-2 w-4/12 bg-white rounded-lg shadow-xl invisible group-hover:visible w-full">

                    <a href="/app"
                        class="no-underline px-4 py-2 block text-grey-900 hover:text-blue-500">
                        บัญชีโฆษณา

                    </a>

                    <hr class="border-t mx-2 border-grey-ligght">
                    <a href="{{ route('logout') }}"
                        class=" no-underline px-4 py-2 block text-grey-900 hover:text-blue-500" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}

                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @else
                <a href="{{ route('login') }}"
                class="mt-1 block px-2 py-1 text-white text-base rounded hover:bg-blue-700 hover:text-white sm:mt-0 sm:ml-2">Sing Up</a>

            @endauth
        </div>
            @auth
            <div class="px-4 py-5 border-t border-gray-800 sm:hidden">
                <div class="flex items-center">
                    <img class="h-8 w-8 border-2 border-gray-600 rounded-full object-cover" src="{{ Storage::url(Auth::user()->avatar) }}" alt="">
                    <span class="ml-3 text-base text-black">{{ Auth::user()->name }}</span>
                </div>
                <div class="mt-4">
                    <a href="/app" class="px-2 py-1 mt-2 block text-white text-base rounded hover:bg-blue-700 hover:text-white sm:mt-0 sm:ml-2">บัญชีโฆษณา</a>
                    <a href="{{ route('logout') }}" class="px-2 py-1 mt-2 block text-white text-base rounded hover:bg-blue-700 hover:text-white sm:mt-0 sm:ml-2"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @endauth
    </div>
</div>


