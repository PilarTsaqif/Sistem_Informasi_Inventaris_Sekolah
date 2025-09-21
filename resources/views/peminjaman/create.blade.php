@extends('layouts.app')
@section('title', 'Buat Peminjaman')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Peminjaman Barang</h2>
    @if ($errors->any())<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert"><ul class="list-disc list-inside text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-6">@csrf @include('peminjaman.partials.form-fields')</form>
</div>
@endsection