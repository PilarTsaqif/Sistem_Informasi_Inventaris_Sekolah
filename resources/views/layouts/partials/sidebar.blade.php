<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0 md:shadow-none flex flex-col border-r border-gray-200">
    
    <div class="flex-shrink-0 flex items-center justify-center h-16 border-b border-gray-200">
        <span class="font-bold text-xl text-blue-600 tracking-wide">Menu Inventaris</span>
    </div>

    <nav class="mt-4 px-2 flex-1 overflow-y-auto">
        <div class="space-y-1">
            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-medium">Dashboard</span>
            </x-sidebar-link>
        </div>

        <div class="mt-4">
            <p class="px-2 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Ruang Praktik</p>
            <div class="space-y-1">
                @foreach($ruangansForSidebar as $ruangan)
                    <x-sidebar-link :href="route('fasilitas.index', $ruangan->id)" :active="request()->routeIs('fasilitas.*') && request()->route('ruangan')?->id == $ruangan->id">
                         <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <span class="font-medium">{{ $ruangan->nama_ruangan }}</span>
                    </x-sidebar-link>
                @endforeach
            </div>
        </div>

        <div class="mt-4">
            <p class="px-2 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Inventaris</p>
            <div class="space-y-1">
                <x-sidebar-link :href="route('barang-masuk.index')" :active="request()->routeIs('barang-masuk.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="font-medium">Barang Masuk</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('barang-keluar.index')" :active="request()->routeIs('barang-keluar.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path></svg>
                    <span class="font-medium">Barang Keluar</span>
                </x-sidebar-link>
                 <x-sidebar-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4"></path></svg>
                    <span class="font-medium">Peminjaman</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('pengembalian.index')" :active="request()->routeIs('pengembalian.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path></svg>
                    <span class="font-medium">Pengembalian</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('stok-barang.index')" :active="request()->routeIs('stok-barang.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    <span class="font-medium">Laporan Stok</span>
                </x-sidebar-link>
            </div>
        </div>

        @can('is-toolman')
        <div class="mt-4">
            <p class="px-2 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Data Master</p>
            <div class="space-y-1">
                <x-sidebar-link :href="route('master.barang.index')" :active="request()->routeIs('master.barang.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    <span class="font-medium">Data Barang</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('master.kategori-barang.index')" :active="request()->routeIs('master.kategori-barang.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span class="font-medium">Kategori Barang</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('master.satuan.index')" :active="request()->routeIs('master.satuan.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A2 2 0 013 12V7a4 4 0 014-4z"></path></svg>
                    <span class="font-medium">Satuan Barang</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('master.pemasok.index')" :active="request()->routeIs('master.pemasok.*')">
                     <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="font-medium">Pemasok</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('master.jurusan.index')" :active="request()->routeIs('master.jurusan.*')">
                     <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-9.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6"></path></svg>
                    <span class="font-medium">Jurusan</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('master.ruangan.index')" :active="request()->routeIs('master.ruangan.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="font-medium">Ruangan</span>
                </x-sidebar-link>
            </div>
        </div>
        <div class="mt-4">
            <p class="px-2 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Administrasi</p>
             <div class="space-y-1">
                <x-sidebar-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-1a6 6 0 00-5.197-5.975M15 21H9"></path></svg>
                    <span class="font-medium">Manajemen User</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0 -3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.096 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="font-medium">Manajemen Role</span>
                </x-sidebar-link>
             </div>
        </div>
        @endcan
    </nav>
</aside>