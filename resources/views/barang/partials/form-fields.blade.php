<div>
    <label for="kode_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
    <input type="text" id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang ?? null) }}" 
           {{ isset($barang) ? 'disabled' : 'required' }} 
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ isset($barang) ? 'bg-gray-100' : '' }}">
    @if(isset($barang))<p class="mt-1 text-xs text-gray-500">Kode barang tidak dapat diubah.</p>@endif
</div>
<div><label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label><input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? null) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
<div><label for="kategori_barang_id" class="block text-sm font-medium text-gray-700">Kategori Barang</label><select name="kategori_barang_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><option value="">-- Pilih Kategori --</option>@foreach($kategoriBarangs as $kategori)<option value="{{ $kategori->id }}" {{ old('kategori_barang_id', $barang->kategori_barang_id ?? null) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>@endforeach</select></div>
<div><label for="id_satuanbarang" class="block text-sm font-medium text-gray-700">Satuan</label><select name="id_satuanbarang" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><option value="">-- Pilih Satuan --</option>@foreach($satuans as $satuan)<option value="{{ $satuan->id }}" {{ old('id_satuanbarang', $barang->id_satuanbarang ?? null) == $satuan->id ? 'selected' : '' }}>{{ $satuan->nama_satuan }}</option>@endforeach</select></div>
<div><label for="stok_minimal" class="block text-sm font-medium text-gray-700">Batas Stok Minimal</label><input type="number" name="stok_minimal" value="{{ old('stok_minimal', $barang->stok_minimal ?? 5) }}" required min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><p class="mt-1 text-xs text-gray-500">Akan memicu status "Menipis" di laporan stok.</p></div>
<div><label for="info_maintenance" class="block text-sm font-medium text-gray-700">Info Maintenance <span class="text-gray-400">(Opsional)</span></label><input type="text" name="info_maintenance" value="{{ old('info_maintenance', $barang->info_maintenance ?? null) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: Rutin per 3 bulan"></div>
<div class="flex justify-end space-x-4 pt-4 border-t mt-6">
    <a href="{{ route('barang.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Batal</a>
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 font-medium">{{ isset($barang) ? 'Update Barang' : 'Simpan Barang' }}</button>
</div>