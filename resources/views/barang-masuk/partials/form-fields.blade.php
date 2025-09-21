<div>
    <label for="tgl_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
    <input type="date" name="tgl_masuk" value="{{ old('tgl_masuk', isset($barangMasuk) ? $barangMasuk->tgl_masuk->format('Y-m-d') : date('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
</div>
<div>
    <label for="kode_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
    <select name="kode_barang" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        <option value="">-- Pilih Barang --</option>
        @foreach($barangs as $barang)
            <option value="{{ $barang->kode_barang }}" {{ old('kode_barang', $barangMasuk->kode_barang ?? null) == $barang->kode_barang ? 'selected' : '' }}>{{ $barang->nama_barang }}</option>
        @endforeach
    </select>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    <div>
        <label for="jumlah_masuk" class="block text-sm font-medium text-gray-700">Jumlah Masuk</label>
        <input type="number" name="jumlah_masuk" value="{{ old('jumlah_masuk', $barangMasuk->jumlah_masuk ?? null) }}" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>
    <div>
        <label for="id_satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
         <select name="id_satuan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="">-- Pilih Satuan --</option>
            @foreach($satuans as $satuan)
                <option value="{{ $satuan->id }}" {{ old('id_satuan', $barangMasuk->id_satuan ?? null) == $satuan->id ? 'selected' : '' }}>{{ $satuan->nama_satuan }}</option>
            @endforeach
        </select>
    </div>
</div>
<div>
    <label for="kondisi" class="block text-sm font-medium text-gray-700">Kondisi</label>
    <select name="kondisi" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        <option value="Baik" {{ old('kondisi', $barangMasuk->kondisi ?? 'Baik') == 'Baik' ? 'selected' : '' }}>Baik</option>
        <option value="Rusak" {{ old('kondisi', $barangMasuk->kondisi ?? null) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
    </select>
</div>
<div>
    <label for="pemasok_id" class="block text-sm font-medium text-gray-700">Pemasok / Sumber Dana <span class="text-gray-400">(Opsional)</span></label>
    <select name="pemasok_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        <option value="">-- Pilih Pemasok --</option>
        @foreach($pemasoks as $pemasok)
            <option value="{{ $pemasok->id }}" {{ old('pemasok_id', $barangMasuk->pemasok_id ?? null) == $pemasok->id ? 'selected' : '' }}>{{ $pemasok->nama_pemasok }}</option>
        @endforeach
    </select>
</div>
 <div>
    <label for="tgl_expired" class="block text-sm font-medium text-gray-700">Tanggal Expired <span class="text-gray-400">(Opsional)</span></label>
    <input type="date" name="tgl_expired" value="{{ old('tgl_expired', isset($barangMasuk) && $barangMasuk->tgl_expired ? $barangMasuk->tgl_expired->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
</div>
<div class="flex justify-end space-x-4 pt-4 border-t mt-6">
    <a href="{{ route('barang-masuk.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">Batal</a>
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 font-medium">{{ isset($barangMasuk) ? 'Update Catatan' : 'Simpan Catatan' }}</button>
</div>