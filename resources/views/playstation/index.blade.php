@extends('layouts.main')

@section('content')

<!-- HEADER -->
<header class="bg-gradient-to-r from-white to-white p-4 flex justify-between items-center shadow-md">
    <div>
        <a href="{{ route('setting') }}" class="text-xl">
            <i class="fas fa-arrow-left"></i>
            <span class="ms-3">Data Playstation</span>
        </a> 
    </div>
    <button onclick="openModal()" class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-xl active:scale-95 transition">
        <i class="fas fa-plus text-lg"></i>
    </button>
</header>

<main class="p-4 space-y-4">
    <!-- LIST -->
    <section class="space-y-3">

        @if (session('alert'))
            <div class="flex items-center gap-3 bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-3">
                <i class="fas fa-circle-check"></i>
                <span class="text-sm font-medium">{{ session('alert') }}</span>
            </div>
        @endif
        
        @foreach ($result as $row)
        <!-- CARD -->
        <a href="{{ route('playstation.edit', encrypt($row->id)) }}">
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:bg-slate-50 mb-3">
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <h3 class="font-semibold text-slate-800"><i class="fas fa-gamepad"></i> {{ $row->type }}</h3>
                    </div>

                    @php
                        $color = match($row->status) {
                            'available' => 'emerald',
                            'used' => 'blue',
                            'maintenance' => 'amber',
                            default => 'slate'
                        };
                    @endphp

                    <span class="inline-flex items-center gap-1.5 text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700 px-2.5 py-1 rounded-full">
                        <span class="w-2 h-2 bg-{{ $color }}-500 rounded-full"></span>
                        {{ $row->status }}
                    </span>
                </div>

                <div class="flex justify-between items-center text-sm text-slate-600">
                    <span>Rp {{ number_format($row->hourly_rate) }} / jam</span>
                </div>
            </div>
        </a>
        @endforeach

    </section>
</main>

<!-- MODAL -->
<div id="addModal" class="fixed inset-x-0 bottom-0 top-16 z-50 bg-white rounded-t-2xl p-4 shadow-xl transform translate-y-full transition-transform duration-300 ease-out">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold text-slate-700">Tambah Baru</h3>
        <button onclick="closeModal()" class="text-slate-400 text-xl">
            &times;
        </button>
    </div>

    <form action="{{ route('playstation.store') }}" class="space-y-3" method="POST">
        @csrf
        <small class="text-rose-500">@error('code'){{ $message }}@enderror</small>
        <input type="text" name="code" placeholder="Code" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400"/>

        <small class="text-rose-500">@error('type'){{ $message }}@enderror</small>
        <input type="text" name="type" placeholder="Type" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400"/>

        <small class="text-rose-500">@error('serial_number'){{ $message }}@enderror</small>
        <input type="text" name="serial_number" placeholder="Serial Number" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400"/>

        <small class="text-rose-500">@error('hourly_rate'){{ $message }}@enderror</small>
        <input type="number" name="hourly_rate" placeholder="Hourly Rate" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400"/>

        <small class="text-rose-500">@error('notes'){{ $message }}@enderror</small>
        <input type="text" name="notes" placeholder="Notes" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400"/>

        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
            <i class="fas fa-save"></i> Simpan
        </button>
    </form>
</div>

@endsection