<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0 md:shadow-none flex flex-col">
    
    <div class="flex-shrink-0 flex items-center justify-center h-16 bg-blue-600 text-white shadow-md">
        <span class="font-bold text-xl tracking-wide">Inventaris SMKN 8</span>
    </div>

    <nav class="mt-4 px-3 flex-1 overflow-y-auto">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="font-medium">Dashboard</span>
        </x-sidebar-link>
        
        {{-- Grup: Ruang Praktik Siswa --}}
        <p class="px-4 mt-5 mb-2 text-sm font-semibold text-gray-500">Ruang Praktik Siswa</p>
        @if(isset($ruangansForSidebar) && $ruangansForSidebar->count() > 0)
            @foreach($ruangansForSidebar as $ruangan)
                <x-sidebar-link :href="route('fasilitas.index', $ruangan->id)" :active="request()->is('ruangan/'.$ruangan->id.'/fasilitas*')">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="font-medium">{{ ucwords(strtolower($ruangan->nama_ruangan)) }}</span>
                </x-sidebar-link>
            @endforeach
        @endif

        {{-- Grup: Manajemen Inventaris --}}
        <p class="px-4 mt-5 mb-2 text-sm font-semibold text-gray-500">Manajemen Inventaris</p>
        <x-sidebar-link :href="route('barang-masuk.index')" :active="request()->routeIs('barang-masuk.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span class="font-medium">Barang Masuk</span>
        </x-sidebar-link>
        <x-sidebar-link :href="route('barang-keluar.index')" :active="request()->routeIs('barang-keluar.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path></svg>
            <span class="font-medium">Barang Keluar</span>
        </x-sidebar-link>
        <x-sidebar-link :href="route('stok-barang.index')" :active="request()->routeIs('stok-barang.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span class="font-medium">Laporan Stok</span>
        </x-sidebar-link>

        {{-- Grup: Transaksi --}}
        <p class="px-4 mt-5 mb-2 text-sm font-semibold text-gray-500">Transaksi</p>
        <x-sidebar-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4"></path></svg>
            <span class="font-medium">Peminjaman</span>
        </x-sidebar-link>
        <x-sidebar-link :href="route('pengembalian.index')" :active="request()->routeIs('pengembalian.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path></svg>
            <span class="font-medium">Pengembalian</span>
        </x-sidebar-link>
        
        {{-- Grup: Data Master --}}
        <p class="px-4 mt-5 mb-2 text-sm font-semibold text-gray-500">Data Master</p>
        <x-sidebar-link :href="route('barang.index')" :active="request()->routeIs('barang.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
            <span class="font-medium">Data Barang</span>
        </x-sidebar-link>
        <x-sidebar-link :href="route('kategori-barang.index')" :active="request()->routeIs('kategori-barang.*')">
             <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <span class="font-medium">Kategori Barang</span>
        </x-sidebar-link>
        <x-sidebar-link :href="route('satuan.index')" :active="request()->routeIs('satuan.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A2 2 0 013 12V7a4 4 0 014-4z"></path></svg>
            <span class="font-medium">Satuan Barang</span>
        </x-sidebar-link>
        <x-sidebar-link :href="route('jurusan.index')" :active="request()->routeIs('jurusan.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path></svg>
            <span class="font-medium">Manajemen Jurusan</span>
        </x-sidebar-link>
        <x-sidebar-link :href="route('ruangan.index')" :active="request()->routeIs('ruangan.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <span class="font-medium">Manajemen Ruangan</span>
        </x-sidebar-link>
        
        {{-- Grup: Administrasi --}}
        <p class="px-4 mt-5 mb-2 text-sm font-semibold text-gray-500">Administrasi</p>
        <x-sidebar-link :href="route('users.index')" :active="request()->routeIs('users.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-1a6 6 0 00-5.197-5.975M15 21H9"></path></svg>
            <span class="font-medium">Manajemen User</span>
        </x-sidebar-link>
        <x-sidebar-link :href="route('roles.index')" :active="request()->routeIs('roles.*')">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0 -3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.096 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <span class="font-medium">Manajemen Role</span>
        </x-sidebar-link>
    </nav>
</aside>