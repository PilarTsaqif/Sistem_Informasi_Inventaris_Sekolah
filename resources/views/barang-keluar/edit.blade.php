@extends('layouts.app')
@section('title', 'Edit Catatan Barang Keluar')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Barang Keluar</h2>
    @if ($errors->any())<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert"><ul class="list-disc list-inside text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <form action="{{ route('barang-keluar.update', $barangKeluar->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        @include('barang-keluar.partials.form-fields', ['barangKeluar' => $barangKeluar])
    </form>
</div>
@endsection