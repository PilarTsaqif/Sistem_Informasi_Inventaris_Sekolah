<div>
    <label for="tgl_keluar" class="block text-sm font-medium text-gray-700">Tanggal Keluar</label>
    <input type="date" name="tgl_keluar" value="{{ old('tgl_keluar', isset($barangKeluar) ? $barangKeluar->tgl_keluar->format('Y-m-d') : date('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
</div>
<div>
    <label for="id_barangmasuk" class="block text-sm font-medium text-gray-700">Pilih Batch Barang (Stok Tersedia)</label>
    <select name="id_barangmasuk" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        <option value="">-- Pilih Barang & Batch Masuk --</option>
        @foreach($barangMasukTersedia as $batch)
            <option value="{{ $batch->id }}" {{ old('id_barangmasuk', $barangKeluar->id_barangmasuk ?? null) == $batch->id ? 'selected' : '' }}>
                {{ $batch->barang->nama_barang }} (Masuk: {{ $batch->tgl_masuk->format('d M Y') }}) - Stok: {{ $batch->sisa_stok ?? 'N/A' }}
            </option>
        @endforeach
    </select>
</div>
<div>
    <label for="jumlah_keluar" class="block text-sm font-medium text-gray-700">Jumlah Keluar</label>
    <input type="number" name="jumlah_keluar" value="{{ old('jumlah_keluar', $barangKeluar->jumlah_keluar ?? null) }}" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
</div>
<div class="border-t pt-6 space-y-6">
    <p class="text-base font-medium text-gray-800">Data Customer</p>
    <div><label for="customer" class="block text-sm font-medium text-gray-700">Nama Customer</label><input type="text" name="customer" value="{{ old('customer', $barangKeluar->customer ?? null) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
    <div><label for="no_telp" class="block text-sm font-medium text-gray-700">No. Telepon</label><input type="text" name="no_telp" value="{{ old('no_telp', $barangKeluar->no_telp ?? null) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
    <div><label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label><textarea name="alamat" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('alamat', $barangKeluar->alamat ?? null) }}</textarea></div>
</div>
<div class="flex justify-end space-x-4 pt-4 border-t mt-6">
    <a href="{{ route('barang-keluar.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Batal</a>
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 font-medium">{{ isset($barangKeluar) ? 'Update Catatan' : 'Simpan Catatan' }}</button>
</div>