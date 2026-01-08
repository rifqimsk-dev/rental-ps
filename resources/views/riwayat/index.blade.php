@extends('layouts.main')

@section('content')

<!-- HEADER -->
<header class="bg-gradient-to-r from-white to-white p-4 flex justify-between items-center shadow-md">
    <span class="font-semibold text-xl">Riwayat Orderan</span>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/250px-User_icon_2.svg.png" class="h-10" alt="" />
</header>

<main class="space-y-4 pt-3 m-3 mb-20 pb-10">
    @if ($transaction->isEmpty())
    <div class="bg-white border border-slate-200 rounded-xl p-8 text-center shadow-sm">
          <div class="flex justify-center mb-4">
            <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center">
              <i class="fas fa-inbox text-blue-500 text-2xl"></i>
            </div>
          </div>
          <h3 class="text-base font-semibold text-slate-700">Belum ada data</h3>
          <p class="text-sm text-slate-500 mt-1">
            Data belum tersedia atau belum ada yang tercatat saat ini.
          </p>
    </div>
    @endif

    @foreach ($transaction as $row)
    @php
        $color = match($row->status) {
            'cancelled'   => 'red',
            'finished'  => 'gray',
            default     => 'slate'
        };
    @endphp
    <div class="bg-white rounded-xl shadow p-4 opacity-70">
        <div class="flex justify-between items-center mb-2">
            <span class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d M Y') }}</span>
            <span class="text-xs bg-{{ $color }}-100 text-{{ $color }}-600 px-2 py-1 rounded">
                {{ $row->status }}
            </span>
        </div>
        <h3 class="font-semibold">{{ $row->customer_name }}</h3>
        <div class="text-sm text-gray-600 space-y-1">
            <p>🎮 {{ $row->playstation->type }} - {{ $row->zone->name }}</p>
            <p>⏱️ 12:00 - 14:00</p>
            <p>💰 Rp {{ number_format($row->total_price,0,",",".") }}</p>
        </div>
    </div>
    @endforeach
</main>

@include('home.create')
@include('layouts.navbar')

@endsection