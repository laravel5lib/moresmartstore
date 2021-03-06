{{-- <div class="bg-white shadow-md flex justify-between lg:items-center px-4 py-3  fixed top-0 inset-x-0 z-50 "> --}}
<div class="max-w-full lg:bg-white bg-gray-200 shadow-md lg:flex lg:justify-between lg:items-center px-4 py-2 fixed top-0 inset-x-0 z-50 ">
    <div class="text-left  mr-2 ">
        <a class="text-base  no-underline hover:text-mstore hover:no-underline" href="/">
            @include('partials.logo')
        </a>
    </div>
    <div class="flex items-center justify-between lg:justify-end">
        <div class="block lg:hidden">
            <button class="navbar-burger block  text-blue-500 hover:text-red-500 focus:text-gray-800 focus:outline-none">
                <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                <path  fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                </svg>
            </button>
        </div>


        @auth
        <div class="flex  items-center justify-end">
            <div id="notifications" class="block relative group ">
                <div  class="cursor-pointer ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current " viewBox="0 0 20 20" width="20" height="20">
                        <path d="M4 8a6 6 0 0 1 4.03-5.67 2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8zm8 10a2 2 0 1 1-4 0h4z"/>
                    </svg>
                </div>
                <div id="notificationsMenu" class="w-32 absolute  left-0 mt-0 p-2 bg-white rounded-lg shadow-xl invisible group-hover:visible">
                    <p class="text-sm">ไม่มีข้อความแจ้งเตือน</p>
                </div>
            </div>
            <div class="relative group block">
                <div  class="flex items-center cursor-pointer  text-gray-800  group-hover: border-gray  hover:text-blue  mt-1 px-4 mb-0 lg:mt-0">
                    <img class="h-8 w-8 border-2 border-grey-light rounded-full object-cover" src="{{ Storage::url(Auth::user()->avatar) }}"
                        alt="{{ Auth::user()->name }}">
                        <span class="no-underline px-2 py-2 block text-grey-900">{{ Auth::user()->name }}</span>

                </div>
                <div class="w-auto absolute left-0 mt-0 py-2 bg-white rounded-lg shadow-xl invisible group-hover:visible">

                    <a href="/home"
                        class="no-underline px-4 py-2 block text-grey-900 hover:text-blue-500">
                        หน้าธุรกิจของคุณ
                    </a>

                    <hr class="border-t mx-2 border-gray-light">
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
        </div>
        @endauth

    </div>
    <div id="main-nav" class="lg:block lg:w-auto hidden text-base font-medium lg:bg-white bg-blue-400 lg:rounded-none rounded-lg">
        <div class="px-2 pt-2 pb-4  lg:flex lg:p-0 ">
            <a href="/" class="block px-2 py-1 text-gray-800  rounded hover:bg-blue-700 hover:text-gray-100">หน้าหลัก</a>
            <a href="/vendors" class="mt-1 block px-2 py-1 text-gray-800  rounded hover:bg-blue-700 hover:text-gray-100 lg:mt-0 lg:ml-2">ข้อมูลธุรกิจ</a>
            <a href="/products" class="mt-1 block px-2 py-1 text-gray-800  rounded hover:bg-blue-700 hover:text-gray-100 lg:mt-0 lg:ml-2">สินค้า</a>
            <a href="/post" class="mt-1 block px-2 py-1 text-gray-800  rounded hover:bg-blue-700 hover:text-gray-100 lg:mt-0 lg:ml-2">โพส</a>
            <a href="/blogs" class="mt-1 block px-2 py-1 text-gray-800  rounded hover:bg-blue-700 hover:text-gray-100 lg:mt-0 lg:ml-2">บทความ</a>
            @guest
            <a href="{{ route('login') }}"
                class="mt-1 block px-2 py-1 text-gray-100 bg-blue-500 rounded hover:bg-red-600 hover:text-gray-100 lg:mt-0 lg:ml-2">
                Login
            </a>
            @endguest

        </div>
    </div>
</div>


