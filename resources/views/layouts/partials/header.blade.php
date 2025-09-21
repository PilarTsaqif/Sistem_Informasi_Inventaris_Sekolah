<header class="flex justify-between items-center p-4 bg-white border-b">
    <div class="md:hidden">
        <button @click.stop="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>

    <div class="font-bold text-xl text-gray-700">
        @yield('title')
    </div>

    @auth
    <div class="flex items-center space-x-4">
        <span>Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span></span>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-gray-600 hover:text-blue-500" title="Logout">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </button>
        </form>
    </div>
    @endauth
</header>