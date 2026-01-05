@extends('layouts.main')

@section('content')

<!-- HEADER -->
<header class="bg-gradient-to-r from-white to-white p-4 flex justify-between items-center shadow-md">
    <div>
        <a href="{{ route('playstation.index') }}" class="text-xl">
            <i class="fas fa-arrow-left"></i>
            <span class="ms-3">Ubah / Hapus Data</span>
        </a> 
    </div>
    <button onclick="openModal()" class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-tr from-rose-600 to-rose-400 text-white shadow-xl active:scale-95 transition">
        <i class="fas fa-trash text-lg"></i>
    </button>
</header>

<main class="p-4 space-y-4">
    <!-- LIST -->
    <section class="px-6 py-6 pb-10 rounded-lg bg-white border border-slate-200 shadow-lg">
        <form action="{{ route('playstation.update', encrypt($row->id)) }}" class="" method="POST">
            @csrf
            @method('PUT')
            <small class="text-rose-500">@error('code'){{ $message }}@enderror</small>
            <input type="text" name="code" value="{{ old('code', $row->code) }}" placeholder="Code" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 mb-6"/>

            <small class="text-rose-500">@error('type'){{ $message }}@enderror</small>
            <input type="text" name="type" value="{{ old('type', $row->type) }}" placeholder="Type" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 mb-6"/>

            <small class="text-rose-500">@error('serial_number'){{ $message }}@enderror</small>
            <input type="text" name="serial_number" value="{{ old('serial_number', $row->serial_number) }}" placeholder="Serial Number" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 mb-6"/>

            <small class="text-rose-500">@error('hourly_rate'){{ $message }}@enderror</small>
            <input type="number" name="hourly_rate" value="{{ old('hourly_rate', (int)$row->hourly_rate) }}" placeholder="Hourly Rate" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 mb-6"/>

            <small class="text-rose-500">@error('notes'){{ $message }}@enderror</small>
            <input type="text" name="notes" value="{{ old('notes', $row->notes) }}" placeholder="Notes" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 mb-6"/>

            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>

    </section>
</main>

<!-- MODAL -->
<div id="addModal" class="fixed inset-x-0 bottom-0 top-16 z-50 bg-white rounded-t-2xl p-4 shadow-xl transform translate-y-full transition-transform duration-300 ease-out">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold text-slate-700">Hapus Data</h3>
        <button onclick="closeModal()" class="text-slate-400 text-xl">
            &times;
        </button>
    </div>

    <form action="{{ route('playstation.destroy', encrypt($row->id)) }}" class="space-y-3" method="POST">
        @csrf
        @method('DELETE')
        <div class="flex items-center gap-3 bg-rose-100 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl mb-3">
            <i class="fas fa-info-circle"></i>
            <span class="text-sm font-medium">Apakah anda ingin menghapus data ini ?</span>
        </div>
        <button class="w-full bg-rose-600 hover:bg-rose-700 text-white py-2 rounded-lg font-semibold transition">
            <i class="fas fa-save"></i> Ya, Hapus
        </button>
    </form>
</div>

@endsection